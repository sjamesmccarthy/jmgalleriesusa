<?php
/* 
component: AMAZING OFFER 
description: displays the amazing offer
css: component_amazingoffer.scss
created: jmccarthy
date: April 17, 2020
version: 1
*/

/* Add Code Here */
$amazingoffer_json = $this->api_AmazingOffer_Get_Latest();
extract($amazingoffer_json, EXTR_PREFIX_ALL, "res");

/* GENERATE HTML BLOCK */
if ($this->config->components['polarized'] == 'true') {  
$html = <<< END
   <article id="rewards" class="mt-64">
                <div class="grid-4_sm-2 grid-4_md-3">
                    <div class="most-popular--title col-12">
                        <h2 class="uppercase ">YOUR AMAZING OFFER &mdash; SAVE 52%</h2>
                        <p><b>As a collector you are privy to some special, exclusive new release fine art by j.McCarthy and some amazing offers.</b></p>
                        <p class="mt-8">As So The Story Goes ... at Salk Institute for Biologocial Studies in La Jolla, California. After walking around this beautiful campus just before sunset, I finally came to the front-gate and a "closed" sign stared back at me. I stood there, blank faced and let down when a security guard approached and asked if I'd like a tour. Of course I replied "are you joking?" There was only 1 rule he said: "No tripods". He escorted me to the well-known and well-photographed courtyard and there, with my tripod benched, I got a few shots of this architecturally renowned campus that unifies the sky, sea and science and once a year during the Winter Solstice the river of life aligns directly with an ocean sunset.</p>

                        <p class="mt-8"><a target="_ao" href="/contact?photo={$res_currenOfferName}&size=SIZE-60CM&frame=DARK-WALNUT&cost=480&promo_code=COLAMOF-SAVE52&email={$this->collector_data_obj->email}&name={$this->collector_data_obj->first_name} {$this->collector_data_obj->last_name}">Order Your Framed {$res_imageSize} Limited Edition Exclusive Amazing Offer Now for <b>{$res_amazingOfferPrice}</b> <strike>{$res_amazingOfferRegPrice}</strike> (52% off Limited Edition Pricing)</a></p>
                    </div>
                    
                    <div class="amazing-offer-photo mt-32">
                    <!-- <a target="_ao" href="/d/collector/amazing-offer"><button class="button-inv" style="position: absolute;right: 40px;top: 40px;">ORDER THIS AMAZING OFFER</button></a> -->
                    <p class="amazing-offer-center">
                        <a href="/amazing-offer">
                        <img class="amazing-offer-image" style="width: {$res_imageWidth}" src="/catalog/__image/{$res_amazingOfferFileName}" alt="Amazing Offer Email Photo" />
                        </a>
                    </p>
                    <img style="width: 10%; opacity: .5; position: absolute; bottom: 30px; right: 30px; {$res_amazingOfferSigInvert}" src="/view/image/logo_fullsize.png" />
                  </div>
              

                </div>
            </article>
END;
}

return($html);

