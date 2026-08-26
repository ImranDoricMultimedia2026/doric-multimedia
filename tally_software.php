<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Tally Software Solutions | TallyPrime, GST & Accounting Services | Doric Multimedia Pvt. Ltd.</title>

  <meta
    name="description"
    content="Doric Multimedia offers complete Tally Software solutions including TallyPrime installation, accounting, GST management, inventory, payroll, data migration, customization, AMC, training and technical support."
  >

  <meta
    name="keywords"
    content="Tally Software, TallyPrime, Tally ERP, Doric Multimedia, Tally installation, Tally implementation, Tally customization, Tally support, Tally AMC, Tally training, GST software, accounting software"
  >

  <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
  >

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

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      margin: 0;
      overflow-x: hidden;
      background: var(--team-bg);
      color: var(--team-navy);
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    button,
    a {
      -webkit-tap-highlight-color: transparent;
    }

    /* ================================
       Team section
    ================================= */

    .premium-team {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      padding: 50px 0;
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
      margin: 0 auto 58px;
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

    /* ===== Premium center overlay ===== */
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
      .premium-team {
        padding: 85px 0;
      }

      .team-modal-visual {
        min-height: 390px;
      }

      .team-modal-image-wrap {
        inset: 35px 70px 0;
      }

      .team-modal-content {
        min-height: auto;
        padding: 44px 38px 48px;
      }
    }

    @media (max-width: 767.98px) {
      .premium-team {
        padding: 70px 0;
      }

      .team-section-header {
        margin-bottom: 38px;
      }

      .team-section-description {
        font-size: 0.95rem;
      }

      .team-image-area {
        height: 340px;
      }

      .team-profile-modal .modal-dialog {
        margin: 14px;
      }

      .team-profile-modal .modal-content {
        border-radius: 25px;
      }

      .team-modal-visual {
        min-height: 350px;
      }

      .team-modal-image-wrap {
        inset: 32px 55px 0;
      }

      .team-modal-content {
        padding: 38px 27px 40px;
      }
    }

    @media (max-width: 480px) {
      .team-image-area {
        height: 300px;
      }

      .team-modal-visual {
        min-height: 310px;
      }

      .team-modal-image-wrap {
        inset: 30px 34px 0;
      }
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




    /* =========================================
   TALLYPRIME DOWNLOAD SECTION
========================================= */

.premium-tally-download {
    position: relative;
    overflow: hidden;
    padding: 110px 0;
    background:
        radial-gradient(
            circle at 10% 20%,
            rgba(157, 54, 38, 0.08),
            transparent 32%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(11, 23, 42, 0.06),
            transparent 32%
        ),
        var(--team-bg);
}


/* Decorations */

.tally-decoration {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    filter: blur(1px);
}

.tally-decoration-one {
    width: 280px;
    height: 280px;
    top: -120px;
    left: -100px;
    background: rgba(157, 54, 38, 0.06);
}

.tally-decoration-two {
    width: 350px;
    height: 350px;
    right: -150px;
    bottom: -160px;
    background: rgba(11, 23, 42, 0.05);
}


/* Header */

.tally-download-header {
    position: relative;
    z-index: 2;
    max-width: 850px;
    margin: 0 auto 55px;
    text-align: center;
}

.tally-download-title {
    margin: 20px 0 18px;
    color: var(--team-navy);
    font-size: clamp(34px, 4vw, 54px);
    line-height: 1.08;
    font-weight: 800;
    letter-spacing: -1.5px;
}

.tally-download-title span {
    color: var(--team-primary);
}

.tally-download-description {
    max-width: 760px;
    margin: 0 auto;
    color: var(--team-text);
    font-size: 17px;
    line-height: 1.8;
}


/* Cards */

.tally-download-card {
    position: relative;
    height: 100%;
    padding: 32px;
    border: 1px solid var(--team-border);
    border-radius: var(--team-radius);
    background: rgba(255, 255, 255, 0.92);
    box-shadow: var(--team-shadow);
    transition:
        transform 0.35s ease,
        box-shadow 0.35s ease,
        border-color 0.35s ease;
}

.tally-download-card:hover {
    transform: translateY(-8px);
    border-color: rgba(157, 54, 38, 0.3);
    box-shadow:
        0 30px 80px rgba(15, 23, 42, 0.13);
}


/* Card Top */

.tally-card-top {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 24px;
}

.tally-logo-box {
    width: 68px;
    height: 68px;
    flex: 0 0 68px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    color: var(--team-white);
    background: linear-gradient(
        135deg,
        var(--team-primary),
        var(--team-primary-dark)
    );
    box-shadow:
        0 12px 28px rgba(157, 54, 38, 0.25);
}

.tally-logo-box i {
    font-size: 27px;
}

.edit-log-icon {
    background: linear-gradient(
        135deg,
        var(--team-navy),
        var(--team-navy-light)
    );

    box-shadow:
        0 12px 28px rgba(11, 23, 42, 0.2);
}


.tally-card-label {
    display: block;
    margin-bottom: 5px;
    color: var(--team-primary);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.3px;
}

.tally-card-top h2 {
    margin: 0;
    color: var(--team-navy);
    font-size: 25px;
    font-weight: 800;
}

.tally-version {
    display: inline-block;
    margin-top: 5px;
    padding: 4px 10px;
    border-radius: 50px;
    color: var(--team-primary);
    background: var(--team-primary-light);
    font-size: 12px;
    font-weight: 700;
}


/* Description */

.tally-card-description {
    margin: 0 0 25px;
    color: var(--team-text);
    font-size: 15px;
    line-height: 1.75;
}


/* Features */

.tally-features {
    display: grid;
    gap: 12px;
    margin-bottom: 28px;
}

.tally-feature {
    display: flex;
    align-items: center;
    gap: 11px;
    color: var(--team-navy);
    font-size: 14px;
    font-weight: 600;
}

.tally-feature i {
    width: 21px;
    height: 21px;
    flex: 0 0 21px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: var(--team-primary);
    background: var(--team-primary-light);
    font-size: 10px;
}


/* Footer */

.tally-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding-top: 22px;
    border-top: 1px solid var(--team-border);
}

.tally-release {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--team-muted);
    font-size: 12px;
    font-weight: 600;
}

.tally-release i {
    color: var(--team-primary);
}


/* Download Button */

.tally-download-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 13px 20px;
    border-radius: 12px;
    color: var(--team-white);
    background: var(--team-primary);
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
    transition: all 0.3s ease;
}

.tally-download-btn:hover {
    color: var(--team-white);
    background: var(--team-primary-dark);
    transform: translateY(-2px);
}

.tally-outline-btn {
    color: var(--team-primary);
    background: var(--team-primary-light);
    border: 1px solid rgba(157, 54, 38, 0.18);
}

.tally-outline-btn:hover {
    color: var(--team-white);
    background: var(--team-primary);
}


/* =========================================
   SUPPORT BOX
========================================= */

.tally-support-box {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 22px;
    margin-top: 45px;
    padding: 28px 32px;
    border-radius: 22px;
    background: var(--team-navy);
    box-shadow:
        0 25px 60px rgba(11, 23, 42, 0.15);
}

.tally-support-icon {
    width: 58px;
    height: 58px;
    flex: 0 0 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    color: var(--team-white);
    background: var(--team-primary);
}

.tally-support-icon i {
    font-size: 22px;
}

.tally-support-content {
    flex: 1;
}

.tally-support-label {
    display: block;
    margin-bottom: 5px;
    color: #f3a092;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.2px;
}

.tally-support-content h3 {
    margin: 0 0 5px;
    color: var(--team-white);
    font-size: 21px;
    font-weight: 750;
}

.tally-support-content p {
    margin: 0;
    color: #cbd5e1;
    font-size: 13px;
    line-height: 1.6;
}

.tally-support-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 20px;
    border-radius: 12px;
    color: var(--team-navy);
    background: var(--team-white);
    text-decoration: none;
    font-size: 13px;
    font-weight: 750;
    white-space: nowrap;
    transition: all 0.3s ease;
}

.tally-support-btn:hover {
    color: var(--team-white);
    background: var(--team-primary);
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 991px) {

    .premium-tally-download {
        padding: 80px 0;
    }

    .tally-support-box {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .tally-support-content {
        min-width: calc(100% - 85px);
    }

    .tally-support-btn {
        margin-left: 80px;
    }

}


@media (max-width: 767px) {

    .premium-tally-download {
        padding: 65px 0;
    }

    .tally-download-header {
        margin-bottom: 35px;
    }

    .tally-download-title {
        font-size: 34px;
    }

    .tally-download-description {
        font-size: 15px;
    }

    .tally-download-card {
        padding: 24px;
        border-radius: 22px;
    }

    .tally-card-footer {
        align-items: flex-start;
        flex-direction: column;
    }

    .tally-download-btn {
        width: 100%;
    }

    .tally-support-box {
        padding: 24px;
    }

    .tally-support-content {
        width: 100%;
        min-width: 0;
    }

    .tally-support-btn {
        width: 100%;
        margin-left: 0;
    }

}


@media (max-width: 480px) {

    .tally-card-top {
        align-items: flex-start;
    }

    .tally-logo-box {
        width: 56px;
        height: 56px;
        flex-basis: 56px;
        border-radius: 15px;
    }

    .tally-logo-box i {
        font-size: 22px;
    }

    .tally-card-top h2 {
        font-size: 21px;
    }

    .tally-feature {
        font-size: 13px;
    }

    .tally-support-content h3 {
        font-size: 18px;
    }

}
  </style>
</head>

<body>

<?php include("navbar.php"); ?>

<?php include("modal.php"); ?>

<?php include("service.php"); ?>

<main>
  <section class="premium-tally-download" aria-labelledby="tallyDownloadTitle">

  <span class="tally-decoration tally-decoration-one" aria-hidden="true"></span>
  <span class="tally-decoration tally-decoration-two" aria-hidden="true"></span>

  <div class="container">

    <!-- Section Header -->
    <header class="tally-download-header">

      <div class="premium-badge-wrapper">
        <span class="premium-badge">
          <span class="badge-dot"></span>
          TALLYPRIME DOWNLOAD
          <span class="badge-dot"></span>
        </span>
      </div>

      <h1 class="tally-download-title" id="tallyDownloadTitle">
        Download <span>TallyPrime</span>
      
      </h1>

      <p class="tally-download-description">
        Get the latest TallyPrime Rel 7.1 for your business and experience
        reliable accounting, inventory, GST and business management with
        expert support from Doric Multimedia.
      </p>

    </header>


    <!-- Download Cards -->
    <div class="row g-4 justify-content-center">

      <!-- TallyPrime -->
      <div class="col-lg-6">

        <div class="tally-download-card">

          <div class="tally-card-top">

            <div class="tally-logo-box">
              <i class="fa-solid fa-calculator"></i>
            </div>

            <div>
              <span class="tally-card-label">LATEST RELEASE</span>

              <h2>
                TallyPrime
              </h2>

              <span class="tally-version">
                Rel 7.1
              </span>
            </div>

          </div>


          <p class="tally-card-description">
            Download TallyPrime Rel 7.1 for smarter accounting, GST
            compliance, inventory management and efficient business
            operations.
          </p>


          <div class="tally-features">

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Accounting &amp; Financial Management</span>
            </div>

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>GST &amp; Business Compliance</span>
            </div>

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Inventory &amp; Business Management</span>
            </div>

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Easy-to-use Business Reports</span>
            </div>

          </div>


          <div class="tally-card-footer">

            <div class="tally-release">
              <i class="fa-solid fa-download"></i>
              <span>Official TallyPrime Release</span>
            </div>

            <a
              href="https://tallysolutions.com/download/"
              target="_blank"
              rel="noopener noreferrer"
              class="tally-download-btn"
            >
              Download TallyPrime
              <i class="fa-solid fa-arrow-right"></i>
            </a>

          </div>

        </div>

      </div>


      <!-- Edit Log -->
      <div class="col-lg-6">

        <div class="tally-download-card edit-log-card">

          <div class="tally-card-top">

            <div class="tally-logo-box edit-log-icon">
              <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div>
              <span class="tally-card-label">FOR BUSINESS CONTROL</span>

              <h2>
                TallyPrime + Edit Log
              </h2>

              <span class="tally-version">
                Rel 7.1
              </span>
            </div>

          </div>


          <p class="tally-card-description">
            Edit Log helps businesses track changes made in their
            transactions and maintain stronger internal controls and
            compliance processes.
          </p>


          <div class="tally-features">

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Track changes made in transactions</span>
            </div>

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Improve internal business control</span>
            </div>

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Useful for MCA compliance requirements</span>
            </div>

            <div class="tally-feature">
              <i class="fa-solid fa-check"></i>
              <span>Keep Edit Log permanently enabled</span>
            </div>

          </div>


          <div class="tally-card-footer">

            <div class="tally-release">
              <i class="fa-solid fa-circle-info"></i>
              <span>Edit Log is disabled by default</span>
            </div>

            <a
              href="https://help.tallysolutions.com/tally-prime/edit-log/get-started-with-edit-log/"
              target="_blank"
              rel="noopener noreferrer"
              class="tally-download-btn tally-outline-btn"
            >
              Know More
              <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

          </div>

        </div>

      </div>

    </div>


    <!-- Bottom Support Area -->
    <div class="tally-support-box">

      <div class="tally-support-icon">
        <i class="fa-solid fa-headset"></i>
      </div>

      <div class="tally-support-content">

        <span class="tally-support-label">
          NEED HELP WITH TALLYPRIME?
        </span>

        <h3>
          Downloading is easy. Getting the right setup is even easier.
        </h3>

        <p>
          Doric Multimedia helps businesses with TallyPrime
          implementation, customization, support, upgrades and
          business-focused solutions.
        </p>

      </div>

      <a href="tel:+919888696300" class="tally-support-btn">
    Talk to Our Tally Experts
    <span>+91 98886 96300</span>
    <i class="fa-solid fa-phone"></i>
</a>

    </div>

  </div>

</section>
  <section class="premium-team" aria-labelledby="teamSectionTitle">
    <span class="team-decoration team-decoration-one" aria-hidden="true"></span>
    <span class="team-decoration team-decoration-two" aria-hidden="true"></span>

    <div class="container">
      <header class="team-section-header">
       <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                           MEET THE EXPERTS
                            <span class="badge-dot"></span>
                        </span>
                    </div>

        <h1 class="team-section-title" id="teamSectionTitle">
          People behind your <span>Tally success</span>
        </h1>

        <p class="team-section-description">
          A dedicated team of sales, implementation, customization and support
          professionals helping businesses get the best from Tally.
        </p>
      </header>

      <div class="row g-4 justify-content-center">

        <!-- Sushil Rana -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Sushil Rana"
            data-role="Sales &amp; Marketing"
            data-experience="10+ Years"
            data-speciality="Key Sales &amp; Account Management"
            data-description="With more than 10 years of experience in key sales and account management, Sushil drives revenue growth, builds strategic partnerships and helps businesses choose the right Tally solutions."
            data-image="images/2.png"
            aria-label="View Sushil Rana profile"
          >
            <div class="team-image-area">
              <img
                src="images/2.png"
                alt="Sushil Rana"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Sushil Rana')"
              >

              <!-- Learn More Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>Learn More</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-bullhorn" aria-hidden="true"></i>
                Sales &amp; Marketing
              </span>

              <span class="team-experience-badge">10+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Sushil Rana</h2>
              <p class="team-member-speciality">
                Key Sales &amp; Account Management
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>

              <!-- Ramesh Raj -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Ramesh Raj"
            data-role="Customization &amp; Solutions"
            data-experience="15+ Years"
            data-speciality="Sales, Solutions &amp; Tally Customization"
            data-description="Ramesh has more than 15 years of experience in sales and business solutions. He architects customized Tally workflows that align software functionality with specific operational requirements."
            data-image="images/INSTAGRAM AD.png"
            aria-label="View Ramesh Raj profile"
          >
            <div class="team-image-area">
              <img
                src="images/INSTAGRAM AD.png"
                alt="Ramesh Raj"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Ramesh Raj')"
              >

              <!-- Learn More Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>Learn More</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-code" aria-hidden="true"></i>
                Customization &amp; Solutions
              </span>

              <span class="team-experience-badge">15+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Ramesh Raj</h2>
              <p class="team-member-speciality">
                Sales, Solutions &amp; Tally Customization
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>
               <!-- Gurpreet Kaur -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Gurpreet Kaur"
            data-role="TSS Renewal &amp; Client Management"
            data-experience="9+ Years"
            data-speciality="Tally Sales, Support &amp; Client Retention"
            data-description="Gurpreet brings more than 9 years of experience in Tally sales and support. She specializes in client retention, TSS renewals and maintaining strong long-term customer relationships."
            data-image="images/5.png"
            aria-label="View Gurpreet Kaur profile"
          >
            <div class="team-image-area">
              <img
                src="images/5.png"
                alt="Gurpreet Kaur"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Gurpreet Kaur')"
              >

              <!-- Learn More Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>Learn More</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>
                TSS Renewal &amp; Client
              </span>

              <span class="team-experience-badge">9+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Gurpreet Kaur</h2>
              <p class="team-member-speciality">
                Tally Sales, Support &amp; Client Retention
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>



          <!-- Vijay -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Vijay"
            data-role="Client Support"
            data-experience="9+ Years"
            data-speciality="Tally Support &amp; Implementation"
            data-description="Vijay has more than 9 years of experience in Tally support and implementation. He focuses on smooth deployment, fast issue resolution and uninterrupted day-to-day business operations."
            data-image="images/6.png"
            aria-label="View Vijay profile"
          >
            <div class="team-image-area">
              <img
                src="images/6.png"
                alt="Vijay"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Vijay')"
              >

              <!-- Learn More Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>Learn More</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-headset" aria-hidden="true"></i>
                Client Support
              </span>

              <span class="team-experience-badge">9+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Vijay</h2>
              <p class="team-member-speciality">
                Tally Support &amp; Implementation
              </p>

              <span class="team-card-action" aria-hidden="true">
                <i class="fa-solid fa-arrow-right"></i>
              </span>
            </div>
          </button>
        </div>


  
      
        <!-- Amarjeet -->
        <div class="col-xl-4 col-lg-4 col-md-6 team-member-column">
          <button
            type="button"
            class="team-member-card"
            data-bs-toggle="modal"
            data-bs-target="#teamProfileModal"
            data-name="Amarjeet"
            data-role="Sales &amp; Customization"
            data-experience="15+ Years"
            data-speciality="Sales, Implementation &amp; Deployment"
            data-description="With more than 15 years of experience in sales and implementation, Amarjeet specializes in complete Tally deployment, configuration and business-focused customization."
            data-image="images/3.png"
            aria-label="View Amarjeet profile"
          >
            <div class="team-image-area">
              <img
                src="images/3.png"
                alt="Amarjeet"
                class="team-member-image"
                loading="lazy"
                onerror="setTeamImageFallback(this, 'Amarjeet')"
              >

              <!-- Learn More Overlay -->
              <div class="team-image-overlay" aria-hidden="true">
                <div class="team-preview-icon">
                  <i class="fa-solid fa-eye"></i>
                  <span>Learn More</span>
                </div>
              </div>

              <span class="team-role-badge">
                <i class="fa-solid fa-gears" aria-hidden="true"></i>
                Sales &amp; Customization
              </span>

              <span class="team-experience-badge">15+ Years</span>
            </div>

            <div class="team-member-content">
              <h2 class="team-member-name">Amarjeet</h2>
              <p class="team-member-speciality">
                Sales, Implementation &amp; Deployment
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

<!-- Team Profile Modal -->
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