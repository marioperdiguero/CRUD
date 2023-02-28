<?php 

class Request {

    /**
    * @var array El array que contiene la ruta a la que se accede.
    */
    private $route;

    /**
    * @var string|null El token de autenticación o null si no se proporciona.
    */
    private $auth_token;

    /**
    * @var string|null La fecha de la solicitud o null si no se proporciona.
    */
    private $date;

    /**
    * @var string|null La dirección IP del cliente o null si no se proporciona.
    */
    private $client_ip;

    /**
    * @var Exceptions El objeto de manejo de errores de la aplicación.
    */
    public $error_handler;

    /**
     * Constructor de la clase que inicializa los parámetros de la instancia.
     *
     * @param array $route La ruta a la que se accede.
     * @param string|null $auth_token El token de autenticación o null si no se proporciona.
     * @param string|null $date La fecha de la solicitud o null si no se proporciona.
     * @param string|null $client_ip La dirección IP del cliente o null si no se proporciona.
     * @param Exceptions $error_handler El objeto de manejo de errores de la aplicación.
     * @throws InvalidArgumentException Si alguno de los parámetros no es válido.
    */
    function __construct($route, $auth_token, $date, $client_ip, $error_handler) {
        if (empty($route)) {
            throw new InvalidArgumentException("La ruta no puede estar vacía.");
        }
        if (!is_string($auth_token) && !is_null($auth_token)) {
            throw new InvalidArgumentException("El token de autenticación debe ser una cadena o null.");
        }
        if (!is_string($date) && !is_null($date)) {
            throw new InvalidArgumentException("La fecha debe ser una cadena o null.");
        }
        if (!is_string($client_ip) && !is_null($client_ip)) {
            throw new InvalidArgumentException("La dirección IP del cliente debe ser una cadena o null.");
        }
        if(empty($error_handler)) {
            throw new InvalidArgumentException("Debe proporcionar un objeto para manejar los errores");
        }
        
        $this->route = $route;
        $this->auth_token = $auth_token;
        $this->date = $date;
        $this->client_ip = $client_ip;
        $this->error_handler = $error_handler;
    }

    /**
    * Obtiene la ruta actual como una cadena de texto.
    *
    * Si la ruta contiene sólo un elemento, ese elemento será devuelto. De lo contrario,
    * se unirán todos los elementos de la ruta con "/" y se devolverá la cadena resultante.
    *
    * @return string La ruta actual como una cadena de texto.
    */
    public function getRoute(): string {
        if(count($this->route) == 1) return $this->route[0];

        return implode("/", $this->route);
    }

    /**
    * Obtiene la ruta del primer elemento padre de la ruta actual.
    *
    * Devuelve el primer elemento de la ruta actual como una cadena de texto. Si la ruta actual
    * contiene sólo un elemento, se devolverá la cadena "index".
    *
    * @return string La ruta del primer elemento padre de la ruta actual.
    */
    public function getParentRoute(): string {
        if(count($this->route) == 1) return 'index';
        return $this->route[0];
    }

    /**
    * Devuelve el recurso al que se está accediendo en la ruta.
    *
    * Si la ruta sólo tiene un elemento, ese elemento será el recurso.
    * Si la ruta tiene más de un elemento, el recurso será el resto de la ruta excluyendo al primer elemento.
    *
    * @return mixed El recurso al que se está accediendo en la ruta. Si la ruta tiene sólo un elemento, se devuelve un string con dicho elemento.
    * Si la ruta tiene más de un elemento, se devuelve un array con el resto de los elementos de la ruta excluyendo al primero.
    */
    public function getRouteResource(): mixed {
        if(count($this->route) == 1 && $this->route[0] == "") return "index";
        if(count($this->route) == 1) return $this->route[0];

        $route_copy = $this->route;
        $resource = array_shift($route_copy); 

        return $resource;
    }

    /**
    * Obtiene la dirección IP del cliente.
    *
    * @return string|null La dirección IP del cliente o null si no se proporcionó.
    */
    public function getClientIP(): ?string {
        return $this->client_ip;
    }

    /**
    * Obtiene el token de autenticación.
    *
    * @return string|null El token de autenticación o null si no se proporcionó.
    */
    public function getAuthToken(): ?string {
        return $this->auth_token;
    }

    /**
    * Comprueba si la ruta actual coincide con la ruta proporcionada.
    *
    * @param string $route La ruta a comprobar.
    * @return bool Verdadero si la ruta actual coincide con la ruta proporcionada, de lo contrario falso.
    */
    public function matchesRoute(string $route): bool {
        return $this->getRoute() === $route;
    }

    /**
    * Devuelve toda la información de la instancia actual del objeto separada por comas en un string.
    *
    * @return string La cadena de información de la instancia actual
    */
    public function getRequestLog(): string {
        return "[" . implode(", ", [
            $this->route ? implode('/', $this->route) : '',
            $this->auth_token ?? 'NOT AUTH', 
            $this->date ?? 'NOT DATE', 
            $this->client_ip ?? 'NOT IP'
        ]) . "]";
    }
}

?>