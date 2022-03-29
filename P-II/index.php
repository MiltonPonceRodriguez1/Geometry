<?php
require_once "Node.php";
require_once "Point.php";
require_once "Tree.php";

$point1 = new Point(0.0, 0.0);
$point2 = new Point(1.0, 1.0);
$point3 = new Point(2.0, 2.0);
$point4 = new Point(3.0, 3.0);
$point5 = new Point(4.0, 4.0);
$point6 = new Point(5.0, 5.0);
$point7 = new Point(6.0, 6.0);
$array = array();
/*for ($i=0; $i <= 1000 ; $i++) { 
    array_push($array, new Point((float) $i, (float) $i));
}*/

//var_dump($array);die();

$array = array($point5, $point2, $point1, $point4, $point3, $point6, $point7);

$tree = new Tree("x");
$nodo = $tree->construct($array);

$tree->inOrden($tree->getRoot());

$tree->query_2D_RECURSIVE($tree->getRoot(), new Point(0.0, 0.0), new Point(7.0, 7.0));
$arr = $tree->getPointsRect();
var_dump($tree->cont);
var_dump($arr);

die();
