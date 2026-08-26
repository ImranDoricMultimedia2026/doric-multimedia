<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Tally Xcelerator | Business Growth & Tally Automation Solutions | Doric Multimedia Pvt. Ltd.</title>

<meta name="description" content="Doric Multimedia offers Tally Xcelerator solutions to help businesses accelerate growth with advanced Tally automation, business process optimization, customized solutions, integration, reporting, and expert implementation services for improved efficiency and productivity.">

<meta name="keywords" content="Tally Xcelerator, Tally Xcelerator solutions, Tally automation, TallyPrime, business automation, Tally customization, Tally integration, business process automation, accounting automation, ERP solutions, Tally implementation, Tally reporting, productivity solutions, business growth, Doric Multimedia">

<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
  :root {
    --team-primary: #9d3626;
    --team-primary-dark: #7d281c;
    --team-primary-light: #fff0ed;
    --team-navy: #0b172a;
    --team-navy-light: #17243a;
    --team-text: #475569;
    --team-muted: #64748b;
    --team-border: rgba(148, 163, 184, 0.2);
    --team-white: #ffffff;
    --team-bg: #f8fafc;
    --team-radius: 28px;
    --team-shadow: 0 24px 70px rgba(15, 23, 42, 0.09);
  }

  * { box-sizing: border-box; }

  html { scroll-behavior: smooth; }

  body {
    margin: 0;
    overflow-x: hidden;
    background: var(--team-bg);
    color: var(--team-navy);
    font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  button, a { -webkit-tap-highlight-color: transparent; }

  /* ===== BADGE TITLE ===== */
  .badge-title {
    display: inline-block;
    background: var(--team-primary);
    color: #fff;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 6px 18px;
    border-radius: 40px;
    margin-bottom: 12px;
  }

  .tally-title {
    font-size: clamp(2rem, 4vw, 2.8rem);
    font-weight: 800;
    letter-spacing: -0.04em;
    color: var(--team-navy);
  }

  .tally-title span { color: var(--team-primary); }

  /* ===== OVERVIEW SECTION ===== */
  .overview-section {
    padding: 60px 0;
    background: #ffffff;
  }

  .overview-content {
    max-width: 820px;
    margin: 0 auto;
  }

  .overview-content p {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #444;
    margin-bottom: 20px;
    text-align: justify;
  }

  .overview-content p:last-child {
    margin-bottom: 0;
  }

  /* ===== BENEFITS SECTION ===== */
  .benefits-section {
    padding: 60px 0 70px;
    background: #f8fafc;
  }

  .benefit-card {
    padding: 30px 22px 26px;
    border-radius: 20px;
    background: #ffffff;
    border: 1px solid var(--team-border);
    transition: all 0.4s ease;
    box-shadow: 0 4px 16px rgba(0,0,0,0.02);
    height: 100%;
    text-align: center;
  }

  .benefit-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(157,54,38,0.08);
    border-color: rgba(157,54,38,0.12);
  }

  .benefit-card .icon-box {
    width: 60px;
    height: 60px;
    margin: 0 auto 16px;
    display: grid;
    place-items: center;
    border-radius: 16px;
    background: var(--team-primary-light);
    color: var(--team-primary);
    font-size: 1.8rem;
    transition: all 0.4s ease;
  }

  .benefit-card:hover .icon-box {
    background: var(--team-primary);
    color: #fff;
    transform: scale(1.05);
  }

  .benefit-card h4 {
    font-size: 1.05rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: var(--team-navy);
  }

  .benefit-card p {
    font-size: 0.9rem;
    color: var(--team-text);
    line-height: 1.7;
    margin: 0;
  }

  /* ===== UPSKILLING SECTION ===== */
  .upskilling-section {
    padding: 60px 0;
    background: #ffffff;
  }

  .service-content-box {
    padding: 32px 28px;
    border-radius: 20px;
    background: #f8fafc;
    border: 1px solid var(--team-border);
    transition: all 0.4s ease;
    height: 100%;
  }

  .service-content-box:hover {
    background: #ffffff;
    box-shadow: 0 12px 36px rgba(0,0,0,0.04);
    transform: translateY(-4px);
    border-color: rgba(157,54,38,0.10);
  }

  .service-content-box h4 {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--team-navy);
    margin-bottom: 12px;
  }

  .service-content-box h4 i {
    color: var(--team-primary);
    margin-right: 10px;
  }

  .service-content-box p {
    font-size: 0.95rem;
    color: var(--team-text);
    line-height: 1.8;
    margin: 0;
  }

  /* ===== TARGET SECTION ===== */
  .target-section {
    padding: 60px 0 70px;
    background: #f8fafc;
  }

  .target-card {
    padding: 30px 24px;
    border-radius: 20px;
    background: #ffffff;
    border: 1px solid var(--team-border);
    transition: all 0.4s ease;
    text-align: center;
    height: 100%;
  }

  .target-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(157,54,38,0.08);
    border-color: rgba(157,54,38,0.15);
  }

  .target-card h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--team-navy);
    margin-bottom: 10px;
  }

  .target-card h4 i {
    color: var(--team-primary);
    margin-right: 8px;
  }

  .target-card p {
    font-size: 0.9rem;
    color: var(--team-text);
    line-height: 1.7;
    margin: 0;
  }

  /* ================================
     TEAM SECTION
  ================================= */

  .premium-team {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    padding: 70px 0 90px;
    background:
      radial-gradient(circle at 5% 12%, rgba(157, 54, 38, 0.12), transparent 24%),
      radial-gradient(circle at 96% 88%, rgba(11, 23, 42, 0.1), transparent 28%),
      linear-gradient(145deg, #ffffff 0%, #f8fafc 55%, #f1f5f9 100%);
  }

  .premium-team::before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.42;
    background-image:
      linear-gradient(rgba(15, 23, 42, 0.035) 1px, transparent 1px),
      linear-gradient(90deg, rgba(15, 23, 42, 0.035) 1px, transparent 1px);
    background-size: 42px 42px;
    mask-image: linear-gradient(to bottom, black, transparent 88%);
  }

  .team-decoration {
    position: absolute;
    z-index: -1;
    border-radius: 50%;
    filter: blur(2px);
    pointer-events: none;
  }

  .team-decoration-one {
    top: 70px;
    right: -90px;
    width: 250px;
    height: 250px;
    border: 45px solid rgba(157, 54, 38, 0.06);
  }

  .team-decoration-two {
    bottom: 60px;
    left: -70px;
    width: 180px;
    height: 180px;
    background: rgba(11, 23, 42, 0.04);
  }

  .team-section-header {
    max-width: 760px;
    margin: 0 auto 48px;
    text-align: center;
  }

  .team-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 18px;
    padding: 9px 17px;
    border: 1px solid rgba(157, 54, 38, 0.14);
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.84);
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.06);
    color: var(--team-primary);
    font-size: 0.76rem;
    font-weight: 800;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    backdrop-filter: blur(12px);
  }

  .team-eyebrow-icon {
    display: inline-grid;
    width: 25px;
    height: 25px;
    place-items: center;
    border-radius: 50%;
    background: var(--team-primary);
    color: #fff;
    font-size: 0.68rem;
  }

  .team-section-title {
    margin: 0;
    color: var(--team-navy);
    font-size: clamp(2.25rem, 5vw, 4rem);
    font-weight: 800;
    letter-spacing: -0.055em;
    line-height: 1.05;
  }

  .team-section-title span {
    color: var(--team-primary);
  }

  .team-section-description {
    max-width: 620px;
    margin: 22px auto 0;
    color: var(--team-muted);
    font-size: 1.04rem;
    line-height: 1.8;
  }

  /* ================================
     Team card
  ================================= */

  .team-member-column {
    display: flex;
  }

  .team-member-card {
    position: relative;
    width: 100%;
    padding: 0;
    overflow: hidden;
    border: 1px solid var(--team-border);
    border-radius: var(--team-radius);
    background: rgba(255, 255, 255, 0.92);
    box-shadow: var(--team-shadow);
    text-align: left;
    cursor: pointer;
    transition:
      transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1),
      box-shadow 0.4s ease,
      border-color 0.4s ease;
    backdrop-filter: blur(14px);
  }

  .team-member-card::before {
    content: "";
    position: absolute;
    z-index: 3;
    top: -80px;
    right: -80px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(157, 54, 38, 0.1);
    transition: transform 0.45s ease;
    pointer-events: none;
  }

  .team-member-card:hover,
  .team-member-card:focus-visible {
    transform: translateY(-12px);
    border-color: rgba(157, 54, 38, 0.28);
    box-shadow: 0 35px 85px rgba(15, 23, 42, 0.16);
    outline: none;
  }

  .team-member-card:hover::before,
  .team-member-card:focus-visible::before {
    transform: scale(1.35);
  }

  .team-image-area {
    position: relative;
    height: 295px;
    margin: 10px;
    overflow: hidden;
    border-radius: 21px;
    background:
      radial-gradient(circle at 50% 20%, #ffffff, transparent 45%),
      linear-gradient(145deg, #e9eef5, #dce4ee);
  }

  .team-image-area::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to bottom,
      transparent 48%,
      rgba(11, 23, 42, 0.08) 72%,
      rgba(11, 23, 42, 0.65) 100%
    );
    pointer-events: none;
  }

  .team-member-image {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: top center;
    transition: transform 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  .team-member-card:hover .team-member-image,
  .team-member-card:focus-visible .team-member-image {
    transform: scale(1.065);
  }




  /* ===== Premium Look Overlay ===== */
  .team-image-overlay {
    position: absolute;
    inset: 0;
    z-index: 4;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(11, 23, 42, 0.55);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.35s ease, visibility 0.35s ease;
    border-radius: 21px;
    pointer-events: none;
  }

  .team-member-card:hover .team-image-overlay,
  .team-member-card:focus-visible .team-image-overlay {
    opacity: 1;
    visibility: visible;
  }

  .team-preview-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 18px 22px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.95);
    color: var(--team-primary);
    box-shadow: 0 12px 40px rgba(15, 23, 42, 0.25);
    transform: scale(0.85);
    transition: transform 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  .team-member-card:hover .team-preview-icon,
  .team-member-card:focus-visible .team-preview-icon {
    transform: scale(1);
  }

  .team-preview-icon i {
    font-size: 1.55rem;
  }

  .team-preview-icon span {
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--team-navy);
  }

  .team-role-badge {
    position: absolute;
    z-index: 2;
    top: 18px;
    left: 18px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    max-width: calc(100% - 36px);
    padding: 9px 13px;
    border: 1px solid rgba(255, 255, 255, 0.45);
    border-radius: 999px;
    background: rgba(11, 23, 42, 0.8);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    line-height: 1.2;
    backdrop-filter: blur(12px);
  }

  .team-role-badge i {
    color: #f6a89b;
  }

  .team-experience-badge {
    position: absolute;
    z-index: 2;
    right: 16px;
    bottom: 16px;
    padding: 8px 12px;
    border: 1px solid rgba(255, 255, 255, 0.28);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.9);
    color: var(--team-navy);
    font-size: 0.74rem;
    font-weight: 800;
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.12);
    backdrop-filter: blur(12px);
  }

  .team-member-content {
    position: relative;
    padding: 17px 23px 25px;
  }

  .team-member-name {
    margin: 0 50px 7px 0;
    color: var(--team-navy);
    font-size: 1.34rem;
    font-weight: 800;
    letter-spacing: -0.025em;
  }

  .team-member-speciality {
    min-height: 46px;
    margin: 0;
    color: var(--team-text);
    font-size: 0.9rem;
    line-height: 1.55;
  }

  .team-card-action {
    position: absolute;
    top: 18px;
    right: 21px;
    display: grid;
    width: 39px;
    height: 39px;
    place-items: center;
    border-radius: 50%;
    background: var(--team-primary-light);
    color: var(--team-primary);
    transition:
      transform 0.3s ease,
      background 0.3s ease,
      color 0.3s ease;
  }

  .team-member-card:hover .team-card-action,
  .team-member-card:focus-visible .team-card-action {
    transform: rotate(-45deg);
    background: var(--team-primary);
    color: #fff;
  }

  /* ================================
     Modal
  ================================= */

  .team-profile-modal .modal-dialog {
    max-width: 920px;
  }

  .team-profile-modal .modal-content {
    overflow: hidden;
    border: 0;
    border-radius: 32px;
    background: #fff;
    box-shadow: 0 40px 120px rgba(15, 23, 42, 0.28);
  }

  .team-modal-close {
    position: absolute;
    z-index: 10;
    top: 18px;
    right: 18px;
    display: grid;
    width: 44px;
    height: 44px;
    place-items: center;
    border: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.92);
    color: var(--team-navy);
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.12);
    transition:
      transform 0.25s ease,
      background 0.25s ease,
      color 0.25s ease;
  }

  .team-modal-close:hover {
    transform: rotate(90deg);
    background: var(--team-primary);
    color: #fff;
  }

  .team-modal-visual {
    position: relative;
    min-height: 510px;
    overflow: hidden;
    background:
      radial-gradient(circle at 30% 15%, rgba(255, 255, 255, 0.22), transparent 30%),
      linear-gradient(150deg, var(--team-primary), var(--team-primary-dark));
  }

  .team-modal-visual::before {
    content: "";
    position: absolute;
    top: -120px;
    left: -130px;
    width: 330px;
    height: 330px;
    border: 55px solid rgba(255, 255, 255, 0.08);
    border-radius: 50%;
  }

  .team-modal-visual::after {
    content: "";
    position: absolute;
    right: -80px;
    bottom: -90px;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: rgba(11, 23, 42, 0.16);
  }

  .team-modal-image-wrap {
    position: absolute;
    z-index: 2;
    inset: 48px 36px 0;
    overflow: hidden;
    border-radius: 120px 120px 0 0;
    background: rgba(255, 255, 255, 0.13);
    box-shadow: 0 30px 80px rgba(35, 13, 9, 0.28);
  }

  .team-modal-image {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: top center;
  }

  .team-modal-content {
    display: flex;
    min-height: 510px;
    flex-direction: column;
    justify-content: center;
    padding: 58px 54px;
  }

  .team-modal-label {
    display: inline-flex;
    align-self: flex-start;
    align-items: center;
    gap: 7px;
    margin-bottom: 20px;
    padding: 8px 13px;
    border-radius: 999px;
    background: var(--team-primary-light);
    color: var(--team-primary);
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
  }

  .team-modal-name {
    margin: 0;
    color: var(--team-navy);
    font-size: clamp(2rem, 4vw, 3.1rem);
    font-weight: 800;
    letter-spacing: -0.055em;
    line-height: 1.05;
  }

  .team-modal-role {
    margin-top: 13px;
    color: var(--team-primary);
    font-size: 1rem;
    font-weight: 750;
  }

  .team-modal-divider {
    width: 58px;
    height: 4px;
    margin: 24px 0;
    border-radius: 20px;
    background: var(--team-primary);
  }

  .team-modal-description {
    margin: 0;
    color: var(--team-text);
    font-size: 1rem;
    line-height: 1.8;
  }

  .team-modal-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 28px;
  }

  .team-meta-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 13px;
    border: 1px solid var(--team-border);
    border-radius: 12px;
    background: #f8fafc;
    color: var(--team-navy);
    font-size: 0.82rem;
    font-weight: 700;
  }

  .team-meta-pill i {
    color: var(--team-primary);
  }

  /* ================================
     Responsive
  ================================= */

  @media (max-width: 991.98px) {
    .premium-team { padding: 60px 0; }
    .team-modal-visual { min-height: 390px; }
    .team-modal-image-wrap { inset: 35px 70px 0; }
    .team-modal-content { min-height: auto; padding: 44px 38px 48px; }
  }

  @media (max-width: 767.98px) {
    .premium-team { padding: 50px 0; }
    .team-section-header { margin-bottom: 38px; }
    .team-section-description { font-size: 0.95rem; }
    .team-image-area { height: 340px; }
    .team-profile-modal .modal-dialog { margin: 14px; }
    .team-profile-modal .modal-content { border-radius: 25px; }
    .team-modal-visual { min-height: 350px; }
    .team-modal-image-wrap { inset: 32px 55px 0; }
    .team-modal-content { padding: 38px 27px 40px; }
    .overview-section { padding: 40px 0; }
    .benefits-section { padding: 40px 0 50px; }
    .upskilling-section { padding: 40px 0; }
    .target-section { padding: 40px 0 50px; }
  }

  @media (max-width: 480px) {
    .team-image-area { height: 300px; }
    .team-modal-visual { min-height: 310px; }
    .team-modal-image-wrap { inset: 30px 34px 0; }
  }

  @media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
      scroll-behavior: auto !important;
      transition-duration: 0.01ms !important;
      animation-duration: 0.01ms !important;
      animation-iteration-count: 1 !important;
    }
  }
</style>

</head>

<body>

<?php include("navbar.php"); ?>
<?php include("modal.php"); ?>
<!-- =========================================================
   TALLYXCELERATOR — MULTI-LAYOUT ULTRA PREMIUM DESIGN
   Har section ka alag level ka design
========================================================= -->
<!-- =========================================================
   TALLYXCELERATOR — 2026 ULTRA PREMIUM FUTURISTIC DESIGN
   Neo-Glassmorphism | Micro-interactions | 3D Depth
========================================================= -->

<style>
/* =========================================================
   2026 ROOT VARIABLES — ULTRA PREMIUM
========================================================= */

:root {
    --tx-primary: #8f3024;
    --tx-primary-dark: #641d16;
    --tx-primary-light: #b94b3a;
    --tx-gold: #b59668;
    --tx-gold-light: #d4b896;
    --tx-gold-glow: rgba(181,150,104,0.3);
    
    --tx-ink: #0a0808;
    --tx-text: #2a2523;
    --tx-muted: #8a8280;
    --tx-muted-light: #b0a8a5;
    
    --tx-bg: #f6f3f0;
    --tx-white: #ffffff;
    --tx-border: rgba(255,255,255,0.25);
    
    /* 2026 Glow Effects */
    --tx-glow-primary: 0 0 60px rgba(143,48,36,0.15);
    --tx-glow-gold: 0 0 80px rgba(181,150,104,0.12);
    --tx-glow-white: 0 0 100px rgba(255,255,255,0.06);
    
    /* 2026 Shadows — Extra Depth */
    --tx-shadow-xs: 0 2px 20px rgba(43,25,18,0.04);
    --tx-shadow-sm: 0 8px 40px rgba(43,25,18,0.06);
    --tx-shadow: 0 20px 70px rgba(43,25,18,0.08);
    --tx-shadow-lg: 0 40px 120px rgba(43,25,18,0.14);
    --tx-shadow-xl: 0 60px 180px rgba(43,25,18,0.18);
    --tx-shadow-3d: 0 30px 80px rgba(43,25,18,0.12), 0 10px 30px rgba(43,25,18,0.04);
    
    /* 2026 Border Radius */
    --tx-radius-sm: 12px;
    --tx-radius: 24px;
    --tx-radius-lg: 32px;
    --tx-radius-xl: 40px;
    --tx-radius-full: 9999px;
    
    /* 2026 Transitions */
    --tx-transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    --tx-transition-bounce: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* =========================================================
   GLOBAL — 2026 BASE
========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.tx-2026 {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: var(--tx-bg);
    overflow: hidden;
    position: relative;
}

.tx-2026 * {
    box-sizing: border-box;
}

.tx-container {
    width: min(1200px, calc(100% - 48px));
    margin: 0 auto;
    position: relative;
}

/* =========================================================
   2026 TYPOGRAPHY
========================================================= */

.tx-badge-2026 {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--tx-primary);
    background: rgba(143,48,36,0.06);
    padding: 6px 16px 6px 12px;
    border-radius: var(--tx-radius-full);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(143,48,36,0.06);
}

.tx-badge-2026 i {
    font-size: 10px;
    color: var(--tx-gold);
}

.tx-heading-2026 {
    font-size: clamp(40px, 5.5vw, 68px);
    line-height: 1.02;
    letter-spacing: -4px;
    font-weight: 850;
    color: var(--tx-ink);
    margin: 18px 0 0;
}

.tx-heading-2026 .tx-gradient-text {
    background: linear-gradient(135deg, var(--tx-primary), var(--tx-primary-dark), var(--tx-gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tx-heading-2026 .tx-gradient-gold {
    background: linear-gradient(135deg, var(--tx-gold), #d4a858);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tx-text-2026 {
    font-size: 15px;
    line-height: 1.9;
    color: var(--tx-muted);
    max-width: 620px;
}

.tx-text-2026 strong {
    color: var(--tx-ink);
    font-weight: 700;
}

.tx-divider-2026 {
    width: 60px;
    height: 4px;
    border-radius: 10px;
    background: linear-gradient(90deg, var(--tx-primary), var(--tx-gold));
    margin: 18px 0;
}

.tx-divider-2026-center {
    margin: 18px auto;
}

/* =========================================================
   SECTION 1: OVERVIEW — 2026 HERO LAYOUT
   Floating glassmorphism | 3D Depth | Animated Particles
========================================================= */

.tx-overview-2026 {
    position: relative;
    padding: 140px 0 120px;
    background: 
        radial-gradient(ellipse at 80% 20%, rgba(143,48,36,0.04), transparent 50%),
        radial-gradient(ellipse at 20% 80%, rgba(181,150,104,0.03), transparent 50%),
        #ffffff;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

/* Floating particles */
.tx-overview-2026 .tx-particles {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}

.tx-overview-2026 .tx-particle {
    position: absolute;
    border-radius: 50%;
    background: rgba(143,48,36,0.04);
    animation: txFloatParticle 20s infinite ease-in-out;
}

.tx-overview-2026 .tx-particle:nth-child(1) {
    width: 300px;
    height: 300px;
    top: -100px;
    right: -50px;
    animation-delay: 0s;
    background: rgba(181,150,104,0.04);
}

.tx-overview-2026 .tx-particle:nth-child(2) {
    width: 200px;
    height: 200px;
    bottom: -50px;
    left: -50px;
    animation-delay: -5s;
    background: rgba(143,48,36,0.03);
}

.tx-overview-2026 .tx-particle:nth-child(3) {
    width: 150px;
    height: 150px;
    top: 40%;
    right: 10%;
    animation-delay: -10s;
    background: rgba(181,150,104,0.05);
}

/* Main glow orb */
.tx-overview-2026 .tx-glow-orb {
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    right: -200px;
    top: -250px;
    background: radial-gradient(circle, rgba(143,48,36,0.06), transparent 70%);
    filter: blur(60px);
    pointer-events: none;
}

.tx-overview-2026 .tx-grid-2026 {
    display: grid;
    grid-template-columns: 1fr 0.9fr;
    gap: 80px;
    align-items: center;
    position: relative;
    z-index: 2;
}

/* Left Content */
.tx-overview-2026 .tx-left-content {
    position: relative;
}

.tx-overview-2026 .tx-left-content .tx-heading-2026 {
    max-width: 700px;
}

.tx-overview-2026 .tx-left-content .tx-text-2026 {
    margin-top: 22px;
}

.tx-overview-2026 .tx-left-content .tx-text-2026:first-of-type {
    margin-top: 28px;
}

/* Right — Glass Card */
.tx-overview-2026 .tx-glass-card {
    position: relative;
    padding: 48px 40px 40px;
    border-radius: var(--tx-radius-xl);
    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 1px solid rgba(255,255,255,0.5);
    box-shadow: 
        var(--tx-shadow-lg),
        inset 0 1px 0 rgba(255,255,255,0.8);
    transition: var(--tx-transition);
}

.tx-overview-2026 .tx-glass-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--tx-shadow-xl), inset 0 1px 0 rgba(255,255,255,0.8);
}

/* Glass card gradient top line */
.tx-overview-2026 .tx-glass-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 20%;
    right: 20%;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--tx-primary), var(--tx-gold), transparent);
    border-radius: 10px;
}

.tx-overview-2026 .tx-glass-card .tx-quote-icon {
    font-size: 32px;
    color: rgba(143,48,36,0.08);
    line-height: 1;
    margin-bottom: 8px;
}

.tx-overview-2026 .tx-glass-card p {
    font-size: 20px;
    line-height: 1.6;
    color: var(--tx-ink);
    font-weight: 600;
    letter-spacing: -0.5px;
}

.tx-overview-2026 .tx-glass-card p i {
    color: var(--tx-primary);
    margin-right: 14px;
}

.tx-overview-2026 .tx-glass-card .tx-card-footer {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid rgba(0,0,0,0.04);
}

.tx-overview-2026 .tx-glass-card .tx-card-footer span {
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--tx-muted-light);
}

.tx-overview-2026 .tx-glass-card .tx-card-footer .tx-dot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: var(--tx-gold);
}

/* Floating 3D badge */
.tx-overview-2026 .tx-float-badge {
    position: absolute;
    bottom: -16px;
    right: -16px;
    padding: 20px 30px;
    border-radius: var(--tx-radius);
    background: linear-gradient(135deg, var(--tx-primary), var(--tx-primary-dark));
    color: #fff;
    box-shadow: 0 25px 60px rgba(143,48,36,0.3);
    animation: txFloatBadge 6s ease-in-out infinite;
}

.tx-overview-2026 .tx-float-badge .tx-number {
    font-size: 34px;
    font-weight: 900;
    letter-spacing: -3px;
    line-height: 1;
}

.tx-overview-2026 .tx-float-badge .tx-label {
    font-size: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0.8;
    margin-top: 4px;
}


/* =========================================================
   SECTION 2: BENEFITS — 2026 NEO-GLASS LAYOUT
   Floating cards | Gradient borders | Hover 3D lift
========================================================= */

.tx-benefits-2026 {
    position: relative;
    padding: 120px 0;
    background: var(--tx-bg);
    overflow: hidden;
}

/* Background decoration */
.tx-benefits-2026 .tx-bg-deco {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.tx-benefits-2026 .tx-bg-deco .tx-circle {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(143,48,36,0.03);
}

.tx-benefits-2026 .tx-bg-deco .tx-circle:nth-child(1) {
    width: 500px;
    height: 500px;
    right: -200px;
    top: -100px;
}

.tx-benefits-2026 .tx-bg-deco .tx-circle:nth-child(2) {
    width: 300px;
    height: 300px;
    left: -100px;
    bottom: -50px;
}

.tx-benefits-2026 .tx-header-2026 {
    text-align: center;
    margin-bottom: 55px;
    position: relative;
    z-index: 2;
}

.tx-benefits-2026 .tx-header-2026 .tx-heading-2026 {
    max-width: 700px;
    margin: 18px auto 0;
}

.tx-benefits-2026 .tx-grid-2026 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    position: relative;
    z-index: 2;
}

.tx-benefit-2026 {
    position: relative;
    padding: 40px 28px 32px;
    border-radius: var(--tx-radius);
    background: var(--tx-white);
    border: 1px solid rgba(255,255,255,0.5);
    box-shadow: var(--tx-shadow-sm);
    transition: var(--tx-transition-bounce);
    overflow: hidden;
}

/* Hover glow effect */
.tx-benefit-2026::before {
    content: "";
    position: absolute;
    inset: -1px;
    border-radius: var(--tx-radius);
    padding: 1px;
    background: linear-gradient(135deg, transparent, rgba(143,48,36,0.05), transparent);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: var(--tx-transition);
}

.tx-benefit-2026:hover::before {
    opacity: 1;
}

.tx-benefit-2026:hover {
    transform: translateY(-12px) scale(1.01);
    box-shadow: var(--tx-shadow-xl), var(--tx-glow-primary);
    border-color: rgba(143,48,36,0.08);
}

/* Gradient top bar */
.tx-benefit-2026 .tx-top-bar {
    width: 40px;
    height: 3px;
    border-radius: 10px;
    background: linear-gradient(90deg, var(--tx-primary), var(--tx-gold));
    margin-bottom: 20px;
    transition: var(--tx-transition);
}

.tx-benefit-2026:hover .tx-top-bar {
    width: 60px;
}

.tx-benefit-2026 .tx-icon-wrap {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(143,48,36,0.06), rgba(181,150,104,0.06));
    color: var(--tx-primary);
    font-size: 22px;
    margin-bottom: 18px;
    transition: var(--tx-transition);
}

.tx-benefit-2026:hover .tx-icon-wrap {
    background: linear-gradient(135deg, var(--tx-primary), var(--tx-primary-dark));
    color: #fff;
    box-shadow: 0 15px 40px rgba(143,48,36,0.2);
    transform: scale(1.05) rotate(-2deg);
}

.tx-benefit-2026 .tx-index {
    position: absolute;
    right: 20px;
    top: 16px;
    font-size: 42px;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -4px;
    color: rgba(0,0,0,0.02);
    transition: var(--tx-transition);
}

.tx-benefit-2026:hover .tx-index {
    color: rgba(143,48,36,0.04);
    transform: scale(1.1);
}

.tx-benefit-2026 h4 {
    font-size: 18px;
    font-weight: 800;
    color: var(--tx-ink);
    margin-bottom: 10px;
}

.tx-benefit-2026 p {
    font-size: 12px;
    line-height: 1.8;
    color: var(--tx-muted);
    margin: 0;
}

.tx-benefit-2026 .tx-hover-arrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 16px;
    font-size: 8px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--tx-primary);
    opacity: 0;
    transform: translateX(-12px);
    transition: var(--tx-transition-bounce);
}

.tx-benefit-2026:hover .tx-hover-arrow {
    opacity: 1;
    transform: translateX(0);
}


/* =========================================================
   SECTION 3: UPSKILLING — 2026 SPLIT LAYOUT
   Asymmetric design | Gradient cards | Micro-interactions
========================================================= */

.tx-upskilling-2026 {
    position: relative;
    padding: 130px 0;
    background: #ffffff;
    overflow: hidden;
}

/* Asymmetric decoration */
.tx-upskilling-2026 .tx-asym-deco {
    position: absolute;
    right: -150px;
    top: -150px;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    border: 1px solid rgba(143,48,36,0.03);
    pointer-events: none;
}

.tx-upskilling-2026 .tx-asym-deco-2 {
    position: absolute;
    left: -100px;
    bottom: -100px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    border: 1px solid rgba(181,150,104,0.04);
    pointer-events: none;
}

.tx-upskilling-2026 .tx-header-2026 {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 2;
}

.tx-upskilling-2026 .tx-grid-2026 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    position: relative;
    z-index: 2;
}

.tx-upskill-2026 {
    position: relative;
    padding: 48px 38px 40px;
    border-radius: var(--tx-radius-xl);
    background: var(--tx-white);
    border: 1px solid var(--tx-border);
    box-shadow: var(--tx-shadow-sm);
    transition: var(--tx-transition-bounce);
    overflow: hidden;
}

/* Gradient hover overlay */
.tx-upskill-2026::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(143,48,36,0.02), rgba(181,150,104,0.02));
    opacity: 0;
    transition: var(--tx-transition);
}

.tx-upskill-2026:hover::after {
    opacity: 1;
}

.tx-upskill-2026:hover {
    transform: translateY(-8px);
    box-shadow: var(--tx-shadow-lg);
    border-color: rgba(143,48,36,0.06);
}

.tx-upskill-2026 .tx-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 4px 16px 4px 12px;
    border-radius: var(--tx-radius-full);
    background: rgba(143,48,36,0.04);
    color: var(--tx-primary);
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 16px;
    position: relative;
    z-index: 2;
}

.tx-upskill-2026 .tx-tag i {
    font-size: 10px;
}

.tx-upskill-2026 .tx-header-row {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 18px;
    position: relative;
    z-index: 2;
}

.tx-upskill-2026 .tx-header-row .tx-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--tx-primary), var(--tx-primary-dark));
    color: #fff;
    font-size: 24px;
    flex-shrink: 0;
    box-shadow: 0 15px 40px rgba(143,48,36,0.15);
    transition: var(--tx-transition);
}

.tx-upskill-2026:hover .tx-header-row .tx-icon {
    transform: scale(1.05) rotate(-3deg);
    box-shadow: 0 20px 50px rgba(143,48,36,0.2);
}

.tx-upskill-2026 .tx-header-row h4 {
    font-size: 20px;
    font-weight: 800;
    color: var(--tx-ink);
    margin: 0;
    padding-top: 4px;
}

.tx-upskill-2026 p {
    font-size: 14px;
    line-height: 1.85;
    color: var(--tx-muted);
    margin: 0;
    position: relative;
    z-index: 2;
}

.tx-upskill-2026 .tx-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 18px;
    position: relative;
    z-index: 2;
}

.tx-upskill-2026 .tx-tags span {
    padding: 5px 16px;
    border-radius: var(--tx-radius-full);
    background: rgba(0,0,0,0.02);
    border: 1px solid rgba(0,0,0,0.04);
    font-size: 9px;
    font-weight: 600;
    color: var(--tx-muted);
    transition: var(--tx-transition);
}

.tx-upskill-2026:hover .tx-tags span {
    background: rgba(143,48,36,0.04);
    border-color: rgba(143,48,36,0.06);
    color: var(--tx-primary);
}


/* =========================================================
   SECTION 4: TARGET — 2026 DARK LUXURY
   Deep gradient | Glass cards | Gold accents | 3D depth
========================================================= */

.tx-target-2026 {
    position: relative;
    padding: 130px 0;
    background: 
        linear-gradient(135deg, #1a0806 0%, #3d0f0a 30%, #5a1810 60%, #3d0f0a 100%);
    overflow: hidden;
}

/* Animated gradient overlay */
.tx-target-2026::before {
    content: "";
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(ellipse at 30% 50%, rgba(181,150,104,0.04), transparent 60%),
        radial-gradient(ellipse at 70% 50%, rgba(143,48,36,0.04), transparent 60%);
    pointer-events: none;
}

/* Decorative rings */
.tx-target-2026 .tx-ring-deco {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.02);
    pointer-events: none;
}

.tx-target-2026 .tx-ring-deco:nth-child(1) {
    width: 600px;
    height: 600px;
    right: -200px;
    top: -100px;
}

.tx-target-2026 .tx-ring-deco:nth-child(2) {
    width: 400px;
    height: 400px;
    left: -150px;
    bottom: -50px;
}

/* Glow orbs */
.tx-target-2026 .tx-glow-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}

.tx-target-2026 .tx-glow-orb:nth-child(3) {
    width: 400px;
    height: 400px;
    right: -100px;
    bottom: -150px;
    background: radial-gradient(circle, rgba(181,150,104,0.04), transparent 70%);
}

.tx-target-2026 .tx-glow-orb:nth-child(4) {
    width: 300px;
    height: 300px;
    left: -50px;
    top: -100px;
    background: radial-gradient(circle, rgba(143,48,36,0.04), transparent 70%);
}

.tx-target-2026 .tx-header-2026 {
    text-align: center;
    margin-bottom: 55px;
    position: relative;
    z-index: 2;
}

.tx-target-2026 .tx-header-2026 .tx-badge-2026 {
    color: #e5c898;
    background: rgba(229,200,152,0.08);
    border-color: rgba(229,200,152,0.06);
}

.tx-target-2026 .tx-header-2026 .tx-badge-2026 i {
    color: #e5c898;
}

.tx-target-2026 .tx-header-2026 .tx-heading-2026 {
    color: #fff;
}

.tx-target-2026 .tx-header-2026 .tx-divider-2026 {
    background: linear-gradient(90deg, #e5c898, var(--tx-gold));
    margin: 18px auto;
}

.tx-target-2026 .tx-grid-2026 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    position: relative;
    z-index: 2;
}

.tx-target-2026 .tx-target-card {
    position: relative;
    padding: 42px 32px 36px;
    border-radius: var(--tx-radius);
    background: rgba(255,255,255,0.03);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.06);
    transition: var(--tx-transition-bounce);
    overflow: hidden;
}

/* Glass shine effect */
.tx-target-2026 .tx-target-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.03), transparent 50%);
    opacity: 0;
    transition: var(--tx-transition);
}

.tx-target-2026 .tx-target-card:hover::before {
    opacity: 1;
}

.tx-target-2026 .tx-target-card:hover {
    transform: translateY(-12px);
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,255,255,0.12);
    box-shadow: 0 30px 100px rgba(0,0,0,0.3);
}

/* Gold accent bar */
.tx-target-2026 .tx-target-card .tx-accent-bar {
    width: 40px;
    height: 3px;
    border-radius: 10px;
    background: linear-gradient(90deg, #e5c898, var(--tx-gold));
    margin-bottom: 20px;
    transition: var(--tx-transition);
}

.tx-target-2026 .tx-target-card:hover .tx-accent-bar {
    width: 60px;
}

.tx-target-2026 .tx-target-card .tx-icon-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
}

.tx-target-2026 .tx-target-card .tx-icon-row .tx-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(229,200,152,0.08);
    color: #e5c898;
    font-size: 20px;
    flex-shrink: 0;
    transition: var(--tx-transition);
}

.tx-target-2026 .tx-target-card:hover .tx-icon-row .tx-icon {
    background: rgba(229,200,152,0.15);
    transform: scale(1.05);
}

.tx-target-2026 .tx-target-card .tx-icon-row h4 {
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    margin: 0;
}

.tx-target-2026 .tx-target-card p {
    font-size: 13px;
    line-height: 1.8;
    color: rgba(255,255,255,0.6);
    margin: 0;
}

.tx-target-2026 .tx-target-card .tx-index {
    position: absolute;
    right: 22px;
    top: 18px;
    font-size: 40px;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -4px;
    color: rgba(255,255,255,0.02);
    transition: var(--tx-transition);
}

.tx-target-2026 .tx-target-card:hover .tx-index {
    color: rgba(255,255,255,0.04);
}


/* =========================================================
   2026 ANIMATIONS
========================================================= */

@keyframes txFloatParticle {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -30px) scale(1.05); }
    50% { transform: translate(-10px, 20px) scale(0.95); }
    75% { transform: translate(30px, 10px) scale(1.02); }
}

@keyframes txFloatBadge {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
}

@keyframes txFadeUp2026 {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes txFadeIn2026 {
    from { opacity: 0; }
    to { opacity: 1; }
}

.tx-animate-2026 {
    animation: txFadeUp2026 0.9s cubic-bezier(0.23, 1, 0.32, 1) forwards;
}

.tx-delay-1 { animation-delay: 0.1s; opacity: 0; }
.tx-delay-2 { animation-delay: 0.2s; opacity: 0; }
.tx-delay-3 { animation-delay: 0.3s; opacity: 0; }
.tx-delay-4 { animation-delay: 0.4s; opacity: 0; }

.tx-fade-in-2026 {
    animation: txFadeIn2026 1.2s ease forwards;
}


/* =========================================================
   2026 RESPONSIVE
========================================================= */

@media(max-width: 1100px) {
    .tx-overview-2026 .tx-grid-2026 {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    
    .tx-benefits-2026 .tx-grid-2026 {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .tx-target-2026 .tx-grid-2026 {
        grid-template-columns: 1fr 1fr;
    }
}

@media(max-width: 900px) {
    .tx-upskilling-2026 .tx-grid-2026 {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 700px) {
    .tx-overview-2026 {
        padding: 100px 0 80px;
        min-height: auto;
    }
    
    .tx-benefits-2026 .tx-grid-2026 {
        grid-template-columns: 1fr;
    }
    
    .tx-target-2026 .tx-grid-2026 {
        grid-template-columns: 1fr;
    }
    
    .tx-heading-2026 {
        font-size: 32px;
        letter-spacing: -2px;
    }
    
    .tx-overview-2026 .tx-glass-card p {
        font-size: 16px;
    }
    
    .tx-overview-2026 .tx-float-badge {
        position: relative;
        bottom: auto;
        right: auto;
        margin-top: 20px;
    }
    
    .tx-upskill-2026 {
        padding: 32px 24px;
    }
    
    .tx-upskill-2026 .tx-header-row {
        flex-direction: column;
        gap: 12px;
    }
}

@media(max-width: 430px) {
    .tx-overview-2026 {
        padding: 70px 0 60px;
    }
    
    .tx-benefits-2026 {
        padding: 70px 0;
    }
    
    .tx-upskilling-2026 {
        padding: 70px 0;
    }
    
    .tx-target-2026 {
        padding: 70px 0;
    }
    
    .tx-heading-2026 {
        font-size: 28px;
        letter-spacing: -1px;
    }
    
    .tx-benefit-2026 {
        padding: 28px 20px;
    }
    
    .tx-target-2026 .tx-target-card {
        padding: 30px 22px;
    }
}

/* =========================================================
   REDUCED MOTION
========================================================= */

@media(prefers-reduced-motion: reduce) {
    .tx-overview-2026 .tx-particle,
    .tx-overview-2026 .tx-float-badge,
    .tx-benefit-2026,
    .tx-upskill-2026,
    .tx-target-2026 .tx-target-card {
        animation: none !important;
        transition: none !important;
    }
    
    .tx-overview-2026 .tx-float-badge {
        transform: none !important;
    }
}
</style>


<!-- =========================================================
   SECTION 1: OVERVIEW — 2026 HERO LAYOUT
========================================================= -->

<section class="tx-overview-2026">
    <!-- Floating Particles -->
    <div class="tx-particles">
        <div class="tx-particle"></div>
        <div class="tx-particle"></div>
        <div class="tx-particle"></div>
    </div>
    
    <!-- Glow Orb -->
    <div class="tx-glow-orb"></div>
    
    <div class="tx-container">
        <div class="tx-grid-2026">
            
            <!-- Left Content -->
            <div class="tx-left-content tx-animate-2026 tx-delay-1">
               <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                           Program Overview
                            <span class="badge-dot"></span>
                        </span>
                    </div>
                
                <h2 class="tx-heading-2026">
                    TallyXcelerator – <span class="tx-gradient-text">Program Overview</span>
                </h2>
                
                <div class="tx-divider-2026"></div>
                
                <p class="tx-text-2026">
                    Business consulting, coaching, mentoring, training, etc. was earlier perceived by MSMEs as a services exclusive to large enterprises with sizeable budgets. In today's highly competitive & fast changing business world, MSMEs are beginning to recognise the need for engaging with the right experts for such high impact services. However, many MSMEs are still uncertain about where to start this journey.
                </p>
                
                <p class="tx-text-2026">
                    The TallyXcelerator program was developed for this very purpose and was built with a deep understanding of the unique needs of MSMEs. Whether you are an established MSME, an aspiring entrepreneur with a promising idea, or a startup with a solid business plan, this program will provide you with a 360-degree comprehensive support. Through this program, you can get access to a set of experts called <strong>TallyXcelerators (TXs)</strong>, who will offer tailored solutions for your business needs. The TXs will enable you to upskill & upscale your organisation and help you realise your growth ambitions.
                </p>
            </div>
            
            <!-- Right Glass Card -->
            <div class="tx-animate-2026 tx-delay-2">
                <div class="tx-glass-card">
                    <div class="tx-quote-icon">
                      
                    </div>
                    
                    <p>
                        <i class="fa-regular fa-circle-check"></i>
                        TallyXcelerator is a 360-degree program aimed at MSMEs for their growth and development.
                    </p>
                    
                    <div class="tx-card-footer">
                        <span>Program Highlight</span>
                        <span class="tx-dot"></span>
                        <span>360° Comprehensive Support</span>
                    </div>
                </div>
                
                <!-- Floating 3D Badge -->
                <div class="tx-float-badge">
                    <div class="tx-number">360°</div>
                    <div class="tx-label">Comprehensive Support</div>
                </div>
            </div>
            
        </div>
    </div>
</section>


<!-- =========================================================
   SECTION 2: BENEFITS — 2026 NEO-GLASS LAYOUT
========================================================= -->

<section class="tx-benefits-2026">

    <!-- Background Decoration -->
    <div class="tx-bg-deco">
        <div class="tx-circle"></div>
        <div class="tx-circle"></div>
    </div>

    <div class="tx-container">

        <!-- Section Header -->
        <div class="tx-header-2026">

            <div class="premium-badge-wrapper">
                <span class="premium-badge">
                    <span class="badge-dot"></span>
                    BENEFITS
                    <span class="badge-dot"></span>
                </span>
            </div>

            <h2 class="tx-heading-2026">
                Key <span class="tx-gradient-text">Benefits</span>
            </h2>

            <div class="tx-divider-2026 tx-divider-2026-center"></div>

        </div>


        <!-- Benefits Grid -->
        <div class="tx-grid-2026">


            <!-- BENEFIT 1 -->
            <div class="tx-benefit-2026 tx-animate-2026 tx-delay-1">

                <span class="tx-index"></span>

                <div class="tx-top-bar"></div>

                <div class="tx-icon-wrap">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>

                <h4>Enhancing Business Skills</h4>

                <p>
                    Access to training and mentorship to help businesses
                    refine their and their teams' entrepreneurial skills.
                </p>

                <span class="tx-hover-arrow">
                    Learn More
                    <i class="fa-solid fa-arrow-right"></i>
                </span>

            </div>



            <!-- BENEFIT 2 -->
            <div class="tx-benefit-2026 tx-animate-2026 tx-delay-2">

                <span class="tx-index"></span>

                <div class="tx-top-bar"></div>

                <div class="tx-icon-wrap">
                    <i class="fa-solid fa-user-group"></i>
                </div>

                <h4>Expanding Networks</h4>

                <p>
                    Opportunities to connect with a broader business community,
                    including potential partners and investors, facilitating growth.
                </p>

                <span class="tx-hover-arrow">
                    Learn More
                    <i class="fa-solid fa-arrow-right"></i>
                </span>

            </div>



            <!-- BENEFIT 3 -->
            <div class="tx-benefit-2026 tx-animate-2026 tx-delay-3">

                <span class="tx-index"></span>

                <div class="tx-top-bar"></div>

                <div class="tx-icon-wrap">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <h4>Resource Access</h4>

                <p>
                    Guidance on obtaining necessary resources, from financing
                    options to business development services, to scale a business effectively.
                </p>

                <span class="tx-hover-arrow">
                    Learn More
                    <i class="fa-solid fa-arrow-right"></i>
                </span>

            </div>



            <!-- BENEFIT 4 -->
            <div class="tx-benefit-2026 tx-animate-2026 tx-delay-4">

                <span class="tx-index"></span>

                <div class="tx-top-bar"></div>

                <div class="tx-icon-wrap">
                    <i class="fa-solid fa-headset"></i>
                </div>

                <h4>Ongoing Support</h4>

                <p>
                    Ongoing support to help businesses stay on track,
                    overcome challenges, and seize new opportunities.
                </p>

                <span class="tx-hover-arrow">
                    Learn More
                    <i class="fa-solid fa-arrow-right"></i>
                </span>

            </div>


        </div>

    </div>

</section>


<!-- =========================================================
   SECTION 3: UPSKILLING — 2026 SPLIT LAYOUT
========================================================= -->

<section class="tx-upskilling-2026">

    <!-- Asymmetric Decorations -->
    <div class="tx-asym-deco"></div>
    <div class="tx-asym-deco-2"></div>

    <div class="tx-container">

        <!-- Section Header -->
        <div class="tx-header-2026">

            <div class="premium-badge-wrapper">
                <span class="premium-badge">
                    <span class="badge-dot"></span>
                    Upskilling Marketing Services
                    <span class="badge-dot"></span>
                </span>
            </div>

            <h2 class="tx-heading-2026">
                Upskilling and Digital
                <span class="tx-gradient-gold">Marketing Services</span>
            </h2>

            <div class="tx-divider-2026 tx-divider-2026-center"></div>

        </div>


        <!-- Services Grid -->
        <div class="tx-grid-2026">


            <!-- SERVICE 01 -->
            <div class="tx-upskill-2026 tx-animate-2026 tx-delay-1">

                <div class="tx-tag">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    Service 01
                </div>

                <div class="tx-header-row">

                    <div class="tx-icon">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>

                    <h4>Specialized Training Programs</h4>

                </div>

                <p>
                    TXs also offers specialized training programs to upskill
                    both the business owners and their teams, ensuring they
                    are well-equipped with the latest industry knowledge and
                    best practices. These skilling initiatives include
                    workshops on soft skill training, financial management,
                    operational efficiency, and leadership development.
                </p>

                <div class="tx-tags">
                    <span>Soft Skills</span>
                    <span>Financial Management</span>
                    <span>Operational Efficiency</span>
                    <span>Leadership Development</span>
                </div>

            </div>



            <!-- SERVICE 02 -->
            <div class="tx-upskill-2026 tx-animate-2026 tx-delay-2">

                <div class="tx-tag">
                    <i class="fa-solid fa-bullseye"></i>
                    Service 02
                </div>

                <div class="tx-header-row">

                    <div class="tx-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>

                    <h4>Digital Marketing Services</h4>

                </div>

                <p>
                    Additionally, TXs also provide comprehensive digital
                    marketing services, including SEO optimization, social
                    media management, and online advertising strategies.
                    These services are designed to enhance the online presence
                    of SMEs, helping them reach a broader audience and
                    effectively market their products and services.
                </p>

                <div class="tx-tags">
                    <span>SEO Optimization</span>
                    <span>Social Media Management</span>
                    <span>Online Advertising</span>
                </div>

            </div>


        </div>

    </div>

</section>


<!-- =========================================================
   SECTION 4: TARGET — 2026 DARK LUXURY
========================================================= -->

<section class="tx-target-2026">
    <!-- Decorative Rings -->
    <div class="tx-ring-deco"></div>
    <div class="tx-ring-deco"></div>
    
    <!-- Glow Orbs -->
    <div class="tx-glow-orb"></div>
    <div class="tx-glow-orb"></div>
    
    <div class="tx-container">
       <div class="tx-header-2026">
    <span class="tx-badge-2026">
        <i class="fa-solid fa-people-group"></i> Target
    </span>
    
    <h2 class="tx-heading-2026">
        Target <span class="tx-gradient-gold">Beneficiaries</span>
    </h2>
    
    <div class="tx-divider-2026 tx-divider-2026-center"></div>
</div>
        
        <div class="tx-grid-2026">
            
            <div class="tx-target-card tx-animate-2026 tx-delay-1">
                <span class="tx-index">01</span>
                <div class="tx-accent-bar"></div>
                
                <div class="tx-icon-row">
                    <div class="tx-icon"><i class="fa-regular fa-building"></i></div>
                    <h4>Established SME</h4>
                </div>
                
                <p>Medium, and micro enterprises (SMEs) with a history of strong business performance.</p>
            </div>
            
            <div class="tx-target-card tx-animate-2026 tx-delay-2">
                <span class="tx-index">02</span>
                <div class="tx-accent-bar"></div>
                
                <div class="tx-icon-row">
                    <div class="tx-icon"><i class="fa-regular fa-lightbulb"></i></div>
                    <h4>Potential Entrepreneurs</h4>
                </div>
                
                <p>Entrepreneurs with innovative business ideas and high growth potential.</p>
            </div>
            
            <div class="tx-target-card tx-animate-2026 tx-delay-3">
                <span class="tx-index">03</span>
                <div class="tx-accent-bar"></div>
                
                <div class="tx-icon-row">
                    <div class="tx-icon"><i class="fa-regular fa-rocket"></i></div>
                    <h4>Start-up Companies</h4>
                </div>
                
                <p>With viable and promising project proposals.</p>
            </div>
            
        </div>
    </div>
</section>

<!-- ===== TEAM SECTION ===== -->
<main>
  <section class="premium-team" aria-labelledby="teamSectionTitle">
    <span class="team-decoration team-decoration-one" aria-hidden="true"></span>
    <span class="team-decoration team-decoration-two" aria-hidden="true"></span>

    <div class="container">
      <header class="team-section-header">
        <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                       Meet the experts

                            <span class="badge-dot"></span>
                        </span>
                    </div>

        <h1 class="team-section-title" id="teamSectionTitle">
          Our <span>TallyXcelerator</span> Team
        </h1>

        <p class="team-section-description">
          A dedicated team of trainers, consultants and program managers helping businesses grow with TallyXcelerator.
        </p>
      </header>

      <div class="row g-4 justify-content-center">

        <!-- 1. Balwant Singha -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Balwant Singha"
            data-role="Product Trainer &amp; Coach"
            data-experience="16+ Years"
            data-speciality="Tally Product Training &amp; Professional Development"
            data-description="With more than 16 years of experience in Tally product training and professional development, Balwant specializes in coaching and mentoring teams for effective Tally implementation and business process optimization."
            data-image="images/team1.png"
            aria-label="View Balwant Singha profile"
          >
            <div class="team-image-area">
              <img
                src="images/team1.png"
                alt="Balwant Singha"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Balwant Singha')"
              >

              <!-- Premium Look Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>LEARN MORE</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-chalkboard-user" aria-hidden="true"></i>
                Product Trainer &amp; Coach
              </span>

              <span class="team-experience-badge">16+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Balwant Singha</h2>
              <p class="team-member-speciality">
                Tally Product Training &amp; Professional Development
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>

        <!-- 2. Rashim -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Rashim"
            data-role="Business Consultant"
            data-experience="12+ Years"
            data-speciality="Soft Skills Training &amp; Business Consulting"
            data-description="Rashim brings more than 12 years of experience in soft skills training and business consulting. She specializes in leadership development, organizational growth, and strategic planning for MSMEs."
            data-image="images/team4.png"
            aria-label="View Rashim profile"
          >
            <div class="team-image-area">
              <img
                src="images/team4.png"
                alt="Rashim"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Rashim')"
              >

              <!-- Premium Look Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>LEARN MORE</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-handshake" aria-hidden="true"></i>
                Business Consultant
              </span>

              <span class="team-experience-badge">12+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Rashim</h2>
              <p class="team-member-speciality">
                Soft Skills Training &amp; Business Consulting
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>

        <!-- 3. Ayush Goel -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Ayush Goel"
            data-role="Product Trainer"
            data-experience="4+ Years"
            data-speciality="Tally Product Training &amp; Business Consulting"
            data-description="Ayush has more than 4 years of experience in Tally product training and business consulting. He focuses on practical training for TallyPrime, GST compliance, and ERP solutions."
            data-image="images/team2.png"
            aria-label="View Ayush Goel profile"
          >
            <div class="team-image-area">
              <img
                src="images/team2.png"
                alt="Ayush Goel"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Ayush Goel')"
              >

              <!-- Premium Look Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>LEARN MORE</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-laptop-code" aria-hidden="true"></i>
                Product Trainer
              </span>

              <span class="team-experience-badge">4+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Ayush Goel</h2>
              <p class="team-member-speciality">
                Tally Product Training &amp; Business Consulting
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>

        <!-- 4. Puja Bhardwaj -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Puja Bhardwaj"
            data-role="Programme Manager"
            data-experience="15+ Years"
            data-speciality="Business &amp; Skill Training"
            data-description="With more than 15 years of experience in business and skill training, Puja manages end-to-end program delivery, client engagement, and strategic program development for TallyXcelerator."
            data-image="images/team8.png"
            aria-label="View Puja Bhardwaj profile"
          >
            <div class="team-image-area">
              <img
                src="images/team8.png"
                alt="Puja Bhardwaj"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Puja Bhardwaj')"
              >

              <!-- Premium Look Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>LEARN MORE</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
                Programme Manager
              </span>

              <span class="team-experience-badge">15+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Puja Bhardwaj</h2>
              <p class="team-member-speciality">
                Business &amp; Skill Training
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>

        <!-- 5. Anil -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Anil"
            data-role="Business Consultant"
            data-experience="17+ Years"
            data-speciality="Sales, Marketing &amp; Business Consulting"
            data-description="Anil has more than 17 years of experience in sales, marketing and business consulting. He is an expert in business strategy, market expansion, and revenue growth for MSMEs."
            data-image="images/team6.png"
            aria-label="View Anil profile"
          >
            <div class="team-image-area">
              <img
                src="images/team6.png"
                alt="Anil"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Anil')"
              >

              <!-- Premium Look Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>LEARN MORE</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                Business Consultant
              </span>

              <span class="team-experience-badge">17+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Anil</h2>
              <p class="team-member-speciality">
                Sales, Marketing &amp; Business Consulting
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>

      </div>
    </div>
  </section>
</main>

<!-- ===== TEAM MODAL ===== -->
<div
  class="modal fade team-profile-modal"
  id="teamProfileModal"
  tabindex="-1"
  aria-labelledby="teamModalName"
  aria-hidden="true"
>
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content position-relative">

      <button
        type="button"
        class="team-modal-close"
        data-bs-dismiss="modal"
        aria-label="Close profile"
      >
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>

      <div class="row g-0">
        <div class="col-lg-5">
          <div class="team-modal-visual">
            <div class="team-modal-image-wrap">
              <img
                src=""
                alt=""
                class="team-modal-image"
                id="teamModalImage"
              >
            </div>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="team-modal-content">
            <span class="team-modal-label">
              <i class="fa-solid fa-user-tie" aria-hidden="true"></i>
              Team profile
            </span>

            <h2 class="team-modal-name" id="teamModalName">Team Member</h2>

            <div class="team-modal-role" id="teamModalRole">
              Professional Role
            </div>

            <div class="team-modal-divider" aria-hidden="true"></div>

            <p class="team-modal-description" id="teamModalDescription">
              Team member description.
            </p>

            <div class="team-modal-meta">
              <span class="team-meta-pill">
                <i class="fa-solid fa-award" aria-hidden="true"></i>
                <span id="teamModalExperience">Experience</span>
              </span>

              <span class="team-meta-pill">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <span id="teamModalSpeciality">Speciality</span>
              </span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function createTeamAvatar(name, width = 700, height = 760) {
    const safeName = String(name || "Team Member").trim();
    const initials = safeName
      .split(/\s+/)
      .filter(Boolean)
      .slice(0, 2)
      .map(word => word.charAt(0).toUpperCase())
      .join("");

    const escapedInitials = initials
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&apos;");

    const svg = `
      <svg xmlns="http://www.w3.org/2000/svg"
           width="${width}"
           height="${height}"
           viewBox="0 0 ${width} ${height}">
        <defs>
          <linearGradient id="avatarGradient" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#9d3626"/>
            <stop offset="100%" stop-color="#0b172a"/>
          </linearGradient>
        </defs>

        <rect width="100%" height="100%" fill="url(#avatarGradient)"/>
        <circle
          cx="${width / 2}"
          cy="${height * 0.38}"
          r="${Math.min(width, height) * 0.17}"
          fill="rgba(255,255,255,0.18)"
        />
        <path
          d="M${width * 0.18},${height}
             C${width * 0.22},${height * 0.69}
              ${width * 0.78},${height * 0.69}
              ${width * 0.82},${height}
             Z"
          fill="rgba(255,255,255,0.13)"
        />
        <text
          x="50%"
          y="52%"
          text-anchor="middle"
          dominant-baseline="middle"
          fill="#ffffff"
          font-family="Arial, sans-serif"
          font-size="${Math.min(width, height) * 0.16}"
          font-weight="700"
        >${escapedInitials}</text>
      </svg>
    `;

    return "data:image/svg+xml;charset=UTF-8," + encodeURIComponent(svg);
  }

  function setTeamImageFallback(imageElement, memberName) {
    imageElement.onerror = null;
    imageElement.src = createTeamAvatar(memberName);
  }

  document.addEventListener("DOMContentLoaded", function () {
    const modalElement = document.getElementById("teamProfileModal");

    if (!modalElement) {
      return;
    }

    const modalImage = document.getElementById("teamModalImage");
    const modalName = document.getElementById("teamModalName");
    const modalRole = document.getElementById("teamModalRole");
    const modalDescription = document.getElementById("teamModalDescription");
    const modalExperience = document.getElementById("teamModalExperience");
    const modalSpeciality = document.getElementById("teamModalSpeciality");

    modalElement.addEventListener("show.bs.modal", function (event) {
      const triggerCard = event.relatedTarget;

      if (!triggerCard) {
        return;
      }

      const member = {
        name: triggerCard.dataset.name || "Team Member",
        role: triggerCard.dataset.role || "Team Professional",
        experience: triggerCard.dataset.experience || "Experienced",
        speciality: triggerCard.dataset.speciality || "Tally Solutions",
        description:
          triggerCard.dataset.description ||
          "Experienced professional dedicated to delivering effective Tally solutions.",
        image: triggerCard.dataset.image || ""
      };

      modalName.textContent = member.name;
      modalRole.textContent = member.role;
      modalDescription.textContent = member.description;
      modalExperience.textContent = member.experience;
      modalSpeciality.textContent = member.speciality;

      modalImage.alt = member.name;
      modalImage.onerror = function () {
        this.onerror = null;
        this.src = createTeamAvatar(member.name);
      };

      modalImage.src = member.image || createTeamAvatar(member.name);
    });

    modalElement.addEventListener("hidden.bs.modal", function () {
      modalImage.removeAttribute("src");
      modalImage.alt = "";
    });
  });
</script>

</body>
</html>