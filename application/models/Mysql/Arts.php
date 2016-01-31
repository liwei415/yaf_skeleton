<?php

class Mysql_ArtsModel extends Mysql_AbstractModel {

    protected $_table_name = 'arts';

    public function fndArts($page, $limit) {
        $sql = "SELECT t1.a_id, t1.u_id, t1.featured, t1.title, t1.author,
                       t1.date_added, t1.summary, GROUP_CONCAT(t3.tag) AS tag
                FROM arts AS t1
                LEFT JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                LEFT JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id
                GROUP BY t1.a_id
                ORDER BY t1.date_added DESC
                LIMIT $page, $limit";
        return $this->select($sql);
    }

    public function cntArts() {
        $sql = "SELECT COUNT(*) FROM arts";
        return $this->select_one($sql);
    }

    public function fndArtsByTag($tag, $page, $limit) {
        $sql = "SELECT t1.*, GROUP_CONCAT(t3.tag) AS tag
                FROM
                (
                  SELECT t1.a_id, t1.u_id, t1.featured, t1.title, t1.author,
                         t1.date_added, t1.summary
                  FROM arts AS t1
                  INNER JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                  INNER JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id AND
                             t3.tag = '$tag'
                ) AS t1
                LEFT JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                LEFT JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id
                GROUP BY t1.a_id
                ORDER BY t1.date_added DESC
                LIMIT $page, $limit";
        return $this->select($sql);
    }

    public function cntArtsByTag($tag) {
        $sql = "SELECT COUNT(*)
                FROM
                (
                  SELECT t1.*, GROUP_CONCAT(t3.tag) AS tag
                  FROM
                  (
                    SELECT t1.a_id, t1.u_id, t1.featured, t1.title, t1.author,
                           t1.date_added, t1.summary
                    FROM arts AS t1
                    INNER JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                    INNER JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id AND
                               t3.tag = '$tag'
                  ) AS t1
                LEFT JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                LEFT JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id
                GROUP BY t1.a_id
                ) AS t1";
        return $this->select_one($sql);
    }

    public function fndArtsByAuthor($u_id, $page, $limit) {
        $sql = "SELECT t1.a_id, t1.u_id, t1.featured, t1.title, t1.author,
                       t1.date_added, t1.summary, GROUP_CONCAT(t3.tag) AS tag
                FROM arts AS t1
                LEFT JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                LEFT JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id
                WHERE u_id  = $u_id
                GROUP BY t1.a_id
                ORDER BY t1.date_added DESC
                LIMIT $page, $limit";
        return $this->select($sql);
    }

    public function cntArtsByAuthor($u_id) {
        $sql = "SELECT COUNT(*) FROM arts WHERE u_id = $u_id";
        return $this->select_one($sql);
    }

    public function fndArt($a_id) {
        $sql = "SELECT t1.*, t2.username, t2.photo, t2.intro, t2.website, t2.location
                FROM
                (
                  SELECT t1.*, GROUP_CONCAT(t3.tag) AS tag
                  FROM arts AS t1
                  LEFT JOIN arts_tag AS t2 ON t1.a_id = t2.a_id
                  LEFT JOIN dic_tag AS t3 ON t2.dt_id = t3.dt_id
                  WHERE t1.a_id = $a_id
                  GROUP BY t1.a_id
                ) AS t1
                INNER JOIN users AS t2 ON t1.u_id = t2.u_id";
        return $this->select_row($sql);
    }

    public function fndPrevArt($a_id) {
        $sql = "SELECT a_id, title
                FROM arts
                WHERE a_id < $a_id ORDER BY a_id DESC LIMIT 1";
        return $this->select_row($sql);
    }

    public function fndNextArt($a_id) {
        $sql = "SELECT a_id, title
                FROM arts
                WHERE a_id > $a_id ORDER BY a_id ASC LIMIT 1";
        return $this->select_row($sql);
    }


}
