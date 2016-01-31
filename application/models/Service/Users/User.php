<?php

/**
 * 文章列表查询
 */
class Service_Users_UserModel extends Service_AbstractModel {

    public function fndUsers($u_id) {
        $dao = new Dao_UsersModel();
        return $dao->fndUsers($u_id);
    }


}
