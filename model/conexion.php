<?php

require_once 'data.php';
ini_set('default_charset', 'utf-8');

class conexion
{

    protected $mysql;
    protected $cambios = array();

    public function __construct()
    {
        $this->mysql = new mysqli(_SERVIDORMYSQL_, _USUARIOMYSQL_, _CLAVEMYSQL_, _BDMYSQL_);
        if ($this->mysql->connect_errno) {
            //do something when crash db connection
            die();
        }

        $this->mysql->set_charset("utf8");
        $this->set_cambios();
        date_default_timezone_set('America/Lima');
    }

    public function get_mysql()
    {
        return $this->mysql;
    }

    public function call_sp($nombre, $parametros)
    {
        $salida = [];
        $mysql = $this->get_mysql();

        if (is_array($parametros) and ! is_null($nombre)) {
            $parametros_quoted = [];

            foreach ($parametros as $value) {
                $parametros_quoted[] = "'" . $value . "'";
            }

            $parametros_plain = implode(',', $parametros_quoted);
            $sql = "CALL $nombre($parametros_plain)";
            $q = $mysql->query($sql);
            $mysql->next_result();

            //$salida = $q;
            if ($q !== false) {
                $con = $q->num_rows;
                if ($con > 0) {
                    while ($r = $q->fetch_assoc()) {
                        $salida[] = $r;
                    }
                }
            }
        }

        return $salida;
    }

    public function cerrar()
    {
        $this->mysql->close();
        unset($this->mysql);
    }

    public function get_cambios()
    {
        return $this->cambios;
    }

    private function set_cambios()
    {
        $this->cambios["{TITLE}"] = "";
        $this->cambios["{NOMBRE}"] = "";
        $this->cambios["{URLBASE}"] = _URLBASE_;
        $this->cambios["{URLSTATIC}"] = _URLSTATIC_;
        $this->cambios["{URLUSUARIOS}"] = _URLUSERSAPI_;
    }

    public function set_cambio($tag, $value)
    {
        $this->cambios[$tag] = $value;
    }

}
