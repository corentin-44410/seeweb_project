<?php
require('../modele/DbConnection.php');
require('../modele/domain_name_modele.php');

$db = myPDO::getInstance();
$domain_name = new Domain_Name($db);
$liste_domain_name = $domain_name->getAllDomain();
$liste_client = $domain_name->getAllClient();

if(isset($_GET) && sizeof($_GET)>0){
  $domain_details = $domain_name->getDomainDetails($_GET['domain'])[0];
}
