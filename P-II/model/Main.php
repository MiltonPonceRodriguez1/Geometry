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

if(
    (isset($_POST['point_1']) && !empty($_POST['point_1'])) && (isset($_POST['point_2']) && !empty($_POST['point_2'])) 
) {
    $post_data_1 = explode(",", $_POST['point_1']);
    $post_data_2 = explode(",", $_POST['point_2']);

    $point_rect_1 = new Point((float) $post_data_1[0], (float) $post_data_1[1]);
    $point_rect_2 = new Point((float) $post_data_2[0], (float) $post_data_2[1]);

    $array = array();
    for ($i = 0; $i < 1000 ; $i++) { 
        $float = 0.1+ (rand(2,10)/10);
        array_push($array, new Point(((float)rand(0, 50))+$float, ((float)rand(0, 50))+$float));
    }

    $tree = new Tree("x");
    $nodo = $tree->construct($array);

    $tree->query2D($tree->getRoot(), $point_rect_1, $point_rect_2);
    $points_rectangle = $tree->getPointsRect();

    $array = Helpers::json_encode_points($array);
    $point_rect_1 = Helpers::json_encode_point($point_rect_1);
    $point_rect_2 = Helpers::json_encode_point($point_rect_2);
    $points_rectangle = Helpers::json_encode_points($points_rectangle);
    /* FIN ALGORITMO SEARCH ORTOGONAL */

    if(!empty($points_rectangle)) {
        $data = array(
            'status' => 'success',
            'code' => 200,
            'points' => $array,
            'points_rect' => $points_rectangle,
            'rect_p1' => $point_rect_1,
            'rect_p2' => $point_rect_2
        );
    } else {
        $data = array(
            'status' => 'error',
            'code' => 400,
            'msg' => 'Error al procesar la respuesta !!'
        );
    }
} 

echo json_encode($data);

