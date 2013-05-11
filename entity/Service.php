<?php
namespace entity;

class Service {

    private $id;
    private $intitule;
    private $description;
    private $tarif;
    private $actif; // ce service a-t-il été sélectionné
    
    public function __construct($intitule, $description, $tarif, $actif, $id = null) {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->description = $description;
        $this->tarif = $tarif;
        $this->actif = $actif;
    }

    public function getId() {
        return $this->id;
    }
   
    public function getIntitule() {
        return $this->intitule;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getTarif() {
        return $this->tarif;
    }

    public function getActif() {
        return $this->actif;
    }

    public function setActif($actif) {
        $this->actif = $actif;
    }

    public function __toString() {
        return "$this->id $this->intitule $this->description $this->tarif $this->actif";
    }

}

?>