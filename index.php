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
                            <img src="images/tlprime.jpg" alt="TallyPrime" class="hero-display-img">

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
                            <img src="images/tlserver.jpg" alt="TallyPrime Server" class="hero-display-img">

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
                            <img src="images/tlcloud.jpg" alt="Tally on Cloud" class="hero-display-img">

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
                            <img src="images/tally1.1.png" alt="Customization & Implementation" class="hero-display-img">

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
    $(document).ready(function(){
        $('.main-hero-slider').slick({
            dots: true,
            infinite: true,
            speed: 800,
            fade: true, /* Premium cross-fade effects */
            cssEase: 'linear',
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            pauseOnHover: false
        });
    });
</script>





<section class="strategic-advantage-section">
    <div class="container">
        <div class="row align-items-end">
            
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="advantage-left-content">
                    <span class="badge-text-light">WHY CHOOSE Doric Multimedia</span>
                    <h2 class="advantage-title">Simplifying Accounting, <br>Empowering Businesses</h2>
                    <p class="advantage-desc">
                        Delivering reliable Tally solutions with expert support, seamless implementation, and smart business accounting services for growing enterprises.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-5 text-lg-end">
                <div class="advantage-right-content">
                    <h4 class="strategies-count-text">
                        Over 500+ Businesses <br>Successfully Managed with Tally
                    </h4>
                   <a href="javascript:void(0)" onclick="openModal()"  class="btn-free-consulting">Get Free Demo</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-content">
                    <!-- <span class="badge-title">About DMPL</span> -->
                    
                    <h2 class="main-title">
                        Delivering Smart Business & IT Solutions for Modern Enterprises
                    </h2>

                    <p class="description">
                        DMPL is a trusted technology and business solutions provider specializing in Tally services, cloud solutions, software customization, and digital transformation. We bring together business expertise and innovative technology to help organizations streamline operations, improve productivity, and achieve sustainable growth.
                    </p>

                    <p class="description">
                        From Tally implementation and cloud hosting to custom business applications and ongoing technical support, our team delivers reliable solutions tailored to the unique requirements of businesses across industries.
                    </p>

                    <div class="features-grid">
                        <div class="feature-item">Tally Licensing & Implementation</div>
                        <div class="feature-item">Tally on Cloud (AWS Powered)</div>
                        <div class="feature-item">TDL Customization & Integration</div>
                        <div class="feature-item">Business Process Automation</div>
                        <div class="feature-item">Technical Consulting & Support</div>
                        <div class="feature-item">Cloud & Digital Solutions</div>
                    </div>

                    <a href="index.php#ser" class="btn-learn-more">
                        Discover Our Services
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-image-wrapper">
                    <div class="sharp-image-container">
                        <img src="images/about_tally.png"
                             class="img-fluid main-img"
                             alt="DMPL Business Solutions">
                    </div>

                    <div class="stats-badge-sharp">
                        <span class="badge-subtitle">Trusted By</span>
                        <h3 class="badge-percentage">500+</h3>
                        <p class="badge-text">
                            Businesses for Tally, Cloud & IT Solutions
                        </p>
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
                    Let’s Simplify Your Accounting with DMPL Tally
                </h1>

                <div class="divider"></div>
                
                <div class="contact-info-flex">
                    <div class="info-item">
                        <p class="info-label">EMAIL ADDRESS</p>
                        <p class="info-value">support@dmpltally.com</p>
                    </div>

                    <div class="info-item">
                        <p class="info-label">WORKING HOURS</p>
                        <p class="info-value">Mon - Saturday, 09 AM - 07 PM</p>
                    </div>
                </div>
            </div>
            
            <!-- FORM SECTION -->
            <div class="col-lg-6">
                <div class="form-green-parent">
                    
                    <div class="form-card-header">
                        <!-- <h3>Free DMPL Tally Consultation</h3> -->

                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg> -->
                    </div>
                    
                    <div class="form-white-child">
                        <p class="form-subtitle">
                            Book your free consultation with DMPL Tally experts and get
                            solutions for accounting, GST, billing, and business automation.
                        </p>
                     <form action="">
    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-custom-label">Your Name</label>
            <input type="text" class="form-control custom-input"
                placeholder="Enter your full name" required>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-custom-label">Phone Number</label>
            <input type="tel" class="form-control custom-input"
                placeholder="Enter your phone number" required>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-custom-label">Email Address</label>
            <input type="email" class="form-control custom-input"
                placeholder="Enter your email address" required>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-custom-label">Subject</label>
            <input type="text" class="form-control custom-input"
                placeholder="Enter subject"
             >
        </div>

        <div class="col-12 mb-4">
            <label class="form-custom-label">Message</label>
            <textarea
                class="form-control custom-input"
                rows="3"
                placeholder="Enter your query..."
                required></textarea>
        </div>
    </div>

    <div class="form-footer-action">
        <button type="submit" class="btn btn-send-msg">
            Send Message
        </button>

        <a href="tel:9888696300" class="form-phone-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>

            Call: +91 98886 96300
        </a>
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





<section class="counter-section" id="counter_section">
    <div class="container">
        <div class="counter-grid-wrapper">
            
            <!-- Counter Item -->
            <div class="counter-item">
                <div class="counter-number-block">
                    <span class="counter-digit">7</span>
                </div>
                <p class="counter-title">Tally Xcelerator</p>
            </div>

            <!-- Counter Item -->
            <div class="counter-item">
                <div class="counter-number-block">
                    <span class="counter-digit">55</span><span class="counter-plus">+</span>
                </div>
                <p class="counter-title">Custom Modules</p>
            </div>

            <!-- Counter Item -->
            <div class="counter-item">
                <div class="counter-number-block">
                    <span class="counter-digit">3675</span><span class="counter-plus">+</span>
                </div>
                <p class="counter-title">Partners</p>
            </div>

            <!-- Counter Item -->
            <div class="counter-item">
                <div class="counter-number-block">
                    <span class="counter-digit">3675</span><span class="counter-plus">+</span>
                </div>
                <p class="counter-title">Corporate Clients</p>
            </div>

        </div>
    </div>
</section>










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


</body>
</html>