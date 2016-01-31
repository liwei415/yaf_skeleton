<?php

class Mysql_UsersModel extends Mysql_AbstractModel {

    protected $_table_name = 'users';

    public function fndUsers($u_id) {
        $sql = "SELECT *
                FROM users
                WHERE u_id = $u_id";
        return $this->select_row($sql);
    }


}
