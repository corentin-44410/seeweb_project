<?php
	require_once 'DbConnection.php';

	clASs Domain_Name {

    private $_db;

		/****************/
		/* Constructor */
		/****************/
		public function __construct($db){
			$this->setDb($db);
		}


		/**********/
		/* Setter */
		/**********/
		public function setDb($db){
			$this->_db = $db;
		}

		/*****************************************/
		/* On récupère tous les noms de domaines */
		/*****************************************/
		public function getAllDomain(){
			$req = $this->_db->prepare("SELECT nom_domaine.id AS id, nom_domaine.nom AS nom, nom_domaine.cout_annuel,
nom_domaine.leClient, client.id AS idClient, client.societe, client.prenom AS prenomClient,client.nom AS nomClient
FROM nom_domaine left join client ON  nom_domaine.leClient = client.id order by id");
			$req->execute();
			return $req->fetchAll();
		}

		/*****************************************/
		/* On récupère tous les clients          */
		/*****************************************/
		public function getAllClient(){
			$req = $this->_db->prepare("SELECT nom, prenom, id from client");
			$req->execute();
			return $req->fetchAll();
		}

		/*****************************************/
		/* On récupère les détails d'un domaine  */
		/*****************************************/
		public function getDomainDetails($id){
			$req = $this->_db->prepare("SELECT nom_domaine.id AS id, nom_domaine.nom AS nom, nom_domaine.cout_annuel,
			nom_domaine.leClient, client.id AS idClient, client.societe, client.prenom AS prenomClient,client.nom AS nomClient
			FROM nom_domaine left join client ON  nom_domaine.leClient = client.id WHERE nom_domaine.id = ?");
			$req->execute([$id]);
			return $req->fetchAll();
		}

		/************************************************************/
		/* On récupère les noms de domaines ressemblant au mot clé  */
		/************************************************************/
		public function getDomainByKeywords($keywords){
			$keywords = htmlentities($keywords);
			// echo ("SELECT nom_domaine.nom FROM nom_domaine WHERE nom_domaine.nom LIKE '%$keywords%' order by id");
			$req = $this->_db->prepare("SELECT nom_domaine.id, nom_domaine.nom  FROM nom_domaine WHERE nom_domaine.nom LIKE '%$keywords%' order by id LIMIT 5");
			$req->execute();
			return $req->fetchAll();
		}

		/************************************************************/
		/* On insère la reservation du client                       */
		/************************************************************/
		public function insertReservation($client,$domain){
			try{
				$domain = htmlentities($domain);
				$client = htmlentities($client);
				$req = $this->_db->prepare("UPDATE nom_domaine SET leClient = ? WHERE id = ? ");
				$req->execute([$client,$domain]);
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
			}
		}

		/************************************************************/
		/* On insère un nouveau nom de domaine                      */
		/************************************************************/
		public function insertDomain($domain_name,$price){
			try{
				$domain_name = htmlentities($domain_name);
				$price = htmlentities($price);
				$req = $this->_db->prepare("INSERT INTO nom_domaine(nom,cout_annuel) VALUES(?,?)");
				$req->execute([$domain_name,$price]);
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
			}
		}

		/************************************************************/
		/* On insère un nouveau nom de domaine                      */
		/************************************************************/
		public function insertDomainClient($domain_name,$price,$client){
			try{
				$domain_name = htmlentities($domain_name);
				$price = htmlentities($price);
				$client = htmlentities($client);
				$req = $this->_db->prepare("INSERT INTO nom_domaine(nom,cout_annuel,leClient) VALUES(?,?,?)");
				$req->execute([$domain_name,$price,$client]);
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
			}
		}

		/************************************************************/
		/* On insère un nouveau nom de domaine                      */
		/************************************************************/
		public function insertClient($nom,$prenom){
			try{
				$domain_name = htmlentities($domain_name);
				$price = htmlentities($price);
				$req = $this->_db->prepare("INSERT INTO nom_domaine(nom,cout_annuel) VALUES(?,?)");
				$req->execute([$domain_name,$price]);
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
			}
		}

		/************************************************************/
		/* On insère un nouveau nom de domaine                      */
		/************************************************************/
		public function deleteDomain($domain_name){
			try{
				$domain_name = htmlentities($domain_name);
				$req = $this->_db->prepare("DELETE FROM nom_domaine WHERE id = ?");
				$req->execute([$domain_name]);

			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
			}
		}

		/************************************************************/
		/* On insère un nouveau nom de domaine                      */
		/************************************************************/
		public function updateDomain($domain_id,$domain_name, $domain_price, $client){
			try{
				$domain_id = htmlentities($domain_id);
				$domain_name = htmlentities($domain_name);
				$domain_price = htmlentities($domain_price);
				$client = htmlentities($client);
				if($client == '0'){
					$req = $this->_db->prepare("UPDATE nom_domaine SET nom = ?, cout_annuel = ?, leClient = NULL WHERE id = ?");
					$req->execute([$domain_name,$domain_price,$domain_id]);
				}else{
					$req = $this->_db->prepare("UPDATE nom_domaine SET nom = ?, cout_annuel = ?, leClient = ? WHERE id = ?");
					$req->execute([$domain_name,$domain_price,$client,$domain_id]);
				}
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
			}
		}
}
