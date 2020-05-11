<?php
/* 
component: MY REWARDS 
description: determines reward points for collector
css: component_rewards.scss
created: jmccarthy
date: April 17, 2020
version: 1
*/

/* Add Code Here */

$myrewards_points = $this->api_MyRewards_Get_Points($this->collector_data_obj->collector_id);
$myrewards_points = round($myrewards_points['points']*1.5);
// $p_code = strtoupper($this->collector_data_obj->last_name) . $this->collector_data_obj->collector_id;
$p_code = "ARTROCKS15";

/* GENERATE HTML BLOCK */
if ($this->config->component_polarized == 'true') {  
$html = <<< END
    <article id="rewards" class="mt-64">
        <div class="grid-4_sm-2 grid-4_md-3">
            <div class="most-popular--title col-12">
            <h2 class="uppercase ">YOUR REWARDS = $myrewards_points  POINTS</h2>
            <p><b>As a collector you are enrolled in our rewards program and it's pretty simple.</b></p>
            <p class="mt-8">To get started share our website with your family and friends, and if they purchase a Limited Edition Fine Art Photograph, we will send you a tinyViews&trade; of your choice. You also receive points, and once you reach 2,500 points you're getting a free 12x18 Collector Proof of your selection. <u>Simply share this promo-code: {$p_code} ,</u> and your friends and family will use this code when ordering their fine art either online, by phone or email. They will also receive a 15% #itswhoyouknow discount.</p>
            </div>
            
            <div class="col-12">

                <div id="form_referrCollectorForm_container" class="mt-32">
                      
                    <form id="referrCollectorForm" action="/view/ajax_email_process.php" method="POST">
                    <input type="hidden" id="formType" name="formType" value="referrCollectorForm" />
                    <input type="hidden" id="referred_by" name="referred_by" value="{$this->collector_data_obj->first_name} {$this->collector_data_obj->last_name}" />
                    <input type="hidden" id="referred_by_email" name="referred_by_email" value="{$this->collector_data_obj->email}" />
                    <input type="hidden" id="promo_code" name="promo_code" value="{$p_code} " />
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                    <input name="refer_IP" type="hidden" value="{$_SERVER['REMOTE_ADDR']} " />

                    <div>
                    <label for="edition-style">FRIEND'S NAME</label>
                    <input class="third-size" maxlength="255" type="text" id="ref_name" name="ref_name" placeholder="FRIEND'S NAME (eg, JESSIE JAMES)" /">
                    <label for="edition-style">FRIEND'S EMAIL</label>
                    <input class="third-size" maxlength="255" type="text" id="ref_email" name="ref_email" placeholder="FRIEND'S EMAIL (eg, jessiejames@yahoo.com)" />
                    <button class="button-inv" id="sendrederral" style="padding:13px; margin-left: 10px;">SHARE PROMO CODE</button>
                    <p class="small">*The information supplied above is not saved and private to your session. However, your browser may remember previous form values.</p>
                    </div>
                    </form>
                </div>

                <p id="form_response" class="mt-16"> </p>

            </div>

        </div>
    </article>
END;
}

return($html);

