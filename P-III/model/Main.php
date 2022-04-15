<?php
require_once "Node.php";
require_once "Point.php";
require_once "Tree.php";
require_once "Helpers.php";


/*if(
    (isset($_POST['point_1']) && !empty($_POST['point_1'])) && (isset($_POST['point_2']) && !empty($_POST['point_2'])) 
) {
    
} */

$point = new Point(2, 4);

$point12 = new Point(1, 2);
$point2 = new Point(3, 5);

$node = new Node($point);

//$tree = new Tree(null, $point);
//$tree->insert($tree->getRoot(), $point2, 0);
//$tree->insert($tree->getRoot(), $point12, 0);


$point1 = new Point(31, 40);
$point2 = new Point(42, 35);
$point3 = new Point(19, 50);
$point4 = new Point(10, 6);
$point5 = new Point(25, 55);
$point6 = new Point(57, 53);
$point7 = new Point(50, 18);
$point8 = new Point(17, 22);
$point9 = new Point(45, 52);
$point10 = new Point(6, 31);
$array = array($point2, $point3, $point4, $point5, $point6, $point7, $point8, $point9, $point10);

$tree = new Tree(null, $point1);


for($i=0; $i<count($array); $i++) {
    $tree->insert($tree->getRoot(), $array[$i]);
}

$tree->printInOrder($tree->getRoot());
//var_dump($tree->getRoot());
echo "<br>";

$tree-> search_neighbor($tree->getRoot(), new Point(18, 20));
var_dump($tree->getNeighbor());
die();
