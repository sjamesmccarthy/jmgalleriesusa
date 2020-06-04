<section class="settingsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 settings--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>
               
               <div class="grid admin-header">
                   <div class="col pb-0">
                    <h2><?= $this->page->title ?></h2>
                        <div class="tabs"> 
                            <div><b>ABOUT</b></div>
                            <div><a href="#system">SYSTEM</a></div>
                            <div><a href="#components">COMPONENTS</a></div>
                            <div><a href="#notices">NOTICES</a></div>
                            <div><a href="#promos">PROMO-CODES</a></div>
                            <div><a href="#session">SESSION</a></div>
                            <div><a id="show-code" href="#">&lt;/&gt;</a></div>
                        </div>
                    </div>
                </div>
                
                <div class="code-block">
                    <?php $this->printp_r($code_block); ?>
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
                        <div class="divTableRow">
                            <div class="divTableCell">available_sizes_limited (label for Filmstrip only)</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="available_sizes_limited" value="<?= $available_sizes_limited ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">edition_description_limited (label for Filmstrip &Details)</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="edition_description_limited" value="<?= $edition_description_limited ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">available_sizes_open (label for Filmstrip only)</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="available_sizes_open" value="<?= $available_sizes_open ?>" />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">edition_description_open (label for Filmstrip &Details)</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="edition_description_open" value="<?= $edition_description_open ?>" />
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
                                    <div class="divTableCell"><a id="getTS" href="#">package_version</a> -- <span class="small"> Build : </span> <span id="ts" class="small"></span></div>
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
                    <a name="promos"></a><h4>Promo Codes</h4>

                    <div class="divTable w-100 mt-32 pb-32">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-50"></div>
                             <div class="divTableCell thead pl-8"></div>
                        </div>

                       <div class="divTableRow">
                            <div class="divTableCell">seasonal</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="promo_seasonal" value="<?= $promo_seasonal ?>"  />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">holiday</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="promo_holiday" value="<?= $promo_holiday ?>"  />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">generic</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="promo_generic" value="<?= $promo_generic ?>"  />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">collector</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="promo_collector" value="<?= $promo_collector ?>"  />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">special</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="promo_special" value='<?= $promo_special ?>'  />
                            </div>
                        </div>

                       <div class="divTableRow">
                            <div class="divTableCell">le_pricing</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="le_pricing" value='<?= $le_pricing ?>' />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">le_frames_pricing</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="le_frames_pricing" value='<?= $le_frames_pricing ?>'  />
                            </div>
                        </div>

                       <div class="divTableRow">
                            <div class="divTableCell">tv_pricing</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="tv_pricing" value='<?= $tv_pricing ?>' />
                            </div>
                        </div>
                       <div class="divTableRow">
                            <div class="divTableCell">studio_frames_pricing</div>
                            <div class="divTableCell">
                                 <input class="w-100" type="text" name="studio_frames_pricing" value='<?= $studio_frames_pricing ?>'  />
                            </div>
                        </div>
                                
                    </div>

                </div>

                 <div class="grid" id="tab-promos">
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

                <div class="grid pt-32 nopad-left" id="tab-session">
                  <button id="sendform">UPDATE SETTINGS</button>
                </div>
                </form>

        </div>
    </div>

   
</section>

<script>
jQuery(document).ready(function($){

    $('#show-code').on("click", function(e) {
        e.preventDefault();
        $('.code-block').toggle();
    });

    $('#getTS').on("click", function(e) {
       e.preventDefault();
       let ts = Date.now();
        $('#ts').html( ts );
    });

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