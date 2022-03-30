<?php 

require_once "Point.php";
/**
 * 
 */
class Node {
	public $left;
	public $right;
	public $sub_tree = null;
	public $point;
	public $points;

	function __construct(Point $point, Array $points) {
		$this->point = $point;
		$this->points = $points;
	}
}