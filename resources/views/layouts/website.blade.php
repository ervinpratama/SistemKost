<!--
=========================================================
* Soft UI Design System PRO - v1.0.8
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-design-system-pro 
* Copyright 2021 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('design-system/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('design-system/img/favicon.png') }}">
    <title>Bougenville Kost</title>
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/soft-ui-design-system-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="bootstrap, bootstrap 5, bootstrap5, ui kit, design system, responsive design, web design ui, ui design system, soft ui kit, soft ui design system">
    <meta name="description" content="Most complex and innovative Design System Made by Creative Tim. Check our latest Premium Bootstrap 5 UI Kit.">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Soft UI Design System Pro by Creative Tim">
    <meta name="twitter:description" content="Most complex and innovative Design System Made by Creative Tim. Check our latest Premium Bootstrap 5 UI Kit.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/414/thumb/opt_sds_thumbnail.png">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Soft UI Design System Pro by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://demos.creative-tim.com/soft-ui-design-system-pro/presentation.html" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/414/thumb/opt_sds_thumbnail.png" />
    <meta property="og:description" content="Most complex and innovative Design System Made by Creative Tim. Check our latest Premium Bootstrap 5 UI Kit." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Font Open Sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('design-system/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('design-system/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('design-system/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('design-system/css/soft-design-system-pro.min.css?v=1.0.8') }}" rel="stylesheet" />
    <!-- Custom CSS Page -->
    @stack('style')
    <!-- Anti-flicker snippet (recommended)  -->
    <style>
        .async-hide {
            opacity: 0 !important
        }

    </style>
</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.partials.web_navbar')
    <!-- End Navbar -->

    <!-- Page Content -->
    @yield('content')
    <!-- End Page Content -->

    @include('sweetalert::alert')

    <!-- Footer -->
    @include('layouts.partials.web_footer')
    <!-- End Footer -->
    
    <!--   Core JS Files   -->
    <script src="{{ asset('design-system/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('design-system/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('design-system/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!--  Plugin for TypedJS, full documentation here: https://github.com/mattboldt/typed.js/ -->
    <script src="{{ asset('design-system/js/plugins/typedjs.js') }}"></script>
    <script src="{{ asset('design-system/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('design-system/js/plugins/flatpickr.min.js') }}"></script>
    <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
    <script src="{{ asset('design-system/js/plugins/parallax.min.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('design-system/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for the GlideJS Carousel, full documentation here: http://kenwheeler.github.io/slick/ -->
    <script src="{{ asset('design-system/js/plugins/glidejs.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for the blob animation -->
    <script src="{{ asset('design-system/js/plugins/anime.min.js') }}" type="text/javascript"> </script>
    <!-- Chart JS -->
    <script src="{{ asset('design-system/js/plugins/chartjs.min.js') }}"></script>
    <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('design-system/js/soft-design-system-pro.min.js?v=1.0.8') }}" type="text/javascript"></script>
    <script>
    </script>
    <script>
        if (document.getElementById('choices-button')) {
            var element = document.getElementById('choices-button');
            const example = new Choices(element, {
                searchEnabled: false
            });

        }
        if (document.getElementById('choices-remove-button')) {
            var element = document.getElementById('choices-remove-button');
            const example = new Choices(element, {
                searchEnabled: false
            });
        }

        if (document.querySelector('.datepicker')) {
            flatpickr('.datepicker', {
                mode: "single"
            }); // flatpickr
        }

    </script>
    <script>
        if (document.getElementsByClassName('page-header')) {
            window.addEventListener('scroll', function () {
                var scrollPosition = window.pageYOffset;
                var bgParallax = document.querySelector('.page-header');
                var limit = bgParallax.offsetTop + bgParallax.offsetHeight;
                if (scrollPosition > bgParallax.offsetTop && scrollPosition <= limit) {
                    bgParallax.style.backgroundPositionY = (50 - 10 * scrollPosition / limit * 3) + '%';
                } else {
                    bgParallax.style.backgroundPositionY = '50%';
                }
            });
        }

    </script>
</body>

</html>
