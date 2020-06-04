<?php
namespace App\Custom;

use Illuminate\Http\Request;
use Auth;

class Sms{
    public static function send($url){
        $ch_banpage = curl_init($url);
        curl_setopt($ch_banpage, CURLOPT_URL, $url);
        curl_setopt($ch_banpage, CURLOPT_HEADER, 0);
        curl_setopt($ch_banpage, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch_banpage);
        curl_close($ch_banpage);
        return $curl_scraped_page;
    }






}



?>
