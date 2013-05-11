<?php
include '../setup.php';

include '../entity/Hebergement.php';
include '../entity/Appartement.php';
include '../entity/Villa.php';
include '../dao/MysqlDao.php';

use dao\MysqlDao;


$dao = new MysqlDao();
//var_dump($dao->getAllHebergementsWithCadre());
//var_dump($dao->getAllHebergements());
var_dump($dao->getHebergementById(2));

?>
