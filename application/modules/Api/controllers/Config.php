<?php

/**
 * 配置文件测试
 */
class ConfigController extends Our_Controller_Api {

    public function readAction() {
        var_dump(Yaf_Registry::get('config'));
    }

}
