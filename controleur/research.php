<?php
if(isset($_GET['keywords']) && $_GET['keywords'] != ""){
  require('../modele/DbConnection.php');
  require('../modele/domain_name_modele.php');

  $db = myPDO::getInstance();
  $domain_name = new Domain_Name($db);
  $keywords = $_GET['keywords'];
  $liste_domain_name_by_keywords = $domain_name->getDomainByKeywords($keywords);
  // print_r($liste_domain_name_by_keywords);
  echo JSON_encode($liste_domain_name_by_keywords);
}else{
  echo JSON_encode('Aucun nom de domaine trouvé');
}
