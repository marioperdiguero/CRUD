<?php 

include_once 'utils/Config.php';
include_once 'controllers/HomeController.php';

switch ($request->getParentRoute()) {
    case 'index':
        HomeController::handle($request);
        break;
    default:
        break;
}

?>