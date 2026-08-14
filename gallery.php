<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Work Environment Gallery |  Doric Multimedia Pvt. Ltd. | DMPL </title>

<meta name="description" content="Explore the Work Environment Gallery of Doric Multimedia. Get a glimpse of our modern workspace, collaborative culture, expert team, training sessions, client interactions, events, and innovative business solutions that drive success.">

<meta name="keywords" content="Doric Multimedia Gallery, Work Environment, Office Gallery, Team at Doric Multimedia, Workplace Culture, Office Photos, Corporate Environment, Business Workspace, Team Collaboration, Company Events, Professional Office, Digital Solutions Company, Tally Experts, IT Company Gallery">

</head>
<?php include("navbar.php")?>

<!-- <section class="breadcrumb-section">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="breadcrumb-heading">Gallery</h1>
                <div class="breadcrumb-nav">
                    <a href="index.php">Home</a>
                    <span class="separator">/</span>
                    <span class="current-page">Gallery</span>
                </div>
            </div>
        </div>
    </div>
</section> -->


<section class="work_env ">
    <div class="container">
        <!-- Section Title -->
        <div class="row text-center ">
            <div class="col-lg-12">
                <h6 class="subtitle-badge">
                    <span class="line"></span> Work Environment <span class="line"></span>
                </h6>
                <h1 class="main-heading">
                    We Create A <span class="highlight-green">Positive & </span> Creative Space
                </h1>
                <div class="divider"></div>
            </div>
        </div>

        <!-- 4 Image Grid with Lightbox -->
        <div class="row">
            <!-- Image 1 -->
            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 mb-4">
                <a href="images/work1.jpeg" class="glightbox env-card">
                    <img src="images/work1.jpeg" class="img-fluid" alt="Environment">
                </a>
            </div>
            <!-- Image 2 -->
            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 mb-4">
                <a href="images/work2.jpeg" class="glightbox env-card">
                    <img src="images/work2.jpeg" class="img-fluid" alt="Environment">
                </a>
            </div>
            <!-- Image 3 -->
            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 mb-4">
                <a href="images/work3.jpeg" class="glightbox env-card">
                    <img src="images/work3.jpeg" class="img-fluid" alt="Environment">
                </a>
            </div>
            <!-- Image 4 -->
            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 mb-4">
                <a href="images/work4.jpeg" class="glightbox env-card">
                    <img src="images/work4.jpeg" class="img-fluid" alt="Environment">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. CSS (Style tag mein) -->
<style>

 

.gslide-image img {
        max-height: 80vh !important; 
        object-fit: contain;     
       
    }

    /* Popup background ko aur dark karne ke liye (Optional) */
    .goverlay {
        background: rgba(0, 0, 0, 0.85) !important;
    }


.glightbox-close {
        width: 40px !important;
        height: 40px !important;
        background: rgba(255, 255, 255, 0.2) !important; /* Halka transparent background */
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        right: 20px !important;
        top: 20px !important;
        transition: 0.3s ease;
    }

    .glightbox-close:hover {
        background: rgba(157, 54, 38, 1) !important; /* Hover par aapka Brand Color */
        transform: rotate(90deg); /* Ghumne wala effect */
    }

    /* Icon ka color safed */
    .glightbox-close svg {
        fill: #fff !important;
        width: 20px;
    }

    /* Arrows (Next/Prev) ko bhi highlight karna */
    .glightbox-prev, .glightbox-next {
        background: rgba(255, 255, 255, 0.2) !important;
        border-radius: 50%;
        padding: 10px !important;
    }
</style>


<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        closeButton: true
    });
</script>

<style>

</style>


<?php include("footer.php")?>

</body>
</html>