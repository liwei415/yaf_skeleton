<?php

ini_set('session.name', 'PHPSESSID_INUX_XYZ');

 /* 错误打印到网页: 0 & 1 */
if (ini_get('yaf.environ') == 'develop') {
    ini_set('display_errors', 1);
}

date_default_timezone_set("Asia/Shanghai");
mb_internal_encoding("UTF-8");
define("APPLICATION_PATH", realpath(dirname(__FILE__) . '/../'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/application/library'),
    get_include_path(),
)));

$app = new Yaf_Application(APPLICATION_PATH . "/conf/application.ini", ini_get('yaf.environ'));
$app->bootstrap()->run();
