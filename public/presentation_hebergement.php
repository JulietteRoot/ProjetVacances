<?php
include '../setup.php';

use entity\Appartement;
use entity\Villa;

session_start();

$hebergement = $_SESSION['hebergement']; // attention, peut-être soit un objet appartement, soit un objet villa
if ( $hebergement instanceof Villa) {
    $type = 'villa';
} elseif ($hebergement instanceof Appartement) {
    $type = 'appartement';
} else {
    // On pourrait faire une fonction pour renvoyer une Exception ici...
    header("location:/ProjetVacances/public/error.php"); 
}
//var_dump($hebergement);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/style.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <?php if(strcmp($type, "appartement") == 0) : //alternative, pour comparer 2 chaines de caractères. Renvoie zéro si elles sont identiques ?>
            <h1>Appartement à <?php echo $hebergement->getVille();?></h1>
            <p><?php echo $hebergement->getDescriptif();?></p>
            <p><?php echo "{$hebergement->getCapacite()}m², étage N°{$hebergement->getEtage()}, {$hebergement->getTarifJour()} € par jour" ?></p>
            
        <?php else : ?>
            <h1>Villa à <?php echo $hebergement->getVille();?></h1>
            <p><?php echo $hebergement->getDescriptif();?></p>
            <p><?php echo "{$hebergement->getCapacite()}m², piscine de {$hebergement->getSurfacePiscine()}m2, {$hebergement->getTarifJour()} € par jour"; ?></p>
        <?php endif; ?>
            
            <ul>Les services inclus sont :
                <?php foreach ($_SESSION['services_inclus'] as $service): ?>
                    <li><?php echo $service->getIntitule(); ?></li>
                <?php endforeach; ?>
            </ul>
    </body>
</html>
