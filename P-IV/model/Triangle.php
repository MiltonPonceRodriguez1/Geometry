<?php

include_once 'Helpers.php';

class Triangle {

    private $a;
    private $b;
    private $c;
    private $edges = array();
    private $circumcenter;

    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;

        array_push( $this->edges, array($this->a, $this->b), array($this->b, $this->c), array($this->c, $this->a) );

        $this->circumcenter = Helpers::circumcenter($a, $b, $c);
    }

    public function is_point_in_circumcircle($point) {
        if(
            Helpers::distance($this->a, $this->circumcenter) >
            Helpers::distance($point, $this->circumcenter)
        ){
            return true;
        }
        return false;
    }

    public function has_vertex($point) {
        if(
            Helpers::compare_points($this->a, $point) ||
            Helpers::compare_points($this->b, $point) ||
            Helpers::compare_points($this->c, $point)
        ) {
            return true;
        }
        return false;
    }

    public function show() {
        foreach ($this->edges as $edge) {
            echo '[0]: ['.$edge[0]->get_X().', '.$edge[0]->get_Y().'], '. '[1]: ['.$edge[1]->get_X().', '.$edge[1]->get_Y().'] <br><br>';
        }
    }

    public function get_edges() {
        return $this->edges;
    }

    public function get_a() {
        return $this->a;
    }

    public function get_b() {
        return $this->b;
    }

    public function get_c() {
        return $this->c;
    }


}

?>