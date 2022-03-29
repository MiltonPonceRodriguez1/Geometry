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

$array = array($point5, $point2, $point1, $point4, $point3, $point6, $point7);
var_dump($array);

$tree = new Tree("x");
$nodo = $tree->construct($array);
//var_dump($nodo);die()
var_dump($tree->getRoot()->left->point);
$tree->inOrden($tree->getRoot());

//var_dump($tree->getRoot()->right->right);
die();

$tree = new Tree("x");
echo '<h1>'.$tree->construct().'</h1>';
var_dump($tree);die();



?>