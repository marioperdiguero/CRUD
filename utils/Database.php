<?php 

/**
* Clase que permite la conexión a una base de datos MySQL utilizando la extensión PDO.
*/
class DataBase {

  /**
  * @var string El nombre de usuario utilizado para la conexión a la base de datos.
  */
  private $username;

  /**
  * @var string La contraseña utilizada para la conexión a la base de datos.
  */
  private $password;

  /**
  * @var string La dirección del servidor de la base de datos.
  */
  private $host;

  /**
  * @var string El nombre de la base de datos a la que se conectará.
  */
  private $database_name;

  /**
  * @var PDO|null La instancia de PDO utilizada para la conexión a la base de datos.
  */
  public $DB;

  /**
  * Constructor de la clase.
  * 
  * @param string $username El nombre de usuario utilizado para la conexión a la base de datos.
  * @param string $password La contraseña utilizada para la conexión a la base de datos.
  * @param string $host La dirección del servidor de la base de datos.
  * @param string $database_name El nombre de la base de datos a la que se conectará.
  */
  function __construct($username, $password, $host, $database_name) {
    $this->username = $username;
    $this->password = $password;
    $this->host = $host;
    $this->database_name = $database_name;
  }

  /**
  * Conecta a la base de datos utilizando los valores proporcionados en el constructor.
  *
  * @return boolean true si la conexión fue exitosa, false en caso contrario.
  */
  function connect() {
    try {
      $this->DB = new PDO("mysql:host=$this->host;dbname=$this->database_name", $this->username, $this->password);
      $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

}

?>