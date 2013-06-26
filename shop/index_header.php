<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/shop/index_header.html
 * 如果您的模型要进行修改，请修改 models/shop/index_header.php
 *
 * 修改完成之后需要您进入后台重新编译，才会重新生成。
 * 如果您开启了debug模式运行，那么您可以省去上面这一步，但是debug模式每次都会判断程序是否更新，debug模式只适合开发调试。
 * 如果您正式运行此程序时，请切换到service模式运行！
 *
 * 如您有问题请到官方论坛（http://tech.jooyea.com/bbs/）提问，谢谢您的支持。
 */
?><?php
/*
 * 此段代码由debug模式下生成运行，请勿改动！
 * 如果debug模式下出错不能再次自动编译时，请进入后台手动编译！
 */
/* debug模式运行生成代码 开始 */
if(!function_exists("tpl_engine")) {
	require("foundation/ftpl_compile.php");
}
if(filemtime("templates/default/shop/index_header.html") > filemtime(__file__) || (file_exists("models/shop/index_header.php") && filemtime("models/shop/index_header.php") > filemtime(__file__)) ) {
	tpl_engine("default","shop/index_header.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
if(!$IWEB_SHOP_IN) {
	trigger_error('Hacking attempt');
}

if($USER['shop_id']) {
	$url=shop_url($USER['shop_id']);
} else {
	$url='modules.php?app=shop_info';
}
$search_header_type = short_check(get_args("search_type"));
//引入语言包
if(!isset($i_langpackage)){
	$i_langpackage = new indexlp;
}
$ksearch=short_check(get_args("k"));
if($i_langpackage->i_search_keyword==$ksearch){
	$ksearch="";
}
?><link href="/css/css.css" type="text/css" rel="stylesheet" />
<link href="/css/index.css" rel="stylesheet" type="text/css" />
<div class="hds">
<div class="hd">

<div class="lg">
<?php echo $SYSINFO['sys_name'];?>!<?php  if($USER['login']){?><?php echo  $i_langpackage->i_hi;?>! <?php echo  $USER['user_name'];?> <a href="do.php?act=logout"><?php echo  $i_langpackage->i_logout;?></a><?php } else {?><a href="login.php"><?php echo $i_langpackage->i_login;?></a>&nbsp;|&nbsp;<a href="modules.php?app=reg"><?php echo $i_langpackage->i_register_free;?></a><?php }?>&nbsp;&nbsp;
<a href="modules.php"><?php echo $i_langpackage->i_u_center;?></a>
        <a class="shop_cart" href="modules.php?app=user_cart"><?php echo $i_langpackage->i_cart;?></a>
</div>
</div>
<div class="nv">
<ul>
<li style="width: 90px;"><a href="/">首页</a></li>
<li style="width: 98px;"><a href="/search.php">买狗狗</a></li>
<li style="width: 90px;"><a href="/search.php?search_type=搜商家">犬舍</a></li>
<li style="width: 100px;"><a href="/zhishi/">养狗问答</a></li>
<li style="width: 95px;"><a href="/free.html">免费领狗</a></li>
<li style="width: 90px;"><a href="/use/">用品商城</a></li>
<li style="width: 100px;"><a href="/jiameng.html">代理加盟</a></li>
<li style="width: 100px;"><a href="/kefu.html">客服服务</a></li>
<li style="width: 200px;text-align: left;padding-left: 26px;">搜索一下</li>
</ul>
</div>
</div>
<div class="ikey">
<ul>
<li><img src="/css/hot.jpg" border=0></li>
<li><a href="http://hsq.bch168.com/" target="_blank">哈士奇</a></li>
<li><a href="http://zao.bch168.com/" target="_blank">藏獒</a></li> 
<li><a href="http://tdx.bch168.com/" target="_blank">泰迪熊</a></li> 
<li><a href="http://smyq.bch168.com/" target="_blank">萨摩耶</a></li> 
<li><a href="http://bxq.bch168.com/" target="_blank">比熊</a></li> 
<li><a href="http://jmq.bch168.com/" target="_blank">金毛</a></li> 
<li><a href="http://lbldq.bch168.com/" target="_blank">拉布拉多</a></li> 
<li><a href="http://ssq.bch168.com/" target="_blank">松狮</a></li> 
<li><a href="http://jww.bch168.com/" target="_blank">吉娃娃</a></li> 
<li><a href="http://bmq.bch168.com/" target="_blank">博美犬</a></li> 
<li><a href="http://xnrq.bch168.com/" target="_blank">雪纳瑞</a></li> 
<li><a href="http://gbq.bch168.com/" target="_blank">贵宾</a></li> 
<li><a href="http://alsjq.bch168.com/" target="_blank">阿拉斯加</a></li> 
<li><a href="http://hdq.bch168.com/" target="_blank">蝴蝶犬</a></li> 

</ul>
</div>
<div style="width: 980px;margin: 0 auto;padding: 0;"><?php } ?>