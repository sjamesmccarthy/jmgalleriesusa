<section class="settings--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 settings--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>
               
                <div class="grid">
                    <div class="col"><h2>Settings</h2></div>
                </div>
                
                <div class="tabs"> 
                    <div><b>ABOUT</b></div>
                    <div><a href="#system">SYSTEM</a></div>
                    <div><a href="#components">COMPONENTS</a></div>
                    <div><a href="#notices">NOTICES</a></div>
                    <div><a href="#session">SESSION</a></div>
                </div>

                <form id="settings-upd" action="/studio/api/update/settings" method="POST" enctype="multipart/form-data">

                <div class="grid" id="tab-about">
                     <div class="divTable w-100 mt-32 pb-32">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-50"></div>
                             <div class="divTableCell thead pl-8"></div>
                        </div>

                        <div class="divTableRow">
                            <div class="divTableCell">site_name</div>
                            <div class="divTableCell">
                                <input class="w-100" type="text" name="site_name" value="<?= $site_name ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">email</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="email" value="<?= $email ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">phone</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="phone" value="<?= $phone ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">copyright</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="copyright" value="<?= $copyright ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">coa_contract</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="coa_contract" value="<?= $coa_contract ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">limited_edition_max</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="limited_edition_max" value="<?= $limited_edition_max ?>" />
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
                                        <input class="w-100" type="text" name="package_name" value="<?= $package_name ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_version</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="package_version" value="<?= $package_version ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_release_notes</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="package_release_notes" value="<?= $package_release_notes ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_git</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="package_git" value="<?= $package_git ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_license</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="package_license" value="<?= $package_license ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">package_blacklist</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="text" name="package_blacklist" value="<?= $package_blacklist ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_template</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="hidden" name="prefix_template" value="tpl_" />
                                         <input class="w-100" type="text" name="prefix_template" value="tpl_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_page</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="hidden" name="prefix_page" value="view_" />
                                         <input class="w-100" type="text" name="prefix_page" value="view_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_negatives</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="hidden" name="prefix_negatives" value="_catidx" />
                                         <input class="w-100" type="text" name="prefix_negatives" value="_catidx" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_partial</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="hidden" name="prefix_partial" value="partial_"  />
                                         <input class="w-100" type="text" name="prefix_partial" value="partial_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell">prefix_component</div>
                                    <div class="divTableCell">
                                         <input class="w-100" type="hidden" name="prefix_component" value="component_" />
                                         <input class="w-100" type="text" name="prefix_component" value="component_" disabled />
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

                       <div class="divTableRow">
                            <div class="divTableCell">component_polarized</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="component_polarized" value="<?= $component_polarized ?>"  />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">component_notice</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="component_notice" value="<?= $component_notice ?>"  />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">component_newsletter</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="component_newsletter" value="<?= $component_newsletter ?>"  />
                            </div>
                        </div>
                                
                    </div>

                </div>

                <div class="grid" id="tab-notices">
                    <div class="col-12">
                        <a name="notices"></a><h4>Notices</h4>
                        <p class="small">file://view/data_notices.json</p>
                    </div>

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
                        <p class="small"> file://.user.ini file on server</p>
                    </div>

                    <div class="divTable w-100 pb-32">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-50"></div>
                             <div class="divTableCell thead pl-8"></div>
                        </div>

                        <div class="divTableRow">
                            <div class="divTableCell">session.auto_start</div>
                            <div class="divTableCell">
                                <input class="w-100" type="hidden" name="session_auto_start" value="Off" />
                                <input class="w-100" type="text" name="session_auto_start" value="Off" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.save_path</div>
                            <div class="divTableCell">
                                <input class="w-100" type="hidden" name="session_save_path" value="/home2/jmgalleries/public_html/.sessions" />
                                <input class="w-100" type="text" name="session_save_path" value="/home2/jmgalleries/public_html/.sessions" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.cookie_lifetime</div>
                            <div class="divTableCell">
                                <input class="w-100" type="hidden" name="session_cookie_lifetime" value="86400" />
                                <input class="w-100" type="text" name="session_cookie_lifetime" value="86400" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.gc_maxlifetime</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="hidden" name="session_gc_maxlifetime" value="86400" />
                                 <input class="w-100" type="text" name="session_gc_maxlifetime" value="86400" disabled/>
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">session.cache_expire</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="hidden" name="session_cache_expire" value="180" />
                                 <input class="w-100" type="text" name="session_cache_expire" value="180" disabled/>
                            </div>
                        </div>
                                
                    </div>

                </div>

                <div class="grid pt-32" id="tab-session">
                  <button id="sendform">UPDATE SETTINGS</button>
                </div>
                </form>

        </div>
    </div>

   
</section>

<script>
jQuery(document).ready(function($){
    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#settings-add');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#settings-upd').submit();             
          } 
        });
    });
});
</script>