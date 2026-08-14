<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>DMPL </title>

<!-- Bootstrap & Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

     <link rel="stylesheet" href="style.css?<?=time(); ?>">

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    overflow-x: hidden;
    max-width: 100%;
}

body {
    font-family: "DM Sans", sans-serif;
    -webkit-overflow-scrolling: touch;
    touch-action: pan-y;
}


.navbar-custom {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background: transparent !important; 
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
    padding: 24px 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}


.navbar-custom.scrolled {
    padding: 12px 0; 
    background: #ffffff !important; 
    backdrop-filter: none !important; 
    -webkit-backdrop-filter: none !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); 
    border-bottom: 1px solid #e2e8f0; 
}

.navbar-custom .container {
    max-width: 1300px;
    padding: 18px 35px;
    

    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 5px; 
    
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.1);
    position: relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.navbar-custom.scrolled .container {
    background: transparent !important; 
    backdrop-filter: opacity(0) !important; 
    -webkit-backdrop-filter: opacity(0) !important;
    border-color: transparent !important;
    box-shadow: none !important;
    padding: 6px 35px; 
}


.navbar-custom.scrolled .nav-link {
    color: #334155 !important; 
}

.navbar-custom.scrolled .nav-link:hover {
    color: #9d3626 !important; 
    text-shadow: none;
}

.navbar-custom.scrolled .nav-link::after {
    box-shadow: none; 
}

/* स्क्रॉल होने पर बटन का सॉलिड लुक */
.navbar-custom.scrolled .btn-custom {
    background: #9d3626; 
    color: #ffffff !important;
    border-color: transparent;
}

.navbar-custom.scrolled .btn-custom::before {
    background: #111111; 
}

/* स्क्रॉल होने पर मोबाइल हैमबर्गर मेनू की लाइन्स */
.navbar-custom.scrolled .navbar-toggler-icon,
.navbar-custom.scrolled .navbar-toggler-icon::before,
.navbar-custom.scrolled .navbar-toggler-icon::after {
    background-color: #334155;
}



/* ==========================================
   PREMIUM GLASS NAVBAR WRAPPER
========================================== */
.navbar-custom {
    position: fixed; /* Sticky top scroll effect ke liye fixed kiya */
    top: 0;
    width: 100%;
    z-index: 1000;
    background: transparent !important;
    padding: 24px 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Scroll hone par navbar thoda shrink hoga */
.navbar-custom.scrolled {
    padding: 14px 0;
}

/* ==========================================
   GLASS CONTAINER 
========================================== */
.navbar-custom .container {
    max-width: 1300px;
    padding: 18px 35px;
    
    /* Ultra-clear glass foundation */
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    
    /* Sharp neon-cryptic borders */
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 5px; /* Sharp corners maintained */
    
    /* Futuristic 3D Shadows */
    box-shadow: 
        0 20px 50px rgba(0, 0, 0, 0.3),
        inset 0 1px 1px rgba(255, 255, 255, 0.1);
        
    position: relative;
    transition: all 0.4s ease;
}

/* Active Scroll State for Container */
.navbar-custom.scrolled .container {
    background: rgba(10, 12, 18, 0.7); /* Thoda dark overlay jab scroll ho */
    border-color: rgba(255, 255, 255, 0.12);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
}

/* ==========================================
   NAV LINKS (MODERN LIGHT GLOW)
========================================== */
.nav-link {
    color: rgba(255, 255, 255, 0.7) !important;
    font-weight: 500;
    font-size: 15px;
    margin: 0 16px;
    position: relative;
    padding: 8px 0 !important;
    transition: all 0.3s ease;
}

/* Hover effect with animated bottom indicator line */
.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: #9d3626; /* Modern Crypto Orange Accent */
    box-shadow: 0 0 10px #9d3626;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover {
    color: #fff !important;
    text-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
}

.nav-link:hover::after {
    width: 100%;
}

/* ==========================================
   PREMIUM CYBER/GLASS BUTTON
========================================== */
.btn-custom {
    background: rgba(161, 29, 3, 0.1);
    color: #fff !important;
    border: 1px solid rgba(255, 74, 38, 0.4);
    padding: 12px 26px;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border-radius: 0px; /* Sharp modern look */
    cursor: pointer;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-custom i {
    transition: transform 0.3s ease;
}

/* Hover Button Layer fill animation */
.btn-custom::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, #ff4a26, #ff7a00);
    z-index: -1;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-custom:hover {
    border-color: transparent;
    box-shadow: 0 0 25px rgba(255, 74, 38, 0.4);
    transform: translateY(-2px);
}

.btn-custom:hover::before {
    left: 0;
}

.btn-custom:hover i {
    transform: translate(3px, -3px); /* Arrow animations */
}

/* ==========================================
   LOGO & BRANDING
========================================== */
.navbar-brand {
    display: flex;
    align-items: center;
}

.logo {
    height: 34px;
    /* White logo enhancement agar dark background use kar rhe ho toh useful h */
    filter: drop-shadow(0 0 8px rgba(255,255,255,0.1)); 
    transition: transform 0.3s ease;
}

.navbar-brand:hover .logo {
    transform: scale(1.03);
}

/* ==========================================
   MOBILE RESPONSIVENESS & TOGGLER
========================================== */
.navbar-toggler {
    border: none !important;
    padding: 4px;
}

/* Custom modern animated toggle icon lines */
.navbar-toggler-icon {
    background-image: none !important;
    position: relative;
    width: 24px;
    height: 2px;
    background-color: #fff;
    display: inline-block;
    transition: all 0.3s ease;
}

.navbar-toggler-icon::before,
.navbar-toggler-icon::after {
    content: '';
    position: absolute;
    width: 24px;
    height: 2px;
    background-color: #fff;
    transition: all 0.3s ease;
}

.navbar-toggler-icon::before { top: -8px; left: 0; }
.navbar-toggler-icon::after { bottom: -8px; left: 0; }

/* Mobile Menu Glass Card Dropdown */
@media (max-width: 991px) {
    .navbar-custom {
        padding: 0px 0;
        border-radius:0px;
    }
    .navbar-custom .container{
             border-radius:0px !important;
    }
    
    .navbar-collapse {
      
    
        margin-top: 16px;
        padding: 0px;
        border: 1px solid rgba(255, 255, 255, 0.08);
   
    }

    .nav-link {
        margin: 12px 0;
        padding: 4px 0 !important;
    }
    
    .nav-link::after {
        left: 0;
        transform: none;
    }

    .btn-custom {
        width: 100%;
        justify-content: center;
        margin-top: 15px;
    }
}

/* ==========================================
   ONLY MOBILE & TABLET RESPONSIVE RESET 
========================================== */
@media (max-width: 991px) {
    /* 1. मोबाइल पर बिना स्क्रॉल किए भी बैकग्राउंड प्योर व्हाइट रहेगा */
    .navbar-custom {
        padding: 10px 0 !important;
        background: #ffffff !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    /* 2. कंटेनर के सभी ग्लास इफेक्ट्स मोबाइल पर पूरी तरह बंद */
    .navbar-custom .container {
        background: transparent !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        border: none !important;
        box-shadow: none !important;
        padding: 5px 15px !important;
        border-radius: 0px !important;
    }

    /* 3. व्हाइट बैकग्राउंड पर लोगो को साफ दिखाने के लिए फिल्टर हटाया */
    .logo {
        filter: none !important;
    }

    /* 4. मोबाइल लिंक्स स्टाइल - क्लीन डार्क टेक्स्ट */
    .nav-link {
        color: #334155 !important;
        margin: 10px 0;
        padding: 8px 12px !important;
        font-size: 16px;
        border-radius: 4px;
    }

    .nav-link:hover {
        color: #9d3626 !important;
        background: rgba(157, 54, 38, 0.05);
        text-shadow: none !important;
    }
    
    /* नीचे की एनिमेटेड लाइन मोबाइल पर छुपाई */
    .nav-link::after { 
        display: none !important; 
    }

    /* 5. हैमबर्गर (तीन लाइन) का कलर मोबाइल पर डार्क रहेगा */
    .navbar-toggler-icon,
    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
        background-color: #334155 !important;
    }

    /* 6. मोबाइल कोप्सिबल (ड्रॉपडाउन) एरिया की क्लीन स्पेसिंग */
    .navbar-collapse {
        margin-top: 10px;
        padding: 15px 0 5px 0;
        border-top: 1px solid #f1f5f9;
    }

    /* 7. कॉल बटन को फुल विड्थ और सॉलिड रस्ट कलर किया */
    .btn-custom {
        width: 100%;
        justify-content: center;
        margin-top: 10px;
        background: #9d3626 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 14px;
        box-shadow: 0 4px 12px rgba(157, 54, 38, 0.2);
    }
    
    /* बटन का ग्रेडिएंट स्लाइडर मोबाइल पर रोका */
    .btn-custom::before { 
        display: none !important; 
    }
}
</style>
</head>

<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="images/dmpl_logo.png" alt="Logo" class="logo" />
        </a>

        <!-- Premium Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
         <i class="ri-menu-3-line"></i>
        </button>

        <!-- Menu Links -->
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#ser">Services</a></li>
          
      
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
            </ul>

            <!-- CTA Glass Button -->
            <a href="tel:9888696300" class="d-inline-block w-100-mobile">
                <button class="btn btn-custom">
                    Call Now <i class="ri-arrow-right-up-line"></i>
                </button>
            </a>
        </div>

    </div>
</nav>
<!-- Navbar End -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Dynamic Glass transition effect on scroll
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar-custom");
    if (window.scrollY > 30) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
</script>

<style>
    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }

    body {
        -webkit-overflow-scrolling: touch;
        touch-action: pan-y;
    }
</style>

</body>
</html>