<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title><?= $addSiteName ?><?= $this->title ?></title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,700&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900&display=swap" rel="stylesheet">    

    <link rel="stylesheet" href="/view/css/main.css?<?= time(); ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="/view/image/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/view/image/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/view/image/favicon/favicon-96x96.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/view/image/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta name="p:domain_verify" content="b1aefccc20a0932f9e254f23dac1e4e3"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/view/js/bxslider/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" href="/view/js/bxslider/jquery.bxslider.css" type="text/css" media="all">
    
    <script src="https://kit.fontawesome.com/27673c99c5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/view/css/overrides.css">
    
    <!-- <script src="/view/js/instafeed.min.js"></script> -->

    <script>
    jQuery(document).ready(function($){
        $('.slider').bxSlider({
            startSlide: 0,
            slideWidth: 1440,
            shrinkItems: false,
            speed: 400,
            touchEnabled: true,
            keyboardEnabled: true,
            pager: true,
            controls: true,
            hideControlOnEnd: true
        });
    });
    </script>
</head>