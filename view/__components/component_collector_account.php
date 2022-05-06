<?php

/* Logic */

$username = $this->collector_data_obj->email;
$collector_id = $this->collector_data_obj->collector_id;
$user_id = $_SESSION['uid'];

$html = <<<END
<article id="my-account" class="mt-32">
<p class="form_response success">Donec id elit non mi porta gravida at eget metus.</p>
<form id="collector-account" action="/studio/api/update/collector-account" method="POST">
<input type="hidden" name="username" value="{$username}" />
<input type="hidden" name="collector_id" value="{$collector_id}" />
<input type="hidden" name="user_id" value="{$user_id}" />
<input type="hidden" name="type" value="COLLECTOR" />

    <div class="grid">
        <div class="col">
        <h4>Change PIN Number</h4>
        </div>
    </div>
    
    <div class="grid">
        <div id="change-pin" class="col-12">
            <input class="" maxlength="6" type="text" id="pin" name="pin" placeholder="New Pin (eg, 123456)" />
            <input class="" maxlength="6" type="text" id="pin_check" name="pin_check" placeholder="Confirm New Pin" /">
        </div>
    </div>
    
    <div class="grid">
        <div class="col">
            <button id="pin_btn" value="SEND">UPDATE PIN</button>
       </div>
     </div>
     
     <div class="grid">
        <div class="col tryagain">
            <p class="tiny">To change PIN again, please refresh page</p>
       </div>
    </div>
    
    <div class="grid">
        <div id="change-pin" class="col">
            <p>If need assistance updating any other account information, such as email, please submit a request through our <a href="/contact">contact form</a>.</p>
        </div>
    </div>
    
    <div class="grid">
        <div class="col text-right">
            <a href="" class="close-myaccount"><i class="fas fa-times"></i></a>
        </div>
    </div>
</form>
</article>
END;

return($html);

?>
