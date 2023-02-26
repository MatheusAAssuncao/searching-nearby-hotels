<?php
    
namespace Source\api;

use Source\interfaces\InterfaceApi;

class Xlr8 implements InterfaceApi {

    public static function getData() : array
    {
        $data_source = [];
        
        $i = 1;
        while (true) {
            $json = self::curl("https://xlr8-interview-files.s3.eu-west-2.amazonaws.com/source_".$i.".json");
            if(empty($json)) {
                break;
            }

            $data = json_decode($json, true);

            if ($data['success'] != true) {
                continue;
            }

            $data_source = array_merge($data_source, $data['message']);

            $i++;
        }

        return $data_source;
    }

    public static function curl($url)  
    {  
        $ch = curl_init($url);  
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = curl_exec($ch);  
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
        curl_close($ch);  

        return ($httpcode >= 200 && $httpcode < 300) ? $data : false;
    } 
}
?>