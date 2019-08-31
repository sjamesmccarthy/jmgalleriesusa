<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title><?= $addSiteName ?><?= $this->title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="/view/image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/view/image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/view/image/favicon-16x16.png">
    <link rel="manifest" href="/view/image/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/view/js/bxslider/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" href="/view/js/bxslider/jquery.bxslider.css" type="text/css" media="all">
    
    <script src="/view/js/instafeed.min.js"></script>

    <link rel="stylesheet" href="/view/css/overrides.css">

    <script>
    $(document).ready(function(){
        $('.slider').bxSlider({
            startSlide: 0,
            slideWidth: 1368,
            shrinkItems: false,
            speed: 400,
            touchEnabled: true,
            keyboardEnabled: true,
            pager: true,
            controls: true,
        });
    });
    </script>
</head>