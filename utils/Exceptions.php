<?php 

include_once 'Database.php';

/**
* Clase que maneja excepciones y errores HTTP, así como los registros de errores en la base de datos.
*/
class Exceptions {
    
    /**
    * @var PDO La instancia de PDO para conectarse a la base de datos.
    */
    private $db;

    /**
    * Crea una nueva instancia de la clase `Exceptions`.
    *
    * @param PDO La instancia de PDO para conectarse a la base de datos.
    */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
    * Devuelve un mensaje de error HTTP 403 Forbidden.
    *
    * @param string $message Mensaje de error personalizado.
    * @return void
    */
    public function httpForbidden($message = 'Forbidden') {
        header("HTTP/1.1 403 Forbidden");
        self::redirectToErrorPage(403, $message, 'No tiene acceso a este contenido, disculpe las molestias.');
    }

    /**
    * Devuelve un mensaje de error HTTP 404 Not Found.
    *
    * @param string $message Mensaje de error personalizado.
    * @return void
    */
    public function httpNotFound($message = 'Not Found') {
        header("HTTP/1.1 404 Not Found");
        self::redirectToErrorPage(404, $message, 'No se encontró lo que estaba buscando, disculpe las molestias.');
    }

    /**
    * Devuelve un mensaje de error HTTP 500 Internal Server Error.
    *
    * @param string $message Mensaje de error personalizado.
    * @return void
    */
    public function httpInternalServerError($message = 'Internal Server Error') {
        header("HTTP/1.1 500 Internal Server Error");
        self::redirectToErrorPage(500, $message, 'Hubo un error en el servidor, disculpe las molestias.');
    }

    /**
    * Devuelve un mensaje de error de conexión a la base de datos.
    *
    * @param string $message Mensaje de error personalizado.
    * @return void
    */
    public static function databaseConnectionError($message = 'Database Connection Error') {
        header("HTTP/1.1 500 Internal Server Error");
        $response = ['error' => $message];
        echo json_encode($response);
        exit();
    }

    /**
    * Guarda el registro de errores en la base de datos.
    *
    * @param int $code Código de error HTTP.
    * @param string $message Mensaje de error.
    * @return void
    */
    public function saveErrorLog($code, $message) {
        // STMT -> Statement
        $stmt = $this->db->prepare('INSERT INTO errors_logs (URL, HTTP_Code, Error) VALUES (:url, :code, :error)');
        $params = array(':url' => $_SERVER['REQUEST_URI'], ':code' => $code, ':error' => $message);
        $stmt->execute($params);
    }

    /**
    * Redirige al usuario a la página de error correspondiente y guarda el registro en la base de datos.
    *
    * @param int $code Código de error HTTP.
    * @param string $error_message Mensaje de error.
    * @param string $error_client_message Mensaje de error para el cliente.
    * @return void
    */
    public function redirectToErrorPage($code, $error_message, $error_client_message) {
        self::saveErrorLog($code, $error_message);
        include('pages/errors.php');
        exit();
    }

}

?>