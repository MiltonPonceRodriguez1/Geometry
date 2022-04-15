<?php

include_once 'punto-J.php';

class Nodo {

    private $punto;
    private $nodoIzq;
    private $nodoDer;
    private $mejorVecino;
    private $mejorDistancia;

    public function __construct(Punto $p) {
        $this->punto = $p;
        $this->nodoIzq = null;
        $this->nodoDer = null;
        $this->mejorDistancia = 9999;
    }

    public function get_Punto() {
        return $this->punto;
    }

    public function get_Vecino() {
        return $this->mejorVecino;
    }

    public function set_Vecino($n) {
        $this->mejorVecino = $n;
    }

    public function get_Dist() {
        return $this->mejorDistancia;
    }

    public function set_Dist($n) {
        $this->mejorDistancia = $n;
    }

    public function get_Izq() {
        return $this->nodoIzq;
    }

    public function get_Der() {
        return $this->nodoDer;
    }

    public function set_Izq(Nodo $n) {
        $this->nodoIzq = $n;
    }

    public function set_Der(Nodo $n) {
        $this->nodoDer = $n;
    }

}

function inertar_Rec(Nodo $root=null, Punto $punto, $profundidad) {
    if(is_null($root)) {
        return new Nodo($punto);
    }

    $cd = $profundidad % 2;

    if($cd == 0) {
        if($punto->getX() < $root->get_Punto()->getX()) {
            $root->set_Izq( inertar_Rec($root->get_Izq(), $punto, $profundidad+1) );
        } else {
            $root->set_Der( inertar_Rec($root->get_Der(), $punto, $profundidad+1) );
        }
    } elseif($cd == 1) {
        if($punto->getY() < $root->get_Punto()->getY()) {
            $root->set_Izq( inertar_Rec($root->get_Izq(), $punto, $profundidad+1) );
        } else {
            $root->set_Der( inertar_Rec($root->get_Der(), $punto, $profundidad+1) );
        }
    }

    return $root;
}

function sonLoMismo($puntoA, $puntoB) {
    if($puntoA->getX() == $puntoB->getX() && $puntoA->getY() == $puntoB->getY()){
        return true;
    } else {
        return false;
    }
}

function buscaRec($root=null, Punto $punto, $profundidad) {
    if(is_null($root)) {
        return false;
    }

    if(sonLoMismo($root->get_Punto(), $punto)){
        return true;
    }

    $cd = $profundidad % 2;

    if($cd == 0) {
        if($punto->getX() < $root->get_Punto()->getX()) {
            return buscaRec($root->get_Izq(), $punto, $profundidad+1);
        }
        return buscaRec($root->get_Der(), $punto, $profundidad+1);

    } elseif($cd == 1) {
        if($punto->getY() < $root->get_Punto()->getY()) {
            return buscaRec($root->get_Izq(), $punto, $profundidad+1);
        }
        return buscaRec($root->get_Der(), $punto, $profundidad+1);

    }

    return buscaRec($root->get_Der(), $punto, $profundidad+1);

}

function busca($root=null, Punto $punto) {
    return buscaRec($root, $punto, 0);
}

function insertar(Nodo $root=null, Punto $punto) {
    return inertar_Rec($root, $punto, 0);
}

function printInOrder($nodo) {
    if(is_null($nodo)) {
        return;
    }

    printInOrder($nodo->get_Izq());

    echo '  ('.$nodo->get_Punto()->getX().' , '.$nodo->get_Punto()->getY().')  <br>';

    printInOrder($nodo->get_Der());
}

function calcula_Distancia($puntoA, $puntoB) {
    return sqrt( (pow(($puntoB->getX() - $puntoA->getX()), 2)) + (pow(($puntoB->getY() - $puntoA->getY()), 2)));
}

function busca_vecino_rec($root=null, $punto, &$puntoVecino, &$distanciaMejor, $profundidad=0) {
    if(is_null($root)) {
        return;
    }

    // echo calcula_Distancia($root->get_Punto(), $punto)."<br>";
    var_dump($root->get_Punto());
    if( calcula_Distancia($root->get_Punto(), $punto) < $distanciaMejor ) {
        // echo '<br>XDD';
        // var_dump($root->get_Vecino());
        $puntoVecino = $root->get_Punto();
        $distanciaMejor = calcula_Distancia($root->get_Punto(), $punto);
        // var_dump($root->get_Vecino());
    }

    $cd = $profundidad % 2;

    if($cd == 0) {
        if($punto->getX() < $root->get_Punto()->getX()) {
            return busca_vecino_rec($root->get_Izq(), $punto, $puntoVecino, $distanciaMejor, $profundidad+1);
        }
        return busca_vecino_rec($root->get_Der(), $punto, $puntoVecino, $distanciaMejor, $profundidad+1);

    } elseif($cd == 1) {
        if($punto->getY() < $root->get_Punto()->getY()) {
            return busca_vecino_rec($root->get_Izq(), $punto, $puntoVecino, $distanciaMejor, $profundidad+1);
        }
        return busca_vecino_rec($root->get_Der(), $punto, $puntoVecino, $distanciaMejor, $profundidad+1);

    }

}


$point1 = new Punto(31, 40);
$point2 = new Punto(42, 35);
$point3 = new Punto(19, 50);
$point4 = new Punto(10, 6);
$point5 = new Punto(25, 55);
$point6 = new Punto(57, 53);
$point7 = new Punto(50, 18);

$point8 = new Punto(17, 22);
$point9 = new Punto(45, 52);
$point10 = new Punto(6, 31);
$arrayPuntos = array($point1, $point2, $point3, $point4, $point5, $point6, $point7,
    $point8, $point9, $point10);

$raiz = null;

for($i=0; $i<10; $i++) {
    $raiz = insertar($raiz, $arrayPuntos[$i]);
}

// var_dump($raiz);

// var_dump( busca($raiz, new Punto(10, 2)) );

// var_dump( busca($raiz, new Punto(2, 7)) );

// var_dump(calcula_Distancia($point1, $point2));

printInOrder($raiz);

$mejorVecino = new Punto(0, 0);
$distancia = 9999;

busca_vecino_rec($raiz, new Punto(18, 20), $mejorVecino, $distancia);

var_dump($mejorVecino);
var_dump($distancia);

?>