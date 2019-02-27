<html>

<head>
<!-- insert custom css, js, fonts, etc -->
<!-- read in from routes-json -->
</head>

<body>

    <?php $this->insert('header'); ?>
    
    <p style='text-align: center; padding: 40px; background-color: rgba(0,0,0,1); color: #FFF'>layout for GALLERY</p>

        <div style="background-color: rgba(0,0,0,.3); padding: 100px;">
            <?php $this->getPageContent(); ?>
        </div>

    <?php $this->insert('footer'); ?>
    <?php $this->insert('ga-code'); ?>

</body>
</html>