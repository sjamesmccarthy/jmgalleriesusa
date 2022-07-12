<?php


$catalog_path_cleaned = ltrim($this->page->catalog_path, "/");

/* Load all photo meta data */
$photo_meta = $this->api_Catalog_Photo("0", $this->page->photo_path);
$this->props = $photo_meta;

/* FILMSTRIP: GALLERY THUMBS */
$you_may_also_like_html = $this->component("most_popular");

/* API call to fetch parent collections id */
$collection_detail = $this->api_Admin_Get_Collections_Item(
  $photo_meta["parent_collections_id"]
);
$catalog_code = $collection_detail["catalog_code"];

/* Get Edition types and max_editions */
$edition_styles_array = json_decode($this->config->edition_types, true);
// $edition_styles = array_keys($edition_styles_array);

if (isset($photo_meta["catalog_photo_id"])) {
  $this->api_Update_Photo_Viewed($photo_meta["catalog_photo_id"]);
}

$this->catalog_title = ucwords($photo_meta["catalog_title"]);
$this->page->title = $photo_meta["title"];

$available_sizes = $photo_meta["available_sizes"];

$tv_price_array = json_decode($this->config->tv_pricing, true);
$studio_frames_pricing = json_decode(
  $this->config->studio_frames_pricing,
  true
);

$le_price_array = json_decode($this->config->le_pricing, true);
$le_price_array_metal = json_decode($this->config->le_pricing_metal, true);
$le_frames_pricing = json_decode($this->config->le_frames_pricing, true);

/* Check for date taken and add HTML variable */
$date_taken_Y = date("Y", strtotime($photo_meta['date_taken']));
if($date_taken_Y != '-0001') {
  $date_taken = ", <spam style='text-transform: lowercase'>c.</span> " . $date_taken_Y;
} else {
  $date_taken = null;
}

/* Determine if the "VirtualRoom" photo exists */
if (
  file_exists(
    $_SERVER["DOCUMENT_ROOT"] .
      "/view/__catalog/__image/" .
      $photo_meta["file_name"] .
      "-room.jpg"
  ) &&
  $photo_meta["as_limited"] == "0"
) {
  $in_roomImg =
    '<div class="col"><img class="in-room-img" src="/view/__catalog/__image/' .
    $photo_meta["file_name"] .
    '-room.jpg" alt="' .
    $photo_meta["file-name"] .
    '" /></div>';
  $tv = 1;
} else {
  $in_roomImg = null;
  $tv = 0;
}

if ($tv == 1) {
  $tv_img_disclaimer =
    "*Frames, envelopes, stamps, plants and pens are not included with any tinyViews&trade; Edition.";
} else {
  $tv_img_disclaimer = null;
}

$super_photo =
  '
    <div class="img-container col-12 mb-32 ' .
  $photo_meta["orientation"] .
  '">
        <p style="text-align: center">
        <img src="/view/__catalog/__image/' .
  $photo_meta["file_name"] .
  '.jpg" alt="' .
  $photo_meta["file_name"] .
  '" />
        </p>
    </div>';

$as_editions = null;
$as_editions_tmp = null;

if ($photo_meta["desc"] != null) {
  if ($photo_meta["desc"] == "paper") {
    $edition_desc_material = $this->config->tv_material_desc;
    // "Moab® Slick Rock Metallic Paper";
    // $frame_disabled_option = '<option value="FRAMEINCLUDED">Select a Frame (Included In Price)</option>';
    $edition_frame =
      "<!-- Framed in one of our three Premium Designer Frames protected with Tru Vue&reg; Museum Glass. -->";
    // $frame_price_default = "FRAMEINCLUDED";
    $frame_price_default = "0";
    $frame_disabled = "disabled";
    $frame_disabled_option =
      '<option value="FRAMELESS">FRAMING OPTIONS</option><option value="ADDWITHACRYLIC">+ Add Additional Premium Frame (+$$)</option>';
    $frame_info_link = "Premium Designer Frames pricing";
  }

  if ($photo_meta["desc"] == "canvas") {
    $edition_desc_material = "Silverada Metallic Canvas";
    $edition_frame =
      "and is float mounted without a frame. One of our Premium Designer Frames can be optionally added for an additional cost.";
    $frame_disabled = "disabled";
    $frame_disabled_option =
      '<option value="FRAMELESS">No Frame Needed With Canvas</option><option value="ADDWITHACRYLIC">+ Add Additional Premium Frame (+$$)</option>';
    $frame_info_link = "Premium Designer Frames pricing";
    $frame_price_default = "0";
  }

  if ($photo_meta["desc"] == "acrylic") {
    $edition_desc_material =
      "HD Acrylic or HD Chromaluxe&reg; Metal (⅛ inch thick including wall mount)";
    $edition_frame =
      '<!--One of our <a href="/styles">Premium Designer Frames</a> can be optionally added for an additional cost.--><!-- This fine-art may also be available in HD Chromaluxe&reg; Metal. Please <a href="/contact">contact an art consultant</a> for availability and pricing.-->';
    $frame_disabled = "disabled";
    $frame_disabled_option =
      '<option value="FRAMELESS">Includes Aluminum Wall Mount</option><option value="ADDWITHACRYLIC">+ Add Additional Premium Frame (+$$)</option>';
    $frame_info_link = "Premium Designer Frames pricing";
    $frame_price_default = "0";
  }

  // $edition_desc_material_slash = '/ ' . $edition_desc_material;
  $edition_desc_material_slash = null;
} else {
  if ($photo_meta["as_open"] != 1) {
    $edition_desc_material_slash =
      "/ " . "Collectors Choice of Fine Art Paper or Acrylic";
    $edition_desc_material = "HD Acrylic";
    $frame_info_link = "the Premium Designer Frames";
  } else {
    $edition_desc_material_slash = null;
    $frame_info_link = "the Premium Designer Frames";
  }
}

/* If as_limited is set */
if ($photo_meta["as_limited"] == 1) {
  $ed_G = true;
  $edition = "limited";
  $this->page->edition = $edition;
  $product_id = 1;
  $catalog_no = $catalog_code . $photo_meta["catalog_photo_id"] . "LE";
  $matted_size_default = "0";

  // $edition_desc = $this->config->edition_description_limited;
  // $edition_max  = ' / ' . $this->config->limited_edition_max;

  if (array_key_exists("limited", $edition_styles_array)) {
    $edition_desc = "Limited Edition";
    $edition_max = $edition_styles_array["limited"];
  }

  $hidden_edition_type =
    '<input type="hidden" name="edition_type" value="limited" />';

  /* Picking a default value to show */
  if ($available_sizes != "in_code") {
    $custom_price_array = explode("|", $available_sizes);
    $le_price_array = json_decode($custom_price_array[0], true);
    $le_price_array_metal = json_decode($custom_price_array[1], true);

    // $le_price_array = json_decode($available_sizes, true);
    // $le_price_array_metal = json_decode($this->config->le_pricing_metal, true);
  }

  foreach ($le_price_array as $paK => $paV) {
    $pricing_long .= $paK . " ";
  }

  $pricing_long = preg_replace("#\s+#", ", ", trim($pricing_long));
  $price_count = sizeof($le_price_array);

  $i = 1;
  foreach ($le_price_array as $k => $v) {
    if ($price_count == 1 || ($price_count > 1 && $i == 1)) {
      $default_price = $v;
      $default_size = $k;
    }
    $i++;
  }

  $btn = "BUY ARTWORK";
  $btn_link =
    '<a style="display:block;" href="/contact?photo=' .
    $photo_meta["file_name"] .
    '">'; //class="btn-nudge"
  $gallery_details =
    '<!--<p class="pt-32 bold">About The Art</p>--><p class="pt-32 pb-16 text-center">Limited Edition of ' .
    $edition_max .
    ", signed with Certificate of Authenticity and Digital Provenance Archived. Printed on " .
    $edition_desc_material .
    " and the available sizes include: " .
    $this->config->available_sizes_limited .
    ' inches. <!-- (larger sizes available on special order, <a href="/contact">contact an art consultant</a>) -->' .
    $edition_frame .
    "<!-- If you have any questions about our " .
    $edition_desc_material .
    ', or need more information about out <a href="/styles">styles, frames and editions</a>, please <a href="/contact">contact an art consultant</a>.--></p>';

  /* PRICING SELECT */
  $sizes_pricing = '<div class="col-4_sm-12 select-wrapper">
        <label for="buysize"></label>
        <select id="buysize" name="buysize" style="padding-left: 10px; margin-bottom: 0;">';

  foreach ($le_price_array as $leK => $leV) {
    // if($leK == $default_size) { $default = 'SELECTED'; } else { $default = null; }
    $sizes_pricing .=
      "<option " .
      $default .
      ' data-price="' .
      $leV .
      '" data-mattedsize="0" data-material="acrylic" value="' .
      $leK .
      '">SIZE: ' .
      $leK .
      " Acrylic</option>";
  }

  // if($available_sizes == "in_code") {
  $sizes_pricing .= '<option value="---">---</option>';
  foreach ($le_price_array_metal as $leKm => $leVm) {

    if($leKm == "12x18 (Mothers Day Edition)") {
      $default = 'SELECTED';
      $default_price = $leVm;
    } else { $default = null; }

    $sizes_pricing .=
      "<option " .
      $default .
      ' data-price="' .
      $leVm .
      '" data-mattedsize="0" data-material="metal" value="' .
      $leKm .
      '">SIZE: ' .
      $leKm .
      " Metal</option>";
  }
  // }

  $sizes_pricing .= '
        </select>
        </div>';

  /* FRAME SELECT */
  /* Currently does not loop through {le_frames_pricing} in settings */
  $sizes_frames .=
    '
        <div class="col-4_sm-12 select-wrapper">
            <label for="frame"></label>
            <select id="frame" name="frame" style="padding-left: 10px; margin-bottom:0;">
                ' .
    $frame_disabled_option .
    '
                <option value="Black Vodka"' .
    $frame_disabled .
    '>FRAME: Premium Designer Black Vodka (similar to a Dark Black stain)</option>
                <option value="Whiskey"' .
    $frame_disabled .
    '>FRAME: Premium Designer Whiskey (similar to a Medium Brown stain)</option>
                <option value="Bourbon"' .
    $frame_disabled .
    '>FRAME: Premium Designer Bourbon (similar to a Light Brown stain)</option>
            </select>
        </div>
        <input type="hidden" name="edition" value="limited" />';
}

/* If as_OPEN is set */
if ($photo_meta["as_open"] == 1) {
  $ed_O = true;
  $edition = "tinyviews";
  $this->page->edition = $edition;
  $product_id = 2;
  $edition_desc_material = $this->config->tv_material_desc;
  // Moab® Slick Rock Metallic Paper";
  $catalog_no = $catalog_code . $photo_meta["catalog_photo_id"] . "OT";
  $frame_price_default = "0";
  // $matted_size_default = "8x10";
  $matted_size_default = "0";

  // if($ed_G === true || $ed_S === true) { $as_editions_tmp .= ", "; }
  // $as_editions_tmp .= "";

  // $edition_desc = $this->config->edition_description_open;
  // $edition_desc_material_slash = null;
  // $edition_max = null;

  if (array_key_exists("open", $edition_styles_array)) {
    $edition_desc = "Open Edition";
    $edition_max = null;
  }

  $hidden_edition_type =
    '<input type="hidden" name="edition_type" value="open" />';

  $btn = "BUY ARTWORK";
  $btn_link =
    '<a style="display:block;" class="mt-16" href="/contact?photo=' .
    $photo_meta["file_name"] .
    '&open=true">'; //class="btn-nudge"
  $gallery_details =
    '<p class="mt-32">Open Edition, un-numbered and not signed. Printed on ' .
    $edition_desc_material .
    " and available in size(s) of: " .
    $this->config->available_sizes_open .
    " inches (if print only, it will include 1/2 inch white border). It can also be framed in an optional Studio Frame for additional cost.";

  /* Picking a default value to show */
  if ($available_sizes != "in_code") {
    $tv_price_array = json_decode($available_sizes, true);
  }

  $price_count = sizeof($tv_price_array);

  $i = 1;
  foreach ($tv_price_array as $k => $v) {
    if ($price_count == 1 || ($price_count > 1 && $i == 1)) {
      $tvP = explode("|", $k);
      $default_price = $v;
      $default_size = $tvP[0];
    }
    $i++;
  }

  // $default_price = $tv_price_array['8x10|11x14'];
  // $default_size = '12x18';

  /* Loop through available_sizes */
  $sizes_pricing = '<div class="col-4_sm-12 select-wrapper">
        <label for="buysize"></label>
        <select id="buysize" name="buysize" style="padding-left: 10px; margin-bottom: 0;">';

  foreach ($tv_price_array as $tvK => $tvV) {
    $tvP = explode("|", $tvK);
    if ($tvP[0] == $default_size) {
      $default = "SELECTED";
    } else {
      $default = null;
    }
    // $this->console($tvP);

    if ($photo_meta["as_limited"] == "0" && $tvP[0] == "5x7NC") {
      if (
        file_exists(
          $_SERVER["DOCUMENT_ROOT"] .
            "/view/__catalog/__image/" .
            $photo_meta["file_name"] .
            "-tinyviews-notes.jpg"
        )
      ) {
        $tinyviewNotesImage =
          '<div class="col"><img class="in-room-img"  src="/view/__catalog/__image/' .
          $photo_meta["file_name"] .
          '-tinyviews-notes.jpg" alt="' .
          $photo_meta["file_name"] .
          '" /></div>';
        $sizes_pricing .=
          "<option " .
          $default .
          'data-price="' .
          $tvV .
          '" value="NOTECARDS">SIZE: 5x7 NOTECARD/POSTCARD (Set of 3)</option>';
        $tv = 1;
      } else {
        $tinyviewNotesImage = null;
        $tinyviewNotesOption = null;
        $tv = 0;
      }
    } elseif ($photo_meta["as_limited"] == "0" && $tvP[0] == "8x8") {
      /* Determine if the "TinyViews photo exists */
      if (
        file_exists(
          $_SERVER["DOCUMENT_ROOT"] .
            "/view/__catalog/__image/" .
            $photo_meta["file_name"] .
            "-tinyviews.jpg"
        ) &&
        $photo_meta["as_limited"] == "0"
      ) {
        $tinyviewImage =
          '<div class="col"><img class="in-room-img"  src="/view/__catalog/__image/' .
          $photo_meta["file_name"] .
          '-tinyviews.jpg" alt="' .
          $photo_meta["file_name"] .
          '" /></div>';
        $sizes_pricing .=
          "<option " .
          $default .
          ' data-price="' .
          $tvV .
          '" ' .
          'data-frameprice="' .
          $studio_frames_pricing["8x8"] .
          '" value="8x8">SIZE: SQUARE 8x8</option>';
        $tv = 1;
      } else {
        $tinyviewImage = null;
        $tv = 0;
        $tinyviewSquareOption = null;
        $sizes_pricing .=
          "<option " .
          $default .
          ' data-price="' .
          $tvV .
          '" ' .
          'data-frameprice="' .
          $studio_frames_pricing["8x8"] .
          '" value="8x8">SIZE: 8x8</option>';
        $tv = 1;
      }
    } elseif ($photo_meta["as_limited"] == "0" && $tvP[0] == "12x12") {
      /* Determine if the "TinyViews photo exists */
      if (
        file_exists(
          $_SERVER["DOCUMENT_ROOT"] .
            "/view/__catalog/__image/" .
            $photo_meta["file_name"] .
            "-tinyviews.jpg"
        ) &&
        $photo_meta["as_limited"] == "0"
      ) {
        $tinyviewImage =
          '<div class="col"><img class="in-room-img"  src="/view/__catalog/__image/' .
          $photo_meta["file_name"] .
          '-tinyviews.jpg" alt="' .
          $photo_meta["file_name"] .
          '" /></div>';
        $sizes_pricing .=
          "<option " .
          $default .
          ' data-price="' .
          $tvV .
          '" ' .
          'data-frameprice="' .
          $studio_frames_pricing["12x12"] .
          '" value="12x12">SIZE: SQUARE 12x12</option>';
        $tv = 1;
      } else {
        $tinyviewImage = null;
        $tv = 0;
        $tinyviewSquareOption = null;
      }
    } else {
      $studio_fp =
        $studio_frames_pricing[
          $tvP[0]
        ]; /* Changed from 1, may had to do with the Mats */

      $sizes_pricing .=
        "<option " .
        $default .
        ' data-price="' .
        $tvV .
        '" ' .
        'data-frameprice="' .
        $studio_fp .
        '" value="' .
        $tvP[0] .
        '" data-mattedsize="' .
        $tvP[1] .
        '">SIZE: ' .
        $tvP[0] .
        "<!-- (Matted to: " .
        $tvP[1] .
        ") --> </option>";
    }
  }

  $sizes_pricing .= "</select></div>";

  /* FRAMES pricing */
  $sizes_frames .= '
        <div class="col-4_sm-12 select-wrapper">
            <label for="frame"></label>
            <select id="frame" name="frame" style="padding-left: 10px; margin-bottom: 0;">
                <option value="PRINT-ONLY">PRINT ONLY - NO FRAME</option>
                <!-- <option value="Studio-Ash-Gray">+ ADD STUDIO FRAME (Ash Gray)</option> -->
                <!-- <option value="Studio-Snow-White">+ ADD STUDIO FRAME (Snow White)</option> -->
            </select>
           <!-- <span class="tiny"><a href="/styles">More information about frame styles and pricing</span> -->
        </div>
        <input type="hidden" name="edition" value="open" />';

  $tinyViewFinePrint =
    '<div class="col-12 mb-64 ml-8"><p>tinyViews&trade; Giclée Prints are available in standard framing sizes 5x7, 8x10 and 11x14 with a 1/2" white border ready for framing. Please read our <a target="_info" href="/styles">Frames, Editions and Pricing</a> page for more information about our Studio Frames for tinyViews&trade; Giclée Prints.' .
    $tv_img_disclaimer .
    "</p></div>";
}

// $as_editions = $as_editions_tmp;
$catalog_no_hidden =
  "<input type='hidden' name='catalog_no' value='" . $catalog_no . "' />";

/* Photo orientation */
if ($photo_meta["orientation"] == "portrait") {
  $img_w = "64%";
  $grid = "-11";
  $col_left = "col-6";
  $col_right = "col-5";
} elseif ($photo_meta["orientation"] == "square") {
  $img_w = "100%";
  $grid = "-11";
  $col_left = "col-6";
  $col_right = "col-5";
} else {
  $img_w = "100%";
  $grid = "-11";
  $col_left = "col-7";
  $col_right = "col-4";
}

/* FORMAT EXIF DATA */
if ($photo_meta["aperture"] != "" && $photo_meta["lens_model"] != "") {
  $exif_data = '<div class="col-11 pb-8">';
  $exif_data .= '<p class="pt-16 field-notes">';

  $exif_data .=
    "Field Notes: " .
    $photo_meta["camera"] .
    ", " .
    $photo_meta["lens_model"] .
    ", " .
    $photo_meta["aperture"] .
    ", " .
    $photo_meta["shutter"];

  if ($photo_meta["loc_waypoint"] != "") {
    $exif_data .= " @ " . $photo_meta["loc_waypoint"];
  }

  $exif_data .= "</p>";
  $exif_data .= "</div>";
}
?>

<script>
    // var title = document.title;
    // var dbTitle = "<?= $photo_meta["title"] ?>";
    // if (document.title != dbTitle) {
    //     document.title = dbTitle;
    // }
</script>
