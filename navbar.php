<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<link rel="stylesheet" href="/style.css?<?=time(); ?>">

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


<!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<!-- 1. GLightbox CSS (Header mein lagayein) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<!-- 3. GLightbox JS (Footer/Body ke end mein lagayein) -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>





<!-- Standard Browser Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="/images/dmpllogo.jpg">
<link rel="icon" type="image/png" sizes="16x16" href="/images/dmpllogo.jpg">

<!-- Apple Touch Icon for Mobile Devices -->
<link rel="apple-touch-icon" sizes="180x180" href="/images/dmpllogo.jpg">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "DM Sans", sans-serif;
    background-color: #f8f9fa; /* Safe light gray background for body */
}

/* ==========================================
   PREMIUM STICKY WHITE NAVBAR WITH BOX SHADOW
========================================== */
.navbar-custom {
    position: fixed; /* Fixed at top across scrolling devices */
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1050;
    background: #ffffff !important; /* Pure White Theme */
    padding: 16px 0;
    /* Soft premium box shadow layer from your design reference */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.02);
    border-bottom: 1px solid #edf2f7; 
    transition: all 0.3s ease;
}

/* Spacer used to prevent page content from sliding under fixed navbar */
.navbar-spacer {
    height: 72px; /* Matches navbar approximate height; adjusts in responsive rules below */
    width: 100%;
}

.navbar-custom .container {
    max-width: 1300px;
    padding: 0 15px;
    background: transparent !important;
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
    border: none !important;
    box-shadow: none !important;
}

/* ==========================================
   NAV LINKS (ELEGANT DARK SLATE TEXT)
========================================== */
.nav-link {
    color: #334155 !important; /* Premium dark slate code color */
    font-weight: 600;
    font-size: 15px;
    margin: 0 16px;
    position: relative;
    padding: 8px 0 !important;
    transition: color 0.2s ease;
}

/* Elegant Bottom Line on Hover */
.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: #9d3626; /* Dark Rust Accent */
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover {
    color: #9d3626 !important; 
}

.nav-link:hover::after {
    width: 100%;
}

/* ==========================================
   SOLID DEEP RED CTA CALL BUTTON
========================================== */
.btn-custom {
    background: #9d3626; 
    color: #fff !important;
    border: 1px solid #9d3626;
    padding: 16px 36px;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border-radius: 50px; /* Smooth card curvature */
    cursor: pointer;
    transition: all 0.3s ease;
}
.btn-custom:hover{

    background: #0f172a; 
    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.2);
    transform: translateY(-3px);
    
}
.btn-custom i {
    transition: transform 0.3s ease;
}


.btn-custom:hover i {
    transform: translate(2px, -2px);
}

/* ==========================================
   BRAND LOGO
========================================== */
.navbar-brand {
    display: flex;
    align-items: center;
}

.logo {
    height: 36px;
    transition: transform 0.3s ease;
}

.navbar-brand:hover .logo {
    transform: scale(1.02);
}

/* ==========================================
   MOBILE TOGGLER
========================================== */
.navbar-toggler {
    border: none !important;
    color: #334155;
    font-size: 26px;
    padding: 0;
}



.dropdown-shadcn .dropdown-toggle-clean {
    color: #334155 !important;
    font-weight: 600;
    font-size: 15px;
    margin: 0 16px;
    position: relative;
    padding: 8px 0 !important;
    
    /* Elements ko ek line me alignment dene ke liye */
    display: inline-flex;
    align-items: center;
    gap: 6px; 
    
    text-decoration: none;
    transition: color 0.2s ease;
}

/* Arrow Icon ka custom style */
.dropdown-shadcn .dropdown-arrow {
    font-size: 16px;
    color: #64748b; /* Slate 500 (Muted look) */
    transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), color 0.2s ease;
    line-height: 1;
}

/* Hover underline effect */
.dropdown-shadcn .dropdown-toggle-clean::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: #9d3626; /* Dark Rust Accent */
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

/* Hover ya Active hone par text aur arrow ka color change */
.dropdown-shadcn:hover .dropdown-toggle-clean,
.dropdown-shadcn .show.dropdown-toggle-clean {
    color: #9d3626 !important; 
}

.dropdown-shadcn:hover .dropdown-toggle-clean .dropdown-arrow,
.dropdown-shadcn .show.dropdown-toggle-clean .dropdown-arrow {
    color: #9d3626 !important;
}

/* Desktop par hover karne par arrow rotate hoga (180 degree) */
@media (min-width: 992px) {
    .dropdown-shadcn:hover .dropdown-toggle-clean .dropdown-arrow {
        transform: rotate(180deg);
    }
}

/* Bootstrap click fallback me bhi arrow rotate hoga */
.dropdown-shadcn .show.dropdown-toggle-clean .dropdown-arrow {
    transform: rotate(180deg);
}

.dropdown-shadcn:hover .dropdown-toggle-clean::after,
.dropdown-shadcn .show.dropdown-toggle-clean::after {
    width: 100%;
}

/* Floating Shadcn Card */
.dropdown-shadcn .dropdown-menu {
    display: block;
    visibility: hidden;
    opacity: 0;
    min-width: 250px;
    background: #ffffff;
    border: 1px solid #e2e8f0; 
    border-radius: 8px; 
    padding: 8px;
    margin-top: 14px !important; 
    
    box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08), 
                0 1px 3px rgba(0, 0, 0, 0.02);
    
    transform: scale(0.97) translateY(-6px);
    transition: opacity 0.15s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.15s cubic-bezier(0.16, 1, 0.3, 1),
                visibility 0.15s;
}

/* DESKTOP HOVER TRIGGER */
@media (min-width: 992px) {
    .dropdown-shadcn:hover .dropdown-menu {
        visibility: visible;
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.dropdown-shadcn .dropdown-menu.show {
    visibility: visible;
    opacity: 1;
    transform: scale(1) translateY(0);
}

/* Inner Dropdown Link rows */
.dropdown-shadcn .dropdown-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 11px 14px;
    color: #475569; 
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;
    background: transparent;
    position: relative;
    transition: background-color 0.12s ease, color 0.12s ease;
}

.dropdown-shadcn .dropdown-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 25%;
    height: 50%;
    width: 3px;
    background: #9d3626; 
    border-radius: 0 4px 4px 0;
    opacity: 0;
    transition: opacity 0.12s ease;
}

.dropdown-shadcn .dropdown-item .item-icon {
    font-size: 18px;
    color: #94a3b8; 
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.12s ease, transform 0.12s ease;
}

.dropdown-shadcn .dropdown-item:hover {
    background-color: #f8fafc !important; 
    color: #0f172a !important; 
}

.dropdown-shadcn .dropdown-item:hover::before {
    opacity: 1; 
}

.dropdown-shadcn .dropdown-item:hover .item-icon {
    color: #9d3626; 
    transform: translateX(1px);
}

/* MOBILE EXPANSION FIX */
@media (max-width: 991px) {
    .dropdown-shadcn .dropdown-toggle-clean {
        margin: 8px 0;
        padding: 10px 14px !important;
        font-size: 16px;
        width: 100%;
        justify-content: space-between; /* Mobile me text left aur arrow right me touch ho jayega */
    }
    
    .dropdown-shadcn .dropdown-toggle-clean::after {
        display: none !important;
    }

    .dropdown-shadcn .dropdown-menu {
        display: none;
        visibility: visible;
        opacity: 1;
        transform: none;
        box-shadow: none;
        border: none;
        border-left: 2px solid #e2e8f0;
        margin-left: 20px;
        margin-top: 0 !important;
        padding-left: 10px;
        border-radius: 0;
        background: transparent;
    }
    
    .dropdown-shadcn .dropdown-menu.show {
        display: block;
    }
    
    .dropdown-shadcn .dropdown-item::before {
        display: none;
    }
    
    .dropdown-shadcn .dropdown-item:hover {
        background-color: transparent !important;
        color: #9d3626 !important;
    }
}


/* Mobile Responsive Setup */
@media (max-width: 991px) {
    .navbar-custom {
        padding: 12px 0;
    }

    .navbar-spacer { height: 84px; }

    .nav-link {
        margin: 8px 0;
        padding: 10px 14px !important;
        font-size: 16px;
        border-radius: 6px;
    }

    .nav-link:hover {
        background: rgba(157, 54, 38, 0.05);
    }
    
    .nav-link::after { 
        display: none !important; 
    }

    .navbar-collapse {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-custom {
        width: 100%;
        justify-content: center;
        margin-top: 8px;
    }
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">

        <a class="navbar-brand" href="/index.php">
            <img src="/images/dmpl_logo.png" alt="Logo" class="logo" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
  
              <li class="nav-item dropdown dropdown-shadcn">
                <a class="nav-link dropdown-toggle-clean" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>Services</span>
                    <!-- Yeh raha naya angle down icon -->
                    <i class="ri-arrow-down-s-line dropdown-arrow"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                  
                <li>
                        <a class="dropdown-item" href="/tally_software.php">
                            <div class="item-icon"><i class="ri-terminal-window-line"></i></div>
                            <div class="item-content">
                                <span class="item-title">Tally Prime</span>
                            </div>
                        </a>
                    </li>

                     <li>
   <a class="dropdown-item" href="/tally_capital.php">
      <div class="item-icon">
          <!-- Yahan ri-hand-coin-line lagaya hai -->
          <i class="ri-hand-coin-line"></i>
      </div>
      <div class="item-content">
         <span class="item-title">Tally Capital</span>
      </div>
   </a>
</li>

  <li>
                     <a class="dropdown-item" href="/tally_Xcelerator.php">
                        <div class="item-icon"><i class="ri-calculator-line"></i></div>
                        <div class="item-content">
                            <span class="item-title">Tally Xcelerator</span>
                         </div>
                         </a>
                     </li>
                    <li>
                        <a class="dropdown-item" href="/tally_course.php">
                            <div class="item-icon"><i class="ri-book-open-line"></i></div>
                            <div class="item-content">
                                <span class="item-title">Tally Education</span>
                            </div>
                        </a>
                    </li>

                    



                    


                    <li>
                        <a class="dropdown-item" target="_blank" href="https://onlinedegreediploma.com/">
                            <div class="item-icon"><i class="ri-global-line"></i></div>
                            <div class="item-content">
                                <span class="item-title">Distance Education</span>
                            </div>
                        </a>
                    </li>
                </ul>
                </li>


                <li class="nav-item"><a class="nav-link" href="/gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="/achivements.php">Achievements</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact.php">Contact Us</a></li>
            </ul>

            <a href="#mainModal" class="d-inline-block w-100-mobile" onclick="openModal(); return false;" aria-label="Open Connect With Us form">
                <button type="button" class="btn btn-custom">
                    Get A Free Call <i class="ri-arrow-right-up-line"></i>
                </button>
            </a>
        </div>

    </div>
</nav>
<div class="navbar-spacer" aria-hidden="true"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }

    body {
        -webkit-overflow-scrolling: touch;
        touch-action: pan-y;
    }

    img, svg, video {
        max-width: 100%;
    }
</style>

</body>
</html>