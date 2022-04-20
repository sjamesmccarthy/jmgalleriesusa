<?php
/*
component: admin/navigation
description: returns the neavigation side menu
css: component_admin_navigation.scss
data: db
created: jmccarthy
date: 11/28/19
version: 1
*/

/* Localize session [data] JSON */
$loginInfo = json_decode( $_SESSION['data'], true );
extract($loginInfo, EXTR_PREFIX_SAME, "dup");

/* Alot of work to just get the year */
$shortdate = explode("-", $membersince);
$membersinceyear = $shortdate[0];
$version = $this->config->package_version;

/* Logic for determining location */
// $this->routes->URI->path /studio/catalog, $path[2]
$path = explode('/', $this->routes->URI->path);
$path = $path[2];

/* Fetch list of apps by user */
$apps_list = $this->api_Admin_Get_Nav_AppsByUser($user_id);
// $this->printp_r($apps_list);

foreach ($apps_list as $k_aps => $v_apps) {
    $nav_html .= '
        <div class="toolbox">
            <ul class="' . $v_apps['short_code'] . ' ' . $v_apps['short_code'] . '-add">
            <li class="' . $v_apps['short_code'] . ' ' . $v_apps['short_code'] . '-add"><p class="nav-icons">' . $v_apps['icon'] . '</p> <a style="margin-left: 1rem;" href="/studio/' . $v_apps['short_code'] . '">'. $v_apps['title'] . '</a>';

    // if($v_apps['add_new'] == 1) {
    //     $nav_html .= '
    //             <p class="add-icon-nav"><a href="/studio/' . $v_apps['short_code'] . '-add"><i class="fas fa-plus-circle"></i></a></p>
    //     ';
    // }

    $nav_html .= '
            </li>
            </ul>
        </div>';

}

if(is_null($this->nav_label)) { $this->nav_label = "Adding Photo"; }

/* GENERATE HTML BLOCK */
$html = <<< END

<div class="menu-icon--container">
    <i class="menu-icon fas fa-chevron-circle-left"></i>
</div>

<div class="col-3 navigation--container">

            <div class="toolbox">

            <div class="profile--image">
                <img src="/view/image/$avatar" alt="avatar" />
            </div>

            <div class="profile--name">
            <p>$first_name $last_name</p>
            <p><a href="$website" target="_out">$website</a></p>
            <!-- <p style="font-size: .9rem;">Member since $membersinceyear</p> -->
            <!-- <p class="mt-16"><a href="/studio/manage">DASHBOARD</a></p> -->
            </div>

            </div>

            $nav_html

            <!-- <div class="toolbox">
                <ul>
                <li><p style="width:24px"><i class="fas fa-sign-out-alt"></i></p> <a style="margin-left: 1rem;" href="/studio/signout">Sign Out</a></li>
                </ul>
            </div> -->

            <!-- <div>
                <p class="tiny text-right">$version</p>
            </div> -->

            </div>

        <!-- <div class="col-1"></div> -->


<script>
jQuery(document).ready(function($){

    if(getCookie('aN') == "true") {
        console.log('getCookie(aN)' + getCookie('aN'));
        $('.navigation--container').toggle();
        $('.menu-icon').addClass('flip');
    }

    $('ul li.$path').addClass('selected-item');
    $('ul.$path').addClass('selected');

    $('.menu-icon').on("click",function(e) {
        console.log('menu-icon.click');
        $('.navigation--container').toggle();

        if( $('.navigation--container').is(':visible') ) {
            $('.menu-icon').removeClass('menu-icon--active');
            $('.menu-icon').removeClass('flip');
            setCookie('aN',"false",'30');
            console.log('cookie.Set(aN=false,30)');
        } else {
            $('.menu-icon').addClass('menu-icon--active');
            $('.menu-icon').addClass('flip');
            setCookie('aN',"true",'30');
            console.log('cookie.Set(aN=true,30)');
        }

    });

});
</script>

END;

return($html);

?>
