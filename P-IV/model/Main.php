<?php

include_once 'Triangle.php';
include_once 'Point.php';
include_once 'Helpers.php';


if ( isset($_POST['selectedPoints']) && !empty( json_decode($_POST['selectedPoints']) ) ) {

    $selected_points =  json_decode($_POST['selectedPoints']);

    $points = array();

    // array_push($points, new Point(30, 40));
    // array_push($points, new Point(70, 40));
    // array_push($points, new Point(40, 60));
    // array_push($points, new Point(50, 20));

    // array_push($points, new Point(10, 20));
    // array_push($points, new Point(20, 25));
    // array_push($points, new Point(30, 40));
    // array_push($points, new Point(70, 40));
    // array_push($points, new Point(40, 60));
    // array_push($points, new Point(50, 20));

    for($i=0; $i<count($selected_points); $i++) {
        array_push($points, new Point($selected_points[$i][0], $selected_points[$i][1]));
    }

    $delaunay = Helpers::delaunay_triangulation($points);

    // foreach ($delaunay as $triangulo) {
    //     $triangulo->show();
    // }

    $data = array(
        'success' => 1,
        'code' => 200,
        'status' => 'success',
        'points_delaunay' => Helpers::get_points_edges($delaunay)
    );

    echo json_encode( $data );

} else {
    echo json_encode(array('success' => 0));
}

?>
