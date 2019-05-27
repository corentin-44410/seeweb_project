<?php
	require_once 'DbConnection.php';

	class Client {

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
		public function getAllClient(){
			$req = $this->_db->prepare("SELECT * FROM client");
			$req->execute();
			return $req->fetchAll();
		}

		/*****************************************/
		/* On récupère tous les noms de domaines */
		/*****************************************/
		public function getClientDetails($id){
			$req = $this->_db->prepare("SELECT * FROM client where id = ?");
			$req->execute([$id]);
			return $req->fetchAll();
		}


		/************************************************************/
		/* On insère un nouveau client                              */
		/************************************************************/
		public function insertClient($name,$surname,$society){
			try{
				$name = htmlentities($name);
				$surname = htmlentities($surname);
				$society = htmlentities($society);
				$req = $this->_db->prepare("INSERT INTO client(nom,prenom,societe) VALUES(?,?,?)");
				$req->execute([$name,$surname,$society]);
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de l\'insertion dans la base de données';
			}
		}

		/************************************************************/
		/* On modifie un client                                     */
		/************************************************************/
		public function updateClient($id,$name,$surname,$society){
			try{
				$id = htmlentities($id);
				$name = htmlentities($name);
				$surname = htmlentities($surname);
				$society = htmlentities($society);
				$req = $this->_db->prepare("UPDATE client SET nom = ? , prenom = ?, societe = ? WHERE id = ?");
				$req->execute([$name,$surname,$society,$id]);
			} catch (PDOException $e) {
					$_SESSION['flash']['danger'] = 'Échec lors de l\'insertion dans la base de données';
			}
		}
}
