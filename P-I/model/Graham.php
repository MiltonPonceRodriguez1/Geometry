<?php
require_once "Stack.php";
require_once "Point.php";

$p0;

function orientation($p, $q, $r) {
    $val = ($q->getY() - $p->getY()) * ($r->getX() - $q->getX()) - ($q->getX() - $p->getX()) * ($r->getY() - $q->getY());

    if( $val == 0 ) return 0;
    return ( $val > 0 ) ? 1 : 2;
}

function distSq( $p1, $p2 ) {
    return ($p1->getX() - $p2->getX()) * ($p1->getX() - $p2->getX()) + ($p1->getY() - $p2->getY()) * ($p1->getY() - $p2->getY());
}

function cmp( Point $vp1, Point $vp2 ) {
    $p1 = $vp1;
    $p2 = $vp2;

    $o = orientation($GLOBALS['p0'], $p1, $p2);
    if( $o == 0 ) {
        return ( distSq($GLOBALS['p0'], $p2) >= distSq($GLOBALS['p0'], $p1) ) ? -1 : 1;
    }

    return ($o == 2) ? -1 : 1;
}

class Graham {
    private $points;
    private $finalPoints = array();

    public function __construct($points=null) {
        $this->points = $points;
    }

    public function nextToTop( &$stack ) {
        $point = $stack->top();
        $stack->pop();
        $res = $stack->top();
        $stack->push($point);
        return $res;
    }

    public function swap( &$p1, &$p2 ) {
        $temp = $p1;
        $p1 = $p2;
        $p2 = $temp;
    }

    public function convexHull() {
        $ymin = $this->points[0]->getY();
        $min = 0;

        for($i = 1; $i<count($this->points); $i++) {
            $y = $this->points[$i]->getY();

            if(($y < $ymin) || ($ymin == $y && $this->points[$i]->getX() < $this->points[$min]->getX())) {
                $ymin = $this->points[$i]->getY();
                $min = $i;
            }
        }

        $this->swap($this->points[0], $this->points[$min]);

        $GLOBALS['p0'] = $this->points[0];

        usort($this->points, "cmp");

        $m = 1;
        for($i = 1; $i<count($this->points); $i++) {

            while( $i<count($this->points)-1 && orientation($GLOBALS['p0'], $this->points[$i], $this->points[$i+1]) == 0 ) {
                $i++;
            };

            $this->points[$m] = $this->points[$i];
            $m++;
        }

        if($m < 3) return;

        $S = new Stack();
        $S->push($this->points[0]);
        $S->push($this->points[1]);
        $S->push($this->points[2]);

        for($i=3; $i < count($this->points); $i++) {
            while( $S->size()>1 && orientation( $this->nextToTop($S), $S->top(), $this->points[$i] ) != 2 ) {
                $S->pop();
            }
            $S->push($this->points[$i]);
        }

        while(!$S->empty()) {
            $p = $S->top();
            array_push($this->finalPoints, $p);
            $S->pop();
        }
    }

    public function getFinalPoints() {
        return $this->finalPoints;
    }

}

?>
