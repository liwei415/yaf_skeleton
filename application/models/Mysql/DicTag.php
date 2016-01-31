<?php

class Mysql_ArtsModel extends Mysql_AbstractModel {

    /**
     * 表名
     * 
     * @var string
     */
    protected $_tableName = 'arts';

    /**
     * 主键
     * 
     * @var string
     */
    protected $_pk = 'a_id';

    /**
     * 类实例

     * @var Mysql_ArtsModel
     */
    private static $_instance = null;

    /**
     * 获取类实例
     * 
     * @return Mysql_ArtsModel
     */
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

}
