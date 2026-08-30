# UGC Ad Creator

A conversion-focused, full-page UGC ad script creator for Ascension Suppliers. Built for PHP 8.1+, MySQL, and Razorpay deployment on Hostinger.

## Features

- No traditional header; immersive single-page landing experience
- Interactive UGC script generator with platform, tone, audience, and duration controls
- Email/password registration and login
- Secure PHP session cookies, CSRF protection, password hashing, and rate limiting
- Razorpay server-side order creation and HMAC signature verification
- MySQL schema for users, generated projects, payments, and login attempts
- Responsive design for mobile and desktop

## Quick start

1. Copy `.env.example` to `.env` outside the public web root when possible.
2. Create a MySQL database and import `database/schema.sql`.
3. Set the database and Razorpay values in `.env`.
4. Point the domain document root at this project and use PHP 8.1 or newer.
5. Serve the site over HTTPS.

The landing page and local script generation work without a database. Account and payment actions return a clear configuration error until database credentials are set.

## Authentication overview

See [docs/AUTHENTICATION.md](docs/AUTHENTICATION.md) for components, request flow, credentials, sessions, CSRF tokens, and Razorpay signature handling.

## Security

- Never commit `.env`; it is ignored by Git.
- Passwords are stored only as `password_hash()` output.
- Razorpay secret keys remain server-side.
- Payment success is accepted only after server-side HMAC verification.
- Session identifiers are stored in `HttpOnly`, `SameSite=Lax`, secure cookies on HTTPS.

## Test

Run `php -l` over the PHP files and open `tests/security-check.php` from the command line:

```bash
find . -name '*.php' -print0 | xargs -0 -n1 php -l
php tests/security-check.php
```
