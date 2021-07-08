<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- Favicons -->
    <link rel="shortcut icon" href="https://demo.hasthemes.com/airi-preview/airi/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="https://demo.hasthemes.com/airi-preview/airi/assets/img/icon.png">

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- ************************* CSS Files ************************* -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://demo.hasthemes.com/airi-preview/airi/assets/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://demo.hasthemes.com/airi-preview/airi/assets/css/font-awesome.min.css">

    <!-- dl Icon CSS -->
    <link rel="stylesheet" href="https://demo.hasthemes.com/airi-preview/airi/assets/css/dl-icon.css">

    <!-- All Plugins CSS  -->
    <link rel="stylesheet" href="https://demo.hasthemes.com/airi-preview/airi/assets/css/plugins.css">

    <!-- Revoulation CSS  -->
    <link rel="stylesheet" href="https://demo.hasthemes.com/airi-preview/airi/assets/css/revoulation.css">

    <!-- style CSS -->
    <link rel="stylesheet" href="https://demo.hasthemes.com/airi-preview/airi/assets/css/main.css">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

    <!-- modernizr JS
    ============================================ -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="ai-preloader active">
        <div class="ai-preloader-inner h-100 d-flex align-items-center justify-content-center">
            <div class="ai-child ai-bounce1"></div>
            <div class="ai-child ai-bounce2"></div>
            <div class="ai-child ai-bounce3"></div>
        </div>
    </div>

    @yield('content')


<!-- END FOOTER -->

    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/vendor/jquery.min.js"></script>

    <!-- Bootstrap and Popper Bundle JS -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/bootstrap.bundle.min.js"></script>

    <!-- All Plugins Js -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/plugins.js"></script>

    <!-- Ajax Mail Js -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/ajax-mail.js"></script>

    <!-- Main JS -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/main.js"></script>

    <!-- REVOLUTION JS FILES -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/jquery.themepunch.tools.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/jquery.themepunch.revolution.min.js"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.actions.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.carousel.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.migration.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.navigation.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.parallax.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation/extensions/revolution.extension.video.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/9fd97b7f3f.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/vue-slick-carousel"></script>
    <!-- REVOLUTION ACTIVE JS FILES -->
    <script src="https://demo.hasthemes.com/airi-preview/airi/assets/js/revoulation.js"></script>


</body>

</html>