<?php
require_once "Point.php";
require_once "Helpers.php";
require_once "Stack.php";
require_once "Graham.php";

$point1 = new Point(0.45 , 4.25);
$point2 = new Point(4.12 , 5.31);
$point3 = new Point(10.1 , 3.4);
$point4 = new Point(9.12 , -1.45);
$point5 = new Point(3.6 , 12.55);
$point6 = new Point(12.3 , 7.8);
$point7 = new Point(8.99 , 4.5);
$point8 = new Point(18.36 , 3.44);
$point9 = new Point(16.10 , 12.59);
$point10 = new Point(3.34 , 6.66);
$point11 = new Point(10.3 , 11.8);

$array_points = array($point1, $point2, $point3, $point4, $point5, $point6, $point7, $point8, $point9, $point10, $point11);


$graham = new Graham($array_points);
$graham->convexHull();


$points = Helpers::json_encode_points($array_points);
$final_points = Helpers::json_encode_points($graham->getFinalPoints());

$data = array(
    'success'   =>  1,
    'points' => $points,
    'finalPoints' => $final_points
);

if (isset($data)) {
    echo json_encode($data);
} else {
    echo json_encode(array('success' => 0));
}