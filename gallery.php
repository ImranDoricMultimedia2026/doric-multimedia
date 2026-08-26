<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Work Environment Gallery | Doric Multimedia Pvt. Ltd.</title>

<meta name="description" content="Explore the Work Environment Gallery of Doric Multimedia. Get a glimpse of our modern workspace, collaborative culture, expert team, training sessions, client interactions, events, and innovative business solutions that drive success.">

<meta name="keywords" content="Doric Multimedia Gallery, Work Environment, Office Gallery, Team at Doric Multimedia, Workplace Culture, Office Photos, Corporate Environment, Business Workspace, Team Collaboration, Company Events, Professional Office, Digital Solutions Company, Tally Experts, IT Company Gallery">

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

  /* ===== GALLERY SECTION ===== */
  .gallery-premium {
    padding: 80px 0 100px;
    position: relative;
    isolation: isolate;
    background: 
      radial-gradient(circle at 5% 15%, rgba(157,54,38,0.06), transparent 40%),
      radial-gradient(circle at 95% 85%, rgba(11,23,42,0.05), transparent 40%),
      linear-gradient(170deg, #ffffff 0%, #f8fafc 60%, #f1f5f9 100%);
  }

  .gallery-premium::before {
    content: '';
    position: absolute;
    z-index: -1;
    top: -100px;
    right: -100px;
    width: 450px;
    height: 450px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(157,54,38,0.04), transparent 70%);
    pointer-events: none;
  }

  .gallery-premium::after {
    content: '';
    position: absolute;
    z-index: -1;
    bottom: -80px;
    left: -80px;
    width: 350px;
    height: 350px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(11,23,42,0.03), transparent 70%);
    pointer-events: none;
  }

  /* ===== DECORATIVE ELEMENTS ===== */
  .gallery-grid-wrapper {
    position: relative;
  }

  /* ===== HEADER ===== */
  .gallery-header {
    text-align: center;
    margin-bottom: 55px;
    position: relative;
  }

  .gallery-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 24px;
    border-radius: 999px;
    background: var(--primary);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    margin-bottom: 18px;
    box-shadow: 0 8px 30px rgba(157,54,38,0.2);
    position: relative;
  }

  .gallery-badge::after {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 999px;
    border: 1px solid rgba(157,54,38,0.15);
    animation: pulse-border 2.5s ease-in-out infinite;
  }

  @keyframes pulse-border {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.05); opacity: 0.6; }
  }

  .gallery-badge i {
    font-size: 0.85rem;
  }

  .gallery-title {
    font-size: clamp(2.6rem, 5.5vw, 4.2rem);
    font-weight: 800;
    letter-spacing: -0.04em;
    color: var(--navy);
    line-height: 1.08;
  }

  .gallery-title span {
    color: var(--primary);
    position: relative;
  }

  .gallery-title span::after {
    content: '';
    position: absolute;
    bottom: 6px;
    left: 0;
    width: 100%;
    height: 8px;
    background: rgba(157,54,38,0.12);
    border-radius: 4px;
    z-index: -1;
  }

  .gallery-subtitle {
    color: var(--muted);
    font-size: 1.08rem;
    max-width: 620px;
    margin: 14px auto 0;
    line-height: 1.9;
    font-weight: 400;
  }

  .gallery-divider {
    width: 70px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--gold));
    margin: 20px auto 0;
    border-radius: 4px;
    position: relative;
  }

  .gallery-divider::after {
    content: '';
    position: absolute;
    top: -3px;
    left: 50%;
    transform: translateX(-50%);
    width: 12px;
    height: 10px;
    background: var(--primary);
    border-radius: 2px;
    opacity: 0.5;
  }

  /* ===== GRID - 2 COLUMNS ===== */
  .gallery-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 24px;
    cursor: pointer;
    background: #eef2f6;
    box-shadow: 0 12px 40px rgba(15,23,42,0.06);
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    aspect-ratio: 16 / 10;
  }

  .gallery-item:hover {
    transform: translateY(-12px) scale(1.01);
    box-shadow: 0 30px 70px rgba(157,54,38,0.14);
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.9s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .gallery-item:hover img {
    transform: scale(1.08);
  }

  /* ===== OVERLAY ===== */
  .gallery-item-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 30px 28px;
    background: linear-gradient(
      to top,
      rgba(11,23,42,0.85) 0%,
      rgba(11,23,42,0.3) 50%,
      transparent 100%
    );
    opacity: 0;
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .gallery-item:hover .gallery-item-overlay {
    opacity: 1;
  }

  .gallery-item-overlay .icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.08);
    color: #fff;
    font-size: 1.4rem;
    margin-bottom: 12px;
    transition: all 0.4s ease;
  }

  .gallery-item:hover .icon-circle {
    background: var(--primary);
    transform: scale(1.05) rotate(-8deg);
  }

  .gallery-item-overlay .overlay-title {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.02em;
  }

  .gallery-item-overlay .overlay-sub {
    color: rgba(255,255,255,0.7);
    font-size: 0.85rem;
    margin: 4px 0 0;
  }

  /* ===== COUNTER ===== */
  .gallery-counter {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 28px;
    border-radius: 999px;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(157,54,38,0.08);
    box-shadow: 0 8px 30px rgba(0,0,0,0.04);
    color: var(--navy);
    font-size: 0.9rem;
    font-weight: 700;
    margin-top: 40px;
    transition: all 0.3s ease;
  }

  .gallery-counter:hover {
    border-color: var(--primary);
    box-shadow: 0 12px 40px rgba(157,54,38,0.08);
  }

  .gallery-counter i {
    color: var(--primary);
    font-size: 1.1rem;
  }

  .gallery-counter .number {
    color: var(--primary);
    font-size: 1.2rem;
  }

  /* ===== LIGHTBOX OVERRIDES ===== */
  .gslide-image img {
    max-height: 85vh !important;
    object-fit: contain !important;
    border-radius: 16px !important;
    box-shadow: 0 40px 100px rgba(0,0,0,0.5) !important;
  }

  .goverlay {
    background: rgba(0, 0, 0, 0.9) !important;
    backdrop-filter: blur(12px);
  }

  .glightbox-close {
    width: 52px !important;
    height: 52px !important;
    background: rgba(255, 255, 255, 0.06) !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    right: 28px !important;
    top: 28px !important;
    transition: all 0.4s ease !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
  }

  .glightbox-close:hover {
    background: var(--primary) !important;
    transform: rotate(90deg) scale(1.08) !important;
    border-color: var(--primary) !important;
  }

  .glightbox-close svg {
    fill: #fff !important;
    width: 24px !important;
    height: 24px !important;
  }

  .glightbox-prev,
  .glightbox-next {
    background: rgba(255, 255, 255, 0.06) !important;
    border-radius: 50% !important;
    padding: 16px !important;
    width: 56px !important;
    height: 56px !important;
    transition: all 0.35s ease !important;
    border: 1px solid rgba(255,255,255,0.06) !important;
  }

  .glightbox-prev:hover,
  .glightbox-next:hover {
    background: var(--primary) !important;
    transform: scale(1.08) !important;
  }

  .glightbox-prev svg,
  .glightbox-next svg {
    fill: #fff !important;
    width: 24px !important;
    height: 24px !important;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 992px) {
    .gallery-grid {
      gap: 20px;
    }
    .gallery-premium { padding: 60px 0 70px; }
  }

  @media (max-width: 768px) {
    .gallery-grid {
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }
    .gallery-item { aspect-ratio: 16 / 11; border-radius: 18px; }
    .gallery-title { font-size: 2rem; }
    .gallery-subtitle { font-size: 0.95rem; }
    .gallery-premium { padding: 50px 0 60px; }
    .gallery-header { margin-bottom: 35px; }
    .gallery-item-overlay { padding: 20px; }
    .gallery-item-overlay .icon-circle { width: 44px; height: 44px; font-size: 1.1rem; }
    .gallery-item-overlay .overlay-title { font-size: 0.95rem; }
    .gallery-item-overlay .overlay-sub { font-size: 0.75rem; }
  }

  @media (max-width: 480px) {
    .gallery-grid {
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }
    .gallery-item { aspect-ratio: 16 / 12; border-radius: 14px; }
    .gallery-title { font-size: 1.6rem; }
    .gallery-badge { font-size: 0.6rem; padding: 6px 16px; }
    .gallery-premium { padding: 35px 0 45px; }
    .gallery-counter { font-size: 0.75rem; padding: 8px 18px; }
    .glightbox-close { right: 12px !important; top: 12px !important; width: 40px !important; height: 40px !important; }
    .glightbox-prev, .glightbox-next { width: 40px !important; height: 40px !important; padding: 10px !important; }
  }

  @media (max-width: 380px) {
    .gallery-grid { gap: 8px; }
    .gallery-item { aspect-ratio: 16 / 13; }
    .gallery-item-overlay { padding: 14px; }
    .gallery-item-overlay .icon-circle { width: 36px; height: 36px; font-size: 0.9rem; }
    .gallery-item-overlay .overlay-title { font-size: 0.8rem; }
  }

  @media (prefers-reduced-motion: reduce) {
    * { transition-duration: 0.01ms !important; }
    .gallery-item-overlay { opacity: 1 !important; }
    .gallery-item::after { display: none; }
  }
</style>

</head>
<body>

<?php include("navbar.php"); ?>
<?php include("modal.php"); ?>

<!-- ===== GALLERY SECTION ===== -->
<section class="gallery-premium">
  <div class="container">

    <!-- Header -->
    <div class="gallery-header">
      <span class="gallery-badge">
        <i class="fa-regular fa-images"></i>
        Our Space
      </span>
      <h1 class="gallery-title">
        We Create A <span>Positive &amp; Creative</span> Space
      </h1>
      <p class="gallery-subtitle">
        Step into our world — where collaboration meets innovation, and every corner inspires excellence.
      </p>
      <div class="gallery-divider"></div>
    </div>

    <!-- Grid - 2 Columns -->
    <div class="gallery-grid">

      <!-- Image 1 -->
      <a href="images/work1.jpeg" class="gallery-item glightbox" data-glightbox="title: Work Environment">
        <img src="images/work1.jpeg" alt="Work Environment" loading="lazy">
        <div class="gallery-item-overlay">
          <span class="icon-circle"><i class="fa-regular fa-eye"></i></span>
          <p class="overlay-title">Work Environment</p>
          <p class="overlay-sub">Click to view full image</p>
        </div>
      </a>

      <!-- Image 2 -->
      <a href="images/work2.jpeg" class="gallery-item glightbox" data-glightbox="title: Team Collaboration">
        <img src="images/work2.jpeg" alt="Team Collaboration" loading="lazy">
        <div class="gallery-item-overlay">
          <span class="icon-circle"><i class="fa-regular fa-eye"></i></span>
          <p class="overlay-title">Team Collaboration</p>
          <p class="overlay-sub">Click to view full image</p>
        </div>
      </a>

      <!-- Image 3 -->
      <a href="images/work3.jpeg" class="gallery-item glightbox" data-glightbox="title: Creative Workspace">
        <img src="images/work3.jpeg" alt="Creative Workspace" loading="lazy">
        <div class="gallery-item-overlay">
          <span class="icon-circle"><i class="fa-regular fa-eye"></i></span>
          <p class="overlay-title">Creative Workspace</p>
          <p class="overlay-sub">Click to view full image</p>
        </div>
      </a>

      <!-- Image 4 -->
      <a href="images/work4.jpeg" class="gallery-item glightbox" data-glightbox="title: Office Culture">
        <img src="images/work4.jpeg" alt="Office Culture" loading="lazy">
        <div class="gallery-item-overlay">
          <span class="icon-circle"><i class="fa-regular fa-eye"></i></span>
          <p class="overlay-title">Office Culture</p>
          <p class="overlay-sub">Click to view full image</p>
        </div>
      </a>

    </div>

    <!-- Counter -->
    <div class="text-center">
      <span class="gallery-counter">
        <i class="fa-regular fa-camera"></i>
        <span class="number">4+</span> Moments Captured
      </span>
    </div>

  </div>
</section>

<?php include("footer.php"); ?>

<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

<script>
  // ===== INIT GLIGHTBOX =====
  const lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    closeButton: true,
    zoomable: true,
    draggable: true,
    autoplayVideos: false,
    slideEffect: 'slide'
  });

  // ===== IMAGE FALLBACK =====
  document.querySelectorAll('.gallery-item img').forEach(img => {
    img.addEventListener('error', function() {
      this.onerror = null;
      this.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="600" height="400" viewBox="0 0 600 400"%3E%3Crect width="600" height="400" fill="%23f1f5f9"/%3E%3Ctext x="50%25" y="45%25" text-anchor="middle" font-family="Arial" font-size="40" fill="%239d3626"%3E📷%3C/text%3E%3Ctext x="50%25" y="60%25" text-anchor="middle" font-family="Arial" font-size="16" fill="%2364748b"%3EImage Not Found%3C/text%3E%3C/svg%3E';
    });
  });
</script>

</body>
</html>