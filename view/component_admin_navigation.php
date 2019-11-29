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

/* GENERATE HTML BLOCK */
$html = <<< END
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
                <li class="dashboard selected">STUDIO DASHBOARD</li>
                <li><a href="/studio/catalog">Online Catalog Index</a></li>
                <li><a href="/studio/catalog#add">Add a Photo To Online Catalog</a></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Inventory Index</li>
                <li>Add a Photo To Inventory</li>
                <li>r/Art, Costs, PL (everything)</li>
                <li>r/Lookup Number & Edition</li>
                <li>r/Lookup By Location</li>
                <li>r/Damaged and Donated Summary</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Collector Index</li>
                <li>Add a Collector</li>
                <li>Create Certificate of Authenticity</li>
                <li>r/Find Collector By Name</li>
                <li>r/Find Collectors By Photograph</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>My Collection Certificates</li>
                <li>Contact Support</li>
                <li><a href="/studio/signout">Sign Out</a></li>
                </ul>
            </div>

        </div>

        <div class="col-1"></div>

END;

return($html);

?>