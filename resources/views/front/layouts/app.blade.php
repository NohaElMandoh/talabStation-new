<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from crazycafe.net/html/appiyan/home2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 31 Oct 2021 20:31:09 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FAVICON -->
    <link rel="icon" href="https://talabstation.org/TalabStation/Dashboard-UI/images/talab-station-logo.png">
    <!-- TITLE -->
    <title>Talab Station</title>
    <!-- bootstrap.min.css -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".myLogoDivRed").hide();
        });
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.myLogoDiv').hide(300);
                $('.myLogoDivRed').show(100);
                $(".slicknav_btn").css('background-color','#c40e3d')
            } else {
                $('.myLogoDiv').show(300);
                $('.myLogoDivRed').hide(100);
                $(".slicknav_btn").css('background-color','#FFFFFF')
            }
        });
    </script>

    <!-- <script>
    $('.myLogoDivRed').hide(100);
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50 || $(this).scrollTop() < 50) {
                $('.myLogoDivRed').hide(100);
            } else {
                $('.myLogoDivRed').show(100);
            }
        });
    </script> -->


    @include('front.partials.style')
    <style>
        /* @media (min-width: 1200px){
.container{
    max-width: 100%;
} */
        /* } */

        .get-area.cta .get-app-right {

            margin-top: -68px;
        }

        .home2-hero-area {
            background-image: -webkit-linear-gradient(0deg, #c40e3d 0%, #c40e3d 60%, #c40e3d 100%);
            background-image: -ms-linear-gradient(0deg, #c40e3d 0%, #c40e3d 60%, #c40e3d 100%);
            padding-top: 140 px;
            padding-bottom: 80 px;
            position: relative;
            overflow: hidden;
        }

        a.header-btn.cta {
            color: #c40e3d;
        }
        .home2-theme-bg,
        .home2 div#sticky-wrapper.is-sticky .header-area a.header-btn {
            background: #c40e3d;
            border: 2 px solid transparent;
        }

        .about-single-content {
            color: #37424f;
        }

        .get-area.cta {
            background: #000000;
        }

        .footer-area.cta:before {
            background: #000000;
        }

        .contactedit-area {
            background: #c40e3d;
        }

        .slicknav_btn {
            /* background: #FFFFFF; */
            margin: -41px 27px -6px;
        }

        /* .slicknav_btn_bg_red {
            background: #c40e3d;
        }

        .slicknav_btn_bg_white {
            background: #ffffff;
        } */

        .slicknav_nav {
            /* background: #FFFFFF; */
            color: #000000;
        }
    </style>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="home2">
    <!-- start of facebook messenger chat plugin -->
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "109563794608474");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- end of facebook messenger chat plugin -->

    <!--  page loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!--  page loader end -->
    <div id="home"></div>
    <!--  header area start -->
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <!-- logo cta -->
                    <div class="myLogoDiv">
                        <img style="height:63.7271px" src="{{asset('front/image/logo_white.png')}}" alt="">
                    </div>
                    <div class="myLogoDivRed">
                        <img style="height:66px; margin-top:-5px" src="{{asset('front/image/logo.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-10 text-center">
                    <div class="responsive_menu"></div>
                    <div class="mainmenu cta">
                        <ul id="nav">
                            <li><a href="{{route('home.front')}}">Home</a>

                            </li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#youtube">Youtube</a></li>
                            <!-- <li><a href="#featured">Features</a></li> -->
                            <li><a href="#screens">Screenshots</a></li>
                            <!-- <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#testimonial">Testimonials</a></li> -->
                            <!-- <li><a href="#contact">Contact</a></li> -->
                        </ul>
                        <a href="https://play.google.com/store/apps/details?id=mo.atef.talab.station.client" class="header-btn cta">download now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  header area end -->
    <!--  hero area start -->
    <div class="home2-hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 wow fadeInLeft">
                    <div class="home2-hero-mobile">
                        <img src="{{asset('front/image/get-app-mobile.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 text-center col-md-12 wow fadeInLeft">
                    <div class="home2-hero-text">
                        <h1>Instant Food Delivery Service</h1>
                        <p>Our services are a mobile-based, or web-based services.
                            <br>You can use phone, laptop, or tablet.
                        </p>
                        <a class="home2-download-btn" href="https://play.google.com/store/apps/details?id=mo.atef.talab.station.client"></a>
                        <a class="home2-download-btn2" href="https://play.google.com/store/apps/details?id=mo.atef.talab.station.client"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  hero area start -->
    <!--  about area start -->
    <div class="home2-about-area wow fadeInUp" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="about-single-item">
                        <div class="about-single-icon cta">
                            <span style="background: url(front/assets/img/home2-about-icon1.png);"></span>
                        </div>
                        <div class="about-single-content">
                            <h4>24/7 Support</h4>
                            <p>Instant response on questions and queries of clients during the week 24/7. Clients can order different types of food via our client app.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="about-single-item">
                        <div class="about-single-icon">
                            <span style="background: url(assets/img/home2-about-icon2.png);"></span>
                        </div>
                        <div class="about-single-content">
                            <h4>Merchants and Restaurants</h4>
                            <p>Merchants and Restaurants can save their data via different types of Talab Station platforms. Merchants and Restaurants are integrated with Talab Station.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="about-single-item">
                        <div class="about-single-icon">
                            <span style="background: url(front/assets/img/home2-about-icon3.png);"></span>
                        </div>
                        <div class="about-single-content">
                            <h4>Volunteering with us</h4>
                            <p>Talab Station enable charities to book food for free from restaurants which excesses the need of restaurants. This food is delivered to the needing and poor families by Talab Station.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  about area end -->
    <!--  featured area start -->
    <div class="home-2-featured-area" id="featured" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 wow fadeInRight margin-left-30">
                    <div class="featured-right-item">
                        <div class="featured-title">
                            <h2>Features</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="featured-single-items">
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon1.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>User Friendly</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon2.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Smooth Typography</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon3.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Super Fast</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon4.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Creative Design</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="featured-single-items">
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon5.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Unlimited Features</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon6.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Easy Installation</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon7.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Well Documented</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="featured-single">
                                        <img src="{{asset('front/assets/img/featured-icon8.png')}}" alt="">
                                        <div class="featured-single-text">
                                            <h4>Extra Booster</h4>
                                            <p>Most such devices are sold with several
                                                <br> apps bundled as installed.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInLeft">
                    <div class="featured-mobile pulse">
                        <img src="assets/img/featured-mobile.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  featured area end -->
    <!--  video area start -->
    @include('front.partials.video')
    <!--  video area end -->
    <!--  screenshot area start -->
    <div class="screenshot-area cta2" id="screens">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp text-center">
                    <div class="section-title">
                        <h2>Screenshots</h2>
                        <p>Our products can be presented in mobile and tablet screens, web and dashboards.
                            <br> It can be downloaded to run on Android, IOS, or even web browsers.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="home2-screenshot-slide">
                        <div class="home2-screenshot-single-slide">
                            <img src="{{asset('front/image/screens/screen1.webp')}}" alt="">
                        </div>
                        <div class="home2-screenshot-single-slide">
                            <img src="{{asset('front/image/screens/screen2.webp')}}" alt="">
                        </div>
                        <div class="home2-screenshot-single-slide">
                            <img src="{{asset('front/image/screens/screen3.webp')}}" alt="">
                        </div>
                        <div class="home2-screenshot-single-slide">
                            <img src="{{asset('front/image/screens/screen4.webp')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  screenshot area end -->
    <!--  get area start -->
    <div class="get-area cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 wow fadeInRight">
                    <div class="get-app-right">

                        <img src="{{asset('front/image/get-app-mobile.png')}}" height='60%' width='79%' alt="">
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInRight">
                    <div class="get-area-left">
                        <h1>Get The App Now</h1>
                        <p>Mobile apps were originally offered for general productivity information retrieval, including email, calendar, contacts, stock market and weather information. public demand and the availability of developer tools drove rapid expansion into other categories, such as those handled.</p>
                        <div class="get-app-mobile-app">
                            <a href="https://play.google.com/store/apps/details?id=mo.atef.talab.station.client" class="home2-get-btn"></a>
                            <a href="https://play.google.com/store/apps/details?id=mo.atef.talab.station.client" class="home2-get-btn2"></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  get area end -->
    <!--  pricing area start -->
    <div class="pricng-area cta wow fadeInUp" id="pricing" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title cta-pricing">
                        <h2>Pricing</h2>
                        <p>Talab Station is available on different devices and supported on different screen sizes,
                            <br> such as phones, tables, and TVs.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="single-pricing">
                                <h5>Basic</h5>
                                <h4>$10 <span>/mo</span></h4>
                                <ul>
                                    <li>1 user</li>
                                    <li>10 projects</li>
                                    <li>access to all features</li>
                                    <li>24/7 support</li>
                                </ul>
                                <a href="#" class="price-btn">ordre now</a>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="single-pricing c-active">
                                <h5>Standard</h5>
                                <h4>$20 <span>/mo</span></h4>
                                <ul>
                                    <li>3 user</li>
                                    <li>20 projects</li>
                                    <li>access to all features</li>
                                    <li>24/7 support</li>
                                </ul>
                                <a href="#" class="price-btn">ordre now</a>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="single-pricing">
                                <h5>Premium</h5>
                                <h4>$40 <span>/mo</span></h4>
                                <ul>
                                    <li>7 user</li>
                                    <li>10 projects</li>
                                    <li>access to all features</li>
                                    <li>24/7 support</li>
                                </ul>
                                <a href="#" class="price-btn">ordre now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  pricing area end -->
    <!--  counter area start -->
    <div class="counter-area cta wow fadeInUp" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="#" class="single-counter">
                        <img src="{{asset('front/assets/img/counter-icon1.png')}}" alt="">
                        <h1>15K+</h1>
                        <p>App Downloads</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="single-counter">
                        <img src="{{asset('front/assets/img/counter-icon2.png')}}" alt="">
                        <h1>400+</h1>
                        <p>Happy Clients</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="single-counter">
                        <img src="{{asset('front/assets/img/counter-icon3.png')}}" alt="">
                        <h1>8K+</h1>
                        <p>Active Users</p>
                    </a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#" class="single-counter">
                        <img src="{{asset('front/assets/img/counter-icon4.png')}}" alt="">
                        <h1>900+</h1>
                        <p>Total Reviews</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--  counter area end -->
    <!--  testimonial area start -->
    <div class="testimonial-area cta" id="testimonial" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp text-center">
                    <div class="section-title">
                        <h2>Testimonials</h2>
                        <p>Most such devices are sold with several apps bundled as pre-installed software,
                            <br> such as a web browser, email client, calendar, mapping program.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial-slide">
                        <div class="testimonial-single-slide">
                            <div class="testimonial-slide-content">
                                <p>“Developing apps for mobile devices requires considering the constraints and features of these devices. Mobile devices run on battery and have less powerful processors.”</p>
                            </div>
                            <div class="testimonial-slide-meta">
                                <img src="assets/img/testimonial-slide-meta1.png" alt="">
                                <span class="testimonial-meta">
                                    <span class="meta-title">Elijah Terry</span>
                                    <br>
                                    <span class="meta-content">CEO, Imagine Dragon Inc.</span>
                                </span>
                            </div>
                        </div>
                        <div class="testimonial-single-slide">
                            <div class="testimonial-slide-content">
                                <p>“Developing apps for mobile devices requires considering the constraints and features of these devices. Mobile devices run on battery and have less powerful processors.”</p>
                            </div>
                            <div class="testimonial-slide-meta">
                                <img src="assets/img/testimonial-slide-meta2.png" alt="">
                                <span class="testimonial-meta">
                                    <span class="meta-title">Daniel Wells</span>
                                    <br>
                                    <span class="meta-content">Android Developer, SW&Z</span>
                                </span>
                            </div>
                        </div>
                        <div class="testimonial-single-slide">
                            <div class="testimonial-slide-content">
                                <p>“Developing apps for mobile devices requires considering the constraints and features of these devices. Mobile devices run on battery and have less powerful processors.”</p>
                            </div>
                            <div class="testimonial-slide-meta">
                                <img src="assets/img/testimonial-slide-meta3.png" alt="">
                                <span class="testimonial-meta">
                                    <span class="meta-title">Robert Evans</span>
                                    <br>
                                    <span class="meta-content">SEO Specialist, Singleappel</span>
                                </span>
                            </div>
                        </div>
                        <div class="testimonial-single-slide">
                            <div class="testimonial-slide-content">
                                <p>“Developing apps for mobile devices requires considering the constraints and features of these devices. Mobile devices run on battery and have less powerful processors.”</p>
                            </div>
                            <div class="testimonial-slide-meta">
                                <img src="assets/img/testimonial-slide-meta2.png" alt="">
                                <span class="testimonial-meta">
                                    <span class="meta-title">Daniel Wells</span>
                                    <br>
                                    <span class="meta-content">Android Developer, SW&Z</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  testimonial area end -->
    <!--  blog area start -->
    <div class="blog-slide-area cta" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp text-center">
                    <div class="section-title">
                        <h2>Blog</h2>
                        <p>Most such devices are sold with several apps bundled as pre-installed software,
                            <br> such as a web browser, email client, calendar, mapping program.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col- col-md-12">
                    <div class="blog-slide">
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img1.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Pamela Reid</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">5 Ways to From Your Mobile</a></h4>
                            </div>
                        </div>
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img2.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Jerry Myers</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">The Best of, so far</a></h4>
                            </div>
                        </div>
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img3.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Nicole Adams</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">All the trends we this year</a></h4>
                            </div>
                        </div>
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img1.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Pamela Reid</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">5 Ways to From Your Mobile</a></h4>
                            </div>
                        </div>
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img2.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Jerry Myers</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">The Best of, so far</a></h4>
                            </div>
                        </div>
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img3.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Nicole Adams</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">All the we loved this year</a></h4>
                            </div>
                        </div>
                        <div class="blog-single-slide">
                            <img src="assets/img/blog-slide-img3.jpg" alt="">
                            <div class="blog-slide-text">
                                <p>By <span class="blog-meta">Nicole Adams</span> <span class="blog-bar"> | </span> January 16, 2018</p>
                                <h4><a href="#">All the we loved this year</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  blog area end -->
    <!-- map area start-->
    <div class="blog-slide-area cta">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp text-center" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="section-title">
                        <h2>Reach Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d853.7375363675468!2d33.795217670812214!3d31.138899246717045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14fc2d580e2dcac7%3A0xd87f52adb21367da!2sTalab%20Station!5e0!3m2!1sar!2seg!4v1625207445223!5m2!1sar!2seg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
    <!-- map area end -->
    <!--  contact edit area start -->
    <div class="contactedit-area" id="contact" margin="150px" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title ctas1">
                        <h2>Contact US</h2>
                        <p>Most such devices are sold with several apps bundled as pre-installed software,
                            <br> such as a web browser, email client, calendar, mapping program.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-lg-1 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="contact-form">
                        <form action="http://crazycafe.net/html/appiyan/contact.php">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Full Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Subject">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <div class="home-2-form-submit">
                                        <input type="submit" value="Send message">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="contact-form-right">
                        <div class="contact-form-right-single">
                            <h5>Phone</h5>
                            <a href="tel:+201220776264">+20 1220 7762 64</a>
                        </div>
                        <div class="contact-form-right-single">
                            <h5>Email</h5>
                            <a href="mailto:contact@appiyan.com">talab.station@gmail.com</a>
                        </div>
                        <div class="contact-form-right-single">
                            <h5>Address</h5>
                            <p>Sea st, ElArish, North Sinai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  contact edit area end -->
    <!--  contact area start -->
    <div class="contact-area cta" id="contact" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title ctas1">
                        <h2>Contact US</h2>
                        <p>Most such devices are sold with several apps bundled as pre-installed software,
                            <br> such as a web browser, email client, calendar, mapping program.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-lg-1 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="contact-form">
                        <form action="http://crazycafe.net/html/appiyan/contact.php">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Full Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Subject">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <div class="home-2-form-submit">
                                        <input type="submit" value="Send message">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="contact-form-right">
                        <div class="contact-form-right-single">
                            <h5>Phone</h5>
                            <a href="tel:+201220776264">+20 1220 7762 64</a>
                        </div>
                        <div class="contact-form-right-single">
                            <h5>Email</h5>
                            <a href="mailto:contact@appiyan.com">talab.station@gmail.com</a>
                        </div>
                        <div class="contact-form-right-single">
                            <h5>Address</h5>
                            <p>Sea st, ElArish, North Sinai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  contact area end -->
    <!--  footer area start -->
    <div class="footer-area cta wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-menu">
                        <ul id="footer-list">
                            <li><a href="{{route('home.front')}}">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#youtube">Youtube</a></li>
                            <li><a href="#screens">Screenshots</a></li>
                            <!-- <li><a href="#contact">Contact</a></li> -->
                            <li><a href="https://play.google.com/store/apps/details?id=mo.atef.talab.station.client">Download</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-social-icon">
                        <a href="https://www.facebook.com/talabstationegypt"><i class="zmdi zmdi-facebook"></i></a>
                        <a href="https://twitter.com/talabstationegy"><i class="zmdi zmdi-twitter"></i></a>
                        <a href="https://www.linkedin.com/in/talabstationegypt/"><i class="zmdi zmdi-linkedin"></i></a>
                        <a href="https://www.instagram.com/talabstationegypt/"><i class="zmdi zmdi-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCUmCCaxHAbh4TMicqoN66_A"><i class="zmdi zmdi-youtube-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-logo">
                        <a href="{{route('home.front')}}"><img style="height:66px" src="{{asset('front/image/logo_white.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-title" style="margin-top:32px">
                        <p>Designed by Talab Station</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  footer area end -->
    @include('front.partials.scripts')
</body>


<!-- Mirrored from crazycafe.net/html/appiyan/home2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 31 Oct 2021 20:31:41 GMT -->

</html>