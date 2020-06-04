<head>
    <meta charset="utf-8">
    <meta version="<?= $this->config->package_version ?>" />
    <meta site_name="<?= $this->config->site_name ?>" />
    <meta copyright="<?= $this->config->copyright ?>" />

    <meta property="og:title" content="<?= $this->title ?> at <?= $addSiteName ?> by j.McCarthy" />
    <meta property="og:url" content="https:<?= $this->routes->URI->url ?>" />
    <meta property="og:description" content="Artistic Photography for Fine Art Collectors & Enthusiasts" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://jmgalleries.com<?= $og_image ?>" />
    <meta property="og:image:alt" content="<?= $this->title ?> at <?= $addSiteName ?> by j.McCarthy" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@jmgalleriesusa" />
    <meta name="twitter:creator" content="@jmgalleriesusa" />
    <meta name="twitter:card" content="summary_large_image" />

    <title><?= $addSiteName ?><?= $this->title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,400&display=swap" rel="stylesheet">

   
    <link rel="apple-touch-icon" sizes="180x180" href="/view/image/favicon/<?= $this->env ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/view/image/favicon/<?= $this->env ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/view/image/favicon/<?= $this->env ?>/favicon-16x16.png">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/view/image/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta name="p:domain_verify" content="b1aefccc20a0932f9e254f23dac1e4e3"/>

    <!-- Third party utilities -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/27673c99c5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    
    <link rel="stylesheet" href="/view/css/main.css?<?= time(); ?>">

</head>