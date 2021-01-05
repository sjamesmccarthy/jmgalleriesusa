
    if($i < $large_cards) {

        if ($value['type'] == "article" || $value['type'] == "video") {
            
            $card_html .= '
                <div class="col-6_sm-12 storycard--background" style="background: rgba(0,0,0,1) url(/view/image/fieldnotes/' . $value['image'] . ') no-repeat center; background-size: cover; word-break: break-word;">
                    <div class="content--preview" style="background-color: rgba(0,0,0,.4); height: 100%; min-height: 177px;">
                        <div style="padding: 2rem .1rem;">
                        <p class="--tag">' . strtoupper($value['type']) . '</p>
                        <h4 class="pb-32"><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></h4>
                        <a style="color: #FFF; text-decoration: none;" href=""><p style="position: absolute; bottom: 1rem; border-top: 1px solid #CCC; font-weight: 600; text-transform: uppercase;"><!-- ' . date("D M j Y", strtotime($value['created'])) . '<br /> -->' . $read_time . '</p></a>
                        
                        <!-- <div class="mt-8" style="display: flex; position: relative;">
                                <div style="width: 38px; margin-top: 2px;">
                                    <img src="/view/image/avatar/jamesmccarthy_1.jpg" style="border-radius: 100px; width: 100%;"/>
                                </div>
                                <div class="--byline" style="width: 100%;">
                                    <p class="--byline"><b>' . $value['byline'] . '</b><br />
                                    ' . date("F d, Y", strtotime($value['created'])) . ' - ' . $value['count'] . ' Words, ' . $read_time . '</p>
                                </div>
                        </div> -->
                    </div>
                    </div> 
                </div>
        ';

        } else if ($value['type'] == "filmstrip") {

            $strip_html = null;

            /* API call to get all images from fiedlnotes_images by ID */
            $image_data = $this->api_Admin_Get_FieldnotesImagesById($value['fieldnotes_id']);
            $image_count = count($image_data);
            
            $j=1;
            foreach ($image_data as $imgK => $imgV) {

                    /* variables to assign */
                    $file_path = $imgV['path'];
                    $file_caption = $imgV['caption'];

            /* changed $image_count to 2 */
            if ($j == 2) { $m_right = null; } else { $m_right = 'margin-right: .5rem;'; }
            if ($j >= 3) { $sm_hidden = '_sm-hidden'; } else { $sm_hidden = null; }

                    /* HTML for the images in the strip */
                    if ($j <= 2) {
                    $strip_html .= '<div class="col' . $sm_hidden . '" style="padding-left: 0; background-color: #000; flex: 1; overflow: hidden; width: 100%;' . $m_right . '" data-file="' . $j . '"><p class="center"><img style="min-height: 176px; max-height: 64px;" src="/view/image/fieldnotes/' . $imgV['path'] . '" /></p></div>';
                        
                    // if ($j <= 2) {
                    $image_large .= '<div id="img_' . $j . '_expanded_DISABLED" style="background-color: #000; min-height:300px; position: relative;"><p id="caption_' . $j . '" style="padding: 1rem; position: absolute; background-color: rgba(0,0,0,.4); font-size: 1.3rem; font-weight: 200;">' . $imgV['caption'] . '</p><img style="width: 100%;" src="/view/image/fieldnotes/' . $imgV['path'] . '" /></div>';
                    } 
                    $j++;
            }

            $card_html .= '
                <div class="col-6_sm-12 storycard--background">
                    <div class="content__filmstrip--preview">
                        <p style="font-size: .7rem;">FILMSTRIP</p><h4 style="color: #FFFFFF;"><a href="/polarized/' . $value['short_path'] . '">' . $value['title']. '</a></h4><p style="position: absolute; right: 1rem;bottom: 1rem;">' . $read_time_label . '</p>
                    </div>
                    <div class="content--preview" style="display: flex; flex-wrap: wrap; justify-content: left; padding-left: 0; padding-right: 0;">                        
                    <!-- HTML for images -->' . $strip_html . 
                    '</div>
                    <div class="content__filmstrip--teaser"><p>' . $value['teaser'] . '</p></div> 
                    <!-- Large Preview of Image Selected -->
                    <div id="fimlstrip--preview_' . $j . '" class="filmstrip--large-preview">
                        <p data-filmstrip="' .$j . '" class="close_filmstrip" style="border-bottom-left-radius: 69px; background-color: rgba(255,255,255,.5); text-align: right;padding: 24px;position: absolute;top: 0;right: 0;color: #000;"><i style="position:absolute; top:13px;right:10px;" class="fas fa-times-circle" aria-hidden="true"></i></p>'
                        . $image_large .                            
                    '</div>
                </div>
                ';

        } else {

            $card_html .= 'COULD_NOT_PROCESS';
            
        }

    } else {
        if($value['type'] != "filmstrip") {
            $card_older_html .= '<li class="small"><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></li>';
        }
    }

   $i++; 
}


.__container {

        .--card_layout {
            display: grid;
            grid-gap: 5px;
            overflow: hidden;

             // xSmall devices (landscape phones, 320px and up)
            @media (min-width: 320px) { 
                grid-template-columns: 100%;
                // background-color: lightpink;
            }

            // Small devices (landscape phones, 576px and up)
            @media (min-width: 376px) { 
                grid-template-columns: 50% 50%;
                // background-color: gray;
            }

            // Medium devices (tablets, 768px and up)
            @media (min-width: 767px) {
                grid-template-columns: 33% 33% 33%;
                // background-color: blue;
            }

            // Large devices (tablets (iPad Pro, 1112px and up)
            @media (min-width: 1112px) {
                grid-template-columns: 33% 33% 33%;
                // background-color: orange;
            }

            // Extra large devices (large desktops, 1200px and up)
            @media (min-width: 1200px) {
                grid-template-columns: 33% 33% 33%;
                // background-color: red;
            }

        }

        @media (max-width: 64em) and (orientation: portrait),
            (max-width: 80em) and (orientation: portrait),
            (min-device-width: 375px) and (max-device-height: 812px) 
            and (orientation : landscape) and (-webkit-device-pixel-ratio: 3)
            {
               flex-basis: 100%;
               max-width: 100%;
            }


        .subtitle {
            
            padding-bottom: 3rem;

            @media (max-width: 64em) and (orientation: portrait),
            (max-width: 80em) and (orientation: portrait) 
            {
                font-size: 1.8rem;
                font-weight: 600;
                text-align: center;
                word-wrap: break-word;
                padding-bottom: 2rem;
            }

        }

        ul li {
            list-style: square;
            margin-left: 1rem;
        }
    }


.storycard {
    margin-bottom: 32px;
    position: relative;
    display: flex;
    border-bottom: 1px solid #e4e4e4;
    padding-bottom: 2rem;
    

    h4 {
        font-weight: 600;
        font-size: 1.2rem;

        a {
            color: #000;

            &hover {
                color: lighten(#000,20%);
            }
        }
    }
          .content--preview {
              flex: 3;
              background-color: #FFF;
              padding-right: 1rem;

              .--tag, .--byline {
                    font-size: .7rem;
              }

              .--byline {
                  font-family: 'lato', sans-serif !important;
                  font-weight: 400;
                font-size: .8rem;
              }

              .--teaser,
              .--teaser >p,
              .--teaser >div{
                  padding-top: .5rem;
                  font-size: 1rem;
              }
          }

          .content__image--preview {   
                justify-content: center;
                display: flex;
                flex-direction: row;
                overflow: hidden;
                padding: 0;
                height: 161px;
                flex:1;
                // border-radius: $border-radius;

                    >img {
                        flex: 2;
                        height: 100%;
                    }
          }
}


.content__filmstrip--preview {
    // border-radius: 6px; 
    padding: .5rem 2rem .5rem 2rem; 
    background-color: rgba(0, 0, 0, 0.5);
    padding-top: 1rem;
}

.content__filmstrip--teaser >p {
    // border-radius: 6px; 
    padding: 0 4rem 1rem 2rem; 
    background-color: rgba(0, 0, 0, 0.5);
    line-height: 1.2rem;
    font-size: 1rem;
}
          
.storycard--background {
    position: relative;
    background-color: #000;
    // margin-bottom: 32px;
    color: #FFF;
    // border-radius: $border-radius;
    position: relative;
    padding: 0;
    // height: 220px;

    h4 {
        font-weight: 600;
        font-size: 1.5rem;

        a {
            color: #FFF;

            &:hover {
                color: darken(#FFF, 20%);
            }
        }
    }

    .content--preview {
        // background-color: rgba(0,0,0,.5);
        padding: 0 32px;
        height: 100%;
        // border-radius: $border-radius;

        .--tag, .--byline {
            font-size: .8rem;
        }

        .--byline {
            font-family: Lato, sans-serif !important;
            font-weight: 400;
            padding-left: .3rem;
        }
    } 

    .content__image--preview {   
        padding: 0; margin: 0;
        overflow: hidden;
        // border-radius: $border-radius;

        >img {
            width: 120%;
            overflow: hidden;
            vertical-align: top;
            // border-radius: $border-radius;
        }
    }
    


    .close_filmstrip {
        cursor: pointer;
    }
}