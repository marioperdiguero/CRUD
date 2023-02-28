<?php 

include_once 'Database.php';
include_once 'Exceptions.php';
include_once 'Request.php';
include_once 'middlewares/MaintenanceMiddleware.php';

$dataBase = new DataBase('root', '', 'localhost', 'crud');

if(!$dataBase->connect()) {  
    Exceptions::databaseConnectionError();
}

$errorHandler = new Exceptions($dataBase->DB);

$route = explode('/', $_SERVER['REQUEST_URI']);
$route = array_slice($route, 2);

$date = date('d/m/Y');

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    // Si la dirección IP del cliente está disponible a través de la cabecera HTTP_CLIENT_IP
    $client_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // Si la dirección IP del cliente está disponible a través de la cabecera HTTP_X_FORWARDED_FOR
    $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    // Si la dirección IP del cliente no está disponible a través de ninguna de las cabeceras anteriores
    $client_ip = $_SERVER['REMOTE_ADDR'];
}

$request = new Request($route, null, $date, $client_ip, $errorHandler);

$middleware = [
    new MaintenanceMiddleware(),
];

foreach ($middleware as $m) {
    $m->handle($request);
}

?>