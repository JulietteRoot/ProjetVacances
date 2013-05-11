<?php
namespace entity;

use entity\Client;
use entity\Hebergement;

class Location {

    // si les noms d'attributs sont différents du champ en base, il faut faire des alias.
    
    private $id;
    private $numero;
    private $dateDebut;
    private $dateFin;
    private $reglement;
    private $client;
    private $hebergement;
    
    function __construct($numero, $dateDebut, $dateFin, $reglement, Client $client, Hebergement $hebergement, $id = null) { // Attention, pas de guillements à null
        $this->id = $id;
        $this->numero = $numero;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->reglement = $reglement;
        $this->client = $client;
        $this->hebergement = $hebergement;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

   public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function getReglement() {
        return $this->reglement;
    }

    public function getClient() {
        return $this->client;
    }
    
    public function getHebergement() {
        return $this->hebergement;
    }

    public function __toString() {
        return "$this->id $this->numero $this->dateDebut $this->dateFin $this->reglement $this->client $this->hebergement"; // cf __toString() sur le client
    }

}

?>