<?php

class Dao_ArtsModel extends Dao_AbstractModel {

    public function fndArts($page, $limit) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->fndArts($page, $limit);
    }

    public function cntArts() {
        $mysql = new Mysql_ArtsModel();
        return $mysql->cntArts();
    }

    public function fndArtsByTag($tag, $page, $limit) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->fndArtsByTag($tag, $page, $limit);
    }

    public function cntArtsByTag($tag) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->cntArtsByTag($tag);
    }

    public function fndArtsByAuthor($u_id, $page, $limit) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->fndArtsByAuthor($u_id, $page, $limit);
    }

    public function cntArtsByAuthor($u_id) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->cntArtsByAuthor($u_id);
    }

    public function fndArt($a_id) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->fndArt($a_id);
    }

    public function fndPrevArt($a_id) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->fndPrevArt($a_id);
    }

    public function fndNextArt($a_id) {
        $mysql = new Mysql_ArtsModel();
        return $mysql->fndNextArt($a_id);
    }


}
