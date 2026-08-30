const $ = (s, p = document) => p.querySelector(s);
const $$ = (s, p = document) => [...p.querySelectorAll(s)];
const state = { csrf: '', user: null, authMode: 'register', pendingPlan: null };
const toast = (message) => { const el = $('#toast'); el.textContent = message; el.classList.add('show'); clearTimeout(el.timer); el.timer = setTimeout(() => el.classList.remove('show'), 3200); };

async function api(path, options = {}) {
  const headers = { 'Content-Type': 'application/json', ...(options.headers || {}) };
  if (state.csrf) headers['X-CSRF-Token'] = state.csrf;
  const response = await fetch(path, { credentials: 'same-origin', ...options, headers });
  const data = await response.json().catch(() => ({}));
  if (!response.ok) throw new Error(data.error || 'Request failed.');
  return data;
}

async function loadSession() {
  try { const data = await api('api/session.php'); state.csrf = data.csrf; state.user = data.user; renderAccount(); }
  catch { renderAccount(); }
}
function renderAccount() {
  const button = $('#accountButton');
  if (state.user) { button.innerHTML = `${escapeHtml(state.user.name.split(' ')[0])} · ${state.user.plan} <span>↗</span>`; button.title = 'Click to sign out'; }
  else { button.innerHTML = 'Sign in <span>→</span>'; button.title = ''; }
}

function openAuth(mode = 'register') {
  state.authMode = mode; const register = mode === 'register';
  $('#authTitle').textContent = register ? 'Create your account' : 'Welcome back';
  $('#authSubtitle').textContent = register ? 'Save scripts and unlock creator-ready campaigns.' : 'Sign in to continue creating.';
  $('#nameField').classList.toggle('hidden', !register);
  $('#nameField input').required = register;
  $('#authForm input[name=password]').autocomplete = register ? 'new-password' : 'current-password';
  $('#authForm button[type=submit]').textContent = register ? 'Create free account' : 'Sign in';
  $('#authSwitch').innerHTML = register ? 'Already have an account? <b>Sign in</b>' : 'New here? <b>Create an account</b>';
  $('#authMessage').textContent = ''; $('#authDialog').showModal();
}

$('#accountButton').addEventListener('click', async () => {
  if (!state.user) return openAuth('login');
  if (!confirm('Sign out of UGC Studio?')) return;
  try { await api('api/logout.php', { method: 'POST', body: '{}' }); state.user = null; state.csrf = ''; await loadSession(); toast('Signed out.'); } catch (e) { toast(e.message); }
});
$$('.auth-open').forEach(b => b.addEventListener('click', () => openAuth('register')));
$('.dialog-close').addEventListener('click', () => $('#authDialog').close());
$('#authSwitch').addEventListener('click', () => openAuth(state.authMode === 'register' ? 'login' : 'register'));
$('#authForm').addEventListener('submit', async (event) => {
  event.preventDefault(); const form = new FormData(event.currentTarget); const submit = $('button[type=submit]', event.currentTarget); submit.disabled = true; $('#authMessage').textContent = '';
  try {
    const data = await api(`api/${state.authMode}.php`, { method: 'POST', body: JSON.stringify(Object.fromEntries(form)) });
    state.user = data.user; state.csrf = data.csrf; renderAccount(); $('#authDialog').close(); toast(state.authMode === 'register' ? 'Account created!' : 'Welcome back!');
    if (state.pendingPlan) { const plan = state.pendingPlan; state.pendingPlan = null; startPayment(plan); }
  } catch (e) { $('#authMessage').textContent = e.message; } finally { submit.disabled = false; }
});

$$('#toneChips .chip').forEach(chip => chip.addEventListener('click', () => { $$('#toneChips .chip').forEach(c => c.classList.remove('active')); chip.classList.add('active'); }));
const clean = (value, fallback) => value.trim() || fallback;
function escapeHtml(value) { const div = document.createElement('div'); div.textContent = value; return div.innerHTML; }
function buildScript({ product, audience, platform, duration, tone }) {
  const safeProduct = escapeHtml(product); const safeAudience = escapeHtml(audience);
  const hooks = {
    'problem-solution': `If you’re ${safeAudience.toLowerCase()}, stop scrolling—this might solve the problem you deal with every day.`,
    testimonial: `I honestly didn’t expect ${safeProduct} to make this much difference, but here’s what happened.`,
    unboxing: `I just got ${safeProduct}, and I’m testing it with you for the very first time.`,
    storytime: `Quick story: I was struggling to find something that actually worked—then I found ${safeProduct}.`
  };
  const scenes = [
    ['HOOK · 0–3 SEC', hooks[tone], 'Front camera, direct eye contact. Start mid-action; add bold on-screen text.'],
    ['THE PROBLEM · 3–8 SEC', `I wanted something made for ${safeAudience.toLowerCase()}—without the usual hassle, wasted time or disappointing results.`, 'Show the frustrating “before” moment with two fast cuts.'],
    ['THE DISCOVERY · 8–15 SEC', `That’s when I tried ${safeProduct}. The first thing I noticed was how simple it felt to add to my routine.`, 'Hold the product close to camera, then demonstrate one clear use.'],
    ['THE PROOF · 15–24 SEC', `After using it, I could actually see why people recommend it. It feels practical, easy and genuinely worth trying.`, 'Show the result or benefit. Add three short benefit captions.'],
    ['CTA · FINAL 6 SEC', `If you’ve been looking for the same thing, tap below and try ${safeProduct} for yourself.`, `Return to front camera. Point toward the ${platform} call-to-action button.`]
  ];
  if (duration === '15') scenes.splice(2, 2, ['DEMO + PROOF · 6–11 SEC', `I tried ${safeProduct}, and it made the whole process feel simpler and more effective.`, 'One fast demo, one result shot, large benefit caption.']);
  return scenes.map(([label, voice, direction]) => `<div class="script-block"><b>${label}</b><p>“${voice}”</p><p class="direction">Creator direction: ${direction}</p></div>`).join('');
}
$('#generatorForm').addEventListener('submit', (event) => {
  event.preventDefault(); const product = clean($('#product').value, 'this product'); const audience = clean($('#audience').value, 'people who want a better solution'); const platform = $('#platform').value; const duration = $('#duration').value; const tone = $('#toneChips .active').dataset.value;
  $('#scriptResult').innerHTML = buildScript({ product, audience, platform, duration, tone }); $('#emptyState').classList.add('hidden'); $('#scriptResult').classList.remove('hidden'); $('#scriptMeta').textContent = `${duration} SEC · ${platform.toUpperCase()}`; toast('Your UGC script is ready.');
});
$('#copyButton').addEventListener('click', async () => { const text = $('#scriptResult').innerText; if (!text) return toast('Generate a script first.'); await navigator.clipboard.writeText(text); toast('Script copied.'); });

$$('.buy-plan').forEach(button => button.addEventListener('click', () => { const plan = button.dataset.plan; if (!state.user) { state.pendingPlan = plan; return openAuth('register'); } startPayment(plan); }));
async function startPayment(plan) {
  try {
    const order = await api('api/create-order.php', { method: 'POST', body: JSON.stringify({ plan }) });
    if (!window.Razorpay) throw new Error('Checkout could not load. Please refresh.');
    const checkout = new Razorpay({ key: order.key, amount: order.amount, currency: order.currency, name: 'Ascension UGC Studio', description: `${plan[0].toUpperCase() + plan.slice(1)} plan`, order_id: order.order_id, prefill: { name: order.name, email: state.user.email }, theme: { color: '#ff6846' }, handler: verifyPayment });
    checkout.on('payment.failed', () => toast('Payment did not complete. No plan change was made.')); checkout.open();
  } catch (e) { toast(e.message); }
}
async function verifyPayment(result) {
  try { const data = await api('api/verify-payment.php', { method: 'POST', body: JSON.stringify(result) }); state.user = data.user; renderAccount(); toast('Payment verified—your plan is active!'); }
  catch (e) { toast(e.message); }
}
loadSession();
