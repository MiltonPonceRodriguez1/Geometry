<?php

include_once 'Point.php';
include_once 'Triangle.php';

class Helpers {

    // ---> Funciones extra <---

    public static function compare_points($point1, $point2) {
        $return_value = false;
        if($point1->get_X() == $point2->get_X() && $point1->get_Y() == $point2->get_Y()){
            $return_value = true;
        }
        return $return_value;
    }

    public static function remove(&$triangulation, $bad_triangle) {
        for($i=0; $i<count($triangulation); $i++) {
            if($triangulation[$i] == $bad_triangle){
                unset($triangulation[$i]);
                $triangulation = array_values($triangulation);
            }
        }
    }

    public static function get_edge_array($edge) {
        $edeg_array = array();
        array_push($edeg_array, $edge[0]->get_json_Array(), $edge[1]->get_json_Array() );
        return $edeg_array;
    }

    public static function get_points_edges($delaunay) {
        $array_edges = array();
        foreach($delaunay as $triangle) {
            $aux_array = array();

            array_push($aux_array, Helpers::get_edge_array( $triangle->get_edges()[0] ) );
            array_push($aux_array, Helpers::get_edge_array( $triangle->get_edges()[1] ) );
            array_push($aux_array, Helpers::get_edge_array( $triangle->get_edges()[2] ) );

            array_push($array_edges, $aux_array);
        }
        return $array_edges;
    }

    // ---> FIN Funciones extra <---

    public static function circumcenter($a, $b, $c) {
        $ad = $a->get_X() * $a->get_X()  +  $a->get_Y() * $a->get_Y();
        $bd = $b->get_X() * $b->get_X()  +  $b->get_Y() * $b->get_Y();
        $cd = $c->get_X() * $c->get_X()  +  $c->get_Y() * $c->get_Y();

        $D  = 2 * ($a->get_X() * ($b->get_Y() - $c->get_Y()) + $b->get_X() * ($c->get_Y() - $a->get_Y()) + $c->get_X() * ($a->get_Y() - $b->get_Y()));

        return new Point(
            1 / $D * ($ad * ($b->get_Y() - $c->get_Y()) + $bd * ($c->get_Y() - $a->get_Y()) + $cd * ($a->get_Y() - $b->get_Y())),
            1 / $D * ($ad * ($c->get_X() - $b->get_X()) + $bd * ($a->get_X() - $c->get_X()) + $cd * ($b->get_X() - $a->get_X()))
        );
    }

    public static function line_is_equal($line1, $line2) {
        if(
            (Helpers::compare_points($line1[0], $line2[0]) && Helpers::compare_points($line1[1], $line2[1])) ||
            (Helpers::compare_points($line1[0], $line2[1]) && Helpers::compare_points($line1[1], $line2[0]))
        ){
            return true;
        }
        return false;
    }

    public static function distance($point_A, $point_B) {
        return sqrt( (pow(($point_B->get_X() - $point_A->get_X()), 2)) + (pow(($point_B->get_Y() - $point_A->get_Y()), 2)));
    }

    public static function delaunay_triangulation($points) {
        $triangulation = array();

        $super_triangle_A = new Point(2, 2);
        $super_triangle_B = new Point(100, 2);
        $super_triangle_C = new Point(55, 100);

        $super_triangle = new Triangle($super_triangle_A, $super_triangle_B, $super_triangle_C);

        array_push($triangulation, $super_triangle);

        foreach ($points as $point) {

            $bad_triangles = array();
            foreach ($triangulation as $triangle) {
                if( $triangle->is_point_in_circumcircle($point) ){
                    array_push($bad_triangles, $triangle);
                }

            }

            $polygon = array();
            foreach ($bad_triangles as $triangle) {
                foreach ($triangle->get_edges() as $triangle_edge) {
                    $is_shared = false;
                    foreach ($bad_triangles as $other) {
                        if($triangle == $other){
                            continue;
                        }
                        foreach ($other->get_edges() as $other_edge) {
                            if(Helpers::line_is_equal($triangle_edge, $other_edge)){
                                $is_shared = true;
                            }
                        }
                    }
                    if($is_shared == false){
                        array_push($polygon, $triangle_edge);
                    }
                }
            }

            foreach ($bad_triangles as $bad_triangle) {
                Helpers::remove($triangulation, $bad_triangle);
            }

            foreach ($polygon as $edge) {
                $new_triangle = new Triangle($edge[0], $edge[1], $point);
                array_push($triangulation, $new_triangle);
            }
        }

        foreach ($triangulation as $triangle) {
            if($triangle->has_vertex($super_triangle_A) || $triangle->has_vertex($super_triangle_B) ||
            $triangle->has_vertex($super_triangle_C)) {
                Helpers::remove($triangulation, $triangle);
            }
        }

        return $triangulation;

    }

}



?>