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

	public function getX() {
		return $this->x;
	}

	public function setX(float $x) {
		$this->x = $x;
	}

	public function getY() {
		return $this->y;
	}

	public function setY(float $y) {
		$this->y = $y;
	}
}