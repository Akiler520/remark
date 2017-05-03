<?php
/**
 * Http Request
 * User: Martin
 */

class Yov_RemoteRequest{
    /**
     * http request POST
     * @param $url
     * @param $param
     * @param bool|false $post_file
     * @param int $timeout
     * @return bool|mixed
     */
    public static function post($url, $param, $post_file = false, $timeout = 5){
        $oCurl = curl_init();

        if(stripos($url,"https://") !== false){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
        }

        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $param);

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);

        curl_close($oCurl);

        if(intval($aStatus["http_code"]) == 200){
            return $sContent;
        }else{
            return false;
        }
    }

    /**
     * http request GET
     * @param $url
     * @param $timeout
     * @return bool|mixed
     */
    public static function get($url, $timeout = 5){
        $oCurl = curl_init();

        if(stripos($url,"https://") !== false){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
        }

        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_CONNECTTIMEOUT, $timeout);

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);

        curl_close($oCurl);

        if(intval($aStatus["http_code"]) == 200){
            return $sContent;
        }else{
            return false;
        }
    }
}