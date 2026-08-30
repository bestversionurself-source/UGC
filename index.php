<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="Premium short-form UGC videos for brands, products, apps and social media ads.">
  <meta property="og:title" content="Ascension UGC — Scroll-Stopping Videos">
  <meta property="og:description" content="Authentic, ad-ready UGC videos created to grab attention and drive action.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://learn.ascensionsuppliers.com/">
  <title>Ascension UGC — Scroll-Stopping UGC Videos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
  <div class="loader" id="loader"><span></span></div>
  <header class="site-header">
    <a class="brand" href="#home"><i>AU</i><span>ASCENSION <b>UGC</b></span></a>
    <nav aria-label="Main navigation"><a href="#home">Home</a><a href="#samples">Samples</a><a href="#packages">Packages</a><a href="#process">How It Works</a><a href="#faq">FAQ</a><a href="#contact">Contact</a></nav>
    <a class="button button-dark header-cta" href="#packages">Get Started <span>↗</span></a>
  </header>

  <main>
    <section class="hero section-shell" id="home">
      <div class="hero-copy">
        <div class="eyebrow"><span></span> CREATOR-LED CONTENT THAT CONVERTS</div>
        <h1>Scroll-Stopping UGC Videos <em>That Make People Buy</em></h1>
        <p>Authentic, engaging UGC videos created for brands, products, apps and social media advertising.</p>
        <div class="hero-actions"><a class="button button-coral" href="#packages">Get Your UGC Video <span>↗</span></a><button class="text-button watch-featured" type="button" data-video="videos/ugc1.mp4" data-title="Featured UGC Sample"><b>▶</b> Watch Sample Videos</button></div>
        <div class="badges"><span>✓ Authentic Creator Content</span><span>✓ Short-Form Video</span><span>✓ Ad-Ready Content</span><span>✓ Fast Delivery</span></div>
        <small>Perfect for Instagram Reels, Facebook Ads, TikTok, YouTube Shorts &amp; Websites</small>
      </div>
      <div class="hero-media">
        <div class="social-card s1">♥ 12.4K</div><div class="social-card s2">3.8× ROAS</div>
        <button class="hero-phone watch-featured" type="button" data-video="videos/ugc1.mp4" data-title="Featured UGC Sample" aria-label="Play featured sample">
          <div class="phone-label">UGC REVIEW</div><div class="creator-art"><span></span><i></i><b></b></div><div class="product-art">YOUR<br>PRODUCT</div><strong>“I didn't expect<br>this to work…”</strong><div class="play">▶</div>
        </button>
      </div>
    </section>

    <section class="samples section-shell" id="samples">
      <header class="section-heading"><span>OUR WORK</span><h2>See Our UGC Videos in Action</h2><p>Realistic, engaging video content designed to stop the scroll and drive action.</p></header>
      <div class="video-grid">
        <?php
        $videos = [
          ['ugc1.mp4','Product Review','Beauty & Skincare','review'],
          ['ugc2.mp4','Unboxing Video','E-commerce','unboxing'],
          ['ugc3.mp4','Problem → Solution','Wellness','solution'],
          ['ugc4.mp4','Customer Testimonial','Lifestyle','testimonial'],
          ['ugc5.mp4','Product Demo','Home & Living','demo'],
          ['ugc6.mp4','Promotional Ad','Apps & SaaS','promo'],
        ];
        foreach ($videos as $i => $video): ?>
          <button class="video-card <?= htmlspecialchars($video[3]) ?>" type="button" data-video="videos/<?= htmlspecialchars($video[0]) ?>" data-title="<?= htmlspecialchars($video[1]) ?>">
            <div class="thumb-no">0<?= $i + 1 ?></div><div class="thumb-product">PRODUCT</div><div class="video-play">▶</div>
            <div class="video-info"><span><?= htmlspecialchars($video[2]) ?></span><h3><?= htmlspecialchars($video[1]) ?></h3><small>Watch sample ↗</small></div>
          </button>
        <?php endforeach; ?>
      </div>
      <p class="placeholder-note">Sample video placeholders — replace files in <code>/videos/ugc1.mp4</code> through <code>ugc6.mp4</code> with your final portfolio videos.</p>
    </section>

    <section class="why section-shell">
      <header class="section-heading"><span>WHY UGC?</span><h2>Why Brands Choose UGC</h2></header>
      <div class="feature-grid">
        <article><i>01</i><span>◎</span><h3>Authentic</h3><p>Content that feels natural and relatable rather than like a traditional advertisement.</p></article>
        <article><i>02</i><span>↗</span><h3>Higher Engagement</h3><p>Designed specifically for short-form platforms and social media audiences.</p></article>
        <article><i>03</i><span>▶</span><h3>Ad Ready</h3><p>Videos formatted for Facebook, Instagram, TikTok, YouTube and websites.</p></article>
        <article><i>04</i><span>✦</span><h3>Conversion Focused</h3><p>Strong hooks, benefits and calls-to-action designed to encourage action.</p></article>
      </div>
    </section>

    <section class="pricing" id="packages">
      <div class="section-shell">
        <header class="section-heading"><span>SIMPLE PRICING</span><h2>Choose Your UGC Package</h2><p>Simple packages for brands at every stage.</p></header>
        <div class="price-grid">
          <article class="price-card"><div class="package-name">STARTER</div><h3>₹2,999</h3><p>Perfect for businesses testing UGC for the first time.</p><ul><li>1 UGC Video</li><li>Up to 30 Seconds</li><li>1 Hook</li><li>Product Demonstration</li><li>Natural Creator Style</li><li>Basic Editing</li><li>Captions</li><li>1 Revision</li><li>Delivery within 5–7 Days</li></ul><button class="button button-outline choose-package" data-package="Starter" type="button">Choose Starter <span>↗</span></button></article>
          <article class="price-card popular"><div class="popular-badge">MOST POPULAR</div><div class="package-name">GROWTH</div><h3>₹6,999</h3><p>Perfect for brands running social media ads.</p><ul><li>3 UGC Videos</li><li>Up to 30–45 Seconds Each</li><li>Multiple Hooks</li><li>Product Demonstration</li><li>Professional Editing</li><li>Captions &amp; Subtitles</li><li>Strong CTA</li><li>2 Revisions</li><li>Ad-Ready Format</li><li>Delivery within 5–7 Days</li></ul><button class="button button-light choose-package" data-package="Growth" type="button">Choose Growth <span>↗</span></button></article>
          <article class="price-card"><div class="package-name">PRO</div><h3>₹11,999</h3><p>Perfect for brands that need multiple creative variations.</p><ul><li>5 UGC Videos</li><li>Up to 30–60 Seconds Each</li><li>Multiple Hooks &amp; Angles</li><li>Product Demo</li><li>Testimonial Style</li><li>Professional Editing</li><li>Captions &amp; Subtitles</li><li>Multiple CTA Variations</li><li>3 Revisions</li><li>Ad-Ready Videos</li><li>Priority Delivery</li></ul><button class="button button-outline choose-package" data-package="Pro" type="button">Choose Pro <span>↗</span></button></article>
        </div>
        <p class="custom-note">Custom packages are also available for agencies and large brands. <a href="#contact">Request a quote →</a></p>
      </div>
    </section>

    <section class="process section-shell" id="process">
      <header class="section-heading"><span>OUR PROCESS</span><h2>Get Your UGC Video in 4 Simple Steps</h2></header>
      <div class="timeline">
        <article><b>01</b><h3>Choose Your Package</h3><p>Select the package that fits your campaign.</p></article>
        <article><b>02</b><h3>Send Your Product &amp; Brief</h3><p>Share your product, website, benefits and video requirements.</p></article>
        <article><b>03</b><h3>We Create Your Videos</h3><p>Your content is scripted, recorded and professionally edited.</p></article>
        <article><b>04</b><h3>Receive Your Videos</h3><p>Get ready-to-use videos for social media and advertising campaigns.</p></article>
      </div>
    </section>

    <section class="types section-shell">
      <header class="section-heading"><span>CREATIVE FORMATS</span><h2>What Kind of UGC Can We Create?</h2></header>
      <div class="type-grid"><?php foreach (['Product Review','Unboxing','Product Demonstration','Testimonial','Problem / Solution','How-To Video','Before & After','Voiceover Ad','Talking-to-Camera Ad','Social Media Ad'] as $i => $type): ?><article><span><?= str_pad((string)($i+1),2,'0',STR_PAD_LEFT) ?></span><h3><?= htmlspecialchars($type) ?></h3><b>↗</b></article><?php endforeach; ?></div>
    </section>

    <section class="hooks">
      <div class="section-shell hooks-grid">
        <div><span class="light-label">THE HOOK</span><h2>Your First 3 Seconds Matter</h2><p>We create attention-grabbing hooks designed to stop users from scrolling.</p></div>
        <div class="hook-list"><blockquote>“I didn't expect this to work...”</blockquote><blockquote>“If you're struggling with [problem], watch this.”</blockquote><blockquote>“Here's why everyone's talking about this product.”</blockquote><blockquote>“I wish I discovered this earlier.”</blockquote></div>
      </div>
    </section>

    <section class="brands section-shell">
      <header class="section-heading"><span>BUILT FOR YOUR CATEGORY</span><h2>UGC for Every Type of Brand</h2></header>
      <div class="brand-grid"><?php foreach ([['🛍','E-commerce Brands'],['📱','Apps & SaaS'],['💄','Beauty & Skincare'],['👗','Fashion'],['🍔','Food & Restaurants'],['🏠','Home & Lifestyle'],['🎓','Education'],['💻','Digital Products'],['🏢','Local Businesses'],['🚀','Startups']] as $brand): ?><article><span><?= $brand[0] ?></span><h3><?= htmlspecialchars($brand[1]) ?></h3></article><?php endforeach; ?></div>
    </section>

    <section class="testimonials">
      <div class="section-shell"><header class="section-heading"><span>SAMPLE TESTIMONIALS</span><h2>What Brands Say</h2><p>Placeholder examples shown below — replace with verified customer feedback before publishing as testimonials.</p></header>
        <div class="testimonial-grid">
          <article><div>★★★★★</div><blockquote>“The video felt authentic and performed much better than our traditional creatives.”</blockquote><b>Sarah</b><span>D2C Brand · Sample</span></article>
          <article><div>★★★★★</div><blockquote>“Great communication, fast delivery and excellent video quality.”</blockquote><b>Amit</b><span>E-commerce Founder · Sample</span></article>
          <article><div>★★★★★</div><blockquote>“The UGC videos gave us multiple creatives to test in our Facebook ads.”</blockquote><b>Rahul</b><span>Marketing Agency · Sample</span></article>
        </div>
      </div>
    </section>

    <section class="faq section-shell" id="faq">
      <div><span class="section-kicker">QUESTIONS, ANSWERED</span><h2>Frequently Asked Questions</h2><p>Need something specific? Message us for a custom recommendation.</p><a class="text-link" href="https://wa.me/919325983943?text=Hi%2C%20I%27m%20interested%20in%20your%20UGC%20video%20services.%20I%20would%20like%20to%20know%20more%20about%20the%20packages." target="_blank" rel="noopener">Ask on WhatsApp →</a></div>
      <div class="faq-list">
        <?php $faqs=[['What is UGC?','UGC stands for User Generated Content. It is authentic-style content designed to make brands and products feel more relatable.'],['Do I need to send my product?','Yes, if the video requires physical product demonstration. Digital products can usually be demonstrated remotely.'],['Can I use the videos for Facebook and Instagram ads?','Yes. Videos can be created in formats suitable for social media advertising.'],['Can you create multiple versions of the same video?','Yes. Different hooks, CTAs and creative angles can be created for testing.'],['Do you provide scripts?','Yes. Scripts and hooks can be created based on your product and target audience.'],['Can I request a custom package?','Yes. Contact us for custom packages.']]; foreach($faqs as $faq): ?>
        <details><summary><?= htmlspecialchars($faq[0]) ?><span>+</span></summary><p><?= htmlspecialchars($faq[1]) ?></p></details><?php endforeach; ?>
      </div>
    </section>

    <section class="final-cta"><div class="section-shell"><span>FAST • AUTHENTIC • AD-READY</span><h2>Ready to Turn Your Product Into Scroll-Stopping Content?</h2><p>Let's create UGC videos that grab attention, build trust and drive action.</p><div><a class="button button-coral" href="#packages">Get My UGC Video <span>↗</span></a><a class="button button-light" href="https://wa.me/919325983943?text=Hi%2C%20I%27m%20interested%20in%20your%20UGC%20video%20services.%20I%20would%20like%20to%20know%20more%20about%20the%20packages." target="_blank" rel="noopener">Chat on WhatsApp</a></div></div></section>

    <section class="contact section-shell" id="contact">
      <div class="contact-copy"><span class="section-kicker">START YOUR PROJECT</span><h2>Tell Us About Your Brand</h2><p>Share your requirements and we’ll recommend the right creative direction and package.</p><div class="contact-points"><span>✓ Reply within one business day</span><span>✓ Clear pricing and deliverables</span><span>✓ UGC made for your campaign goal</span></div></div>
      <form id="enquiryForm" novalidate>
        <div class="field-row"><label>Name<input name="name" required autocomplete="name"></label><label>Email<input name="email" type="email" required autocomplete="email"></label></div>
        <div class="field-row"><label>WhatsApp Number<input name="phone" required inputmode="tel" autocomplete="tel"></label><label>Brand / Business Name<input name="brand" required></label></div>
        <label>Website / Product URL<input name="url" type="url" placeholder="https://"></label>
        <label>Choose Package<select name="package"><option>Starter</option><option>Growth</option><option>Pro</option><option>Custom</option></select></label>
        <label>Message / Requirements<textarea name="message" required></textarea></label>
        <button class="button button-coral" type="submit">Request My UGC Video <span>↗</span></button>
        <p class="form-status" id="formStatus" role="status"></p>
      </form>
    </section>
  </main>

  <footer><div><a class="brand" href="#home"><i>AU</i><span>ASCENSION <b>UGC</b></span></a><p>Scroll-stopping UGC content for modern brands.</p></div><div><h3>Explore</h3><a href="#home">Home</a><a href="#samples">Samples</a><a href="#packages">Packages</a><a href="#contact">Contact</a></div><div><h3>Legal</h3><a href="#">Privacy Policy</a><a href="#">Terms &amp; Conditions</a></div><div><h3>Follow</h3><span class="social-links"><a href="#" aria-label="Instagram">IG</a><a href="#" aria-label="Facebook">FB</a><a href="#" aria-label="TikTok">TT</a><a href="#" aria-label="YouTube">YT</a></span></div><small>© 2026 Ascension UGC. All Rights Reserved.</small></footer>

  <dialog id="videoModal" class="video-modal"><button class="modal-close" type="button" aria-label="Close video">×</button><div class="modal-video"><video id="modalVideo" controls playsinline></video><div class="video-fallback" id="videoFallback"><span>▶</span><b id="fallbackTitle">Sample video</b><small>Add the matching MP4 file to play this sample.</small></div></div><h3 id="modalTitle">UGC Sample</h3></dialog>
  <dialog id="orderModal" class="order-modal"><button class="modal-close" type="button" aria-label="Close order">×</button><span class="section-kicker">PLACE YOUR ORDER</span><h2 id="orderTitle">Choose your package</h2><p>Complete the details below to continue with your UGC order.</p><form id="orderForm"><label>Full Name<input name="name" required></label><label>Email<input name="email" type="email" required></label><label>WhatsApp Number<input name="phone" required></label><label>Brand Name<input name="brand" required></label><label>Product / Website<input name="product" required></label><div id="passwordWrap"><label>Create Password<input name="password" type="password" minlength="10"><small>For your first order: 10+ characters with a letter and number.</small></label></div><p id="orderStatus" class="form-status"></p><button class="button button-coral" type="submit">Continue to Secure Payment <span>↗</span></button></form></dialog>

  <a class="mobile-whatsapp" href="https://wa.me/919325983943?text=Hi%2C%20I%27m%20interested%20in%20your%20UGC%20video%20services.%20I%20would%20like%20to%20know%20more%20about%20the%20packages." target="_blank" rel="noopener"><span>◉</span> WhatsApp</a>
  <a class="sticky-get-started" href="#packages">Get Started</a>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="assets/app.js" defer></script>
</body>
</html>
