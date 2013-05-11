<?php
include '../setup.php';

session_start();

use dao\MysqlDao;

try{
    $dao = new MysqlDao();
    $tab = $dao->getAllHebergements(); // tableau d'hébergements avec sous-tableaux appartements et villas
    $appartements = $tab['appart'];
    $villas = $tab['villa'];
    
    $_SESSION['appartements'] = $appartements; // à la clé 'appartements' le tableau des appartements
    $_SESSION['villas'] = $villas; // à la clé 'villas' le tableau des villas
    
    header("location:/ProjetVacances/public/lister_hebergements.php");

} catch(PDOException $ex){
    // On pourrait mettre un log ici
    //header("location:/ProjetVacances/public/error.php"); // on redirige la personne vers une page d'erreur
    echo $ex->getMessage();
}
?>
