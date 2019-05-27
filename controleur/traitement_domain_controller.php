<?php
session_start();
//si on soumet un formulaire
print_r($_POST);
if(isset($_POST) && !empty($_POST)){
  if(isset($_POST['type'])){
    require('../modele/DbConnection.php');
    require('../modele/domain_name_modele.php');
    if($_POST['type'] == "create"){
      //si on soumet les données de soumission d'un nom de domaine
      if(isset($_POST['domain_name']) && isset($_POST['domain_name'])
      && $_POST['domain_name'] != "" && $_POST['domain_price'] != ""){
        $domain_name = $_POST['domain_name'];
        $domain_price = $_POST['domain_price'];

        //on récupère le singleton de la BDD
        $db = myPDO::getInstance();
        $domain_name_obj = new Domain_Name($db);

        //on insère le nom de domaine
        $liste_domain_name = $domain_name_obj->insertDomain($domain_name,$domain_price);
        $_SESSION['flash']['success'] = "Nom de domaine ajouté à la base de données";
        header('Location: ../vue/index.php');
        exit;
      }else{
        $_SESSION['flash']['error'] = "Impossible d'ajouter le nom de domaine";
        header('Location: ../vue/index.php');
        exit;
      }
    }elseif ($_POST['type'] == 'delete') {
      $domain_name = $_POST['domain'];

      //on récupère le singleton de la BDD
      $db = myPDO::getInstance();
      $domain_name_obj = new Domain_Name($db);

      //on supprime le nom de domaine
      $liste_domain_name = $domain_name_obj->deleteDomain($domain_name);
      $_SESSION['flash']['success'] = "Nom de domaine supprimé de la base de données";
      header('Location: ../vue/index.php');
      exit;
    }elseif ($_POST['type'] == 'modify') {
      $domain_id = $_POST['id_domain'];
      $domain_name = $_POST['domain_name'];
      $client = $_POST['client'];
      $domain_price = $_POST['domain_price'];

      //on récupère le singleton de la BDD
      $db = myPDO::getInstance();
      $domain_name_obj = new Domain_Name($db);

      //on met à jour le nom de domaine
      $liste_domain_name = $domain_name_obj->updateDomain($domain_id,$domain_name,$domain_price,$client);
      $_SESSION['flash']['success'] = "Nom de domaine correctement modifié";
      header('Location: ../vue/index.php');
      exit;

    }else{
      $_SESSION['flash']['error'] = "Impossible d'ajouter le nom de domaine : action inconnue";
      header('Location: ../vue/index.php');
      exit;
    }
  }
}else{
  $_SESSION['flash']['error'] = "Impossible d'effectuer l'opération demandée";
  header('Location: ../vue/index.php');
  exit;
}
