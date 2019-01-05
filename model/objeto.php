<?php

class objeto extends conexion implements objetable {

    private $existe = 0;
    protected $data = array();

    public function __construct($plain_query = null, $sp = null) {
        $exe = false;
        if (!is_null($plain_query) and is_array($plain_query)) {
            if ($plain_query["id"] > 0 and is_array($plain_query['campos'])) {
                parent::__construct();
                $sql = "SELECT " . $this->campos_string($plain_query['campos']) . " "
                        . "FROM {$plain_query['tabla']} WHERE {$plain_query['idtable']}='{$plain_query["id"]}'";
                $exe = $this->mysql->query($sql);
            }
        } else if (!is_null($sp) and is_array($sp)) {
            parent::__construct();
            $sql = "CALL {$sp['nombre']}({$this->param_sp($sp['parametros'])})";
            $exe = $this->mysql->query($sql);
            $this->mysql->next_result();
        }

        if ($exe === false) {
            
        } else {
            $cantidad = $exe->num_rows;
            if ($cantidad > 0) {
                $this->existe = 1;

                while ($r = $exe->fetch_assoc()) {
                    $this->data = $r;
                }
            }
        }
    }

    private function campos_string($array) {
        if (is_array($array)) {
            $salida = implode(", ", $array);
            return $salida;
        } else {
            return null;
        }
    }

    private function param_sp($array) {
        if (is_array($array)) {
            $nuevo_arr = [];

            foreach ($array as $value) {
                array_push($nuevo_arr, "'" . $value . "'");
            }

            $salida = implode(", ", $nuevo_arr);
            return $salida;
        } else {
            return null;
        }
    }

    public function existe() {
        if ($this->existe == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_data($index) {
        if ($this->existe == 0) {
            return null;
        } else {
            if (array_key_exists($index, $this->data)) {
                if (is_null($this->data[$index])) {
                    return null;
                } else {
                    return $this->data[$index];
                }
            } else {
                return null;
            }
        }
    }

    public function get_json() {
        if ($this->existe == 0) {
            return null;
        } else {
            return json_encode($this->data);
        }
    }

}
