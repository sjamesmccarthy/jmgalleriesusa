<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-12-2017 7:34:05
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_email_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 05-22-2017 6:21:02
 * @Last modified time: 09-01-2019 08:07:45
 * @Copyright: 2017, 2019
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

    // $core->console($_POST);
    $res_discount = strtoupper($_POST['promo']);
    $res_price= (float)$_POST['cost'];

     /* Math for total price */
    $promos_array = array($core->config->promo_seasonal, $core->config->promo_holiday, $core->config->promo_generic, $core->config->promo_collector, $core->config->promo_special);
    // $core->printp_r($promos_array);

    foreach ($promos_array as $key => $val) {

        $promos_split = explode(":", $val);
        if ($res_discount == $promos_split[0]) {
            $promo = array($promos_split[0] => $promos_split[1]);
        } 

    }

    foreach ($promo as $k => $v) {
        if($res_discount == $k) { 
            $promo_discount = $v;
            
            if( strpos($promo_discount, '%') ) {
                // this is percentage of
                $n_percent = ( (int)rtrim($promo_discount, '\%') / 100);
                $amt_discount = $res_price * $n_percent;
                echo $amt_discount; exit;
                // $total_price = (int)$res_price + (int)$res_tax + (int)$res_shipping - $get_precent_off;
                $total_price = $res_price - $amt_discount;
                $usd=null;
            } else {
                $usd = '$';
                $total_price = $res_price - $promo_discount;
            }

            $promo_active = 1; 
        } 
    }

    if ($promo_active == 1) {
        $promo_discount = "(REFLECTS " . $res_discount . " PROMO " . $usd . $promo_discount . " OFF)";
    } else {
        $total_price = (int)$res_price + (int)$res_tax + (int)$res_shipping;
    }

    if($total_price < 0 ) {
        print "INVALID CODE -0";
    } else {
        if(count($promo) == 1) {
            echo $total_price;
        } else {
            print "INVALID CODE 1";
        }
    }
    

    // if(count($promo) == 1) {
    //     // print number_format($total_price, 0, '.', ',');
    //     echo $total_price;
    // } else {
    //     print "INVALID CODE";
    // }