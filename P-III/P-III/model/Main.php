<?php
require_once "Node.php";
require_once "Point.php";
require_once "Tree.php";
require_once "Helpers.php";

$data = array(
    'status' => 'error',
    'code' => 400,
    'msg' => 'Error al procesar la respuesta !!'
);

if(isset($_POST['point_1']) && !empty($_POST['point_1'])) {
    $post_data_1 = explode(",", $_POST['point_1']);
    $point_neighbor = new Point((float) $post_data_1[0], (float) $post_data_1[1]);

    // $array = array();
    // for ($i = 0; $i <= 50 ; $i++) {
    //     //$float = 0.3+ (rand(2,10)/10);
    //     array_push($array, new Point((rand(0, 50)), (rand(0, 50))));
    // }


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
    $array = array($point1, $point2, $point3, $point4, $point5, $point6, $point7, $point8, $point9, $point10);


    $tree = new Tree(null, $array[0]);


    for($i=1; $i<count($array); $i++) {
        $tree->insert($tree->getRoot(), $array[$i]);
    }

    $tree->search_neighbor($tree->getRoot(), $point_neighbor);
    $tree->assign_axis($tree->getRoot());

    $data = array(
        'status' => 'success',
        'code' => 200,
        'points' => Helpers::json_encode_points($array),
        'neighbor' => Helpers::json_encode_points(array($tree->getNeighbor())),
        'user_point' => Helpers::json_encode_points(array($point_neighbor))
    );
}

echo json_encode($data);
