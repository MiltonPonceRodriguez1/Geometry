<?php
/**
 *
 */
class Point {
	private $x;
	private $y;

	function __construct(float $x, float $y) {
		$this->x = $x;
		$this->y = $y;
	}

	public function get_X() {
        return $this->x;
    }

	public function set_X(float $x) {
		$this->x = $x;
	}

	public function get_Y() {
        return $this->y;
    }

	public function set_Y(float $y) {
		$this->y = $y;
	}

	public function get_json_array() {
        $point_json = array(
            'xValue' => $this->x,
            'yValue' => $this->y
        );
        return $point_json;
    }

}