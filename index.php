<?php
// Early route dispatch: ensure /blog and /blog/{slug} are handled by blog.php
if (php_sapi_name() === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (preg_match('#^/blog(?:/[^/]+)?/?$#', (string) $requestPath) === 1) {
        require __DIR__ . '/blog.php';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title> Doric Multimedia Pvt. Ltd. | DMPL | Tally Solutions, Accounting, GST & Business Management Software</title>

<meta name="description" content="Doric Multimedia provides DMPL Tally solutions for complete accounting, GST compliance, inventory management, payroll, and business management. Simplify your financial operations with expert Tally implementation, support, customization, and automation services.">

<meta name="keywords" content="DMPL Tally, Tally software, TallyPrime, Doric Multimedia, accounting software, GST software, business management software, inventory management, payroll management, Tally implementation, Tally customization, Tally support, financial management, GST compliance, accounting automation, business accounting solutions">

</head>

<?php include("navbar.php")?>
<?php include 'modal.php'; ?>


<div class="hero-slider-wrapper">
    <div class="luxury-blur-glow-1"></div>
    <div class="luxury-blur-glow-2"></div>

   <div class="main-hero-slider">

    <!-- TallyPrime -->
    <div class="hero-slide-item">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 layout-left">
                    <div class="brand-badge">
                        <i class="ri-shield-check-line"></i> Authorized Tally Partner
                    </div>

                    <h1 class="hero-main-title">
                        Grow Your Business with <br>
                        <span class="highlight-text">TallyPrime</span>
                    </h1>

                    <p class="hero-subtext">
                        Simplify accounting, inventory, GST, banking, payroll, and business management with TallyPrime. Get complete control of your business with a powerful and user-friendly solution.
                    </p>

                    <div class="hero-btn-group">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-prime-solid">
                        Get a Free Quote <i class="ri-arrow-right-line"></i>
                        </a>
                        <a href="tel:9888696300" class="btn btn-prime-outline">
                            Call Now
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 layout-right">
                    <div class="premium-image-frame">
                        <div class="premium-image-card">
                            <img src="images/Banner001.png" alt="TallyPrime" class="hero-display-img">

                            <div class="floating-stat-tag">
                                <div class="stat-icon-wrapper src-green">
                                    <i class="ri-verified-badge-line"></i>
                                </div>
                                <div class="stat-meta">
                                    <h3>GST Ready</h3>
                                    <p>Business Solution</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TallyPrime Server -->
    <div class="hero-slide-item">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 layout-left">
                    <div class="brand-badge">
                        <i class="ri-server-line"></i> Multi User Performance
                    </div>

                    <h1 class="hero-main-title">
                        Enhanced Control with <br>
                        <span class="highlight-text">TallyPrime Server</span>
                    </h1>

                    <p class="hero-subtext">
                        Experience superior performance, secure data access, user monitoring, and seamless multi-user operations for medium and large businesses.
                    </p>

                    <div class="hero-btn-group">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-prime-solid">
                        Get a Free Quote <i class="ri-arrow-right-line"></i>
                        </a>
                        <a href="tel:9888696300" class="btn btn-prime-outline">
                            Call Now
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 layout-right">
                    <div class="premium-image-frame">
                        <div class="premium-image-card">
                            <img src="images/Banner003.png" alt="TallyPrime Server" class="hero-display-img">

                            <div class="floating-stat-tag">
                                <div class="stat-icon-wrapper src-orange">
                                    <i class="ri-speed-up-line"></i>
                                </div>
                                <div class="stat-meta">
                                    <h3>Multi User</h3>
                                    <p>High Performance</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tally on Cloud -->
    <div class="hero-slide-item">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 layout-left">
                    <div class="brand-badge">
                        <i class="ri-cloud-line"></i> Work From Anywhere
                    </div>

                    <h1 class="hero-main-title">
                        Anytime Access with <br>
                        <span class="highlight-text">Tally on Cloud</span>
                    </h1>

                    <p class="hero-subtext">
                        Access your Tally data securely from anywhere with cloud-powered hosting. Improve collaboration, data security, and business continuity.
                    </p>

                    <div class="hero-btn-group">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-prime-solid">
                        Get a Free Quote <i class="ri-arrow-right-line"></i>
                        </a>
                        <a href="tel:9888696300" class="btn btn-prime-outline">
                            Call Now
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 layout-right">
                    <div class="premium-image-frame">
                        <div class="premium-image-card">
                            <img src="images/BannerImage01.png" alt="Tally on Cloud" class="hero-display-img">

                            <div class="floating-stat-tag">
                                <div class="stat-icon-wrapper src-blue">
                                    <i class="ri-cloud-windy-line"></i>
                                </div>
                                <div class="stat-meta">
                                    <h3>24×7</h3>
                                    <p>Cloud Access</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customization & Implementation -->
    <div class="hero-slide-item">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 layout-left">
                    <div class="brand-badge">
                        <i class="ri-settings-line"></i> Business Specific Solutions
                    </div>

                    <h1 class="hero-main-title">
                        Customization & <br>
                        <span class="highlight-text">Implementation</span>
                    </h1>

                    <p class="hero-subtext">
                        Get tailor-made Tally solutions designed according to your business processes. From TDL customization to complete implementation and training support.
                    </p>

                  <div class="hero-btn-group">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-prime-solid">
                        Get a Free Quote <i class="ri-arrow-right-line"></i>
                        </a>
                        <a href="tel:9888696300" class="btn btn-prime-outline">
                            Call Now
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 layout-right">
                    <div class="premium-image-frame">
                        <div class="premium-image-card">
                            <img src="images/Banner04.png" alt="Customization & Implementation" class="hero-display-img">

                            <div class="floating-stat-tag">
                                <div class="stat-icon-wrapper src-purple">
                                    <i class="ri-git-repository-private-line"></i>
                                </div>
                                <div class="stat-meta">
                                    <h3>Custom TDL</h3>
                                    <p>Expert Solutions</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
  $(document).ready(function () {
    $('.main-hero-slider').slick({
      dots: true,
      infinite: true,
      speed: 800,
      fade: true,
      cssEase: 'linear',
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: false,
      pauseOnHover: false
    });
  });
</script>



<!-- ============================================
   WORLD'S BEST STRATEGIC ADVANTAGE SECTION
   PURE WHITE BACKGROUND
   ============================================ -->

<section class="strategic-advantage-section">
    <div class="container">
        <!-- Premium Decorative Elements -->
        <div class="strategic-orb strategic-orb-1"></div>
        <div class="strategic-orb strategic-orb-2"></div>
        <div class="strategic-orb strategic-orb-3"></div>

        <div class="row align-items-center g-5">

            <!-- LEFT CONTENT -->
            <div class="col-lg-7">
                <div class="advantage-left-content">

                    <!-- Premium Badge -->
                    <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                            WHY CHOOSE DORIC MULTIMEDIA
                            <span class="badge-dot"></span>
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <h2 class="advantage-title">
                        <span class="title-gradient">Simplifying Accounting,</span>
                        <br>
                        <span class="title-highlight">Empowering Businesses</span>
                    </h2>

                    <!-- Description -->
                    <div class="advantage-desc-wrapper">
                        <p class="advantage-desc">
                            Delivering reliable Tally solutions with expert support, seamless implementation,
                            and smart business accounting services designed for modern enterprises.
                        </p>
                        <div class="desc-underline"></div>
                    </div>

                    <!-- Premium Solutions Row -->
                    <div class="premium-stats-row">

                        <div class="stat-item">
                            <div class="stat-number">Tally</div>
                            <span class="stat-label">Expert Solutions</span>
                        </div>

                        <div class="stat-divider"></div>

                        <div class="stat-item">
                            <div class="stat-number">Cloud</div>
                            <span class="stat-label">Ready Solutions</span>
                        </div>

                        <div class="stat-divider"></div>

                        <div class="stat-item">
                            <div class="stat-number">Custom</div>
                            <span class="stat-label">Business Solutions</span>
                        </div>

                    </div>

                    <!-- Trust Badges -->
                    <div class="trust-badges">
                        <span class="trust-badge">
                            <i class="fas fa-check-circle"></i>
                            Expert Implementation
                        </span>

                        <span class="trust-badge">
                            <i class="fas fa-headset"></i>
                            Dedicated Support
                        </span>

                        <span class="trust-badge">
                            <i class="fas fa-shield-alt"></i>
                            Secure Solutions
                        </span>
                    </div>

                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="col-lg-5">
                <div class="advantage-right-content">

                    <!-- Premium Floating Card -->
                    <div class="floating-premium-card">
                        <div class="card-glow"></div>

                        <div class="card-content">

                            <div class="card-icon-wrapper">
                                <i class="fas fa-rocket"></i>
                            </div>

                            <h4 class="strategies-count-text">
                                Smart Solutions
                                <br>
                                for Modern
                                <span class="highlight-text">Businesses</span>
                            </h4>

                            <div class="card-divider"></div>

                            <p class="card-small-text">
                                From Tally implementation to cloud solutions,
                                customization and business automation.
                            </p>

                            <a href="javascript:void(0)"
                               onclick="openModal()"
                               class="btn-premium-consulting">
                                <span class="btn-text">Get Free Demo</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                            </a>

                        </div>
                    </div>

                    <!-- Floating Mini Badges -->
                    <div class="mini-badges">
                        <div class="mini-badge mini-badge-1">
                            <i class="fas fa-cogs"></i>
                            <span>Expert Solutions</span>
                        </div>

                        <div class="mini-badge mini-badge-2">
                            <i class="fas fa-headset"></i>
                            <span>Dedicated Support</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================
   WORLD'S BEST ABOUT SECTION
   PURE WHITE BACKGROUND
   ============================================ -->

<!-- ============================================
    ABOUT SECTION - AS PER IMAGE
   ============================================ -->

<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <!-- LEFT CONTENT -->
            <div class="col-lg-6">
                <div class="about-content">
                    <!-- Badge -->
                  
                    
                    <!-- Main Heading -->
                    <h2 class="about-heading">
                        Delivering Smart Business <br>
                        <span class="heading-highlight">&amp; IT Solutions for</span> <br>
                        <span class="heading-gradient">Modern Enterprises</span>
                    </h2>

                    <!-- Description -->
                    <p class="about-desc">
                        Doric Multimedia is a trusted technology and business solutions provider specializing in 
                        <span class="highlight-text">Tally services</span>, 
                        <span class="highlight-text">cloud solutions</span>, 
                        <span class="highlight-text">software customization</span>, and 
                        <span class="highlight-text">digital transformation</span>.
                    </p>

                    <p class="about-desc">
                        From Tally implementation and cloud hosting to custom business applications 
                        and ongoing technical support, our team delivers reliable solutions tailored 
                        to the unique requirements of businesses across industries.
                    </p>

                    <!-- Features List -->
                    <div class="features-list">
                        <div class="feature-item">
                            <span class="feature-diamond"></span>
                            Tally Licensing &amp; Implementation
                        </div>
                        <div class="feature-item">
                            <span class="feature-diamond"></span>
                            Tally on Cloud (AWS Powered)
                        </div>
                        <div class="feature-item">
                            <span class="feature-diamond"></span>
                            TDL Customization &amp; Integration
                        </div>
                        <div class="feature-item">
                            <span class="feature-diamond"></span>
                            Business Process Automation
                        </div>
                        <div class="feature-item">
                            <span class="feature-diamond"></span>
                            Technical Consulting &amp; Support
                        </div>
                        <div class="feature-item">
                            <span class="feature-diamond"></span>
                            Cloud &amp; Digital Solutions
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="index.php" class="btn-discover">
                        DISCOVER OUR SERVICES
                        <span class="btn-arrow">→</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT CONTENT - IMAGE -->
            <div class="col-lg-6">
                <div class="about-image-wrapper">
                    <!-- Main Image -->
                    <div class="image-container">
                        <img src="images/HomeLaptop.jpg" 
                             class="img-fluid about-main-img" 
                             alt="DMPL Business Solutions">
                        
                        <!-- Floating Badge - Top Right -->
                        <div class="floating-badge top-badge">
                            <i class="fas fa-trophy"></i>
                            Best Tally Partner
                        </div>
                    </div>

                    <!-- Stats Badge - Bottom -->
                    <div class="stats-badge">
                        <span class="stats-subtitle">
                            <i class="fas fa-users"></i> TRUSTED BY
                        </span>
                        <div class="stats-number">
                            <span class="counter-num" data-count="500">0</span>
                            <span class="stats-plus">+</span>
                        </div>
                        <p class="stats-text">
                            Businesses for Tally, <br>Cloud &amp; IT Solutions
                        </p>
                        <div class="stats-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="rating-text">4.9/5</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="contact_section">
    <div class="container">
        <div class="row align-items-center">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6 contact-left-content">

                <span class="badge-git">Get In Touch</span>

                <h1 class="contact-main-heading">
                    Let’s Simplify Your Accounting with Doric Multimedia Tally
                </h1>

                <div class="divider"></div>

                <!-- CONTACT INFORMATION -->
                <div class="contact-info-flex"
                     style="display: block; width: 100%;">

                    <!-- EMAIL -->
                    <div class="info-item"
                         style="display: block; margin-bottom: 18px;">

                        <p class="info-label"
                           style="margin: 0 0 5px 0;">
                            EMAIL ADDRESS
                        </p>

                        <p class="info-value"
                           style="margin: 0;">
                            mail@doricmultimedia.com
                        </p>

                    </div>


                    <!-- CALL -->
                    <div class="info-item"
                         style="display: block; margin-bottom: 18px;">

                        <p class="info-label"
                           style="margin: 0 0 5px 0;">
                            CALL
                        </p>

                        <p class="info-value"
                           style="margin: 0;">

                            <a href="tel:9888696300"
                               style="color: #ffffff;
                                      text-decoration: none;">

                                +91 98886 96300

                            </a>

                        </p>

                    </div>


                    <!-- WORKING HOURS -->
                    <div class="info-item"
                         style="display: block;">

                        <p class="info-label"
                           style="margin: 0 0 5px 0;">
                            WORKING HOURS
                        </p>

                        <p class="info-value"
                           style="margin: 0;">
                            Mon - Saturday, 10:00 AM - 06:30 PM
                        </p>

                    </div>

                </div>

            </div>


            <!-- FORM SECTION -->
            <div class="col-lg-6">

                <div class="form-green-parent">

                    <div class="form-card-header">
                        <!-- Header intentionally empty -->
                    </div>

                    <div class="form-white-child">

                        <p class="form-subtitle">
                            Book your free consultation with Doric Multimedia Tally experts and get
                            solutions for accounting, GST, billing, and business automation.
                        </p>


                        <form action="">

                            <div class="row">

                                <!-- NAME -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-custom-label">
                                        Your Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control custom-input"
                                        placeholder="Enter your full name"
                                        required>

                                </div>


                                <!-- PHONE -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-custom-label">
                                        Phone Number
                                    </label>

                                    <input
                                        type="tel"
                                        class="form-control custom-input"
                                        placeholder="Enter your phone number"
                                        required>

                                </div>


                                <!-- EMAIL -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-custom-label">
                                        Email Address
                                    </label>

                                    <input
                                        type="email"
                                        class="form-control custom-input"
                                        placeholder="Enter your email address"
                                        required>

                                </div>


                                <!-- SUBJECT -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-custom-label">
                                        Subject
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control custom-input"
                                        placeholder="Enter subject">

                                </div>


                                <!-- MESSAGE -->
                                <div class="col-12 mb-4">

                                    <label class="form-custom-label">
                                        Message
                                    </label>

                                    <textarea
                                        class="form-control custom-input"
                                        rows="3"
                                        placeholder="Enter your query..."
                                        required></textarea>

                                </div>

                            </div>


                            <!-- FORM FOOTER -->
                            <div class="form-footer-action">

                                <button
                                    type="submit"
                                    class="btn btn-send-msg">

                                    Send Message

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<!-- Swiper CSS -->



<?php include("clients.php")?>

<?php include("test.php")?>




<?php include("footer.php")?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const counterSection = document.getElementById("counter_section");
    const counters = document.querySelectorAll(".counter-digit");
    const speed = 60; 

    const startCounter = (counter) => {
        const target = +counter.getAttribute("data-target");
        let count = 0;
        
       
        const increment = Math.ceil(target / speed);

        const updateCount = () => {
            count += increment;
            if (count < target) {
                counter.innerText = count;
                setTimeout(updateCount, 25);
            } else {
                counter.innerText = target; 
            }
        };

        updateCount();
    };


    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                counters.forEach(counter => {
                 
                    if (!counter.hasAttribute('data-target')) {
                        counter.setAttribute('data-target', counter.innerText);
                        counter.innerText = '0';
                        startCounter(counter);
                    }
                });
            
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2 
    });

    if (counterSection) {
        observer.observe(counterSection);
    }
});
</script>




<script>
    const overlay = document.getElementById('overlay');
    const modal = document.getElementById('mainModal');
    const closeBtn = document.getElementById('closeBtn');

    // 1. Manual Click Function (Hamesha kaam karega)
    window.openModal = function() {
        document.body.classList.add('modal-active', 'modal-open');
    };

    // 2. Close Function
    const closeModal = function() {
        document.body.classList.remove('modal-active', 'modal-open');
    };

    // 3. Auto-Popup Logic (Sirf 1 baar ke liye)
    window.addEventListener('load', () => {
        setTimeout(() => {
            const hasSeenModal = localStorage.getItem('modalSeen');
            
            if (!hasSeenModal) {
                openModal();
                localStorage.setItem('modalSeen', 'true');
            }
        }, 5000); // 5 second delay
    });

    // Event Listeners
    if(closeBtn) closeBtn.onclick = closeModal;
    if(overlay) overlay.onclick = closeModal;
    
    document.onkeydown = (e) => { 
        if(e.key === 'Escape') closeModal(); 
    };
</script>


<script>
    // ============================================
// COUNTER ANIMATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const counterElement = document.querySelector('.counter-num');
    
    if (counterElement) {
        const animateCounter = () => {
            const target = parseInt(counterElement.getAttribute('data-count'));
            const duration = 2000;
            const startTime = Date.now();
            
            const updateCounter = () => {
                const currentTime = Date.now();
                const progress = Math.min((currentTime - startTime) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(eased * target);
                
                counterElement.textContent = current;
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    counterElement.textContent = target;
                }
            };
            
            updateCounter();
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (!counterElement.classList.contains('animated')) {
                        counterElement.classList.add('animated');
                        animateCounter();
                    }
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(counterElement);
    }
});
</script>


</body>
</html>