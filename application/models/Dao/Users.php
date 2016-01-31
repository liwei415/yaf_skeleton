<?php

class Dao_UsersModel extends Dao_AbstractModel {

    public function fndUsers($u_id) {
        $mysql = new Mysql_UsersModel();
        return $mysql->fndUsers($u_id);
    }


}
