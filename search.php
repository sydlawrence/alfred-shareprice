<?php


function object2array($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        }
        else {
            $array = $object;
        }
        return $array;
    }

$query = $argv[1];

if ( strlen( $query ) < 3 ):
    exit(1);
endif;

require_once('workflows.php');

$w = new Workflows();


$url = "http://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20yahoo.finance.oquote%20WHERE%20symbol%3D'".$query."'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";

$data = file_get_contents($url);

$results = json_decode($data);



foreach ($results->query->results->option as $key => $val) {

   $w->result( $key, "", $val, $key, "icon.png" );

}




echo $w->toxml();