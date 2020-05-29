<?php

/* Logic */

if ($_REQUEST['note'] != 'false') {
    $html = <<<END

    <article class="note-from-artist">
            <p>
                Hello {$this->collector_data_obj->first_name} {$this->collector_data_obj->last_name},<br /><br />Thank you for being a collector of j.McCarthy Fine Art. I am grateful for your support and continued loyalty, and hope that you have found the perfect place in your home or office for your fine art purchase.<br /><br />This collector portal is where you can easily manage your collection, earn rewards for referring family and friends and discover some amazing offers and new Limited Edition releases that I have curated just for my collectors. If you have any questions about your artwork or would like to inquire about new artwork, please <a href="/contact">contact</a> me.
           </p>

           <p style="text-align: right">Cheers, <br /><img src="/view/image/signature_full-web.png"></p>

            <div id="note-close" style=""><span class="label">THANKS! <i class="fas fa-times-circle"></i></span> </div>
    </article>
    END;
} else {
    $html = null;
}

return($html);

?>