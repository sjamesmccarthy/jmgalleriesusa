<section class="settings--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>
               
                <div class="grid">
                    <div class="col"><h2>Settings</h2></div>
                </div>
                
                <div class="tabs"> 
                    <!-- <div><a href="?filter=STUDIO">ABOUT</a></div> -->
                    <div><a href="#system">SYSTEM</a></div>
                    <div><a href="#components">COMPONENTS</a></div>
                    <div><a href="#notices">NOTICES</a></div>
                    <div><a href="#session">SESSION</a></div>
                </div>

                <div class="grid" id="tab-about">
                    <!-- <h4>About</h4> -->

                             <div class="divTable w-100 mt-32 pb-32">

                                <div class="divTableBody">
                                     <div class="divTableCell thead w-50"></div>
                                     <div class="divTableCell thead pl-8"></div>
                                </div>

                                <div class="divTableRow">
                                    <div class="divTableCell">site_name</div>
                                    <div class="divTableCell">
                                        <input class="w-100" type="text" name="package_name" value="<?= $site_name ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">email</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $email ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">phone</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $phone ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">copyright</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $copyright ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">coa_contract</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $coa_contract ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">limited_edition_max</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $limited_edition_max ?>" />
                                    </div>
                                </div>
                            </div>
                </div>

                <div class="grid" id="tab-system">
                    <a name="system"></a><h4>System</h4>

                            <div class="divTable w-100 mt-32 pb-32">
                                <div class="divTableBody">
                                     <div class="divTableCell thead w-50"></div>
                                     <div class="divTableCell thead pl-8"></div>
                                </div>
                               
                                <div class="divTableRow">
                                    <div class="divTableCell">package_name</div>
                                    <div class="divTableCell">
                                        <input class="w-100" type="text" name="pacakge_name" value="<?= $package_name ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_version</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $package_version ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_update_uri</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $package_update_uri ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_git</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $package_git ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_license</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $package_license ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_blacklist</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="<?= $package_blacklist ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_template</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="tpl_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_page</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="view_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_negatives</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="_catidx" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_partial</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="partial_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_component</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="pacakge_name" value="component_" disabled />
                                    </div>
                                </div>
                            </div>
                </div>

                <div class="grid" id="tab-components">
                    <a name="components"></a><h4>Components</h4>

                    <div class="divTable w-100 mt-32 pb-32">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-50"></div>
                             <div class="divTableCell thead pl-8"></div>
                        </div>

                        <?= $components_html ?>
                                
                    </div>

                </div>

                <div class="grid" id="tab-notices">
                    <a name="notices"></a><h4>Notices</h4>
                    <div class="divTable w-100 mt-32">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-100"></div>
                        </div>

                        <?= $notices_html ?>
                        
                    </div>
                </div>

                <div class="grid" id="tab-session">
                    <div class="col-12">
                        <a name="session"></a><h4>Session</h4>
                        <p> file://.user.ini file on server</p>
                    </div>

                    <div class="divTable w-100 pb-32">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-50"></div>
                             <div class="divTableCell thead pl-8"></div>
                        </div>

                        <div class="divTableRow">
                            <div class="divTableCell">session.auto_start</div>
                            <div class="divTableCell">
                                <input class="w-100" type="text" name="pacakge_name" value="Off" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.save_path</div>
                            <div class="divTableCell">
                                <input class="w-100" type="text" name="pacakge_name" value="/home2/jmgalleries/public_html/.sessions" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.cookie_lifetime</div>
                            <div class="divTableCell">
                                <input class="w-100" type="text" name="pacakge_name" value="86400" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.gc_maxlifetime</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="pacakge_name" value="86400" disabled/>
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.cache_expire</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="pacakge_name" value="180" disabled/>
                            </div>
                        </div>
                                
                    </div>

                </div>

                <div class="grid pt-32" id="tab-session">
                  <button>UPDATE SETTINGS</button>
                </div>

        </div>
    </div>

   
</section>

<script>
    jQuery(document).ready(function($){
       
        $('.notification').delay(5000).slideUp("slow").fadeOut(3000);

    });
</script>