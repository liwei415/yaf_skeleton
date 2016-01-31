<?php

/**
 * DAO的抽象类
 */
abstract class Dao_AbstractModel {

    /**
     * 不允许克隆对象
     */
    public function __clone() {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

}
