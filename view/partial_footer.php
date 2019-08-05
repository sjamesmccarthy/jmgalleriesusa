   <style>
       .contact-form-label {
    font-size: 18px;
    font-weight: 7800;
    /* line-height: 1; */
    margin-top: 40px;
}

.contact-form-interest-list {
    list-style: none;
    margin-top: 20px;
}

.contact-form-interest-list > li {
    margin-left: 20px;
    font-size: 18px;
    margin-top: 10px;
    /* line-height: 1.0; */
}

.contact-form-interest-list > li > input[type="radio"] {
    margin-right: 10px;
}

</style>

   <section id="footer">

        <div class="thin-line<?= $addToClass ?>"></div>

        <div class="grid-noGutter">
        
            <div class="col-6">
                <?php $this->getPartial('newsletter'); ?>
                <div class="pt-24">
                    <a href="/"><img src="/view/image/logo_fullsize.png" style="width: 28px;" /></a>
                     <a href="/"><img src="/view/image/social_twitter.svg" /></a>
                    <a href="/"><img src="/view/image/social_instagram.svg" /></a>
                    <a href="/"><img src="/view/image/social_linkedin.svg" /></a>
                    <a href="/"><img src="/view/image/social_medium.svg" /></a>
                </div>
            </div>
            
            <div class="col-2">
                <h4 style="padding-bottom: 16px;"><a href="/">EXPLORE</a></h4>
                <ul>
                    <li><a href="/exhibits">Exhibitions</a></li>
                    <li><a href="/styles">Frames, Styles & Editions</a></li>
                    <li><a href="/howto">How To Hang Your Photo</a></li>
                    <li><a href="/styles">Pricing</a></li>
                </ul>
            </div>

            <div class="col-2">
                <h4 style="padding-bottom: 16px;"><a href="/about">ABOUT</a></h4>
                    <ul>
                        <li><a href="/about">the Photographer</a></li>
                        <li><a href="/styles">Limited Editions</a></li>
                        <li><a href="/legal">Privacy Policy</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
            </div>

            <div class="col-2">
                    <h4 style="padding-bottom: 16px;"><a href="/shop">SHOP</a></h4>
                        <ul>
                            <li><a href="/shop">tinyViews™</a></li>
                            <li><a href="/shop">2019 Calendar</a></li>
                            <li><a href="/shop">Books</a></li>
                        </ul>
            </div>

        <div class="col" data-push-left="off-10">
            <p smallhalf style="padding-top: 32px;">&copy; 2019 jM Galleries</p>
        </div>

    </div>
    </section>