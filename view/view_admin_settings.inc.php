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

    extract( (array)$this->config, EXTR_PREFIX_SAME, "dup");
    $code_block = (array) $this->config;

    /* CORE - LIST OF NOTICES IN data_notices.json */
    $notices_json = $this->getJSON('view/data_notices.json', 'data_notices');
    extract($notices_json, EXTR_PREFIX_SAME, "dup");

    // Loop through notices
   foreach($notices_json as $k => $v) {

        $notices_html .= '
            <div class="divTableRow">
            <input type="hidden" name="notice_data[]" value="' . $k . '" />
                <div class="divTableCell pb-32">
                    
                    <div class="col-12">' . $k . ' NOTICE</div>
                    
                    <div class="col-12">
                    <label>title</label>
                    <input class="w-100" type="text" name="notice_key_title[]" value="' . $v['title'] . '" />
                    </div>
                    
                    <div class="col-12">
                    <label>message</label>
                    <input class="w-100" type="text" name="notice_key_content[]" value="' . $v['content'] . '" />
                    </div>
                                       
                   <div class="col-12">
                    <label>state</label>
                    <input class="half-size" type="text" name="notice_key_state[]" value="' . $v['state'] . '" />
                    <label>timeout</label>
                    <input class="half-size" type="text" name="notice_key_timeout[]" value="' . $v['timeout'] . '" />
                   </div>
                    
                   <div class="col-12">
                    <label>background-color</label>
                    <input class="half-size" type="text" name="notice_key_type[]" value="' . $v['type'] . '" />
                    <label>font-color</label>
                    <input class="half-size" type="text" name="notice_key_color[]" value="' . $v['color'] . '" />
                   </div>
                    
                </div>
            </div>';    
    }


?>