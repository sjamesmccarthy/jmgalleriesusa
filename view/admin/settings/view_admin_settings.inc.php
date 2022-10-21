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
    $notices_json = $this->getJSON('view/__data/data_notices.json', 'data_notices');
    extract($notices_json, EXTR_PREFIX_SAME, "dup");

    // Loop through notices
   foreach($notices_json as $k => $v) {

      $v['content'] = htmlentities(stripslashes($v['content']));
      $v['mobile_content'] = htmlentities(stripslashes($v['mobile_content']));

      // $this->console($v['content'],1);

        $notices_html .= '
            <div class="divTableRow">
            <input type="hidden" name="notice_data[]" value="' . $k . '" />
            <input class="w-100" type="hidden" name="notice_key_title[]" value="' . $v['title'] . '" />
            <input class="half-size" type="hidden" name="notice_key_state[]" value="' . $v['state'] . '" />

                <div class="divTableCell pb-32">

                    <!-- <div class="col-12"><b>' . $k . '</b> - </div> -->
                    <div class="col-12">
                      <label class="darker">NOTICE_TYPE</label>
                      <input class="half-size force-blue" type="text" name="notice_type" value="' . $k . '" disabled />
                      <label>pages to exclude (/shop,/about)</label>
                      <input class="half-size" type="text" name="notice_key_excludes[]" value="' . $v['excludes'] . '" />
                    </div>

                    <!-- <div class="col-12">
                    <label>title</label>
                    <input class="w-100" type="hidden" name="notice_key_title[]" value="' . $v['title'] . '" />
                    </div> -->

                    <div class="col-12">
                    <label>message</label>
                    <input class="w-100" type="text" name="notice_key_content[]" value="' . $v['content'] . '" />
                    </div>

                    <div class="col-12">
                    <label>mobile message</label>
                    <input class="half-size" type="text" name="notice_key_mobile_content[]" value="' . $v['mobile_content'] . '" />
                    <label>timeout (milliseconds 10000 = 1 second)</label>
                    <input class="half-size" type="text" name="notice_key_timeout[]" value="' . $v['timeout'] . '" />
                    </div>

                    <!-- <div class="col-12">
                    <label>state</label>
                    <input class="half-size" type="text" name="notice_key_state[]" value="' . $v['state'] . '" />
                    </div> -->

                   <div class="col-12">
                    <label>background-color</label>
                    <input class="half-size" type="text" name="notice_key_background_color[]" value="' . $v['background_color'] . '" />
                    <label>font-color</label>
                    <input class="half-size" type="text" name="notice_key_color[]" value="' . $v['color'] . '" />
                   </div>

                </div>
            </div>
            <div class="divider"></div>';
    }


?>
