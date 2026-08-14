<style>
    .cleintlogo_section {
        padding: 60px 0;
        background-color: #ffffff;
    }

    .client-logo-item {
        background: #fff;
        margin: 0 12px; /* Thoda gap balance kiya */
        padding: 10px;
        border: 1px solid #eef0f2;
        border-radius: 16px; 
        text-align: center;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); /* Premium easing */
        cursor: pointer;
        display: flex !important;
        align-items: center;
        justify-content: center;
        height: 130px; 
    }

    .client-logo-item:hover {
        box-shadow: 0 15px 35px rgba(157, 54, 38, 0.2); 
        border-color: #9d3626;
    
    }

    .client-logo-item img {
        max-height: 100px;
        width: auto;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .tally-title {
        font-weight: 800;
        color: #2d2d2d;
        margin-bottom: 0;
        letter-spacing: 0.5px;
    }
</style>

<section class="cleintlogo_section">
    <div class="container">
        <h2 class="tally-title text-center">Our Prestigious Clients</h2>
        <div style="width: 60px; height: 4px; background: #9d3626; margin: 15px auto; border-radius: 2px;"></div>
        
        <div class="client-slider mt-5">
            <!-- Images -->
            <div class="client-logo-item"><img src="images/clientlogo1.png" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo2.png" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo3.jpeg" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo4.jpeg" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo5.jpeg" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo6.png" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo7.jpeg" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo8.jpeg" class="img-fluid" alt="Client"></div>
            <div class="client-logo-item"><img src="images/cleintlogo9.png" class="img-fluid" alt="Client"></div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $('.client-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000, /* 2 second is best for reading */
        speed: 1000,         /* Smoothness ke liye */
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: true,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 4 } },
            { breakpoint: 768, settings: { slidesToShow: 3 } },
            { breakpoint: 480, settings: { slidesToShow: 2 } }
        ]
    });
</script>