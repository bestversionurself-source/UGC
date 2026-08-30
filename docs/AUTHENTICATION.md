# Authentication and credential handling

## Components

| Component | Responsibility |
| --- | --- |
| `bootstrap.php` | Loads configuration, starts hardened sessions, creates the PDO connection, and provides JSON/CSRF helpers. |
| `api/register.php` | Validates new accounts, checks CSRF, hashes passwords, inserts users, and rotates the session ID. |
| `api/login.php` | Rate-limits attempts, verifies the password hash, records attempts, and rotates the session ID. |
| `api/session.php` | Returns the signed-in user's safe public fields and a fresh CSRF token. |
| `api/logout.php` | Requires CSRF, clears session state, expires the cookie, and destroys the session. |
| `api/create-order.php` | Requires a signed-in user and CSRF token; creates a Razorpay order with the secret key on the server. |
| `api/verify-payment.php` | Requires login and CSRF; verifies the Razorpay HMAC signature and records the payment. |
| `assets/app.js` | Sends credentials using same-origin cookies; it never stores passwords, session IDs, or secret keys. |

## Account request flow

1. The browser loads `/api/session.php` and receives a CSRF token plus the current safe user object, if signed in.
2. Register/login forms send JSON and the CSRF value in `X-CSRF-Token`.
3. The server validates input. Registration calls `password_hash(..., PASSWORD_DEFAULT)`; login calls `password_verify()` against the stored hash.
4. On success, the server calls `session_regenerate_id(true)` and stores only `user_id` in the server-side PHP session.
5. The browser receives the opaque session ID only through a cookie. JavaScript cannot read it because the cookie is `HttpOnly`.
6. Logout requires the CSRF token, clears server session data, expires the cookie, and destroys the session.

## Credentials and tokens

- **User password:** travels only in the HTTPS request body, is never logged by this code, and is replaced in the database by a one-way adaptive password hash.
- **Session token:** an opaque PHP-generated ID. It is not kept in `localStorage`. Cookie settings are `HttpOnly`, `SameSite=Lax`, and `Secure` when HTTPS is active.
- **CSRF token:** random 32-byte value stored server-side in the session and returned to the same-origin frontend. State-changing requests must echo it in `X-CSRF-Token`; comparison uses `hash_equals()`.
- **Database credentials:** read from `.env` at runtime and excluded by `.gitignore`; never sent to the browser.
- **Razorpay key ID:** public by design and returned only when opening checkout.
- **Razorpay key secret:** stays in `.env` on the server. It is used for Basic Auth when creating an order and for the HMAC-SHA256 verification of `order_id|payment_id`.
- **Payment signature:** comes from Razorpay Checkout and is independently recomputed on the server. A plan is not marked paid when the signatures differ.

## Payment request flow

1. Authenticated browser posts a plan to `/api/create-order.php` with CSRF.
2. Server maps the plan to a fixed server-side amount; client-provided prices are ignored.
3. Server authenticates to Razorpay with the key ID/secret and creates an order.
4. Browser opens Razorpay Checkout using the public key ID and returned order ID.
5. Checkout returns payment ID, order ID, and signature to the browser.
6. Browser posts those three values to `/api/verify-payment.php` with CSRF.
7. Server computes `HMAC-SHA256(order_id|payment_id, key_secret)`, compares it with `hash_equals()`, checks that the order belongs to the signed-in user, then records success.

## Operational notes

- Use HTTPS in production.
- Place `.env` above `public_html` if Hostinger layout allows; otherwise deny web access to dotfiles.
- Rotate database/Razorpay secrets if they are ever exposed.
- Configure Razorpay webhooks for reconciliation before accepting real payments.
- Login throttling is database-backed by IP and email; use a reverse-proxy-aware trusted IP policy if adding a CDN.
