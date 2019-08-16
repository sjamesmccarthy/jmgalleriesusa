<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->config->site_name ?> <?= $this->title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/main.css">
    <link rel="icon" type="image/x-icon" href="/view/image/favicon.ico?v=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/view/js/bxslider/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" href="/view/js/bxslider/jquery.bxslider.css" type="text/css" media="all">
    
    <script src="/view/js/instafeed.min.js"></script>

    <link rel="stylesheet" href="/view/css/overrides.css">

    <script>
    $(document).ready(function(){
        $('.slider').bxSlider({
            startSlide: 1,
            speed: 400,
            touchEnabled: true,
            keyboardEnabled: true,
            touchEnabled: true,
        });
    });
    </script>
</head>