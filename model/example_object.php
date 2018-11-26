<?php

class example_object extends objeto {

    public function __construct(int $id) {
        $campos = ["employee_id", "cat_id", "name", "surname"];
        $plain_query = ['id' => $id, 'tabla'=> 'employee', 'campos'=> $campos, 'idtable'=>'employee_id'];
        parent::__construct($plain_query);
        if ($this->existe()) {
            $this->get_cat_name();
        }
    }

    /* --------------- example private function --------------- */

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
