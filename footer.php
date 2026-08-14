<footer class="main-footer-section">
    <div class="container">
        
      <div class="row align-items-center justify-content-center text-center footer-top-row">
    <div class="col-lg-12 mb-4 mb-lg-0">
        <div class="footer-brand mx-auto d-flex justify-content-center align-items-center">
            <img src="images/dmpl_logo.png" class="img-fluid footer_logo" alt="DMPL Logo">
        </div>
    </div>
</div>

        <hr class="footer-divider">

        <div class="row footer-middle-row">
            
            <div class="col-xl-3 col-lg-12 mb-4 mb-xl-0">
                <h4 class="footer-link-heading">Stay Tuned</h4>
                <div class="footer-social-icons">
                   
                    <a href="https://www.instagram.com/doricmultimedia/?hl=en"  target="_blank" class="social-icon-btn"><i class="fab fa-instagram"></i></a>
                    <a href="https://in.linkedin.com/company/doric-multimedia-priv-limited"  target="_blank" class="social-icon-btn"><i class="fa-brands fa-linkedin"></i>  </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-4 col-sm-6 mb-4 mb-md-0">
                <h4 class="footer-link-heading">Quick Links</h4>
                <ul class="footer-links-list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="index.php#test">Testimonials</a></li>
                </ul>
            </div>

            <div class="col-xl-3 col-md-4 col-sm-6 mb-4 mb-md-0">
                <h4 class="footer-link-heading">Tally</h4>
                <ul class="footer-links-list">
                    <li><a href="index.php#ser">Tally Prime Server</a></li>
                    <li><a href="index.php#ser">Tally Prime</a></li>
                    <li><a href="index.php#ser">Tally on Cloud</a></li>
                    <li><a href="index.php#ser">Customization &amp; Implementation</a></li>
                </ul>
            </div>

            <div class="col-xl-3 col-md-4 col-sm-6">
                <h4 class="footer-link-heading">Contact Us</h4>
                <ul class="footer-links-list footer-contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt me-2"></i> 
                        <span style="    color: #94a3b8;" >1st Floor, Gulati Market, Near CMC Chowk, Ludhiana</span>
                    </li>
                    <li class="mt-2">
                        <i class="fas fa-phone me-2"></i> 
                        <a href="tel:+919888696300">+91 98886 96300</a>
                    </li>
                    <li class="mt-2">
                        <i class="fas fa-envelope me-2"></i> 
                        <a href="mailto:Inquiry@doricmultimedia.com">Inquiry@doricmultimedia.com</a>
                    </li>
                </ul>
            </div>
            
        </div>

        <hr class="footer-divider">

        <div class="row footer-bottom-row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="copyright-text">© 2026 DMPL. All Rights Reserved</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
               <div class="footer-bottom-links">
    <p>Deisgn By &nbsp; 
        <a style="color: #9d3626;font-size:16px; font-weight:bold" 
           href="https://doricmultimedia.com/">
            Doric Multimedia
        </a>
    </p>
</div>
            </div>
        </div>

    </div>
</footer>


<style>


.main-footer-section {
    /* Ye raha naya blackish-bluish background */
    background: linear-gradient(180deg, #000000 0%, #030921 100%);
    
    padding: 90px 0 30px 0;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.footer_logo {
    height: 50px;
}

.footer-top-row {
    padding-bottom: 20px;
}

.footer-logo {
    font-size: 32px;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.footer-logo span {
    color: #dd6a59;
}

.footer-desc {
    color: #94a3b8;
    font-size: 15px;
    line-height: 1.6;
    max-width: 320px;
}

.newsletter-title {
    font-size: 26px;
    font-weight: 700;
    line-height: 1.3;
    color: #ffffff;
}

/* NEWSLETTER INPUT BOX STYLE */
.newsletter-input-group {
    display: flex;
    background-color: #f8fafc;
    border-radius: 50px;      
    padding: 6px 6px 6px 24px;
    align-items: center;
    margin-bottom: 15px;
}

.newsletter-input-group input {
    background: transparent !important;
    border: none !important;
    color: #0f172a !important;
    padding: 0;
    font-size: 15px;
    font-weight: 500;
}

.newsletter-input-group input:focus {
    box-shadow: none !important;
}

.newsletter-input-group input::placeholder {
    color: #64748b;
}

.btn-newsletter-submit {
    background-color: #dd6a59; 
    color: #ffffff;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-newsletter-submit:hover {
    background-color: #ffffff;
    color: #0f172a;
    transform: scale(1.05);
}

/* CHECKBOX */
.newsletter-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
}

.newsletter-checkbox input[type="checkbox"] {
    accent-color: #dd6a59; 
    width: 16px;
    height: 16px;
    cursor: pointer;
}

.newsletter-checkbox label {
    color: #94a3b8;
    font-size: 13px;
    cursor: pointer;
    user-select: none;
}

/* DIVIDER LINE */
.footer-divider {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    margin: 40px 0;
    opacity: 1;
}

.footer-link-heading {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 25px;
}

.footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links-list li {
    margin-bottom: 12px;
}

.footer-links-list li a {
    color: #94a3b8;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    transition: color 0.2s ease;
}

.footer-links-list li a:hover {
    color: #dd6a59; 
}


.footer-social-icons {
    display: flex;
    gap: 12px;
}

.social-icon-btn {
    width: 40px;
    height: 40px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
}

.social-icon-btn:hover {
    background-color: #dd6a59;
    color: #ffffff;
    border-color: #dd6a59
    transform: translateY(-3px);
}

/* BOTTOM COPYRIGHT ROW */
.copyright-text {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}

.footer-bottom-links a {
    color: #64748b;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s ease;
}

.footer-bottom-links a:hover {
    color: #ffffff;
}

.pipe-separator {
    color: rgba(255, 255, 255, 0.1);
    margin: 0 10px;
}

@media (max-width: 991px) {
    .main-footer-section {
       
        padding: 20px 0 30px 0;
    }
    .footer-divider{
        margin:0px;
    }
    .footer-link-heading {
        margin-bottom: 15px;
        margin-top: 15px;
    }
}

@media (max-width: 575px) {
    .newsletter-title {
        font-size: 22px;
    }
    .newsletter-input-group {
        padding: 6px 6px 6px 16px;
    }
}
</style>