<style>
    .cleintlogo_section {
        padding: 90px 0;
        background-color: #ffffff;
        overflow: hidden;
    }

    .client-logo-item {
        background: #fff;
        margin: 0 12px;
        padding: 10px;

        border: 1px solid #eef0f2;
        border-radius: 16px;

        text-align: center;

        cursor: pointer;

        display: flex !important;
        align-items: center;
        justify-content: center;

        height: 130px;

        transition:
            box-shadow 0.4s ease,
            border-color 0.4s ease;
    }

    .client-logo-item:hover {
        box-shadow:
            0 15px 35px rgba(157, 54, 38, 0.20);

        border-color: #9d3626;
    }

    .client-logo-item img {
        max-height: 100px;
        width: auto;
        object-fit: contain;

        transition: transform 0.4s ease;
    }

    .client-logo-item:hover img {
        transform: scale(1.04);
    }

    .tally-title {
        font-weight: 800;
        color: #2d2d2d;
        margin-bottom: 0;
        letter-spacing: 0.5px;
    }

    /* =====================================================
       CONTINUOUS SLICK SLIDER
       ===================================================== */

    .client-slider .slick-track {
        display: flex !important;
        align-items: center;

        transition-timing-function: linear !important;
    }

    .client-slider .slick-slide {
        height: auto;
    }

    .client-slider .slick-slide > div {
        height: 100%;
    }

    /* Prevent any unwanted pause */
    .client-slider {
        overflow: hidden;
    }
</style>


<section class="cleintlogo_section">

    <div class="container">

        <h2 class="tally-title text-center">
            Our Prestigious Clients
        </h2>

        <div
            style="
                width:60px;
                height:4px;
                background:#9d3626;
                margin:15px auto;
                border-radius:2px;
            ">
        </div>


        <div class="client-slider mt-5">

            <div class="client-logo-item">
                <img src="images/clientlogo1.png"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo2.png"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo3.jpeg"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo4.jpeg"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo5.jpeg"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo6.png"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo7.jpeg"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo8.jpeg"
                     class="img-fluid"
                     alt="Client">
            </div>

            <div class="client-logo-item">
                <img src="images/cleintlogo9.png"
                     class="img-fluid"
                     alt="Client">
            </div>

        </div>

    </div>

</section>


<script>
$(document).ready(function () {

    $('.client-slider').slick({

        slidesToShow: 5,
        slidesToScroll: 1,

        infinite: true,

        arrows: false,
        dots: false,

        /* Continuous movement */
        autoplay: true,

        /* Almost no waiting between slides */
        autoplaySpeed: 0,

        /* Movement speed */
        speed: 5000,

        /* IMPORTANT */
        cssEase: 'linear',

        /* Don't stop when mouse enters */
        pauseOnHover: false,
        pauseOnFocus: false,

        draggable: false,
        swipe: false,

        responsive: [

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4
                }
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },

            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2
                }
            }

        ]

    });

});
</script>