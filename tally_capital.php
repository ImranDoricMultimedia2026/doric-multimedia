<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Tally Capital Solutions | Business Loans & Financial Services | Doric Multimedia Pvt. Ltd. | DMPL | Tally Solutions</title>

<meta name="description" content="Doric Multimedia offers Tally Capital solutions to help businesses access fast and secure business loans, working capital, and financial services through Tally. Simplify business financing with quick approvals, seamless integration, and expert support.">

<meta name="keywords" content="Tally Capital, Tally Capital loans, business loans, working capital, MSME loans, business finance, Tally financial services, TallyPrime, loan through Tally, business funding, Doric Multimedia, financial solutions, business growth, capital finance">

<!-- Font Awesome 6 (Free) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<?php include("navbar.php"); ?>
<?php include("modal.php"); ?>

<style>

/* =========================================================
   TALLY CAPITAL — ULTRA PREMIUM DESIGN
========================================================= */

:root{
    --tc-red:#8f3024;
    --tc-red-dark:#641d16;
    --tc-red-light:#b94b3a;
    --tc-gold:#b59668;

    --tc-ink:#171515;
    --tc-text:#35302e;
    --tc-muted:#77716e;

    --tc-bg:#f8f6f3;
    --tc-white:#ffffff;
    --tc-border:#e9e3de;

    --tc-shadow:0 25px 70px rgba(43,25,18,.08);
}


/* =========================================================
   GLOBAL
========================================================= */

.tally-capital-page{
    position:relative;
    overflow:hidden;
    color:var(--tc-text);
    background:#fff;
}

.tally-capital-page *,
.tally-capital-page *::before,
.tally-capital-page *::after{
    box-sizing:border-box;
}

.tc-container{
    width:min(1180px, calc(100% - 40px));
    margin:auto;
}

.tc-section{
    position:relative;
    padding:110px 0;
}

.tc-kicker{
    display:inline-flex;
    align-items:center;
    gap:10px;
    color:var(--tc-red);
    font-size:12px;
    
    font-weight:800;
    letter-spacing:2.5px;
    text-transform:uppercase;
}

.tc-kicker {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.tc-kicker::before,
.tc-kicker::after {
    content: "";
    width: 28px;
    height: 1px;
    background: var(--tc-gold);
    display: block;
}


.tc-heading{
    margin:16px 0 0;
    color:var(--tc-ink);
    font-size:clamp(38px,5vw,64px);
    line-height:1.02;
    letter-spacing:-3px;
    font-weight:800;
}

.tc-heading span{
    color:var(--tc-red);
}

.tc-description{
    max-width:650px;
    margin:22px 0 0;
    color:var(--tc-muted);
    font-size:14px;
    line-height:1.9;
}


/* =========================================================
   HERO
========================================================= */

.tc-hero{
    position:relative;
  
    display:flex;
    align-items:center;
    padding:85px 0;
    background:
        radial-gradient(
            circle at 85% 25%,
            rgba(143,48,36,.08),
            transparent 30%
        ),
        linear-gradient(
            120deg,
            #fff 0%,
            #fff 58%,
            #f8f4f0 100%
        );
    overflow:hidden;
}

.tc-hero-grid{
    position:absolute;
    inset:0;
    opacity:.4;
    pointer-events:none;
    background-image:
        linear-gradient(rgba(70,40,30,.025) 1px,transparent 1px),
        linear-gradient(90deg,rgba(70,40,30,.025) 1px,transparent 1px);
    background-size:70px 70px;
}

.tc-hero-orb{
    position:absolute;
    width:500px;
    height:500px;
    border-radius:50%;
    right:-250px;
    top:-150px;
    background:rgba(143,48,36,.07);
    filter:blur(70px);
}

.tc-hero-layout{
    position:relative;
    display:grid;
    grid-template-columns:1.02fr .98fr;
    gap:70px;
    align-items:center;
}


/* left */

.tc-hero-content{
    position:relative;
    z-index:2;
}

.tc-hero-kicker{
    display:inline-flex;
    align-items:center;
    gap:9px;
    padding:8px 12px;
    border:1px solid #eadfd9;
    border-radius:100px;
    background:rgba(255,255,255,.75);
    color:var(--tc-red);
    font-size:12px;
    font-weight:800;
    letter-spacing:1.7px;
}

.tc-hero-kicker i{
    color:var(--tc-gold);
}

.tc-hero-title{
    margin:22px 0 0;
    max-width:700px;
    color:var(--tc-ink);
    font-size:clamp(48px,6vw,82px);
    line-height:.98;
    letter-spacing:-5px;
    font-weight:850;
}

.tc-hero-title span{
    color:var(--tc-red);
}

.tc-hero-text{
    max-width:590px;
    margin:25px 0 0;
    color:#716b68;
    font-size:15px;
    line-height:1.9;
}

.tc-hero-actions{
    display:flex;
    align-items:center;
    gap:14px;
    margin-top:35px;
}

.tc-btn-primary{
    display:inline-flex;
    align-items:center;
    gap:14px;
    padding:14px 14px 14px 23px;
    border:0;
    border-radius:100px;
    color:#fff;
    background:linear-gradient(
        135deg,
        var(--tc-red),
        var(--tc-red-dark)
    );
    box-shadow:0 15px 35px rgba(143,48,36,.22);
    font-size:10px;
    font-weight:800;
    cursor:pointer;
    transition:.35s ease;
    text-decoration:none;
}

.tc-btn-primary i{
    width:32px;
    height:32px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    color:var(--tc-red);
    background:#fff;
}

.tc-btn-primary:hover{
    color:#fff;
    transform:translateY(-3px);
    box-shadow:0 20px 45px rgba(143,48,36,.3);
}

.tc-btn-secondary{
    display:inline-flex;
    align-items:center;
    gap:9px;
    padding:13px 18px;
    border:1px solid #ded7d2;
    border-radius:100px;
    color:#403b38;
    background:#fff;
    font-size:10px;
    font-weight:800;
    text-decoration:none;
    transition:.35s ease;
}

.tc-btn-secondary:hover{
    color:var(--tc-red);
    border-color:var(--tc-red);
    transform:translateY(-3px);
}

.tc-hero-trust{
    display:flex;
    align-items:center;
    gap:25px;
    margin-top:40px;
}

.tc-trust-item{
    display:flex;
    align-items:center;
    gap:9px;
}

.tc-trust-icon{
    width:32px;
    height:32px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:10px;
    color:var(--tc-red);
    background:#fbf1ee;
    font-size:11px;
}

.tc-trust-item span{
    color:#67615e;
    font-size:13px;
    font-weight:700;
}

.tc-trust-divider{
    width:1px;
    height:25px;
    background:#ddd6d1;
}


/* hero visual */

.tc-hero-visual{
    position:relative;
    min-height:570px;
}

.tc-hero-image{
    position:absolute;
    inset:25px 0 25px 45px;
    overflow:hidden;
    border-radius:32px;
    box-shadow:var(--tc-shadow);
    
    transition:transform .7s cubic-bezier(.2,.8,.2,1);
}

.tc-hero-image:hover{
    transform:rotate(0deg) scale(1.015);
}

.tc-hero-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.tc-hero-image::after{
    content:"";
    position:absolute;
    inset:0;
    background:
        linear-gradient(
            180deg,
            rgba(20,5,2,.02),
            rgba(20,5,2,.45)
        );
}

.tc-floating-card{
    position:absolute;
    z-index:3;
    display:flex;
    align-items:center;
    gap:12px;
    padding:13px 18px 13px 13px;
    border:1px solid rgba(255,255,255,.55);
    border-radius:16px;
    background:rgba(255,255,255,.9);
    backdrop-filter:blur(18px);
    box-shadow:0 18px 40px rgba(35,20,15,.12);
}

.tc-floating-card.top{
    top:15px;
    right:-5px;
}

.tc-floating-card.bottom{
    left:0;
    bottom:18px;
}

.tc-floating-icon{
    width:40px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    color:#fff;
    background:var(--tc-red);
}

.tc-floating-card small{
    display:block;
    margin-bottom:2px;
    color:#999;
    font-size:7px;
    font-weight:800;
    letter-spacing:1.2px;
}

.tc-floating-card strong{
    display:block;
    color:#292522;
    font-size:11px;
}


/* =========================================================
   WHY TALLYCAPITAL
========================================================= */

.tc-why{
    background:var(--tc-bg);
}

.tc-why-layout{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:70px;
    align-items:center;
}

.tc-why-features{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-top:30px;
}

.tc-why-feature{
    display:flex;
    align-items:center;
    gap:12px;
    padding:18px 20px;
    border:1px solid var(--tc-border);
    border-radius:16px;
    background:#fff;
}

.tc-why-feature i{
    width:38px;
    height:38px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    color:var(--tc-red);
    background:#fbf1ee;
    font-size:14px;
    flex-shrink:0;
}

.tc-why-feature span{
    font-size:11px;
    font-weight:700;
    color:var(--tc-ink);
}


/* =========================================================
   QUICK STATS
========================================================= */

.tc-stats{
    background:#fff;
    padding:70px 0;
}

.tc-stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

.tc-stat-item{
    text-align:center;
    padding:30px 20px;
    border-radius:20px;
    background:var(--tc-bg);
}

.tc-stat-number{
    color:var(--tc-red);
    font-size:48px;
    line-height:1;
    font-weight:850;
    letter-spacing:-3px;
}

.tc-stat-label{
    margin-top:10px;
    color:var(--tc-muted);
    font-size:10px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.8px;
}


/* =========================================================
   PROCESS (TALLYPRIME STEPS)
========================================================= */

.tc-process{
    background:#fff;
}

.tc-process-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-top:45px;
}

.tc-process-card{
    position:relative;
    padding:35px 28px 30px;
    border:1px solid #e5ddd7;
    border-radius:23px;
    background:#fff;
    transition:.45s cubic-bezier(.2,.8,.2,1);
}

.tc-process-card:hover{
    transform:translateY(-8px);
    border-color:rgba(143,48,36,.25);
    box-shadow:var(--tc-shadow);
}

.tc-process-number{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:44px;
    height:44px;
    border-radius:14px;
    color:#fff;
    background:linear-gradient(135deg,var(--tc-red),var(--tc-red-dark));
    font-size:14px;
    font-weight:800;
}

.tc-process-card h3{
    margin:18px 0 10px;
    color:#292522;
    font-size:18px;
    font-weight:800;
}

.tc-process-card p{
    margin:0;
    color:#7b7470;
    font-size:12px;
    line-height:1.8;
}

.tc-process-card .tc-step-highlight{
    display:inline-block;
    padding:3px 12px;
    border-radius:50px;
    background:#fbf1ee;
    color:var(--tc-red);
    font-size:10px;
    font-weight:700;
    margin-top:12px;
}


/* =========================================================
   FUNDING SOLUTIONS
========================================================= */

.tc-funding{
    background:var(--tc-bg);
}

.tc-funding-header{
    max-width:750px;
    margin-bottom:48px;
}

.tc-funding-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
}

.tc-funding-card{
    position:relative;
    min-height:365px;
    padding:25px;
    overflow:hidden;
    border:1px solid #e8e1dc;
    border-radius:24px;
    background:#fff;
    transition:.45s cubic-bezier(.2,.8,.2,1);
}

.tc-funding-card::before{
    content:"";
    position:absolute;
    width:180px;
    height:180px;
    right:-90px;
    top:-90px;
    border-radius:50%;
    background:rgba(143,48,36,.06);
    transition:.5s ease;
}

.tc-funding-card:hover{
    transform:translateY(-9px);
    box-shadow:var(--tc-shadow);
    border-color:rgba(143,48,36,.2);
}

.tc-funding-card:hover::before{
    transform:scale(1.7);
}

.tc-funding-icon{
    width:55px;
    height:55px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:16px;
    color:#fff;
    background:linear-gradient(
        135deg,
        var(--tc-red),
        var(--tc-red-dark)
    );
    box-shadow:0 12px 25px rgba(143,48,36,.18);
    font-size:18px;
}

.tc-funding-limit{
    display:inline-block;
    margin-top:12px;
    padding:4px 14px;
    border-radius:50px;
    background:#fbf1ee;
    color:var(--tc-red);
    font-size:10px;
    font-weight:800;
}

.tc-funding-card h3{
    margin:16px 0 10px;
    color:#25211f;
    font-size:18px;
    line-height:1.25;
    font-weight:800;
}

.tc-funding-card p{
    margin:0;
    color:#79726e;
    font-size:11px;
    line-height:1.75;
}


/* =========================================================
   ABOUT / EXPERTISE
========================================================= */

.tc-expertise{
    padding:120px 0;
    background:
        linear-gradient(
            135deg,
            #4a130e,
            #7e281e
        );
    color:#fff;
    overflow:hidden;
}

.tc-expertise::before{
    content:"";
    position:absolute;
    width:600px;
    height:600px;
    border-radius:50%;
    right:-300px;
    top:-250px;
    background:rgba(255,255,255,.06);
}

.tc-expertise-layout{
    position:relative;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:90px;
    align-items:center;
}

.tc-expertise .tc-kicker{
    color:#e5c898;
}

.tc-expertise .tc-kicker::before{
    background:#e5c898;
}

.tc-expertise .tc-heading{
    color:#fff;
}

.tc-expertise .tc-heading span{
    color:#e5c898;
}

.tc-expertise .tc-description{
    color:rgba(255,255,255,.7);
}

.tc-expertise-points{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    margin-top:35px;
}

.tc-expertise-point{
    padding:17px;
    border:1px solid rgba(255,255,255,.12);
    border-radius:15px;
    background:rgba(255,255,255,.055);
}

.tc-expertise-point strong{
    display:block;
    margin-bottom:5px;
    color:#fff;
    font-size:11px;
}

.tc-expertise-point span{
    color:rgba(255,255,255,.6);
    font-size:9px;
}

.tc-expertise-visual{
    position:relative;
}

.tc-expertise-box{
    position:relative;
    padding:35px;
    border:1px solid rgba(255,255,255,.15);
    border-radius:30px;
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(20px);
}

.tc-expertise-big{
    color:#fff;
    font-size:clamp(75px,9vw,130px);
    line-height:.8;
    font-weight:900;
    letter-spacing:-8px;
}

.tc-expertise-big span{
    color:#e5c898;
}

.tc-expertise-label{
    margin-top:20px;
    color:rgba(255,255,255,.72);
    font-size:11px;
    line-height:1.7;
}

.tc-expertise-line{
    width:100%;
    height:1px;
    margin:28px 0;
    background:rgba(255,255,255,.12);
}

.tc-expertise-mini{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.tc-expertise-mini span{
    color:rgba(255,255,255,.55);
    font-size:9px;
}

.tc-expertise-mini strong{
    color:#fff;
    font-size:11px;
}


/* =========================================================
   VIDEO / RESOURCES
========================================================= */

.tc-video{
    background:#f7f5f2;
}

.tc-video-layout{
    display:grid;
    grid-template-columns:.8fr 1.2fr;
    gap:70px;
    align-items:center;
}

.tc-video-copy .tc-heading{
    font-size:clamp(38px,4.5vw,58px);
}

.tc-video-copy p{
    max-width:480px;
}

.tc-video-link{
    display:inline-flex;
    align-items:center;
    gap:10px;
    margin-top:28px;
    color:var(--tc-red);
    font-size:10px;
    font-weight:800;
    text-decoration:none;
}

.tc-video-link i{
    transition:.3s ease;
}

.tc-video-link:hover{
    color:var(--tc-red-dark);
}

.tc-video-link:hover i{
    transform:translate(4px,-4px);
}

.tc-video-frame{
    position:relative;
    overflow:hidden;
    padding:8px;
    border-radius:28px;
    background:#fff;
    box-shadow:var(--tc-shadow);
}

.tc-video-frame iframe{
    display:block;
    width:100%;
    min-height:430px;
    border:0;
    border-radius:21px;
}


/* =========================================================
   FINAL CTA
========================================================= */

.tc-final{
    padding:90px 0;
    background:#fff;
}

.tc-final-box{
    position:relative;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:35px;
    padding:45px 50px;
    overflow:hidden;
    border-radius:28px;
    background:
        radial-gradient(
            circle at 90% 50%,
            rgba(255,255,255,.1),
            transparent 30%
        ),
        linear-gradient(
            120deg,
            #54160f,
            #8f3024
        );
}

.tc-final-box::before{
    content:"";
    position:absolute;
    width:300px;
    height:300px;
    right:-120px;
    top:-130px;
    border:1px solid rgba(255,255,255,.1);
    border-radius:50%;
}

.tc-final-box h2{
    position:relative;
    margin:0;
    color:#fff;
    font-size:clamp(28px,4vw,45px);
    line-height:1.05;
    letter-spacing:-2px;
}

.tc-final-box p{
    position:relative;
    margin:12px 0 0;
    color:rgba(255,255,255,.68);
    font-size:11px;
}

.tc-final .tc-btn-secondary{
    position:relative;
    flex-shrink:0;
    color:var(--tc-red);
    background:#fff;
    border-color:#fff;
}

.tc-final .tc-btn-secondary:hover{
    color:#fff;
    background:transparent;
}


/* =========================================================
   ANIMATION
========================================================= */

@keyframes tcFloat{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-8px);
    }
}

.tc-floating-card.top{
    animation:tcFloat 5s ease-in-out infinite;
}

.tc-floating-card.bottom{
    animation:tcFloat 6s ease-in-out infinite reverse;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .tc-hero-layout{
        gap:40px;
    }

    .tc-hero-title{
        font-size:62px;
    }

    .tc-process-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .tc-funding-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .tc-stats-grid{
        grid-template-columns:repeat(2,1fr);
    }

}

@media(max-width:900px){

    .tc-hero{
        min-height:auto;
        padding:75px 0;
    }

    .tc-hero-layout{
        grid-template-columns:1fr;
    }

    .tc-hero-content{
        text-align:center;
    }

    .tc-hero-kicker,
    .tc-hero-actions,
    .tc-hero-trust{
        justify-content:center;
    }

    .tc-hero-text{
        margin-left:auto;
        margin-right:auto;
    }

    .tc-hero-visual{
        min-height:500px;
    }

    .tc-hero-image{
        inset:20px 25px 20px 25px;
    }

    .tc-why-layout,
    .tc-expertise-layout,
    .tc-video-layout{
        grid-template-columns:1fr;
        gap:50px;
    }

    .tc-why-features{
        grid-template-columns:1fr;
    }

}

@media(max-width:700px){

    .tc-container{
        width:min(100% - 28px,1180px);
    }

    .tc-section{
        padding:75px 0;
    }

    .tc-hero-title{
        font-size:47px;
        letter-spacing:-3px;
    }

    .tc-hero-text{
        font-size:13px;
    }

    .tc-hero-actions{
        flex-direction:column;
        align-items:stretch;
    }

    .tc-btn-primary,
    .tc-btn-secondary{
        justify-content:center;
    }

    .tc-hero-trust{
        flex-wrap:wrap;
        gap:13px;
    }

    .tc-trust-divider{
        display:none;
    }

    .tc-hero-visual{
        min-height:400px;
    }

    .tc-hero-image{
        inset:20px 10px;
        transform:none;
    }

    .tc-floating-card.top{
        right:0;
        top:0;
    }

    .tc-floating-card.bottom{
        left:0;
        bottom:0;
    }

    .tc-process-grid{
        grid-template-columns:1fr;
    }

    .tc-funding-grid{
        grid-template-columns:1fr;
    }

    .tc-stats-grid{
        grid-template-columns:1fr 1fr;
    }

    .tc-expertise-points{
        grid-template-columns:1fr;
    }

    .tc-video-frame iframe{
        min-height:300px;
    }

    .tc-final-box{
        display:block;
        padding:35px 25px;
    }

    .tc-final .tc-btn-secondary{
        margin-top:25px;
        width:100%;
        justify-content:center;
    }

}

@media(max-width:430px){

    .tc-hero-title{
        font-size:40px;
    }

    .tc-heading{
        font-size:36px;
        letter-spacing:-1.8px;
    }

    .tc-hero-visual{
        min-height:350px;
    }

    .tc-stats-grid{
        grid-template-columns:1fr;
    }

    .tc-floating-card{
        padding:9px 12px 9px 9px;
    }

    .tc-floating-icon{
        width:32px;
        height:32px;
    }

}

@media(prefers-reduced-motion:reduce){

    .tc-floating-card.top,
    .tc-floating-card.bottom{
        animation:none;
    }

    .tc-hero-image,
    .tc-process-card,
    .tc-funding-card{
        transition:none;
    }

}

</style>


<main class="tally-capital-page">


<!-- =========================================================
     HERO
========================================================= -->

<section class="tc-hero">

    <div class="tc-hero-grid"></div>
    <div class="tc-hero-orb"></div>

    <div class="tc-container">

        <div class="tc-hero-layout">

            <div class="tc-hero-content">

               <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                            TALLY CAPITAL
                            <span class="badge-dot"></span>
                        </span>
                    </div>

                <h1 class="tc-hero-title">
                    Simple, Smart & 
                    <span>Superior Financing</span>
                </h1>

                <p class="tc-hero-text">
                    TallyCapital is <strong>changing</strong> the way businesses get business loans. 
                    No more lengthy paperwork, branch visits, or long waits. With TallyCapital, 
                    your company books maintained on Tally already have everything lenders need 
                    to provide you a business loan.
                </p>

                <div class="tc-hero-actions">

                    <a
                        href="javascript:void(0)"
                        onclick="openModal()"
                        class="tc-btn-primary"
                    >
                        Explore Funding
                        <i class="fas fa-arrow-up-right-from-square"></i>
                    </a>

                    <a
                        href="#funding"
                        class="tc-btn-secondary"
                    >
                        View Solutions
                        <i class="fas fa-arrow-down"></i>
                    </a>

                </div>


                <div class="tc-hero-trust">

                    <div class="tc-trust-item">
                        <div class="tc-trust-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span>Pre-Qualified Offers</span>
                    </div>

                    <div class="tc-trust-divider"></div>

                    <div class="tc-trust-item">
                        <div class="tc-trust-icon">
                            <i class="fas fa-building-columns"></i>
                        </div>
                        <span>Multiple Lenders</span>
                    </div>

                    <div class="tc-trust-divider"></div>

                    <div class="tc-trust-item">
                        <div class="tc-trust-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <span>Disbursal in 72 Hours</span>
                    </div>

                </div>

            </div>


            <div class="tc-hero-visual">

                <div class="tc-hero-image">

                    <img
                        src="images/TallyCapitalImage.png"
                        alt="Tally Capital Business Funding"
                    >

                </div>


                <div class="tc-floating-card top">

                    <div class="tc-floating-icon">
                        <i class="fas fa-indian-rupee-sign"></i>
                    </div>

                    <div>
                        <small>FUNDING SOLUTIONS</small>
                        <strong>Up to ₹15 Crores</strong>
                    </div>

                </div>


                <div class="tc-floating-card bottom">

                    <div class="tc-floating-icon">
                        <i class="fas fa-bolt"></i>
                    </div>

                    <div>
                        <small>QUICK DISBURSAL</small>
                        <strong>As fast as 72 hours</strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     QUICK STATS
========================================================= -->

<section class="tc-stats">

    <div class="tc-container">

        <div class="tc-stats-grid">

            <div class="tc-stat-item">
                <div class="tc-stat-number">2</div>
                <div class="tc-stat-label">Minutes to Check Eligibility</div>
            </div>

            <div class="tc-stat-item">
                <div class="tc-stat-number">72</div>
                <div class="tc-stat-label">Hours Disbursal Time</div>
            </div>

            <div class="tc-stat-item">
                <div class="tc-stat-number">20+</div>
                <div class="tc-stat-label">Years of Expertise</div>
            </div>

            <div class="tc-stat-item">
                <div class="tc-stat-number">4</div>
                <div class="tc-stat-label">Funding Solutions</div>
            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     WHY TALLYCAPITAL
========================================================= -->

<section class="tc-section tc-why">

    <div class="tc-container">

        <div class="tc-why-layout">

            <div>

               <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                           WHY TALLY CAPITAL 
                            <span class="badge-dot"></span>
                        </span>
                    </div>
                <h2 class="tc-heading">
                    Why businesses choose
                    <span>TallyCapital</span> for funding needs?
                </h2>

                <p class="tc-description">
                    TallyCapital is <strong>changing</strong> the way businesses get business loans. 
                    No more lengthy paperwork, branch visits, or long waits. With TallyCapital, 
                    your company books maintained on Tally already have everything lenders need.
                </p>

                <div class="tc-why-features">

                    <div class="tc-why-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Check Eligibility in 2 Minutes</span>
                    </div>

                    <div class="tc-why-feature">
                        <i class="fas fa-tag"></i>
                        <span>Get Pre-Qualified Offers</span>
                    </div>

                    <div class="tc-why-feature">
                        <i class="fas fa-bolt"></i>
                        <span>Apply Instantly</span>
                    </div>

                    <div class="tc-why-feature">
                        <i class="fas fa-clock"></i>
                        <span>Disbursal in 72 Hours</span>
                    </div>

                </div>

            </div>

            <div>

                <div style="position:relative; padding:30px; border-radius:28px; background:#fff; box-shadow:var(--tc-shadow); border:1px solid var(--tc-border);">

                    <div style="display:flex; align-items:center; gap:20px; margin-bottom:20px;">

                        <div style="width:60px; height:60px; display:flex; align-items:center; justify-content:center; border-radius:16px; color:#fff; background:linear-gradient(135deg,var(--tc-red),var(--tc-red-dark)); font-size:24px;">
                            <i class="fas fa-file-invoice"></i>
                        </div>

                        <div>
                            <div style="font-size:11px; color:var(--tc-muted); font-weight:700; letter-spacing:1px;">TALLYPRIME</div>
                            <div style="font-size:16px; font-weight:800; color:var(--tc-ink);">Integrated Within</div>
                        </div>

                    </div>

                    <div style="padding:20px; border-radius:16px; background:var(--tc-bg);">

                        <div style="display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid var(--tc-border);">
                            <span style="font-size:12px; font-weight:700; color:var(--tc-ink);">Open TallyPrime</span>
                            <span style="color:var(--tc-muted); font-size:11px;">→</span>
                            <span style="font-size:12px; font-weight:700; color:var(--tc-red);">Press Alt + 9</span>
                            <span style="color:var(--tc-muted); font-size:11px;">→</span>
                            <span style="font-size:12px; font-weight:700; color:var(--tc-ink);">Click "Check Eligibility"</span>
                        </div>

                        <div style="display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid var(--tc-border);">
                            <span style="font-size:12px; font-weight:700; color:var(--tc-ink);">Compare &amp; Pick</span>
                            <span style="color:var(--tc-muted); font-size:11px;">→</span>
                            <span style="font-size:12px; font-weight:700; color:var(--tc-red);">Choose what works for you</span>
                        </div>

                        <div style="display:flex; align-items:center; gap:12px; padding:10px 0;">
                            <span style="font-size:12px; font-weight:700; color:var(--tc-ink);">Upload &amp; Done</span>
                            <span style="color:var(--tc-muted); font-size:11px;">→</span>
                            <span style="font-size:12px; font-weight:700; color:var(--tc-red);">Upload KYC, Submit</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     PROCESS — 3 SIMPLE STEPS
========================================================= -->

<section class="tc-section tc-process">

    <div class="tc-container">

        <div style="text-align:center; max-width:700px; margin:0 auto;">
<div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                           HOW IT WORKS
                            <span class="badge-dot"></span>
                        </span>
                    </div>
            

            <h2 class="tc-heading">
                Apply in <span>3 simple steps</span>
            </h2>

            <p class="tc-description" style="margin-left:auto; margin-right:auto;">
                Check your eligibility, compare offers, and get disbursal — all from within TallyPrime.
            </p>

        </div>


        <div class="tc-process-grid">

            <article class="tc-process-card">

                <div class="tc-process-number">01</div>

                <h3>Open &amp; Check</h3>

                <p>
                    Open TallyPrime → Press <strong>Alt + 9</strong> → Click 
                    <strong>"Check Eligibility"</strong>
                </p>

                <span class="tc-step-highlight">
                    <i class="fas fa-clock"></i> Takes 2 Minutes
                </span>

            </article>


            <article class="tc-process-card">

                <div class="tc-process-number">02</div>

                <h3>Compare &amp; Pick</h3>

                <p>
                    Compare lender offers, review terms, and pick the 
                    solution that works best for your business.
                </p>

                <span class="tc-step-highlight">
                    <i class="fas fa-building-columns"></i> Multiple Lenders
                </span>

            </article>


            <article class="tc-process-card">

                <div class="tc-process-number">03</div>

                <h3>Upload &amp; Done</h3>

                <p>
                    Upload basic KYC documents, submit your application, 
                    and get disbursal in as little as 72 hours.
                </p>

                <span class="tc-step-highlight">
                    <i class="fas fa-bolt"></i> Fast Disbursal
                </span>

            </article>

        </div>

    </div>

</section>



<!-- =========================================================
     FUNDING SOLUTIONS
========================================================= -->

<section class="tc-section tc-funding" id="funding">

    <div class="tc-container">

        <div class="tc-funding-header">

          <div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                           FUNDING SOLUTIONS
                            <span class="badge-dot"></span>
                        </span>
                    </div>

            <h2 class="tc-heading">
                More Funding Options,
                <span>Tailored to Your Needs</span>
            </h2>

            <p class="tc-description">
                Choose from flexible funding options designed around different 
                business situations and goals.
            </p>

        </div>


        <div class="tc-funding-grid">


            <article class="tc-funding-card">

                <div class="tc-funding-icon">
                    <i class="fas fa-rocket"></i>
                </div>

                <h3>Unsecured Loans</h3>

                <span class="tc-funding-limit">Up to ₹75 Lakhs</span>

                <p style="margin-top:12px;">
                    Ideal for growing businesses that need fast, 
                    collateral-free funding.
                </p>

            </article>


            <article class="tc-funding-card">

                <div class="tc-funding-icon">
                    <i class="fas fa-building"></i>
                </div>

                <h3>Loan Against Property</h3>

                <span class="tc-funding-limit">Up to ₹15 Crores</span>

                <p style="margin-top:12px;">
                    Unlock the value of your property to fund business 
                    expansion or working capital.
                </p>

            </article>


            <article class="tc-funding-card">

                <div class="tc-funding-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>

                <h3>CGTMSE Loans</h3>

                <span class="tc-funding-limit">Government-Backed</span>

                <p style="margin-top:12px;">
                    Government-backed credit guarantee for eligible 
                    businesses.
                </p>

            </article>


            <article class="tc-funding-card">

                <div class="tc-funding-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <h3>Professional Loans</h3>

                <span class="tc-funding-limit">Tailored for CAs</span>

                <p style="margin-top:12px;">
                    Tailored financing for practising Chartered 
                    Accountants.
                </p>

            </article>

        </div>

    </div>

</section>



<!-- =========================================================
     ABOUT / EXPERTISE
========================================================= -->

<section class="tc-expertise">

    <div class="tc-container">

        <div class="tc-expertise-layout">

            <div>

               <div class="premium-badge-wrapper">
                        <span class="premium-badge" style="color:#fff;">
                            <span class="badge-dot"></span>
                          ABOUT US
                            <span class="badge-dot"></span>
                        </span>
                    </div>

                <h2 class="tc-heading">
                    Empowering Businesses with
                    <span>20+ Years</span>
                    of Expertise.
                </h2>

                <p class="tc-description">
                    We have been authorised Tally Partners for over 20 years, helping businesses 
                    across <strong>North Zone</strong> set up, manage, and grow with TallyPrime.
                </p>

                <p class="tc-description" style="margin-top:12px;">
                    As a certified TallyCapital partner, we now bring you seamless access to 
                    business financing — right from within the software you already use every day.
                </p>

                <p class="tc-description" style="margin-top:12px;">
                    Whether you need guidance on getting started with TallyCapital or want to 
                    explore your loan options, our team is here to help.
                </p>


                <div class="tc-expertise-points">

                    <div class="tc-expertise-point">
                        <strong>Authorised Tally Partner</strong>
                        <span>20+ years of trusted service across North Zone.</span>
                    </div>

                    <div class="tc-expertise-point">
                        <strong>Certified TallyCapital Partner</strong>
                        <span>Seamless access to business financing through TallyPrime.</span>
                    </div>

                    <div class="tc-expertise-point">
                        <strong>Expert Guidance</strong>
                        <span>Help with getting started and exploring loan options.</span>
                    </div>

                    <div class="tc-expertise-point">
                        <strong>Trusted Ecosystem</strong>
                        <span>Connected with the wider Tally business ecosystem.</span>
                    </div>

                </div>

                <a href="tel:9888696300" style="display:inline-flex; align-items:center; gap:12px; margin-top:30px; padding:14px 28px; border-radius:100px; color:#fff; background:linear-gradient(135deg,var(--tc-red),var(--tc-red-dark)); font-size:10px; font-weight:800; text-decoration:none; transition:.35s ease; box-shadow:0 15px 35px rgba(143,48,36,.22);">
                    <i class="fas fa-phone"></i>
                    Get in touch with us
                    <i class="fas fa-arrow-up-right-from-square"></i>
                </a>

            </div>


            <div class="tc-expertise-visual">

                <div class="tc-expertise-box">

                    <div class="tc-expertise-big">
                        20<span>+</span>
                    </div>

                    <div class="tc-expertise-label">
                        Years of experience and understanding across the 
                        business ecosystem as authorised Tally Partners.
                    </div>

                    <div class="tc-expertise-line"></div>

                    <div class="tc-expertise-mini">
                        <span>TRUSTED TALLY EXPERTS</span>
                        <strong>DORIC MULTIMEDIA</strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<section class="creative_section" >
    <div class="container">
      
        <div class="partner-slider">
            <!-- 7 Images -->
            <div class="slide-item"><img src="images/creative1.jpeg" class="img-fluid" alt="Partner"></div>
            <div class="slide-item"><img src="images/creative2.jpeg"  class="img-fluid" alt="Partner"></div>
            <div class="slide-item"><img src="images/creative3.jpeg"  class="img-fluid" alt="Partner"></div>
            <div class="slide-item"><img src="images/creative4.jpeg"  class="img-fluid" alt="Partner"></div>
            <div class="slide-item"><img src="images/creative5.jpeg"   class="img-fluid" alt="Partner"></div>
            <div class="slide-item"><img src="images/creative6.jpeg"  class="img-fluid" alt="Partner"></div>
            <div class="slide-item"><img src="images/creative7.jpeg"  class="img-fluid" alt="Partner"></div>
        </div>
    </div>
</section>


<script type="text/javascript">
 $('.partner-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: true,
    arrows: false,
    infinite: true,
    // responsive settings wahi purani wali
    responsive: [
        { breakpoint: 1024, settings: { slidesToShow: 4 } },
        { breakpoint: 768, settings: { slidesToShow: 3 } },
        { breakpoint: 480, settings: { slidesToShow: 1 } }
    ]
});
</script>


<!-- =========================================================
     VIDEO / RESOURCES
========================================================= -->

<section class="tc-section tc-video">

    <div class="tc-container">

        <div class="tc-video-layout">

            <div class="tc-video-copy">
<div class="premium-badge-wrapper">
                        <span class="premium-badge">
                            <span class="badge-dot"></span>
                        RESOURCES
                            <span class="badge-dot"></span>
                        </span>
                    </div>
                <h2 class="tc-heading">
                    Learn More About
                    <span>TallyCapital</span>
                </h2>

                <p class="tc-description">
                    <strong>Smart Business Financing</strong> — Grow your business with TallyCapital. 
                    Get quick access to unsecured business loans, instant eligibility checks, 
                    flexible EMI options, and hassle-free digital loan applications through 
                    trusted lending partners — all integrated with TallyPrime.
                </p>

                <a
                    href="https://tallycapital.tallysolutions.com/"
                    target="_blank"
                    rel="noopener"
                    class="tc-video-link"
                >
                    Visit Official Website
                    <i class="fas fa-arrow-up-right-from-square"></i>
                </a>

            </div>


            <div class="tc-video-frame">

                <iframe
                    src="https://www.youtube.com/embed/4LJa6iKgrpE"
                    title="TallyCapital"
                    loading="lazy"
                    allowfullscreen>
                </iframe>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     FINAL CTA
========================================================= -->

<section class="tc-final">

    <div class="tc-container">

        <div class="tc-final-box">

            <div>

                <h2>
                    Ready to explore
                    better funding options?
                </h2>

                <p>
                    Whether you need guidance on getting started with TallyCapital or 
                    want to explore your loan options, our team is here to help.
                </p>

            </div>


            <a
                href="tel:9888696300"
                class="tc-btn-secondary"
            >
                <i class="fas fa-phone"></i>
                Get in Touch
                <i class="fas fa-arrow-up-right-from-square"></i>
            </a>

        </div>

    </div>

</section>


</main>


<?php include("footer.php"); ?>
</body>
</html>