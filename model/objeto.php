<?php

class objeto extends conexion implements objetable {

    private $existe = 0;
    protected $data = array();

    public function __construct(int $id, $tabla, $campos, $idtable) {
        if ($id > 0 and is_array($campos)) {
            parent::__construct();
            $sql = "SELECT " . $this->campos_string($campos) . " "
                    . "FROM $tabla WHERE $idtable='$id'";
            $exe = $this->mysql->query($sql);
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
    }

    private function campos_string($array) {
        if (is_array($array)) {
            $salida = implode(", ", $array);
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
