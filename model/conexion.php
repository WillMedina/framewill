<?php

require_once 'data.php';
ini_set('default_charset', 'utf-8');

class conexion {

    protected $mysql;
    protected $cambios = array();

    public function __construct() {
        $this->mysql = new mysqli(_SERVIDORMYSQL_, _USUARIOMYSQL_, _CLAVEMYSQL_, _BDMYSQL_);
        if ($this->mysql->connect_errno) {
            //do something when crash db connection
            die();
        }

        $this->mysql->set_charset("utf8");
        $this->set_cambios();
        date_default_timezone_set('America/Lima');
    }

    public function get_mysql() {
        return $this->mysql;
    }

    public function cerrar() {
        $this->mysql->close();
        unset($this->mysql);
    }

    public function get_cambios() {
        return $this->cambios;
    }

    private function set_cambios() {
        $this->cambios["{TITLE}"] = "";
        $this->cambios["{NOMBRE}"] = "";
        $this->cambios["{URLBASE}"] = _URLBASE_;
    }

    public function set_cambio($tag, $value) {
        $this->cambios[$tag] = $value;
    }

}
