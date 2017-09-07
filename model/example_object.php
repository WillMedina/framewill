<?php

namespace model;

class example_object extends objeto {

    public function __construct(int $id) {
        $campos = ["employee_id", "cat_id", "name", "surname"];
        parent::__construct($id, "employee", $campos, "employee_id");
        if ($this->existe()) {
            $this->get_cat_name();
        }
    }

    private function get_cat_name() {
        $mysql = $this->get_mysql();
        $sql = 'SELECT cat_name FROM category WHERE cat_id =\'' . $this->get_data("cat_id") . '\'';
        $q = $mysql->query($sql);
        if ($q === true) {
            $c = $q->num_rows;
            if ($c > 0) {
                $r = $q->fetch_assoc();
                $this->data["category"] = $r["cat_name"];
            }
        }
    }

}
