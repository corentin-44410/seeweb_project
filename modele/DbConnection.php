<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

/**
 * Classe avec modèle Singleton pour un accès à la base de données
 * MySQL avec la classe PDO
 */
class myPDO{

  private $PDOInstance = null;
  private static $instance = null;

  /**
   * Identifiants de connexion
   */
  const DB_USER = 'root';
  const DB_HOST = 'localhost';
  const DB_PASS = '';
  const DB_NAME = 'seeweb_db';

  /**
   * Consctructeur de la classe
   */
  private function __construct(){
    try{
      $this->PDOInstance = new PDO('mysql:dbname='.self::DB_NAME.';host='.self::DB_HOST,self::DB_USER ,self::DB_PASS);
    } catch (PDOException $e) {
        $_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
    }
  }

  /**
   * Fonction retournant l'unique instance de connexion
   */
  public static function getInstance(){
    if(is_null(self::$instance))
    {
      self::$instance = new myPDO();
    }
    return self::$instance;
  }

  /**
   * Fcontion permettant d'éxecuter une requête SQL passée en paramètre
   * @param $query la requête à executer
   */
  public function query($query){
    try{
      if($this->PDOInstance != null){
        return $this->PDOInstance->query($query);
      }else{
        throw new Exception('Impossible d\'éxécuter la requête');
      }
    } catch (PDOException $e) {
        $_SESSION['flash']['danger'] = 'Échec lors de la connexion à la base de données';
    }
  }

  /**
   * Fcontion permettant d'éxecuter une requête préparée SQL passée en paramètre
   * @param $query la requête à executer
   */
  public function prepare($query){
    try{
      if($this->PDOInstance != null){
        return $this->PDOInstance->prepare($query);
      }else{
        throw new Exception('Impossible d\'éxécuter la requête');
      }
    }catch (PDOException $e) {
        echo 'Échec lors de la connexion à la base de données';
    }
  }
}
