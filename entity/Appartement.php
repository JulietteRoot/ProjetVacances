<?php
namespace entity;

use entity\Hebergement;

final class Appartement extends Hebergement{ // final on ne peut pas hériter de cette class
    private $etage;


public function __construct($etage, $capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id = null) {
    parent::__construct($capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id);
    $this->etage = $etage;
}

public function getEtage(){
    return $this->etage;
}
        
public function __toString() {
    return parent::__toString()."$this->etage";
}


 }

?>
