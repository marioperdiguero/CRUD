<?php 

/**
* La clase HomeController maneja las rutas que dependan de la raíz y devuelve la respuesta correspondiente.
*/
class HomeController {

    /**
    * Maneja las rutas que dependan de la raíz y devuelve la respuesta correspondiente.
    *
    * @param Request $request El objeto de solicitud del usuario.
    * @return void
    */
    public static function handle($request) {
        $resource = $request->getRouteResource();

        if(is_array($resource)) $request->error_handler->httpNotFound("HomeController:0001:".$request->getRequestLog());

        switch ($resource) {
            case 'index':
                self::index();
                break;
            case 'about':
                echo($request->getRequestLog());
                self::about();
                break;
            case 'contact':
                self::contact();
                break;
            default:
                $request->error_handler->httpNotFound("HomeController:0002:".$request->getRequestLog());
                break;
        }
    }

    /**
    * Devuelve la página index.php.
    *
    * @return void
    */
    private static function index() {
        // Return index.php page
    }

    /**
    * Devuelve la página about.php.
    *
    * @return void
    */
    private static function about() {
        // Return about.php page
    }

    /**
    * Devuelve la página contact.php.
    *
    * @return void
    */
    private static function contact() {
        // Return contact.php page
    }

}

?>