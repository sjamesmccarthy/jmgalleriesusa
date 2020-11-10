<?php 

    $tv_price_array = json_decode($this->config->tv_pricing, true);
    $studio_frames_pricing = json_decode($this->config->studio_frames_pricing, true);

    $le_price_array = json_decode($this->config->le_pricing, true);
    $le_frames_pricing = json_decode($this->config->le_frames_pricing, true);

    /* Build HTML for Limited Editions */
    foreach ($le_price_array as $leK => $leV) {
        $le_pricing_html .= '<div class="divTableRow">
        <div class="divTableCell"></div>
        <div class="divTableCell border-l border-b pl-8">' . $leK . '</div>
        <div class="divTableCell border-l border-b border-r pl-8 pr-8">$' . $leV .'</div>
        </div>';
    }

    /* Build HTML for Open/tinyVIEWS Editions */
    foreach ($tv_price_array as $sfK => $sfV) {

        // Split out the matted size
        $tvP= explode('|', $sfK);

        if($tvP[0] != '5x7NC') {
            $tv_pricing_html .= '<div class="divTableRow">
            <div class="divTableCell"></div>
            <div class="divTableCell border-l border-b pl-8">' . $tvP[0] . '</div>
            <div class="divTableCell border-l border-b border-r pl-8 pr-8">$' . $sfV .'</div>
            </div>';
        }

    }

    /* Build HTML for Limited Editions */
    foreach ($le_frames_pricing as $leK => $leV) {
        $le_frame_pricing_html .= '<div class="divTableRow">
        <div class="divTableCell"></div>
        <div class="divTableCell border-l border-b pl-8">' . $leK . '</div>
        <div class="divTableCell border-l border-b pl-8">2 3/4" Standard*</div>
        <div class="divTableCell border-l border-b border-r pl-8 pr-8">$' . $leV .'</div>
        </div>';
    }

    /* Build HTML for Open/tinyVIEWS Editions */
    foreach ($studio_frames_pricing as $sfK => $sfV) {

        $tv_frame_pricing_html .= '<div class="divTableRow">
        <div class="divTableCell"></div>
        <div class="divTableCell border-l border-b pl-8">' . $sfK . '</div>
        <div class="divTableCell border-l border-b border-r pl-8 pr-8">$' . $sfV .'</div>
        </div>';

    }


?>