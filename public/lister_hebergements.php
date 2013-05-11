<?php
include '../setup.php';

session_start();

$appartements = $_SESSION['appartements'];
$villas = $_SESSION['villas'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/style.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        
        <form action="/ProjetVacances/controller/presentation_hebergement_controller.php" method="POST" id="hebergement" name="hebergement">
            <fieldset>
                <legend>Appartements</legend>
                <?php foreach($appartements as $appartement): ?>
                    <input type="radio" name="id" value="<?php echo $appartement->getId() ?>"> <?php echo "{$appartement->getVille()}, {$appartement->getCapacite()}m², étage N°{$appartement->getEtage()}, {$appartement->getTarifJour()} € par jour"; ?><br>
                <?php endforeach; ?>
            </fieldset>
            
            <fieldset>
                <legend>Villas</legend>
                <?php foreach($villas as $villa): ?>
                    <input type="radio" name="id" value="<?php echo $villa->getId() ?>"> <?php echo "{$villa->getVille()}, {$villa->getCapacite()}m², piscine de {$villa->getSurfacePiscine()}m2, {$villa->getTarifJour()} € par jour"; ?><br>
                <?php endforeach; ?>
            </fieldset>
            <input id="validation" type="submit" value="valider"> <input id="annulation" type="reset" value="annuler">
        </form>
        
    </body>
</html>
