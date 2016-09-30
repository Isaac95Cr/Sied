
<?php

class Mensaje {

    private $titulo;
    private $mensaje;

    public function __construct($titulo, $mensaje) {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
    }

    public function json() {
        $datos["titulo"] = $this->titulo;
        $datos["msj"] = $this->mensaje;
        return json_encode($datos);
    }

}
