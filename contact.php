<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doric Multimedia | Premium Contact</title>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ============================================================
       ULTRA PREMIUM CONTACT — 2026 LUXURY
       ============================================================ */

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      background: #f7f4f1;
      color: #1a1412;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      -webkit-font-smoothing: antialiased;
    }

    .premium-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 40px;
      width: 100%;
    }

    /* ============================================================
       HERO
       ============================================================ */
    .hero-premium {
      padding: 90px 0 70px;
      background:
        radial-gradient(ellipse at 15% 20%, rgba(179, 58, 42, 0.05), transparent 55%),
        radial-gradient(ellipse at 85% 75%, rgba(201, 166, 107, 0.07), transparent 50%),
        linear-gradient(180deg, #ffffff 0%, #f9f6f3 100%);
      position: relative;
      overflow: hidden;
    }

    .hero-premium::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(179,58,42,0.25), rgba(201,166,107,0.35), rgba(179,58,42,0.25), transparent);
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.15fr 0.85fr;
      gap: 30px;  /* reduced from 70px to 30px */
      align-items: center;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 9px 22px 9px 18px;
      background: rgba(179, 58, 42, 0.06);
      border: 1px solid rgba(179, 58, 42, 0.12);
      border-radius: 100px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2.4px;
      text-transform: uppercase;
      color: #b33a2a;
      margin-bottom: 28px;
    }

    .hero-badge i {
      color: #c9a66b;
      font-size: 12px;
    }

    .hero-title {
      font-size: clamp(40px, 5.6vw, 64px);
      font-weight: 800;
      line-height: 1.08;
      letter-spacing: -2.8px;
      color: #0f0c0a;
      margin-bottom: 22px;
    }

    .hero-title .highlight {
      background: linear-gradient(120deg, #b33a2a 0%, #8a2a1e 35%, #c9a66b 85%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-desc {
      font-size: 17px;
      color: #6b625c;
      font-weight: 400;
      max-width: 460px;
      line-height: 1.85;
      margin-bottom: 36px;
    }

    .hero-stats {
      display: flex;
      gap: 48px;
    }

    .hero-stat {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .hero-stat-number {
      font-size: 28px;
      font-weight: 800;
      color: #0f0c0a;
      letter-spacing: -1px;
    }

    .hero-stat-number .gold {
      color: #c9a66b;
    }

    .hero-stat-label {
      font-size: 13px;
      color: #8a807a;
      font-weight: 500;
    }

    /* Hero Visual — 3D image container */
    .hero-visual {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .hero-3d-image {

  object-fit: cover;
  border-radius: 30px;
  
  /* Premium Glass Effect */
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  
  /* 3D Shadow + Glow */
  box-shadow: 
    0 30px 80px rgba(179, 58, 42, 0.2),
    0 0 0 2px rgba(201, 166, 107, 0.2),
    0 0 60px rgba(201, 166, 107, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.6);
  
  /* 3D Transform */
  transform: perspective(1200px) rotateY(-8deg) rotateX(5deg);
  transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
  animation: floatImage 6s ease-in-out infinite;
}
.hero-3d-image:hover {
  transform: perspective(1200px) rotateY(0deg) rotateX(0deg) scale(1.04);
  box-shadow: 
    0 40px 120px rgba(179, 58, 42, 0.35),
    0 0 0 3px rgba(201, 166, 107, 0.4),
    0 0 100px rgba(201, 166, 107, 0.2);
}

    @keyframes floatImage {
      0%, 100% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-16px) scale(1.01); }
    }

    /* ============================================================
       INFO CARDS
       ============================================================ */
    .info-section {
      padding: 55px 0 65px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 22px;
    }

    .glass-card {
      background: rgba(255,255,255,0.72);
      backdrop-filter: blur(28px) saturate(1.5);
      -webkit-backdrop-filter: blur(28px) saturate(1.5);
      border: 1px solid rgba(255,255,255,0.75);
      border-radius: 26px;
      padding: 32px 28px;
      box-shadow:
        0 4px 24px rgba(0,0,0,0.03),
        0 1px 0 rgba(255,255,255,0.8) inset;
      transition: all 0.55s cubic-bezier(0.22, 1, 0.36, 1);
      position: relative;
      overflow: hidden;
    }

    .glass-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2.5px;
      background: linear-gradient(90deg, #b33a2a, #c9a66b);
      opacity: 0;
      transition: opacity 0.45s ease;
    }

    .glass-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 24px 64px rgba(0,0,0,0.07);
      background: rgba(255,255,255,0.88);
    }

    .glass-card:hover::before {
      opacity: 1;
    }

    .glass-card .label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2.1px;
      text-transform: uppercase;
      color: #a89f99;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .glass-card .label i {
      font-size: 14px;
      color: #b33a2a;   /* accent color for all icons */
    }

    .glass-card .value {
      font-size: 15px;
      font-weight: 600;
      color: #1a1412;
      line-height: 1.55;
    }

    .glass-card .value a {
      color: #1a1412;
      text-decoration: none;
      transition: color 0.3s;
    }

    .glass-card .value a:hover {
      color: #b33a2a;
    }

    .social-group {
      display: flex;
      gap: 12px;
      margin-top: 8px;
    }

    .social-group a {
      width: 44px;
      height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: rgba(0,0,0,0.035);
      color: #5a524c;
      font-size: 16px;
      transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
      text-decoration: none;
    }

    .social-group a:hover {
      background: linear-gradient(135deg, #b33a2a, #8a2a1e);
      color: #fff;
      transform: translateY(-5px) scale(1.06);
      box-shadow: 0 14px 32px rgba(179,58,42,0.28);
    }

    .hours-sub {
      font-weight: 400;
      font-size: 13px;
      color: #8a807a;
    }

    /* ============================================================
       MAP + FORM
       ============================================================ */
    .main-section {
      padding: 10px 0 110px;
    }

    .split-layout {
      display: grid;
      grid-template-columns: 1.12fr 0.88fr;
      gap: 42px;
      align-items: stretch;
    }

    /* Map */
    .map-wrapper {
      border-radius: 30px;
      overflow: hidden;
      box-shadow:
        0 32px 90px rgba(0,0,0,0.07),
        0 0 0 1px rgba(0,0,0,0.03);
      min-height: 600px;
      position: relative;
      transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.7s ease;
    }

    .map-wrapper:hover {
      transform: scale(1.008);
      box-shadow: 0 42px 110px rgba(0,0,0,0.1);
    }

    .map-wrapper iframe {
      width: 100%;
      height: 100%;
      min-height: 600px;
      border: 0;
      display: block;
    }

    .map-overlay {
      position: absolute;
      bottom: 28px;
      left: 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 16px 24px;
      background: rgba(255,255,255,0.94);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 18px;
      box-shadow: 0 12px 40px rgba(0,0,0,0.08);
      border: 1px solid rgba(255,255,255,0.7);
    }

    .map-overlay i {
      font-size: 20px;
      color: #b33a2a;
    }

    .map-overlay strong {
      display: block;
      font-size: 14px;
      font-weight: 700;
      color: #0f0c0a;
    }

    .map-overlay span {
      font-size: 12px;
      color: #6b625c;
    }

    /* Form Card */
    .form-card {
      background: rgba(255,255,255,0.78);
      backdrop-filter: blur(32px) saturate(1.6);
      -webkit-backdrop-filter: blur(32px) saturate(1.6);
      border: 1px solid rgba(255,255,255,0.65);
      border-radius: 30px;
      padding: 48px 44px;
      box-shadow:
        0 24px 70px rgba(0,0,0,0.045),
        0 1px 0 rgba(255,255,255,0.85) inset;
      position: relative;
    }

    .form-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 18%;
      right: 18%;
      height: 2.5px;
      background: linear-gradient(90deg, transparent, #b33a2a, #c9a66b, transparent);
      border-radius: 10px;
    }

    .form-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 7px 18px;
      background: rgba(179,58,42,0.05);
      border-radius: 100px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #b33a2a;
      margin-bottom: 16px;
    }

    .form-badge .dot-live {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #22c55e;
      box-shadow: 0 0 0 0 rgba(34,197,94,0.4);
      animation: livePulse 2.2s infinite;
    }

    @keyframes livePulse {
      0% { box-shadow: 0 0 0 0 rgba(34,197,94,0.45); }
      70% { box-shadow: 0 0 0 8px rgba(34,197,94,0); }
      100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
    }

    .form-title {
      font-size: 30px;
      font-weight: 800;
      letter-spacing: -1.4px;
      color: #0f0c0a;
      margin-bottom: 10px;
    }

    .form-desc {
      font-size: 14.5px;
      color: #6b625c;
      line-height: 1.8;
      margin-bottom: 32px;
    }

    .form-desc a {
      color: #b33a2a;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.25s;
    }

    .form-desc a:hover {
      color: #8a2a1e;
    }

    .row-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 16px;
    }

    .field {
      margin-bottom: 16px;
    }

    .input-premium {
      width: 100%;
      padding: 17px 20px;
      border: 1.5px solid rgba(0,0,0,0.07);
      border-radius: 16px;
      background: rgba(255,255,255,0.55);
      font-size: 14.5px;
      font-family: inherit;
      color: #1a1412;
      outline: none;
      transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .input-premium:focus {
      border-color: #b33a2a;
      background: #ffffff;
      box-shadow: 0 0 0 5px rgba(179,58,42,0.07);
    }

    .input-premium::placeholder {
      color: #a89f99;
    }

    .textarea-premium {
      min-height: 130px;
      resize: vertical;
    }

    .select-premium {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%238a807a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 18px center;
      cursor: pointer;
    }

    /* Premium Button */
    .btn-premium {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      padding: 18px 46px;
      border: none;
      border-radius: 100px;
      background: linear-gradient(135deg, #b33a2a 0%, #8a2a1e 100%);
      color: #fff;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 1.3px;
      text-transform: uppercase;
      cursor: pointer;
      font-family: inherit;
      box-shadow:
        0 16px 44px rgba(179,58,42,0.3),
        0 1px 0 rgba(255,255,255,0.15) inset;
      transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1);
      position: relative;
      overflow: hidden;
    }

    .btn-premium::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 60%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
      transition: left 0.6s ease;
    }

    .btn-premium:hover {
      transform: translateY(-4px);
      box-shadow: 0 24px 56px rgba(179,58,42,0.38);
    }

    .btn-premium:hover::after {
      left: 120%;
    }

    .btn-premium:active {
      transform: scale(0.97);
    }

    .btn-premium i {
      font-size: 14px;
      transition: transform 0.35s ease;
    }

    .btn-premium:hover i {
      transform: translateX(5px);
    }

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 1100px) {
      .hero-grid {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
      }
      .hero-desc {
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
      }
      .hero-stats {
        justify-content: center;
      }
      .info-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .split-layout {
        grid-template-columns: 1fr;
        gap: 36px;
      }
      .map-wrapper,
      .map-wrapper iframe {
        min-height: 420px;
      }
      .hero-visual {
        display: flex;
      }
      .hero-3d-image {
        width: 340px;
        height: 340px;
      }
    }

    @media (max-width: 700px) {
      .premium-container {
        padding: 0 22px;
      }
      .hero-premium {
        padding: 55px 0 45px;
      }
      .hero-title {
        font-size: 32px;
        letter-spacing: -1.6px;
      }
      .info-grid {
        grid-template-columns: 1fr;
      }
      .form-card {
        padding: 34px 24px;
      }
      .row-2 {
        grid-template-columns: 1fr;
      }
      .form-title {
        font-size: 25px;
      }
      .map-wrapper,
      .map-wrapper iframe {
        min-height: 320px;
      }
      .hero-stats {
        gap: 28px;
        flex-wrap: wrap;
      }
      .hero-stat-number {
        font-size: 23px;
      }
      .hero-3d-image {
        width: 260px;
        height: 260px;
      }
    }

    @media (max-width: 430px) {
      .premium-container {
        padding: 0 16px;
      }
      .hero-title {
        font-size: 27px;
      }
      .btn-premium {
        width: 100%;
        justify-content: center;
      }
      .map-overlay {
        bottom: 16px;
        left: 16px;
        padding: 13px 18px;
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
      }
      .hero-3d-image {
        width: 200px;
        height: 200px;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .glass-card,
      .map-wrapper,
      .btn-premium,
      .hero-3d-image,
      .form-badge .dot-live {
        transition: none !important;
        animation: none !important;
      }
    }
  </style>
</head>
<body>

<?php include("navbar.php"); ?>
<?php include("modal.php"); ?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="hero-premium">
  <div class="premium-container">
    <div class="hero-grid">
      <div>
       <div class="premium-badge-wrapper">
        <span class="premium-badge">
          <span class="badge-dot"></span>
         DEDICATED  SUPPORT
          <span class="badge-dot"></span>
        </span>
      </div>

        <h1 class="hero-title">
          Let's Build<br>
          <span class="highlight">Something Extraordinary</span>
        </h1>
        <p class="hero-desc">
          From Tally solutions to digital transformation — we're here to 
          elevate your business. Reach out and let's create impact together.
        </p>
        <div class="hero-stats">
          <div class="hero-stat">
            <span class="hero-stat-number">1000+</span>
            <span class="hero-stat-label">Happy Clients</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-number"><span class="gold">98</span>%</span>
            <span class="hero-stat-label">Satisfaction Rate</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-number">20<span class="gold">+</span></span>
            <span class="hero-stat-label">Years Excellence</span>
          </div>
        </div>
      </div>

      <!-- 3D image – width increased to 480px, gap reduced -->
      <div class="hero-visual">
        <img 
          class="hero-3d-image" 
          src="/images/ContactPage.png"
          alt="3D Doric Multimedia visual"
        />
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     INFO CARDS  — icon updates: Address, Connect
     ============================================================ -->
<section class="info-section">
  <div class="premium-container">
    <div class="info-grid">

      <!-- Address card -->
      <div class="glass-card">
        <div class="label"><i class="fa-solid fa-location-crosshairs"></i> Address</div>
        <div class="value">1st Floor, Gulati Market,<br>Near CMC Chowk, Ludhiana</div>
      </div>

      <div class="glass-card">
        <div class="label"><i class="fa-regular fa-envelope"></i> Get In Touch</div>
        <div class="value">
          <a href="mailto:mail@doricmultimedia.com">mail@doricmultimedia.com</a><br>
          <a href="tel:9888696300" style="display:inline-block;margin-top:6px;font-weight:700;">+91 98886 96300</a>
        </div>
      </div>

      <div class="glass-card">
        <div class="label"><i class="fa-solid fa-business-time"></i> Working Hours</div>
        <div class="value">
          Monday – Saturday<br>
          <span class="hours-sub">10:00 am – 06:30 pm</span>
        </div>
      </div>

      <!-- Connect card -->
      <div class="glass-card">
        <div class="label">
          <i class="fa-solid fa-link"></i> Connect
        </div>
        <div class="social-group">
                 <a href="https://www.facebook.com/doricmultimedialdh/" title="Facebook" target="_blank" rel="noopener noreferrer">
    <i class="fab fa-facebook-f"></i>
</a>
  <a href="https://www.instagram.com/doricmultimedia/?hl=en" title="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://in.linkedin.com/company/doric-multimedia-priv-limited" title="LinkedIn">
            <i class="fab fa-linkedin-in"></i>
          </a>
        
   
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ============================================================
     MAP + FORM
     ============================================================ -->
<section class="main-section">
  <div class="premium-container">
    <div class="split-layout">

      <!-- MAP -->
      <div class="map-wrapper">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3423.100925814376!2d75.8639648748159!3d30.911802974498354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a831252f52709%3A0x1240c8a07e62309d!2sDoric%20Multimedia%20Pvt%20Ltd%20(Tally%20Certified%20Partner)!5e0!3m2!1sen!2sin!4v1787126157347!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        <div class="map-overlay">
          <i class="fa-regular fa-location-dot"></i>
          <div>
            <strong>Find Us</strong>
            <span>Gulati Market, Near CMC Chowk</span>
          </div>
        </div>
      </div>

      <!-- FORM -->
      <div class="form-card">
        <div class="form-badge">
          <span class="dot-live"></span>
          We're Online
        </div>
        <h2 class="form-title">Start a Conversation</h2>
        <p class="form-desc">
          Call <a href="tel:9888696300">+91 98886 96300</a> or email 
          <a href="mailto:mail@doricmultimedia.com">mail@doricmultimedia.com</a>.
          Or fill the form — we reply within <strong>12 hours</strong>.
        </p>

        <form action="mail.php" method="POST">
          <div class="row-2">
            <div class="field">
              <input type="text" name="first_name" class="input-premium" placeholder="First Name *" required>
            </div>
            <div class="field">
              <input type="text" name="last_name" class="input-premium" placeholder="Last Name *" required>
            </div>
          </div>

          <div class="row-2">
            <div class="field">
              <input type="email" name="email" class="input-premium" placeholder="Email Address *" required>
            </div>
            <div class="field">
              <input type="tel" name="phone" class="input-premium" placeholder="Phone Number *" required>
            </div>
          </div>

          <div class="row-2">
            <div class="field">
              <input type="text" name="company" class="input-premium" placeholder="Company Name">
            </div>
            <div class="field">
              <select name="service" class="input-premium select-premium" required>
                <option value="" selected disabled>Choose Service *</option>
                <option value="Tally Prime">Tally Prime</option>
                <option value="Tally Capital">Tally Capital</option>
                <option value="Tally Xcelerator">Tally Xcelerator</option>
                <option value="Tally Course">Tally Course</option>
                <option value="Distance Education">Distance Education</option>
                <option value="Website Development">Website Development</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div class="field">
            <textarea name="message" class="input-premium textarea-premium" placeholder="Tell us about your project..."></textarea>
          </div>

          <button type="submit" class="btn-premium">
            Send Message
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php include("footer.php"); ?>

</body>
</html>