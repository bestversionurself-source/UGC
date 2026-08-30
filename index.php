<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="Create scroll-stopping UGC ad scripts in minutes with Ascension UGC Studio.">
  <title>UGC Studio — Ads that feel human</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
  <main>
    <section class="hero shell">
      <div class="brand"><span class="brand-mark">A</span><span>ASCENSION <b>UGC STUDIO</b></span></div>
      <button class="account-pill" id="accountButton" type="button">Sign in <span>→</span></button>
      <div class="hero-copy">
        <div class="eyebrow"><span></span> Built for performance marketers</div>
        <h1>Ads that feel human.<br><em>Results that don’t.</em></h1>
        <p>Turn one product idea into a conversion-ready UGC script, shot list and creator brief—in less time than your coffee takes to cool.</p>
        <div class="hero-actions"><a class="button primary" href="#studio">Create your first ad <span>↗</span></a><a class="text-link" href="#how">See how it works <span>↓</span></a></div>
        <div class="proof"><div class="faces"><i>PR</i><i>AK</i><i>SM</i><i>+</i></div><div><b>1,200+ scripts generated</b><small>Loved by founders & creative teams</small></div></div>
      </div>
      <div class="phone-stack" aria-hidden="true">
        <div class="phone phone-back"><div class="phone-screen coral"><span class="tag">HOOK</span><strong>Wait—your morning routine is missing this.</strong><div class="creator-dot">▶</div></div></div>
        <div class="phone phone-front"><div class="phone-screen cream"><span class="record">● 00:12</span><div class="product-card">YOUR<br>PRODUCT</div><strong>“I didn’t expect<br>this to actually work…”</strong><span class="caption">Honest review ✨</span></div></div>
        <div class="float-card"><span>↗</span><div><b>3.8x ROAS</b><small>Average creator campaign</small></div></div>
      </div>
      <div class="scroll-note">SCROLL TO CREATE <span>↓</span></div>
    </section>

    <section class="studio-section" id="studio">
      <div class="section-heading"><span>01 / THE STUDIO</span><h2>Your idea. A complete<br><em>creator-ready ad.</em></h2><p>Give us the essentials. Get the words, scenes and structure your creator needs.</p></div>
      <div class="studio-card">
        <form id="generatorForm" class="brief-panel">
          <div class="step-label"><i>1</i><span>TELL US ABOUT YOUR AD<small>Everything stays editable</small></span></div>
          <label>What are you selling?<textarea id="product" required maxlength="220" placeholder="e.g. A lightweight mineral sunscreen for sensitive skin"></textarea></label>
          <div class="grid-two">
            <label>Platform<select id="platform"><option>TikTok</option><option>Instagram Reels</option><option>Facebook</option><option>YouTube Shorts</option></select></label>
            <label>Length<select id="duration"><option value="15">15 seconds</option><option value="30" selected>30 seconds</option><option value="45">45 seconds</option><option value="60">60 seconds</option></select></label>
          </div>
          <label>Who is it for?<input id="audience" maxlength="120" placeholder="e.g. Busy women aged 25–40"></label>
          <label>Creative angle<div class="chip-row" id="toneChips"><button type="button" class="chip active" data-value="problem-solution">Problem → Solution</button><button type="button" class="chip" data-value="testimonial">Testimonial</button><button type="button" class="chip" data-value="unboxing">Unboxing</button><button type="button" class="chip" data-value="storytime">Storytime</button></div></label>
          <button class="button primary wide" type="submit">Generate my UGC ad <span>✦</span></button>
        </form>
        <div class="output-panel">
          <div class="output-top"><div><span>YOUR SCRIPT</span><small id="scriptMeta">30 SEC · TIKTOK</small></div><button id="copyButton" type="button">Copy script</button></div>
          <div class="script-empty" id="emptyState"><div class="spark">✦</div><h3>Your scroll-stopper<br>starts here.</h3><p>Complete the brief and your script will appear with scenes, voiceover and creator directions.</p></div>
          <div class="script-result hidden" id="scriptResult"></div>
        </div>
      </div>
    </section>

    <section class="process shell" id="how">
      <div class="section-heading left"><span>02 / HOW IT WORKS</span><h2>From blank page to<br><em>ready to record.</em></h2></div>
      <div class="steps"><article><b>01</b><span>✎</span><h3>Brief your product</h3><p>Tell us what you sell, who needs it and the creative angle.</p></article><article><b>02</b><span>✦</span><h3>Generate your script</h3><p>Get a hook, scene-by-scene direction, voiceover and CTA.</p></article><article><b>03</b><span>▶</span><h3>Record & launch</h3><p>Copy the creator brief, record naturally and publish everywhere.</p></article></div>
    </section>

    <section class="pricing" id="pricing">
      <div class="section-heading"><span>03 / SIMPLE PRICING</span><h2>Make more winners.<br><em>Spend less guessing.</em></h2></div>
      <div class="price-grid"><article><span>START FREE</span><h3>₹0<small>/ forever</small></h3><p>Test the studio and build your first concepts.</p><ul><li>3 scripts per month</li><li>4 proven creative angles</li><li>Copy-ready output</li></ul><button class="button outline auth-open" type="button">Create free account</button></article><article class="featured"><span>MOST POPULAR</span><h3>₹499<small>/ month</small></h3><p>For founders and marketers shipping ads weekly.</p><ul><li>50 scripts per month</li><li>All platforms & durations</li><li>Creator shot lists</li><li>Priority support</li></ul><button class="button light buy-plan" data-plan="creator" type="button">Choose Creator</button></article><article><span>STUDIO</span><h3>₹1,499<small>/ month</small></h3><p>For teams running multiple brands and campaigns.</p><ul><li>Unlimited scripts</li><li>Team-ready briefs</li><li>Commercial usage</li><li>Campaign support</li></ul><button class="button outline buy-plan" data-plan="studio" type="button">Choose Studio</button></article></div>
    </section>
  </main>

  <footer><div class="brand"><span class="brand-mark">A</span><span>ASCENSION <b>UGC STUDIO</b></span></div><p>Ads that feel like recommendations, not interruptions.</p><div><a href="https://ascensionsuppliers.com/">Ascension Suppliers</a><span>© 2026</span></div></footer>

  <dialog id="authDialog"><button class="dialog-close" type="button" aria-label="Close">×</button><div class="auth-brand">ASCENSION <b>UGC STUDIO</b></div><h2 id="authTitle">Create your account</h2><p id="authSubtitle">Save scripts and unlock creator-ready campaigns.</p><form id="authForm"><label id="nameField">Full name<input name="name" autocomplete="name"></label><label>Email<input name="email" type="email" autocomplete="email" required></label><label>Password<input name="password" type="password" minlength="10" autocomplete="new-password" required><small>10+ characters with a letter and number</small></label><div class="form-message" id="authMessage"></div><button class="button primary wide" type="submit">Create free account</button></form><button class="auth-switch" id="authSwitch" type="button">Already have an account? <b>Sign in</b></button></dialog>
  <div class="toast" id="toast" role="status"></div>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="assets/app.js" defer></script>
</body>
</html>
