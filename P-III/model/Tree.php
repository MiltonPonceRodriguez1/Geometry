<?php 

require_once "Node.php";
require_once "Point.php";
/**
 * 
 */
class Tree {
	private $root;
	private $neighbor;
	private $best_dist;

	function __construct($node, Point $point ) {
		if($node == null) {
			$this->root = new Node($point);
		}

		$this->best_dist = 99999;
	}

	public function getRoot() {
		return $this->root;
	} 

	public function insert($node, Point $point, $depth=0) {
		// CASO BASE
		if($node == null) {
			return new Node($point);
		}
	
		$axis = $depth % 2;
	
		if($axis == 0) { // SE PRIORIZA EL EJE DE LAS X
			if($point->getX() < $node->point->getX()) {
				//echo "ENTRO A MENOR";
				$node->left = $this->insert($node->left, $point, $depth + 1);
			} else {
				//echo "ENTRO A MAYOR";
				$node->right = $this->insert($node->right, $point, $depth + 1);
			}
		} else { // SE PRIORIZA EL EJE DE LAS Y
			if($point->getY() < $node->point->getY()) {
				$node->left = $this->insert($node->left, $point, $depth + 1);
			} else {
				$node->right = $this->insert($node->right, $point, $depth + 1);
			}
		}
	
		return $node;
	}

	public function assign_axis($node, $depth=0) {
		// CASO BASE
		if($node == null) {
			return;
		}
	
		$axis = $depth % 2;

		$this->assign_axis($node->left, $depth + 1);
		if($axis == 0) { // SE PRIORIZA EL EJE DE LAS X
			$node->point->setAxis("y");
		} else { // SE PRIORIZA EL EJE DE LAS Y
			$node->point->setAxis("x");
		}
		$this->assign_axis($node->right, $depth + 1);
	}

	public function search_neighbor($node, $point, $depth = 0) {
		if($node == null) {
			return;
		}
		
		$local_dist = $this->dist_btw($node->point, $point);
		
		if($local_dist < $this->best_dist) {
			$this->neighbor = $node->point;
			$this->best_dist = $local_dist;
		}
	
		$axis = $depth % 2;
	
		if($axis == 0) {
			if($point->getX() < $node->point->getX()) {
				return $this->search_neighbor($node->left, $point, $depth+1);
			}
			return $this->search_neighbor($node->right, $point, $depth+1);
	
		} elseif($axis == 1) {
			if($point->getY() < $node->point->getY()) {
				return $this->search_neighbor($node->left, $point, $depth+1);
			}
			return $this->search_neighbor($node->right, $point, $depth+1);
		}
	
	}

	public function printInOrder($node) {

		if(is_null($node)) {
			return;
		}
	
		$this->printInOrder($node->left);
	
		echo '  ('.$node->point->getX().' , '.$node->point->getY().') <br>';
	
		$this->printInOrder($node->right);
	}

	public function dist_btw(Point $p1, Point $p2) {
		return sqrt((pow(($p1->getX() - $p2->getX()), 2)) + (pow(($p1->getY() - $p2->getY()), 2)));
	} 

	public function getNeighbor() {
		return $this->neighbor;
	}

}

