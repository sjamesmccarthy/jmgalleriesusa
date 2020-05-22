 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* CATALOG INDEX */
    $this->nav_label_catalog = "dev: Update Site Settings";
    $navigation_html = $this->component('admin_navigation');

    /* Get any notifications of errors */
    if($_SESSION['error'] == "200") {
        $notification_state = "show";
        $notification_msg = "<p class='heading'>success</p><p>" .  $_SESSION['notify_msg'] . " Has Been Updated</p>";
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    }

    /* CORE - LIST OF SETTINGS IN config.json */
    $data_html = $this->getJSON('config.json', 'data_config');
    $code_block = $data_html;

    extract($data_html, EXTR_PREFIX_SAME, "dup");

    /* Get Available Sizes */
    // $tv_price_array = json_decode($this->config->tv_pricing, true);
    // $available_sizes_open = null;
    // $tv_prices_count = count($tv_price_array);

    // {"5x7":"20","8x8":"40","8x12":"60","12x12":"80","12x18":"120","5x7NC": "30"}
    // $i=1;
    // foreach($tv_price_array as $key_size => $val_price) {
    //     if ($i != 1) {
    //         $comma = ', ';
    //     } 
    //     if ($i == ($tv_prices_count - 1) ) {
    //         $comma = " & ";
    //     }
    //     $available_sizes_open .= $comma . $key_size;
    //     $i++;
    // }

    /* CORE - LIST OF NOTICES IN data_notices.json */
    $notices_json = $this->getJSON('view/data_notices.json', 'data_notices');
    extract($notices_json, EXTR_PREFIX_SAME, "dup");

    // Loop through notices
   foreach($notices_json as $k => $v) {

        $notices_html .= '
            <div class="divTableRow">
            <input type="hidden" name="notice_data[]" value="' . $k . '" />
                <div class="divTableCell pb-32"><p class="pb-8">-- ' . $k . '</p>
                <!-- <div class="divTableCell"> -->
                    title<br />
                    <input class="w-100" type="text" name="notice_key_title[]" value="' . $v['title'] . '" /><br />
                    content<br />
                    <input class="w-100" type="text" name="notice_key_content[]" value="' . $v['content'] . '" /><br />
                    type<br />
                    <input class="w-100" type="text" name="notice_key_type[]" value="' . $v['type'] . '" /><br />
                    timeout<br />
                    <input class="w-100" type="text" name="notice_key_timeout[]" value="' . $v['timeout'] . '" /><br />
                    state<br />
                    <input class="w-100" type="text" name="notice_key_state[]" value="' . $v['state'] . '" />
                </div>
            </div>';    
    }


?>