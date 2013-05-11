<?php
namespace entity;

abstract class Hebergement { // pas d'instance directe d'hébergement

    protected $id;
    protected $capacite;
    protected $tarifJour;
    protected $numero;
    protected $ville;
    protected $descriptif;
    protected $image;
    protected $cadre;
    protected $servicesInclus = array();
    protected $servicesOptions = array();

    function __construct($capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id = null) {
        $this->id = $id;
        $this->capacite = $capacite;
        $this->tarifJour = $tarifJour;
        $this->numero = $numero;
        $this->ville = $ville;
        $this->descriptif = $descriptif;
        $this->image = $image;
        $this->cadre = $cadre;
    }

    public function getId() {
        return $this->id;
    }

    public function getCapacite() {
        return $this->capacite;
    }

    public function getTarifJour() {
        return $this->tarifJour;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getDescriptif() {
        return $this->descriptif;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCadre() {
        return $this->cadre;
    }

    public function getServicesInclus() {
        return $this->servicesInclus;
    }

    public function getServicesOptions() {
        return $this->servicesOptions;
    }

    public function __toString() {
        return "$this->id $this->capacite $this->tarifJour $this->numero $this->ville $this->descriptif $this->image $this->cadre";
    }
    
}

?>