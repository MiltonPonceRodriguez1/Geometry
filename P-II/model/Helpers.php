<?php

class Helpers {

    public static function json_encode_points($points) {
        $new_points = array();
    
        foreach($points as $point) {

            $point_json = array(
                'x' => $point->getX(),
                'y' => $point->getY(),
            );
    
            array_push($new_points, $point_json);
        }
    
        return $new_points;
    }

    public static function json_encode_point($point) {
    
        $point_json = array(
            'x' => $point->getX(),
            'y' => $point->getY(),
        );
    
        return $point_json;
    }
}