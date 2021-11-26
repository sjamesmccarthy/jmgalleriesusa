<a name="top"></a>
<section class="settingsidx--container admin--settingsidx">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>

        <div class="col settings--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>
               
               <div class="grid admin-header">
                   <div class="col pb-0">
                    <h2><?= $this->page->title ?></h2>
                    <p class="close-x"><i class="fas fa-times-circle"></i></p>

                        <div class="tabs"> 
                            <div data-name="ABOUT" class="tab-menu tab-ABOUT active"><a href="#about">ABOUT</a></div>
                            <div data-name="PROMOCODES" class="tab-menu tab-PROMOCODES"><a href="#pricing">Editions, Pricing & PROMOS</a></div>
                            <div data-name="NOTICES" class="tab-menu tab-NOTICES"><a href="#notices">NOTICES</a></div>
                            <div data-name="SYSTEM" class="tab-menu tab-SYSTEM"><a href="#system">SYSTEM</a></div>
                            <!-- <div data-name="COMPONENTS" class="tab-menu tab-COMPONENTS"><a href="#components">COMPONENTS</a></div> -->
                           <!--  <div data-name="SESSION" class="tab-menu tab-SESSION"><a href="#session">SESSION</a></div> -->
                            <div data-name="CODE" class="tab-menu tab-CODE"><a id="show-code" href="#">&lt;/&gt;</a></div>
                            <!-- <div><p id="sendform" class="btn_small">UPDATE SETTINGS</p></div> -->
                        </div>
                    </div>
                </div>
                
                <div class="code-block">
                    <pre>
                    <?php print_r($code_block); ?>
                    <hr />
                    <?php print_r($notices_json); ?>
                    </pre>
                </div>

                <form id="settings-upd" action="/studio/api/update/settings" method="POST" enctype="multipart/form-data">

                <div class="grid" id="tab-about">
                    
                    <div class="col-12">
                        <label>site name</label>
                        <input class="half-size" type="text" name="site_name" value="<?= $site_name ?>" />
                        <label>email</label>
                        <input class="half-size" type="text" name="email" value="<?= $email ?>" />
                    </div>
                
                    <div class="col-12">
                        <label>phone</label>
                         <input class="half-size" type="text" name="phone" value="<?= $phone ?>" />
                         <label>copyright statement</label>
                         <input class="half-size" type="text" name="copyright" value="<?= $copyright ?>" />
                    </div>
                    
                </div>
                
                <div class="grid" id="tab-pricing">
                    
                    <div class="col-12 pb-16">
                        <a name="pricing" href="#top"><h4>Edition Data</h4></a>
                    </div>
                    
                    <div class="col-12">
                            <label>coa contract</label>
                            <input class="half-size" type="hidden" name="coa_contract" value="<?= $coa_contract ?>"  />
                            <input class="half-size" type="text" name="coa_contract" value="<?= $coa_contract ?>" disabled />
                    </div>
                    
                    <div class="col-12">
                            <label>Edition Types</label>
                            <input class="half-size" type="hidden" name="edition_types" value="<?= $edition_types ?>"  />
                            <input class="half-size" type="text" name="edition_types" value='<?= $edition_types ?>' />
                            <label>limited edition max (legacy)</label>
                            <input class="half-size" type="hidden" name="limited_edition_max" value="<?= $limited_edition_max ?>" />
                            <input class="half-size" type="text" name="limited_edition_max" value="<?= $limited_edition_max ?>" disabled />
                    </div>
                        
                    <div class="col-12 pb-16">
                        <a name="pricing" href="#top"><h4>Pricing - Limited Editions (Acrylic/Metal)</h4></a>
                    </div>
                    
                    <div class="col-12">
                        <label>limited edition label</label>
                        <input class="half-size" type="text" name="edition_description_limited" value="<?= $edition_description_limited ?>" />
                        <label>limited edition sizes label (used in details)</label>
                        <input class="half-size" type="text" name="available_sizes_limited" value="<?= $available_sizes_limited ?>" />
                    </div>
                    
                    <div class="col-12">
                        <label>pricing - limited edition (acrylic)</label>
                        <input class="w-100" type="text" name="le_pricing" value='<?= $le_pricing ?>' />
                    </div>
                    
                    <div class="col-12">
                        <label>pricing - limited edition (metal)</label>
                        <input class="w-100" type="text" name="le_pricing_metal" value='<?= $le_pricing_metal ?>' />
                    </div>
                    
                    <div class="col-12">
                        <label>pricing - limited edition framing</label>
                        <input class="w-100" type="text" name="le_frames_pricing" value='<?= $le_frames_pricing ?>'  />
                    </div>
                    
                    <div class="col-12 pb-16">
                            <h4>Pricing - Open Editions (Paper)</h4>
                        </div>
                        
                    <div class="col-12">
                        <label>open edition label (paper)</label>
                        <input class="half-size" type="text" name="edition_description_open" value="<?= $edition_description_open ?>" />
                        <label>open edition sizes label (used in details)</label>
                        <input class="half-size" type="text" name="available_sizes_open" value="<?= $available_sizes_open ?>" />
                    </div>
                    
                    <div class="col-12">
                        <label>pricing - open edition</label>
                        <input class="w-100" type="text" name="tv_pricing" value='<?= $tv_pricing ?>' />
                    </div>
                    
                    <div class="col-12">
                        <label>pricing - open edition framing</label>
                        <input class="w-100" type="text" name="studio_frames_pricing" value='<?= $studio_frames_pricing ?>'  />
                    </div>
                    
                    <div class="col-12 pb-16">
                        <h4>Promotions</h4>
                    </div>
                    
                    <div class="col-12">
                        <label>promo - seasonal</label>
                        <input class="half-size" type="text" name="promo_seasonal" value="<?= $promo_seasonal ?>"  />
                        <label>promo - holiday</label>
                        <input class="half-size" type="text" name="promo_holiday" value="<?= $promo_holiday ?>"  />
                    </div>
                    
                    <div class="col-12">
                        <label>promo - generic</label>
                        <input class="half-size" type="text" name="promo_generic" value="<?= $promo_generic ?>"  />
                        <label>promo - collector</label>
                        <input class="half-size" type="text" name="promo_collector" value="<?= $promo_collector ?>"  />
                    </div>
                    
                    <div class="col-12">
                        <label>promo - special</label>
                         <input class="half-size" type="text" name="promo_special" value='<?= $promo_special ?>'  />
                    </div>
                </div>
                
                <div class="grid">
                            <div class="col">
                                <h4 class="toggle-notices">Notices -toggle</h4>
                            </div>
                            
                            <div class="col right">
                                <a name="notices" href="#top"><i class="fas fa-arrow-circle-up"></i></a> 
                            </div>
                </div>
                    
                <div class="grid" id="tab-notices">
                    
                    <!-- <div class="col">
                        <h4>Notices</h4>
                    </div> -->

                   <!--  <div class="col right">
                        <a name="notices" href="#top"><i class="fas fa-arrow-circle-up"></i></a> 
                    </div> -->

                    <div class="col-12">
                        <p class="small">file://view/data_notices.json</p>
                        <p class="small">NOTE: To ENABLE notices, you will need to <u>set component_notice_type_ACTIVE</u> to the name of the notice TYPE.</p>
                    </div>

                    <div class="divTable w-100">

                        <div class="divTableBody">
                             <div class="divTableCell thead w-100"></div>
                        </div>

                        <?= $notices_html ?>
                        
                        <div class="col-12">
                            <label>component_notice: set false or name of NOTICE_TYPE</label>
                            <input class="half-size" type="text" name="component_notice" value="<?= $component_notice ?>"  />
                        </div>

                    </div>
                </div>
        
            <div class="grid">
                    <div class="col">
                        <h4 class="toggle-system">System -toggle</h4>
                    </div>
                    
                    <div class="col right">
                        <a name="system" href="#top"><i class="fas fa-arrow-circle-up"></i></a> 
                    </div>
            </div>
            
        <div class="section-system">
                <div class="grid" id="tab-system">

                   <!--  <div class="col">
                        <h4>System</h4>
                    </div> -->

           
                            <div class="divTable w-100 mt-32 pb-32">
                               
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">package_name</div> -->
                                    <div class="divTableCell">
                                        <label>package name</label>
                                        <input class="w-100" type="text" name="package_name" value="<?= $package_name ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell"><a id="getTS" href="#">package_version</a> -- <span class="small"> Build : </span> <span id="ts" class="small"></span></div> -->
                                    <div class="divTableCell">
                                        <label>package version</label>
                                         <input class="w-100" type="text" name="package_version" value="<?= $package_version ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">package_release_notes</div> -->
                                    <div class="divTableCell">
                                        <label>package release notes</label>
                                         <input class="w-100" type="text" name="package_release_notes" value="<?= $package_release_notes ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">package_git</div> -->
                                    <div class="divTableCell">
                                        <label>package git</label>
                                         <input class="w-100" type="text" name="package_git" value="<?= $package_git ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                   <!--  <div class="divTableCell">package_license</div> -->
                                    <div class="divTableCell">
                                        <label>package license</label>
                                         <input class="w-100" type="text" name="package_license" value="<?= $package_license ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">package_blacklist</div> -->
                                    <div class="divTableCell">
                                        <label>package blacklist</label>
                                         <input class="w-100" type="text" name="package_blacklist" value="<?= $package_blacklist ?>" />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">prefix_template</div> -->
                                    <div class="divTableCell">
                                        <label>prefix templates</label>
                                         <input class="w-100" type="hidden" name="prefix_template" value="tpl_" />
                                         <input class="w-100" type="text" name="prefix_template" value="tpl_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">prefix_page</div> -->
                                    <div class="divTableCell">
                                        <label>prefix pages</label>
                                         <input class="w-100" type="hidden" name="prefix_page" value="view_" />
                                         <input class="w-100" type="text" name="prefix_page" value="view_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">prefix_negatives</div> -->
                                    <div class="divTableCell">
                                        <label>prefix negatives (no longer used)</label>
                                         <input class="w-100" type="hidden" name="prefix_negatives" value="_catidx" disabled />
                                         <input class="w-100" type="text" name="prefix_negatives" value="_catidx" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                    <!-- <div class="divTableCell">prefix_partial</div> -->
                                    <div class="divTableCell">
                                        <label>prefix partial</label>
                                         <input class="w-100" type="hidden" name="prefix_partial" value="partial_"  />
                                         <input class="w-100" type="text" name="prefix_partial" value="partial_" disabled />
                                    </div>
                                </div>
                                <div class="divTableRow">
                                   <!--  <div class="divTableCell">prefix_component</div> -->
                                    <div class="divTableCell">
                                        <label>prefix component</label>
                                         <input class="w-100" type="hidden" name="prefix_component" value="component_" />
                                         <input class="w-100" type="text" name="prefix_component" value="component_" disabled />
                                    </div>
                                </div>
                            </div>
                </div>

                 <div class="grid" id="tab-components">

                    <div class="col">
                        <h4>Components</h4>
                    </div>

                    <div class="col right">
                        <a name="components" href="#top"><i class="fas fa-arrow-circle-up"></i></a> 
                    </div>

                    <div class="divTable w-100 mt-32 pb-32">

                       <div class="divTableRow">
                            <!-- <div class="divTableCell">component_polarized</div> -->
                            <div class="divTableCell">
                                <label>component_polarized</label>
                                 <input class="w-100" type="text" name="component_polarized" value="<?= $component_polarized ?>"  disabled />
                                 <input class="w-100" type="hidden" name="component_polarized" value="<?= $component_polarized ?>" />
                            </div>
                        </div>

                       <div class="divTableRow">
                            <!-- <div class="divTableCell">component_newsletter</div> -->
                            <div class="divTableCell">
                                <label>component_newsletter</label>
                                 <input class="w-100" type="text" name="component_newsletter" value="<?= $component_newsletter ?>"  disabled />
                                 <input class="w-100" type="hidden" name="component_newsletter" value="<?= $component_newsletter ?>" />
                            </div>
                        </div>
                                
                    </div>

                </div>


                <div class="grid" id="tab-session">

                    <div class="col">
                        <h4>Session</h4>
                    </div>

                    <div class="col right">
                        <a name="session" href="#top"><i class="fas fa-arrow-circle-up"></i></a> 
                    </div>

                    <div class="divTable w-100 pb-32">

                        <!-- <div class="divTableRow">
                            <div class="divTableCell">session.auto_start</div>
                            <div class="divTableCell">
                                <input class="w-100" type="hidden" name="session_auto_start" value="Off" />
                                <input class="w-100" type="text" name="session_auto_start" value="Off" disabled />
                            </div>
                        </div> -->
                        <div class="divTableRow">
                            <!-- <div class="divTableCell">session.save_path</div> -->
                            <div class="divTableCell">
                                <label>session.save_path</label>
                                <input class="w-100" type="hidden" name="session_save_path" value="<?= $session_save_path ?>" />
                                <input class="w-100" type="text" name="session_save_path" value="<?= $session_save_path ?>" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <!-- <div class="divTableCell">session.cookie_lifetime</div> -->
                            <div class="divTableCell">
                                <label>session.cookie_lifetime</label>
                                <input class="w-100" type="hidden" name="session_cookie_lifetime" value="<?= $session_cookie_lifetime ?>" />
                                <input class="w-100" type="text" name="session_cookie_lifetime" value="<?= $session_cookie_lifetime ?>" disabled />
                            </div>
                        </div>
                        <div class="divTableRow">
                            <!-- <div class="divTableCell">session.gc_maxlifetime</div> -->
                            <div class="divTableCell">
                                <label>session.gc_maxlifetime</label>
                                 <input class="w-100" type="hidden" name="session_gc_maxlifetime" value="<?= $session_gc_maxlifetime ?>" />
                                 <input class="w-100" type="text" name="session_gc_maxlifetime" value="<?= $session_gc_maxlifetime ?>" disabled/>
                            </div>
                        </div>
                        <div class="divTableRow">
                            <!-- <div class="divTableCell">session.cache_expire</div> -->
                            <div class="divTableCell">
                                <label>session.cache_expire</label>
                                 <input class="w-100" type="hidden" name="session_cache_expire" value="<?= $session_cache_expire ?>" />
                                 <input class="w-100" type="text" name="session_cache_expire" value="<?= $session_cache_expire ?>" disabled/>
                            </div>
                        </div>
                                
                    </div>

                </div>

            </div><!-- section-system-->
                
                <div class="grid pt-32 nopad-left" id="tab-session">
                  <button id="sendform">UPDATE SETTINGS</button>
                </div>
                </form>

        </div>
    </div>
   
</section>

<script>
jQuery(document).ready(function($){

    $('.close-x').on("click", function() {
        window.location.href = '/studio/manage';
    });

    $('.tab-menu').on("click", function() {
        $('.tab-menu').removeClass("active");
        $('.tab-' + $(this).attr("data-name") ).addClass('active');
        console.log('changing tab active: ' + '.tab-' + $(this).attr("data-name"));
    });

    $('#show-code').on("click", function(e) {
        console.log('show-code(toggle)');
        e.preventDefault();
        $('.code-block').toggle();
    });
    
    $('.toggle-system').on("click", function(e) {
        console.log('show-system(toggle)');
        e.preventDefault();
        $('.section-system').toggle();
    });
    
    $('.toggle-notices').on("click", function(e) {
        console.log('show-notices(toggle)');
        e.preventDefault();
        $('#tab-notices').toggle();
    });

    $('#getTS').on("click", function(e) {
       e.preventDefault();
       let ts = Date.now();
        $('#ts').html( ts );
    });

    $('#sendform').on("click", function() {
        console.log('#sendform.clicked()');
        // $(":input[required]").each(function () {   
            // console.log('checking input fields');                  
            // var myForm = $('#settings-upd');
            // if (!$myForm[0].checkValidity()) 
            //   {                
                $('#settings-upd').submit();             
            //   } 
        // });
    });
});
</script>