<?php

/**
 * 文章列表查询
 */
class Service_Arts_ListModel extends Service_AbstractModel {

    public function fndArts($page, $limit) {
        $dao = new Dao_ArtsModel();
        return $dao->fndArts($page, $limit);
    }

    public function cntArts() {
        $dao = new Dao_ArtsModel();
        return $dao->cntArts();
    }

    public function fndArtsByTag($tag, $page, $limit) {
        $dao = new Dao_ArtsModel();
        return $dao->fndArtsByTag($tag, $page, $limit);
    }

    public function cntArtsByTag($tag) {
        $dao = new Dao_ArtsModel();
        return $dao->cntArtsByTag($tag);
    }

    public function fndArtsByAuthor($u_id, $page, $limit) {
        $dao = new Dao_ArtsModel();
        return $dao->fndArtsByAuthor($u_id, $page, $limit);
    }

    public function cntArtsByAuthor($u_id) {
        $dao = new Dao_ArtsModel();
        return $dao->cntArtsByAuthor($u_id);
    }


}
