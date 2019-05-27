<?php
session_start();
if(isset($_POST) && !empty($_POST) && $_POST['client'] != "" && $_POST['domain'] != ""){
  require('../modele/DbConnection.php');
  require('../modele/domain_name_modele.php');

  $db = myPDO::getInstance();
  $domain_name = new Domain_Name($db);
  $liste_domain_name = $domain_name->insertReservation($_POST['client'],$_POST['domain']);
  $_SESSION['flash']['success'] = "Réservation effectuée";
  header('Location: ../vue/index.php');
  exit;
}else{
  $_SESSION['flash']['error'] = "Impossible d'effectuer la réservation";
  header('Location: ../vue/index.php');
  exit;
}
