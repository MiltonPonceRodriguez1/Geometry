<?php 

require_once "Node.php";
require_once "Point.php";
/**
 * 
 */
class Tree {
	private $root;
	private $by;
	private $points_rect = array();
	public $cont = 0;

	function __construct(string $by) {
		$this->by = $by;
	}

	public function construct(array $points) {
		
		sort($points); // Aca falta poner que lo ordene por el by

		//var_dump($points);die();
		$this->root = 	$this->utilConstruct($points);
	}

	private function utilConstruct(array $points) {
		if (count($points) == 0) {
			return null;
		} elseif (count($points) == 1) {
			//$node = new Node($points[0], $points);
			return new Node($points[0], $points);
		} else {
			$med = intdiv(count($points), 2);

			$point = $points[$med];
			$p1 = $this->copyOfRange($points, 0, $med);
			$p2 = $this->copyOfRange($points, $med + 1, count($points));
			
			$u = new Node($point, $points);
			$t1 = $this->utilConstruct($p1);
			$t2 = $this->utilConstruct($p2);

			$u->left = $t1;
			$u->right = $t2;

			return $u;
		}
	}

	public function isLeaf(Node $root) {
		if($root == null || ($root->left == null && $root->right == null)) {
			return true;
		} 
		return false;
	}

	private function copyOfRange(array $array, int $from, int $to) {
		$aux = array();
		for($i = $from; $i  < $to; $i++) { 
			array_push($aux, $array[$i]);
		}

		return $aux;
	}

	public function getRoot() {
		return $this->root;
	}

	public function inOrden($node) {
		
    	if ($node == null) {
        	return ;
    	}

    	/* first recur on left child */
    	$this->inOrden($node->left);
 
    	/* then print the data of $node */
    	echo  $node->point->getX()." ";
 
    	/* now recur on right child */
    	$this->inOrden($node->right);
	}

	public function query2D($node, Point $p1, Point $p2) {
		$this->cont += 1;
		if ($node == null) {
        	return ;
    	}

		if(
			($node->point->getX() >= $p1->getX() && $node->point->getX() <= $p2->getX()) && 
			($node->point->getY() >= $p1->getY() && $node->point->getY() <= $p2->getY())
		) {
			//echo "Si entro CHIDO xd!<br/>";
			array_push($this->points_rect, $node->point);
		}
		
 
    	/* first recur on left child */
    	$this->query2D($node->left, $p1, $p2);
 
    	/* then print the data of $node */
    	//echo  $node->point->getX()." ";
 
    	/* now recur on right child */
    	$this->query2D($node->right, $p1, $p2);
	}


	public function getPointsRect(){
		return $this->points_rect;
	}
}

