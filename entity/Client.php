<?php
namespace entity;

class Client {

    private $id; // clé en base, technique
    private $nom;
    private $prenom;
    private $numero; // clé métier
    private $locations= array(); // sera un tableau, on l'initialise tout de suite

    public function __construct($nom, $prenom, $numero, $id = null) { // les paramètres valorisés doivent être à la fin
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero = $numero;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getLocations() {
        return $this->locations;
    }

    public function __toString() {
        return "$this->id $this->nom $this->prenom $this->numero $this->locations"; // locations est 1 tableau, ça affichera sans doute "array", pas forcément utile
    }

    
    // EN PHP, on ne peut pas construire des personnes de différentes façons (une avec juste $nom et $numero, une autre avec $nom et $prenom...)
    // Pour avoir un constructeur "à la carte", on va utiliser des méthodes de fabrique statiques.
    // + pour que fetchObjet() fonctionne correctement, il faut un constructeur vide
//    public static function createPersonne($nom, $prenom, $numero){
//        $client = new Client(); // le constructeur de l'objet au départ est vide
//        $client->nom = $nom;
//        $client->prenom = $prenom;
//        $client->numero = $numero;
//        return $client;
//    }
//    public static function createPersonneById($id, $nom, $prenom, $numero){
//        $client = new Client();
//    	  $client->id = $id;
//        $client->nom = $nom;
//        $client->prenom = $prenom;
//        $client->numero = $numero;
//        return $client;
//}

}

?>
