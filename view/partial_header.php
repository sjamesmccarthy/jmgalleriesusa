<head>
    <meta charset="utf-8">
    <meta version="<?= $this->config->package_version ?>" />
    <meta site_name="<?= $this->config->site_name ?>" />
    <meta copyright="<?= $this->config->copyright ?>" />

    <meta property="og:title" content="<?= $addSiteName ?><?= $this->title ?>" />
    <meta property="og:url" content="<?= $this->routes->URI->url ?>" />
    <meta property="og:description" content="Fine Art Photography" />
    <meta property="og:image" content="//jmgalleries.com/catalog/__image/never-ending-story.jpg" />
    <meta property="og:type" content="article" />

    <title><?= $addSiteName ?><?= $this->title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/view/css/main.css?<?= time(); ?>">

   
    <link rel="apple-touch-icon" sizes="180x180" href="/view/image/favicon/<?= $this->env ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/view/image/favicon/<?= $this->env ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/view/image/favicon/<?= $this->env ?>/favicon-16x16.png">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/view/image/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta name="p:domain_verify" content="b1aefccc20a0932f9e254f23dac1e4e3"/>

    <!-- Third party utilities -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/27673c99c5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/sl-1.3.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/sl-1.3.1/datatables.min.js"></script>

    <!-- Overrides, need to combine this with appropriate scss files, but for now deal with it -->
    <link rel="stylesheet" href="/view/css/overrides.css?<?= time(); ?>">
    

    <script>
    jQuery(document).ready(function($){
  
        $(".notice-container").fadeIn('fast').delay(5000).slideUp('slow');

    });
    </script>

    
</head>