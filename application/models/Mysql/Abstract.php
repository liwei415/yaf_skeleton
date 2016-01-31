<?php

abstract class Mysql_AbstractModel {


    protected $_link = NULL;

    public function find($col = '*', $cond = '', $bind = array(), $page = 0, $limit = 10) {
        $this->_link = Our_Mysql::getInstance();
        return $this->_link->find($this->_table_name, $col, $cond, $bind, $page, $limit);
    }

    public function select($sql, $bind = array()) {
        $this->_link = Our_Mysql::getInstance();
        return $this->_link->select($sql, $bind);
    }

    public function select_one($sql, $bind = array()) {
        $this->_link = Our_Mysql::getInstance();
        return $this->_link->select_one($sql, $bind);
    }

    public function select_row($sql, $bind = array()) {
        $this->_link = Our_Mysql::getInstance();
        return $this->_link->select_row($sql, $bind);
    }


}
