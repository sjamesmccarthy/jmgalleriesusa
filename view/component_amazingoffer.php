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

$order_link = '<a target="_ao" href="/contact?photo=' . urlencode($res_currenOfferName) . '&size=SIZE-60CM&frame=STUDIO-SNOW+WHITE+or+ASH+GRAY&cost=480&promo_code=ARTISTPROOF&email=' . $this->collector_data_obj->email . '&name=' . $this->collector_data_obj->first_name . ' ' . $this->collector_data_obj->last_name . '">';

/* GENERATE HTML BLOCK */
if ($this->config->components['polarized'] == 'true') {  
$html = <<< END
   <article id="rewards" class="mt-64">
        <div class="grid-4_sm-2 grid-4_md-3">
            <div class="most-popular--title col-12">
                <h2 class="uppercase ">ARTIST PROOF COLLECTOR EXCLUSIVE</h2>
                <p><b>As a collector you are privy to the exclsuive and very limited Artist Proofs.<br />Since there are only two Artist Proofs created for the edition, once they are gone no more are made.</b></p>
                <p class="mt-8">And So The Story Goes ... at Salk Institute for Biologocial Studies in La Jolla, California. After walking around this beautiful campus just before sunset, I finally came to the front-gate and a "closed" sign stared back at me. I stood there, blank faced and let down when a security guard approached and asked if I'd like a tour. Of course I replied "are you joking?" There was only 1 rule he said: "No tripods". He escorted me to the well-known and well-photographed courtyard and there, with my tripod benched, I got a few shots of this architecturally renowned campus that unifies the sky, sea and science and once a year during the Winter Solstice the river of life aligns directly with an ocean sunset.</p>

                <p class="mt-8">{$order_link}Order Your Studio Framed {$res_imageSize} Artist Proof before they are gone.  <b>{$res_amazingOfferPrice}</b> <strike>{$res_amazingOfferRegPrice}</strike> (ONLY 2 AVAILABLE)</a></p>
            </div>
            
            <div class="amazing-offer-photo mt-32">
            <p class="amazing-offer-center">
                <img src="/view/image/collector_artist-proof.jpg" alt="Artist Proof Collector Exclusive" />
            </p>
            <img style="width: 10%; opacity: .5; position: absolute; bottom: 30px; right: 30px; {$res_amazingOfferSigInvert}" src="/view/image/logo_fullsize.png" />
            {$order_link}<button class="button-inv" style="position: absolute;right: 40px;bottom: 40px;">ORDER THIS ARTIST PROOF</button></a>
          </div>
      

        </div>
    </article>
END;
}

return($html);

