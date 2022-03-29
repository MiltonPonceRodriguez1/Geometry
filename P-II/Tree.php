<?php 

require_once "Node.php";
/**
 * 
 */
class Tree {
	private $root;
	private $by;

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
		/*$aux = array();

		if($node->point->getx() >= ...) {
			array_push($aux, $noce->point);
		}*/
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
}

