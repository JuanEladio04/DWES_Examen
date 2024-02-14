<?php

class Usuario {

    protected $provincia;
    protected $nombre;
    protected $telefono;
    protected $user;
    protected $pass;

    public function __construct($provincia, $nombre, $telefono, $user, $pass) {
        $this->provincia = $provincia;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

?>