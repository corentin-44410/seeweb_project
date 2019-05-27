<?php
session_start();
print_r($_POST);
//si on soumet un formulaire
if(isset($_POST) && !empty($_POST)){
  if(isset($_POST['type'])){
    require('../modele/DbConnection.php');
    require('../modele/client_modele.php');
    if($_POST['type'] == "create"){
      //si on soumet les données de soumission d'un nom de cliente
      if(isset($_POST['client_name']) && isset($_POST['client_society']) && isset($_POST['client_surname'])
      && $_POST['client_name'] != "" && $_POST['client_surname'] != "" && $_POST['client_society'] != ""){

        $nom = $_POST['client_name'];
        $prenom = $_POST['client_surname'];
        $societe = $_POST['client_society'];

        //on récupère le singleton de la BDD
        $db = myPDO::getInstance();
        $client_obj = new Client($db);

        //on insère le nom de cliente
        $liste_client_name = $client_obj->insertClient($nom,$prenom,$societe);
        $_SESSION['flash']['success'] = "Client ajouté à la base de données";
        header('Location: ../vue/index.php');
        exit;
      }else{
        $_SESSION['flash']['error'] = "Impossible d'ajouter le client";
        header('Location: ../vue/index.php');
        exit;
      }
    }elseif ($_POST['type'] == 'modify') {
      $client_id = $_POST['id_client'];
      $client_name = $_POST['client_name'];
      $client_surname = $_POST['client_surname'];
      $client_society = $_POST['client_society'];

      //on récupère le singleton de la BDD
      $db = myPDO::getInstance();
      $client_obj = new Client($db);

      //on met à jour le nom de cliente
      $liste_client_name = $client_obj->updateClient($client_id,$client_name,$client_surname,$client_society);
      $_SESSION['flash']['success'] = "Client correctement modifié";
      header('Location: ../vue/index.php');
      exit;

    }else{
      $_SESSION['flash']['error'] = "Impossible d'ajouter le client : action inconnue";
      header('Location: ../vue/index.php');
      exit;
    }
  }
}else{
  $_SESSION['flash']['error'] = "Impossible d'effectuer l'opération demandée";
  header('Location: ../vue/index.php');
  exit;
}
