<?php
require('../modele/DbConnection.php');
require('../modele/client_modele.php');

$db = myPDO::getInstance();
$client = new Client($db);
$liste_domain_name = $client->getAllClient();

if(isset($_GET) && sizeof($_GET)>0){
  $client_details = $client->getClientDetails($_GET['client'])[0];
}
