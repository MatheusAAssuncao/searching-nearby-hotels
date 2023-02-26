<?php
    
namespace Source;

class DataSource {

    public static function getData() : array
    {
        $data_source = [];
       
        $files = glob(__DIR__ . '/api/*.php');
        foreach ($files as $path) {
            $className = 'Source\api\\' . basename($path, ".php");
            $data_source = array_merge($data_source, $className::getData());
        }

        return $data_source;
    }
}
?>