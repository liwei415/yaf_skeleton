<?php

class Our_Mysql {

    /**
     * Description:（1）静态变量，保存全局实例，跟类绑定，跟对象无关
     *             （2）私有属性，为了避免类外直接调用 类名::$instance，防止为空
     */
    private static $_instance = NULL;
    private $_link = NULL;
    private $_username = NULL;
    private $_password = NULL;
    private $_host = NULL;
    private $_port = NULL;
    private $_dbname = NULL;

    /**
     * 私有化构造函数，防止外界实例化对象
     */
    private function __construct() {
        $conf = Yaf_Registry::get('config')->get('resources.db.params');
        if (!$conf) {
            throw new Exception('数据库连接必须设置');
        }

        $params = $conf->toArray();
        $this->_username = $params['username'];
        $this->_password = $params['password'];
        $this->_host = $params['host'];
        $this->_port = $params['port'];
        $this->_dbname = $params['dbname'];

        $this->_link = new PDO("mysql:host=$this->_host;port=$this->_port;dbname=$this->_dbname",
                               $this->_username,
                               $this->_password);
        $this->_link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_link->exec('set names utf8');

        return $this->_link;
    }

    /**
     * 私有化克隆函数，防止外界克隆对象
     */
    private function __clone() {}

    /**
     * Description:静态方法，单例访问统一入口
     * @return Singleton：返回应用中的唯一对象实例
     */
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function find($table_name, $col, $cond, $bind, $page, $limit) {
        if (!$col) { $col = '*'; }
        if (!$cond) { $cond = ''; }
        if (!$bind) { $bind = array(); }
        if (!$page) { $page = 0; }
        if (!$limit) { $limit = 10; }
        $sql = " SELECT " . $col . " FROM " . $table_name;
        if ($cond) {
            $sql .= " WHERE " . $cond;
        }
        $sql .= " LIMIT " . $page .','.$limit;
        //echo $sql;
        $stmt = $this->_getStatement($sql, $bind);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select($sql, $bind = array()){
        $stmt = $this->_getStatement($sql, $bind);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select_one($sql, $bind = array()){
        $stmt = $this->_getStatement($sql, $bind);
        $stmt->execute();
        $r = $stmt->fetch();
        if(isset($r[0])) {
            return $r[0];
        }
        else {
            return false;
        }
    }

    public function select_row($sql,$bind = array()){
        $stmt = $this->_getStatement($sql, $bind);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); ;
    }

    // public function update($table_name,array $feilds,$condition='',$bind=array(),$config_key=NULL){
    //     $DbLink=self::getDbLink('write',$config_key);
    //     $sql='update `'.$table_name.'` ';
    //     if(count($feilds) ==0 || empty($condition)){
    //         return false;//没有更新任何列,或者全表更新也不支持的太危险了
    //     }
    //     $set_value='';
    //     foreach ($feilds as $key=>$v){
    //         if($v=='NOW()' || strpos($v, '`') !== FALSE){
    //             $set_value.='`'.$key.'`='.$v.',';
    //         }else{
    //             $bind_key=':'.$key;
    //             $bind[$bind_key]=$v;
    //             $set_value.='`'.$key.'`='.$bind_key.',';
    //         }

    //     }
    //     $sql.= ' set '.trim($set_value,',');
    //     $sql.= ' where '.$condition;
    //     return $this->exec($sql,$bind,$config_key);
    // }

    // public function insert($table_name,array $feilds,$config_key=NULL){
    //     $DbLink=self::getDbLink('write',$config_key);
    //     $coloms='';
    //     $values='';
    //     $bind=array();
    //     foreach ($feilds as $key=>$v){
    //         $coloms.='`'.$key.'`,';
    //         if($v === 'NOW()'){
    //             $values.=''.$v.',';
    //         }else{

    //             $bind_key=':'.$key;
    //             $values.=$bind_key.',';
    //             $bind[$bind_key]=$v;
    //         }

    //     }
    //     $coloms=trim($coloms,',');
    //     $values=trim($values,',');
    //     $sql='insert into `'.$table_name.'` ('.$coloms.') values('.$values.') ';
    //     $r=$this->exec($sql,$bind,$config_key);
    //     if($r){
    //         return $DbLink->lastInsertId();
    //     }else{
    //         return false;//抛出异常
    //     }

    // }

    public function delete($table_name, $cond = '', $bind = array()){
        $sql = 'DELETE FROM `' . $table_name . '` ';
        if(empty($cond)) {
            //危险操作直接不允许,清空整张表,不允许
            return FALSE;
        }
        $sql .= ' WHERE ' . $cond;
        return $this->exec($sql, $bind);
    }

    public function exec($sql, $bind = array()){
        $stmt = $this->_getStatement($sql, $bind);
        $r= $stmt->execute();
        return $r;
    }

    private function _getStatement($sql, $bind = array()) {
        $stmt = $this->_link->prepare($sql);
        if(count($bind) > 0) {
            foreach ($bind as $key => $v) {
                $stmt->bindValue($key, $v, "PDO::PARAM_STR");
            }
        }
        return $stmt;
    }


}