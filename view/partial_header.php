<head>
    <meta charset="utf-8">
    <meta name="language" content="English">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1">
    
    <title><?= $title_formatted ?></title>
    
    <meta name='title' content='<?= $this->page->title ?> by j.McCarthy'/>
    <meta name='description' content='jM Galleries, Fine Art Photography of People, Landscapes, Waterfalls, Oceans, Mountains and Deserts. <?= $this->page->title ?>' />
    <meta version="<?= $this->config->package_version ?>" />
    <meta site_name="<?= $this->config->site_name ?>" />
    <meta copyright="<?= $this->config->copyright ?>" />
    <link rel="author" href="humans.txt">

    <meta property="og:title" content="<?= $this->page->title ?> by j.McCarthy" />
    <meta property="og:url" content="https:<?= $this->routes->URI->url ?>" />
    <meta property="og:description" content="Artistic Photography for Fine Art Collectors & Enthusiasts" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://jmgalleries.com<?= $og_image ?>" />
    <meta property="og:image:alt" content="<?= $this->page->title ?> by j.McCarthy" />

    <meta name="twitter:site" content="@jmgalleriesusa" />
    <meta name="twitter:creator" content="@jmgalleriesusa" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:image" content="https://jmgalleries.com<?= $og_image ?>" />

    <!-- core fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- fonts from routing table -->
    <?= $header_font ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/view/image/favicon/<?= $this->env ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/view/image/favicon/<?= $this->env ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/view/image/favicon/<?= $this->env ?>/favicon-16x16.png">

    <!-- Third party utilities -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/27673c99c5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <!-- js from routing file -->
    <?= $header_js ?>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="/view/css/styles.css?<?= time(); ?>">

    <!-- css from routing file -->
    <?= $header_css ?>
    
    <!-- mailchimp integration -->
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/7fe25703399796912d1b5d6f8/1c9fb598be3b08f4fea525e46.js");</script>

</head>