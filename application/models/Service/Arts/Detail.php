<?php

/**
 * 文章详细查询
 */
class Service_Arts_DetailModel extends Service_AbstractModel {

    public function fndArt($a_id) {
        $dao = new Dao_ArtsModel();
        return $dao->fndArt($a_id);
    }

    public function fndPrevArt($a_id) {
        $dao = new Dao_ArtsModel();
        return $dao->fndPrevArt($a_id);
    }

    public function fndNextArt($a_id) {
        $dao = new Dao_ArtsModel();
        return $dao->fndNextArt($a_id);
    }


}