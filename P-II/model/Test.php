<?php
require_once "Point.php";
require_once "Helpers.php";

$array = array();
for ($i = 0; $i < 1000 ; $i++) { 
    $float = 0.1+ (rand(2,10)/10);
    array_push($array, new Point(((float)rand(0, 10))+$float, ((float)rand(0, 10))+$float));
}


var_dump($array);

