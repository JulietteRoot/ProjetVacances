<?php
namespace entity;

use entity\Hebergement;

final class Villa extends Hebergement{ // final on ne peut pas hériter de cette class
    private $surfacePiscine;


public function __construct($surfacePiscine, $capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id = null) {
    parent::__construct($capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id);
    $this->surfacePiscine = $surfacePiscine;
}

public function getSurfacePiscine(){
    return $this->surfacePiscine;
}
        
public function __toString() {
    return parent::__toString()."$this->surfacePiscine";
}


 }

?>
