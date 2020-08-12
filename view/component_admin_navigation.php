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
            <li class="' . $v_apps['short_code'] . ' ' . $v_apps['short_code'] . '-add"><a href="/studio/' . $v_apps['short_code'] . '">'. $v_apps['title'] . '</a>';
            
    if($v_apps['add_new'] == 1) {
        $nav_html .= '
                <p class="add-icon-nav"><a href="/studio/' . $v_apps['short_code'] . '-add"><i class="fas fa-plus-circle"></i></a></p>
        ';
    }

    $nav_html .= '
            </li>            
            </ul>
        </div>';

}

if(is_null($this->nav_label)) { $this->nav_label = "Adding Photo"; }

/* GENERATE HTML BLOCK */
$html = <<< END
<div>
    <p class="menu-icon"><i class="fas fa-theater-masks"></i></p>
</div>

<div class="col-3 navigation--container">
            
            <div class="toolbox mb-32">
            
            <div class="profile--image">
            <img src="/view/image/avatar/$avatar" />
            </div>
            
            <div class="profile--name border--bottom">
            <p>$first_name $last_name</p>
            <p><a href="$website" target="_out">$website</a></p>
            <!-- <p style="font-size: .9rem;">Member since $membersinceyear</p> -->
            <p class="mt-16"><a href="/studio/manage">DASHBOARD</a></p>
            </div>
            
            <!-- <p class="dashboard-icon"><a href="/studio/manage"><i class="fas fa-chart-line"></i></a></p> -->
            </div>

            <!-- <div class="toolbox">
                <ul class="catalog catalog-add">
                <li class="catalog catalog-add"><a href="/studio/catalog">Web Catalog</a><p class="add-icon-nav"><a href="/studio/catalog-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="collections collections-add">
                <li class="collections collections-add"><a href="/studio/collections">Web Collections</a><p class="add-icon-nav"><a href="/studio/collections-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="inventory inventory-add">
                <li class="inventory inventory-add"><a href="/studio/inventory">Inventory</a><p class="add-icon-nav"><a href="/studio/inventory-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="suppliers suppliers-add"> 
                <li class="suppliers suppliers-add"><a href="/studio/suppliers">Suppliers</a> <p class=" add-icon-nav"><a href="/studio/suppliers-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="materials materials-add">
                <li class="materials materials-add"><a href="/studio/materials">Materials Summary</a> <p class=" add-icon-nav"><a class="" href="/studio/materials-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="reports reports-add">
                <li class="reports reports-add"><a href="/studio/reports">Reports / SQL Marks</a> <p class=" add-icon-nav"><a class="" href="/studio/reports-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="collectors collectors-add">
                <li class="collectors collectors-add"><a href="/studio/collectors">Collector Profiler</a><p class="add-icon-nav"><a href="/studio/collectors-add"><i class="fas fa-plus-circle"></i></a></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="orders orders-add">
                <li class="orders orders-add"><a href="/studio/orders">Orders</a><p class="add-icon-nav"><i class="fas fa-lock disabled"></i></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="users users-add">
                <li class="users users-add"><a href="/studio/users">User Management</a><p class="add-icon-nav"><i class="fas fa-lock disabled"></i></p></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul class="settings settings-add">
                <li class="settings settings-add"><a href="/studio/settings">Settings</a><p class="tiny">$version</p><p class="add-icon-nav"><i class="fas fa-lock disabled"></i></p></li>
                </ul>
            </div> 

            <hr /> -->

            $nav_html

            <div class="toolbox">
                <ul>
                <li><a href="/studio/signout">Sign Out</a></li>
                </ul>
            </div>

            <!-- <div>
                <p class="tiny">$version</p>
            </div> -->
            
            </div>

        <!-- <div class="col-1"></div> -->


<script>
jQuery(document).ready(function($){

    $('ul li.$path').addClass('selected-item');
    $('ul.$path').addClass('selected');

    $('.menu-icon').on("click",function(e) {
        console.log('menu-icon.click');
        $('.navigation--container').toggle();

        if( $('.navigation--container').is(':visible') ) { 
            $('.menu-icon').removeClass('menu-icon--active');
        } else {
            $('.menu-icon').addClass('menu-icon--active');
        }

    });

});
</script>

END;

return($html);

?>