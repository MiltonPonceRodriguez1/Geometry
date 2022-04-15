<?php 

require_once "Point.php";
/**
 * 
 */
class Node {
	public $point;
	public $left;
	public $right;

	function __construct(Point $point) {
		$this->point = $point;
	}
}