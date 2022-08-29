<section id="footer">

    <!-- <div class="thin-line"></div> -->

    <div class="pb-32 footer-max-width">

        <div class="grid nopad-left hidden">

            <div class="col-12 collection-list">
                <ul>
                    <?= $collections_html ?>
                    <li><a href="/all">View All</a></li>
                    <li>&mdash;</li>
                    <li><a href="/styles">Frames & Pricing</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                </ul>
            </div>

        </div>

        <div class="grid-center-noGutter">

            <div class="col-7_sm-hidden_md-hidden breadcrumb">
                <p><a href="/"><img class="breadcrumb-logo" src="/view/__image/logo_fullsize.png" alt="breadcrumb-icon" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/__image/icon_navarrow-right.svg" alt="breadcrumb-icon" /><?= $this->page->title ?> </p>
            </div>

            <div class="col-5_sm-12 breadcrumb copyright">
                <p>
                    <!-- <a href="/shop">Shop</a> /  -->
                    <!-- <a href="/fieldnotes">Field Notes</a> /  -->
                    <a href="/thework">the work</a> <img class="breadcrumb-arrow" src="/view/__image/icon_navarrow-right.svg" alt="breadcrumb-icon">
                    <a href="/about">about</a>, <a target="_jmportraits" href="https://jmportraits.com">exhibits, portraits</a> <img class="breadcrumb-arrow" src="/view/__image/icon_navarrow-right.svg" alt="breadcrumb-icon">
                    <a href="/shop">Shop</a> <img class="breadcrumb-arrow" src="/view/__image/icon_navarrow-right.svg" alt="breadcrumb-icon">
                    <!-- <a class="tiny-dis" href="/privacy"><?= $this->config->copyright ?></a> <img class="breadcrumb-arrow" src="/view/__image/icon_navarrow-right.svg" alt="breadcrumb-icon"> -->
                    &nbsp; <a class="tiny-dis" href="/privacy"><?= $this->config->copyright ?> </a> & <img src="https://images.dmca.com/Badges/dmca-badge-w100-5x1-08.png?ID=4f4fc268-5857-46c9-97ec-b0ee644e9892" alt="DMCA.com Protection Status" style="vertical-align: middle" />
                    <a style="font-size:.6rem; margin-left: 2rem;" class="theme-toggle"><i class="fas fa-adjust"></i></a>
                </p>
                <!-- <div><img src ="https://images.dmca.com/Badges/dmca-badge-w100-5x1-08.png?ID=4f4fc268-5857-46c9-97ec-b0ee644e9892"  alt="DMCA.com Protection Status" style="vertical-align: middle" /></div> -->
                <?php
                // $this->getPartial('newsletter');
                ?>
            </div>

        </div>

    </div>

    <?= $cookie_consent ?>

</section>

<script>
    // function setCookie(cname, cvalue, exdays) {
    //     console.log('SettingCookie.partial_footer: ' + cname);
    //   var d = new Date();
    //   d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    //   var expires = "expires="+d.toUTCString();
    //   document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    // }
    //
    // function getCookie(cname) {
    //   var name = cname + "=";
    //   var ca = document.cookie.split(';');
    //   for(var i = 0; i < ca.length; i++) {
    //     var c = ca[i];
    //     while (c.charAt(0) == ' ') {
    //       c = c.substring(1);
    //     }
    //     if (c.indexOf(name) == 0) {
    //       return c.substring(name.length, c.length);
    //     }
    //   }
    //   return "";
    // }



    <?php if (strpos($this->page->catalog_path, '/studio') === false) { ?>

        jQuery(document).ready(function($) {

            let default_theme = '<?= $this->config_env->env[$this->env]['default_theme'] ?>';
            localStorage.setItem("theme", default_theme);
            console.log('re-init-theme: ' + default_theme);

            //TODO: Change this so that there is a user-defined theme and default theme. The user-defined theme is set in a cookie NOT is local storage.

            // Select the button
            const theme = document.querySelector(".theme-toggle");
            // Select the theme preference from localStorage
            const currentTheme = localStorage.getItem("theme");

            if (!currentTheme) {
                console.log('theme-local-storage-not-found');
                localStorage.setItem("theme", "dark");
                console.log('theme-set:' + localStorage.getItem("theme"));
            } else {
                console.log('current-theme:' + currentTheme);
            }

            // If the current theme in localStorage is "dark"...
            if (currentTheme == "dark") {
                // ...then use the .dark-theme class
                document.body.classList.add("dark-theme");
            }

            // If the current theme in localStorage is "dark"...
            if (currentTheme == "light") {
                // ...then use the .dark-theme class
                document.body.classList.remove("dark-theme");
            }

            // Listen for a click on the button
            theme.addEventListener("click", function() {
                // Toggle the .dark-theme class on each click
                document.body.classList.toggle("dark-theme");

                // Let's say the theme is equal to light
                let theme = "light";
                // If the body contains the .dark-theme class...
                if (document.body.classList.contains("dark-theme")) {
                    // ...then let's make the theme dark
                    theme = "dark";
                }
                // Then save the choice in localStorage
                localStorage.setItem("theme", theme);
            });

            //     if(getCookie('cookie_consent') == "AGREED") {
            //         $('cookie_banner').hide();
            //     }
            //
            //     $('#cookie_consent').on("click", function() {
            //
            //         let var_cookie_consent = 'AGREED';
            //
            //         if(getCookie('cookie_consent') == false) {
            //           setCookie('cookie_consent',var_cookie_consent,'30');
            //           console.log('cookie.Set(' + var_cookie_consent + ')');
            //           $('.cookie_banner').hide();
            //         }
            //
            //       });

        });

    <?php } ?>

    function setCookie(cname, cvalue, exdays) {
        console.log('SettingCookie.partial_footer: ' + cname);
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>
