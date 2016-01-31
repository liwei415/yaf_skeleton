<?php

/**
 * api模块控制器抽象类
 */
abstract class Our_Controller_Api extends Our_Controller_Abstract {

    /**
     * api控制器直接输出json格式数据，不需要渲染视图
     */
    public function init() {
        Yaf_Dispatcher::getInstance()->disableView();
    }

}
