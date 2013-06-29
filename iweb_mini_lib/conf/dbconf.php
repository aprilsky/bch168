<?php
if(!$IWEB_SHOP_IN) {
	die("Hacking attempt");
}
$host = '127.0.0.1';//mysql数据库服务器,比如localhost:3306
//$user = 'bch168'; //mysql数据库默认用户名
$user = 'root'; //mysql数据库默认用户名
$pwd = 'admin'; //mysql数据库默认密码
//$pwd = 'dogsdogs'; //mysql数据库默认密码
$db = 'dog'; //默认数据库名
global $tablePreStr;
$tablePreStr = 'imall_';//表前缀

//当前提供服务的mysql数据库
global $dbServs;
$dbServs=array($host,$db,$user,$pwd);
?>
