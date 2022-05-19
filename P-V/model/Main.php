<?php

class Point {
    public $x;
    public $y;
    public $color;
    
    function __construct($x, $y, $color)
    {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }
}

function randgp($max) {
    return floor( (mt_rand() / mt_getrandmax()) * $max );
}

function metric($x, $y, $mt) {
    $res = 0;
    if ($mt == 1) {
        $res = sqrt($x*$x + $y*$y); 
    } elseif ($mt == 2) {
        $res = abs($x) + abs($y);
    } elseif ($mt == 3) {
        $res = pow( pow(abs($x), 3) + pow(abs($y), 3) , 0.33333);
    }

    return $res;
}

function voronoi($points, $width, $height, $mt) {
    $colors = array('#f68161', '#9cf661', '#61f6b9', '#61a5f6', '#c961f6', '#f661a2', '#4cf83b', '#0eefa1', '#5dfb02', '#1502fb', '#fa21f3', '#faf021', '#f7c50f', '#04619d', '#6517f6', '#f61746');
    
    $w = $width; 
    $h = $height;
    $w1 = $w - 2;
    $h1 = $h - 2;
    $x=$y=$d=$dm=$j=0;
    

    $_x = array();
    $_y = array();
    $_c = array();

    $limits = array();

    $selected_points =  json_decode($_POST['selectedPoints']);

    $n = count($selected_points);

    for ($i = 0; $i < $n; $i++) { 
        array_push($_x, $selected_points[$i][0]);
        array_push($_y, $selected_points[$i][1]);
        array_push($_c, $colors[array_rand($colors)]);
    }

    
    for ($y = 0; $y < $h1; $y++) { 
        //echo "entro al primer for <br>";
        
        for ($x = 0; $x < $w1; $x++) { 
            //echo "entro al segundo for <br>";
            
            $dm = metric($h1, $w1, $mt);
            $j = -1;
            for ($i = 0; $i < $n; $i++) { 
                
                //echo "entro al ultimo for <br>";
                $d = metric($_x[$i] - $x, $_y[$i] - $y, $mt);

                if ($d < $dm) {
                    $dm = $d;
                    $j = $i;
                }
            }
            
            array_push($limits, new Point($x, $y, $_c[$j]));
        }
        
    } 
    
    return $limits;
}

$points = voronoi(20, 370, 370, 1);

$data = array(
    'success' => 1,
    'code' => 200,
    'status' => 'success',
    'limits' => $points,
    'points' => json_decode($_POST['selectedPoints'])
);

echo json_encode( $data );



