<?php 

require_once 'utils/Settings.php';

class MaintenanceMiddleware extends Settings {

    /**
    * Comprueba si la aplicación está en modo de mantenimiento y redirige a la página correspondiente si es necesario.
    *
    * @param Request $request El objeto de solicitud para comprobar su ruta.
    * @return void
    */
    public function handle($request) {
        if($request->getRoute() == 'mantenimiento') return;

        if ($this->is_maintenance_mode()) {
            header("Location: ". $this->base_route ."mantenimiento");
            exit();
        }
    }
    
    /**
    * Comprueba si la aplicación está en modo de mantenimiento.
    *
    * @return boolean Verdadero si la aplicación está en modo de mantenimiento, de lo contrario falso.
    */
    private function is_maintenance_mode() {
        if($this->maintenance_mode) {
            return true;
        }

        return false;
    }
}

?>