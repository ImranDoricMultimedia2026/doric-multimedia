<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Achievements & Awards | Doric Multimedia Pvt. Ltd.</title>
<meta name="description" content="Explore the achievements and awards of Doric Multimedia. Our commitment to innovation, quality, customer satisfaction, and excellence in digital solutions, website development, digital marketing, software services, and business technology has earned us the trust of clients and industry recognition.">
<meta name="keywords" content="Doric Multimedia achievements, Doric Multimedia awards, company achievements, business awards, digital agency awards, website development company, digital marketing company, software solutions, business technology, client success, innovation, excellence, trusted technology partner">

<!-- Bootstrap & Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<!-- GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<style>
  :root {
    --primary: #9d3626;
    --primary-dark: #7d281c;
    --primary-light: #fce8e4;
    --navy: #0b172a;
    --text: #475569;
    --muted: #64748b;
    --gold: #c9a84c;
  }

  * { box-sizing: border-box; }

  body {
    background: #f8fafc;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    overflow-x: hidden;
  }

  /* ===== AWARDS SECTION ===== */
  .awards-premium {
    padding: 100px 0 120px;
    position: relative;
    isolation: isolate;
    background:
      radial-gradient(circle at 10% 15%, rgba(157,54,38,0.06), transparent 40%),
      radial-gradient(circle at 90% 85%, rgba(201,168,76,0.05), transparent 40%),
      linear-gradient(165deg, #ffffff 0%, #f8fafc 45%, #f1f5f9 100%);
  }

  .awards-premium::before {
    content: '';
    position: absolute;
    z-index: -1;
    top: -100px;
    right: -100px;
    width: 480px;
    height: 480px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(157,54,38,0.05), transparent 70%);
    pointer-events: none;
  }

  .awards-premium::after {
    content: '';
    position: absolute;
    z-index: -1;
    bottom: -80px;
    left: -80px;
    width: 420px;
    height: 420px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.05), transparent 70%);
    pointer-events: none;
  }

  /* ===== HEADER ===== */
  .awards-header {
    text-align: center;
    margin-bottom: 60px;
  }

  .awards-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 11px 26px;
    border-radius: 999px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    margin-bottom: 20px;
    box-shadow: 0 10px 32px rgba(157,54,38,0.28);
    position: relative;
  }

  .awards-badge::after {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 999px;
    border: 1px solid rgba(157,54,38,0.25);
    animation: pulse-border 2.8s ease-in-out infinite;
  }

  @keyframes pulse-border {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.07); opacity: 0.45; }
  }

  .awards-title {
    font-size: clamp(2.5rem, 5.2vw, 3.9rem);
    font-weight: 800;
    letter-spacing: -0.04em;
    color: var(--navy);
    line-height: 1.08;
  }

  .awards-title span {
    color: var(--primary);
    position: relative;
  }

  .awards-title span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 10px;
    background: rgba(157,54,38,0.13);
    border-radius: 4px;
    z-index: -1;
  }

  .awards-subtitle {
    color: var(--muted);
    font-size: 1.08rem;
    max-width: 620px;
    margin: 16px auto 0;
    line-height: 1.85;
  }

  .awards-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--gold));
    margin: 22px auto 0;
    border-radius: 4px;
    position: relative;
  }

  

  /* ===== AWARD CARD ===== */
  .award-item {
    margin-bottom: 32px;
  }

  .award-card-wrapper {
    background: rgba(255,255,255,0.88);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 28px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: all 0.55s cubic-bezier(0.23, 1, 0.32, 1);
    box-shadow: 
      0 15px 40px rgba(15,23,42,0.06),
      0 0 0 1px rgba(148,163,184,0.08);
  }

  /* Continuous flowing border */
  .award-card-wrapper::before {
    content: '';
    position: absolute;
    inset: -2.5px;
    border-radius: 30px;
    padding: 2.5px;
    background: linear-gradient(
      90deg,
      #9d3626,
      #c9a84c,
      #ff6b6b,
      #ffd93d,
      #6bcb77,
      #4d96ff,
      #9d3626,
      #c9a84c
    );
    background-size: 300% 100%;
    -webkit-mask: 
      linear-gradient(#fff 0 0) content-box, 
      linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    animation: borderFlow 5s linear infinite;
    opacity: 0.7;
    z-index: -1;
  }

  @keyframes borderFlow {
    0%   { background-position: 0% 50%; }
    100% { background-position: 300% 50%; }
  }

  .award-card-wrapper:hover {
    transform: translateY(-14px);
    box-shadow: 
      0 35px 70px rgba(157,54,38,0.14),
      0 0 0 1px rgba(157,54,38,0.1);
  }

  .award-card-wrapper:hover::before {
    animation-duration: 2.4s;
    opacity: 1;
    filter: brightness(1.15);
  }

  .award-card-wrapper::after {
    content: '';
    position: absolute;
    inset: -10px;
    border-radius: 36px;
    background: linear-gradient(135deg, rgba(157,54,38,0.18), rgba(201,168,76,0.12));
    z-index: -2;
    opacity: 0;
    filter: blur(16px);
    transition: opacity 0.5s ease;
  }

  .award-card-wrapper:hover::after {
    opacity: 0.55;
  }

  /* ===== IMAGE CONTAINER ===== */
  .award-image-wrap {
    position: relative;
    overflow: hidden;
    height: 450px;
    background: #eef2f6;
    flex-shrink: 0;
  }

  .award-image-wrap a {
    display: block;
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1;
  }

  .award-image-wrap img {
    width: 100%;
    max-width: 100%;
    height: 100%;
    /* CHANGE: Use cover instead of contain to fill the container */
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.9s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .award-card-wrapper:hover .award-image-wrap img {
    transform: none;
  }

  /* ===== IMAGE OVERLAY ===== */
  .award-image-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(160deg, rgba(11,23,42,0.3) 0%, rgba(157,54,38,0.55) 100%);
    backdrop-filter: blur(5px);
    opacity: 0;
    transition: all 0.45s ease;
    pointer-events: none; /* IMPORTANT FIX */
  }

  .award-image-wrap:hover .award-image-overlay {
    opacity: 1;
  }

  .award-image-overlay .zoom-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border: 1.5px solid rgba(255,255,255,0.2);
    color: #fff;
    font-size: 1.55rem;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  .award-image-wrap:hover .zoom-icon {
    background: var(--primary);
    transform: scale(1.12) rotate(-10deg);
    box-shadow: 0 12px 35px rgba(157,54,38,0.45);
  }

  /* ===== BADGE ON IMAGE ===== */
  .award-badge-top {
    position: absolute;
    top: 18px;
    right: 18px;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 15px;
    border-radius: 999px;
    background: rgba(255,255,255,0.94);
    backdrop-filter: blur(10px);
    box-shadow: 0 6px 22px rgba(0,0,0,0.1);
    font-size: 0.68rem;
    font-weight: 700;
    color: var(--navy);
    letter-spacing: 0.04em;
    pointer-events: none; /* IMPORTANT FIX */
  }

  .award-badge-top i {
    color: var(--gold);
    font-size: 0.75rem;
  }

  /* ===== CONTENT ===== */
  .award-content {
    padding: 28px 28px 32px;
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 150px;
  }

  .award-content p {
    font-size: 0.97rem;
    line-height: 1.9;
    color: var(--text);
    margin: 0;
  }

  .award-content strong {
    color: var(--navy);
    font-weight: 700;
  }

  .award-content .highlight-red {
    color: var(--primary);
    font-weight: 700;
  }

  .award-content .highlight-gold {
    color: var(--gold);
    font-weight: 700;
  }

  /* ===== SPECIAL BADGE ===== */
  .award-special-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 18px;
    border-radius: 999px;
    background: linear-gradient(135deg, var(--gold), #b8942e);
    color: #fff;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    margin-top: 18px;
    align-self: flex-start;
    box-shadow: 0 6px 20px rgba(201,168,76,0.32);
  }

  .award-special-badge i {
    font-size: 0.72rem;
  }

  .award-special-badge.milestone {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    box-shadow: 0 6px 20px rgba(157,54,38,0.32);
  }

  /* ===== LIGHTBOX ===== */
  .glightbox-container {
    z-index: 99999 !important;
  }

  .gslide-image img {
    max-height: 88vh !important;
    max-width: 88vw !important;
    object-fit: contain !important;
    border-radius: 18px !important;
    box-shadow: 0 40px 100px rgba(0,0,0,0.65) !important;
  }

  .goverlay {
    background: rgba(0, 0, 0, 0.93) !important;
    backdrop-filter: blur(18px);
  }

  .glightbox-close {
    width: 56px !important;
    height: 56px !important;
    background: rgba(255, 255, 255, 0.08) !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    right: 30px !important;
    top: 30px !important;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    border: 1px solid rgba(255,255,255,0.12) !important;
    z-index: 100000 !important;
  }

  .glightbox-close:hover {
    background: var(--primary) !important;
    transform: rotate(90deg) scale(1.1) !important;
    border-color: var(--primary) !important;
    box-shadow: 0 0 30px rgba(157,54,38,0.5) !important;
  }

  .glightbox-close svg {
    fill: #fff !important;
    width: 26px !important;
    height: 26px !important;
  }

  .glightbox-prev,
  .glightbox-next {
    background: rgba(255, 255, 255, 0.08) !important;
    border-radius: 50% !important;
    padding: 16px !important;
    width: 58px !important;
    height: 58px !important;
    transition: all 0.35s ease !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    z-index: 100000 !important;
  }

  .glightbox-prev:hover,
  .glightbox-next:hover {
    background: var(--primary) !important;
    transform: scale(1.1) !important;
    box-shadow: 0 0 25px rgba(157,54,38,0.4) !important;
  }

  .glightbox-prev svg,
  .glightbox-next svg {
    fill: #fff !important;
    width: 26px !important;
    height: 26px !important;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 992px) {
    .awards-premium { padding: 70px 0 80px; }
    .award-image-wrap { height: 280px; }
  }

  @media (max-width: 768px) {
    .awards-premium { padding: 55px 0 65px; }
    .awards-title { font-size: 2.1rem; }
    .awards-subtitle { font-size: 0.98rem; }
    .awards-header { margin-bottom: 40px; }
    .award-image-wrap { height: 240px; }
    .award-content { padding: 22px 22px 26px; min-height: 130px; }
    .award-content p { font-size: 0.9rem; }
  }

  @media (max-width: 480px) {
    .awards-premium { padding: 40px 0 50px; }
    .awards-title { font-size: 1.7rem; }
    .awards-badge { font-size: 0.62rem; padding: 8px 18px; }
    .award-image-wrap { height: 210px; }
    .award-card-wrapper { border-radius: 22px; }
    .award-content { padding: 18px 18px 22px; min-height: 110px; }
    .award-content p { font-size: 0.85rem; line-height: 1.75; }
    .award-badge-top { font-size: 0.58rem; padding: 5px 12px; top: 12px; right: 12px; }
    .award-image-overlay .zoom-icon { width: 52px; height: 52px; font-size: 1.2rem; }
    .glightbox-close { right: 14px !important; top: 14px !important; width: 44px !important; height: 44px !important; }
    .glightbox-prev, .glightbox-next { width: 44px !important; height: 44px !important; padding: 11px !important; }
  }

  @media (prefers-reduced-motion: reduce) {
    * { transition-duration: 0.01ms !important; animation: none !important; }
    .award-image-overlay { opacity: 1 !important; background: rgba(11,23,42,0.35) !important; }
  }
</style>
</head>
<body>

<?php include("navbar.php"); ?>
<?php include("modal.php"); ?>

<!-- ===== AWARDS SECTION ===== -->
<section class="awards-premium">
  <div class="container">
    <!-- Header -->
    <div class="awards-header">
     <div class="premium-badge-wrapper">
        <span class="premium-badge">
          <span class="badge-dot"></span>
         OUR RECOGNITION
          <span class="badge-dot"></span>
        </span>
      </div>

      <h1 class="awards-title">
        Our <span>Achievements &amp; Awards</span>
      </h1>
      <p class="awards-subtitle">
        Every award tells a story of dedication, innovation, and excellence — recognized by industry leaders and trusted partners.
      </p>
      <div class="awards-divider"></div>
    </div>

    <!-- Grid -->
    <div class="row g-4">

      <!-- AWARD 1 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img5.jpeg" class="glightbox" data-glightbox="title: 1 Crore Milestone Award">
              <img src="images/img5.jpeg" alt="1 Crore Milestone Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-star"></i> Milestone</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Honoured by <strong>Tally Solutions</strong> for reaching the prestigious
              <span class="highlight-red">1 Crore Milestone</span>,
              demonstrating sustained business success and excellence.
            </p>
            <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> 1 Crore Club
            </span>
          </div>
        </div>
      </div>

      <!-- AWARD 2 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img2.jpeg" class="glightbox" data-glightbox="title: Gurpreet Kaur - Customer Loyalty Award">
              <img src="images/img2.jpeg" alt="Gurpreet Kaur Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-heart"></i> Customer Loyalty</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Awarded by <strong>Tally Solutions</strong> in recognition of
              <span class="highlight-red">Gurpreet Kaur's</span>
              exceptional commitment to customer loyalty and service excellence.
            </p>
             <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> Customer Loyalty Star
            </span>
          </div>
        </div>
      </div>

      <!-- AWARD 3 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img3.jpeg" class="glightbox" data-glightbox="title: Dual Recognition Award">
              <img src="images/img3.jpeg" alt="Dual Recognition Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-award"></i> Dual Honor</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Received <span class="highlight-red">dual recognition</span> from <strong>Tally Solutions</strong>
              for exceptional performance and significant contributions to
              <span class="highlight-gold">TSS Renewal success</span>.
            </p>
               <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> 1 Crore Achievers
            </span>
          </div>
        </div>
      </div>

      <!-- AWARD 4 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img4.jpeg" class="glightbox" data-glightbox="title: Sushil Rana - Customer Growth Award">
              <img src="images/img4.jpeg" alt="Sushil Rana Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-users"></i> Customer Growth</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Awarded by <strong>Tally Solutions</strong> in recognition of
              <span class="highlight-red">Sushil Rana</span> for
              excellence in expanding our <strong>customer family</strong>.
            </p>
               <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i>  TSS Customer Growth Star
            </span>
          </div>
        </div>
      </div>
<!-- AWARD 5 -->
<div class="col-lg-4 col-md-6 award-item">
  <div class="award-card-wrapper">

    <div class="award-image-wrap">
      <a href="images/Director sir.jpeg"
         class="glightbox"
         data-glightbox="title: Guest of Honour - State-Level Cyber Security Workshop">

        <img src="images/cybersecurity.jpeg"
             alt="Guest of Honour at State-Level Cyber Security Workshop"
             loading="lazy">

        <span class="award-badge-top">
          <i class="fa-solid fa-shield-halved"></i> Cyber Security Recognition
        </span>

        <div class="award-image-overlay">
          <span class="zoom-icon">
            <i class="fa-solid fa-magnifying-glass-plus"></i>
          </span>
        </div>

      </a>
    </div>

    <div class="award-content">

      <p>
        Honoured to be invited as the
        <strong>Guest of Honour</strong> at the
        <span class="highlight-red">
          State-Level Cyber Security Workshop
        </span>
        for MSMEs &amp; BMOs in Chandigarh.
      </p>

      <span class="award-special-badge milestone">
        <i class="fa-solid fa-shield-halved"></i>
        Cyber Resilience
      </span>

    </div>

  </div>
</div>
      <!-- AWARD 5 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img1.jpeg" class="glightbox" data-glightbox="title: ITCA - GST Gyan Parv Award">
              <img src="images/img1.jpeg" alt="ITCA Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-building-columns"></i> Industry Recognition</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Recognized by the <strong>Indirect Taxes Consultants Association (ITCA)</strong>
              for valuable support in the successful conduct of the
              <span class="highlight-red">GST Gyan Parv event</span>.
            </p>
               <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> 1 Crore Achievers
            </span>
          </div>
        </div>
      </div>
      
      <!-- AWARD 6 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img6.jpeg" class="glightbox" data-glightbox="title: 1 Crore Milestone Award">
              <img src="images/img6.jpeg" alt="1 Crore Milestone Award 2" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-star"></i> Milestone</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Honoured by <strong>Tally Solutions</strong> for reaching the prestigious
              <span class="highlight-red">1 Crore Milestone</span>,
              demonstrating sustained business success and excellence.
            </p>
            <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> 1 Crore Club
            </span>
          </div>
        </div>
      </div>

      <!-- AWARD 7 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img7.jpeg" class="glightbox" data-glightbox="title: WABA Trials Award">
              <img src="images/img7.jpeg" alt="WABA Trials Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-rocket"></i> Sales Excellence</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Awarded by <strong>Tally Solutions</strong> for recording the
              <span class="highlight-red">highest number of WABA Trials</span>,
              reflecting outstanding sales and customer engagement.
            </p>
               <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> Waba Trials Champion
            </span>
          </div>
        </div>
      </div>

      <!-- AWARD 8 -->
      <div class="col-lg-4 col-md-6 award-item">
        <div class="award-card-wrapper">
          <div class="award-image-wrap">
            <a href="images/img8.jpeg" class="glightbox" data-glightbox="title: Pinnacle Award">
              <img src="images/img8.jpeg" alt="Pinnacle Award" loading="lazy">
              <span class="award-badge-top"><i class="fa-solid fa-crown"></i> Top Performer</span>
              <div class="award-image-overlay">
                <span class="zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
              </div>
            </a>
          </div>
          <div class="award-content">
            <p>
              Honoured by <strong>Tally Solutions</strong> with the
              <span class="highlight-red">Pinnacle Award</span>
              for being the <strong>Performing Partner in the Zone</strong>
              during FY 2022–23.
            </p>
               <span class="award-special-badge milestone">
              <i class="fa-solid fa-gem"></i> Pinnacle Award

            </span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include("footer.php"); ?>

<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
  // Initialize GLightbox
  const lightboxAwards = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    closeButton: true,
    zoomable: true,
    draggable: true,
    slideEffect: 'slide',
    width: '90vw',
    height: '85vh'
  });

  // Image fallback
  document.querySelectorAll('.award-image-wrap img').forEach(img => {
    img.addEventListener('error', function() {
      this.onerror = null;
      this.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="600" height="400" viewBox="0 0 600 400"%3E%3Crect width="600" height="400" fill="%23f1f5f9"/%3E%3Ctext x="50%25" y="45%25" text-anchor="middle" font-family="Arial" font-size="40" fill="%239d3626"%3E🏆%3C/text%3E%3Ctext x="50%25" y="60%25" text-anchor="middle" font-family="Arial" font-size="16" fill="%2364748b"%3EAward Image%3C/text%3E%3C/svg%3E';
    });
  });
</script>
</body>
</html>