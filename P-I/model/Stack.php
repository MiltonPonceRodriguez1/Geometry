<?php

class Stack {
  public $top;
  public $stack = array();

  function __construct() {
    $this->top = -1;
  }

  public function empty() {
    if($this->top == -1) {
      return true;
    } else {
      return false;
    }
  }

  public function size() {
     return $this->top+1;
  }

  public function push($x) {
    $this->stack[++$this->top] = $x;
  }


  public function pop() {
    if($this->top >= 0) {
      $x = $this->stack[$this->top--];
    }
  }


  public function top() {
    if($this->top >= 0) {
      return $this->stack[$this->top];
    }
  }
}



?>

