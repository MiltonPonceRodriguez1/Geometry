<?php

class Helpers {

    public static function json_encode_points($points) {
        $new_points = array();
    
        foreach($points as $point) {

            $point_json = array(
                'x' => $point->getX(),
                'y' => $point->getY(),
                'axis' => $point->getAxis()
            );
    
            array_push($new_points, $point_json);
        }
    
        return $new_points;
    }
}