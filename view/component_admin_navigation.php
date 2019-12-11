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

/* Logic for determing location */
// $this->routes->URI->path /studio/catalog, $path[2]
$path = explode('/', $this->routes->URI->path);
$path = $path[2];

if(is_null($this->nav_label)) { $this->nav_label = "Adding Photo"; }

/* GENERATE HTML BLOCK */
$html = <<< END
<script>
jQuery(document).ready(function($){

    $('ul li.$path').addClass('selected');
});
</script>

<div class="col-2 navigation--container">
            
            <div class="toolbox">
                <div class="profile--image">
                    <img src="/view/image/avatar/$avatar" />
                </div>
                
                <div class="profile--name">
                    <p>$first_name $last_name</p>
                    <p>$website</p>
                    <!-- <p style="font-size: .9rem;">Member since $year</p> -->
                </div>

            </div>

            <div class="toolbox">
                <ul>
                <li class="manage"><a href="/studio/manage">Studio Dashboard</a></li>
                <li class="catalog"><a href="/studio/catalog">Online Catalog Index</a></li>
                <li class="catalog-add"><a href="/studio/catalog-add">$this->nav_label_catalog</a></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li class="inventory"><a href="/studio/inventory">Inventory Index</a></li>
                <li class="inventory-add"><a href="/studio/inventory-add">$this->nav_label_inventory</a></li>
                <li class="disabled">Supplier Index <span class="add-inline">+Add</span></li>
                <li class="disabled">Materials Index  <span class="add-inline">+Add</span></li>
                <li class="disabled">r/Art, Costs, PL (everything)</li>
                <li class="disabled">r/Lookup Number & Edition</li>
                <li class="disabled">r/Lookup By Location</li>
                <li class="disabled">r/Damaged and Donated Summary</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Collector Index</li>
                <li>Add a Collector</li>
                <li class="disabled">Create Certificate of Authenticity</li>
                <li class="disabled">r/Find Collector By Name</li>
                <li class="disabled">r/Find Collectors By Photograph</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li class="disabled">My Collection Certificates</li>
                <li class="disabled">Contact Support</li>
                <li><a href="/studio/signout">Sign Out</a></li>
                </ul>
            </div>

        </div>

        <div class="col-1"></div>

END;

return($html);

?>