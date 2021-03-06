<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/modules/shop/sure_recevi.html
 * 如果您的模型要进行修改，请修改 models/modules/shop/sure_recevi.php
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
if(filemtime("templates/default/modules/shop/sure_recevi.html") > filemtime(__file__) || (file_exists("models/modules/shop/sure_recevi.php") && filemtime("models/modules/shop/sure_recevi.php") > filemtime(__file__)) ) {
	tpl_engine("default","modules/shop/sure_recevi.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
if(!$IWEB_SHOP_IN) {
	die('Hacking attempt');
}
require("foundation/acheck_shop_creat.php");
require("foundation/module_order.php");
require("foundation/module_goods.php");

//语言包引入
$m_langpackage=new moduleslp;
$s_langpackage=new shoplp;

//数据表定义区
$t_order_info = $tablePreStr."order_info";
$t_users = $tablePreStr."users";
$t_order_goods = $tablePreStr."order_goods";
$t_goods = $tablePreStr."goods";

$order_id = intval(get_args('order_id'));
if(!$order_id) { exit($m_langpackage->m_handle_err); }

//定义写操作
dbtarget('w',$dbServs);
$dbo = new dbex;

//判断商品是否锁定，锁定则不许操作
$sql="select b.goods_id,a.transport_type,a.pay_id from $t_order_info as a join $t_order_goods as b on a.order_id=b.order_id where a.order_id=$order_id";
$row1=$dbo->getRow($sql);
if($row1){
	$goods_id=$row1['goods_id'];
}
include("foundation/fgoods_locked.php");
//判断用户是否锁定，锁定则不许操作
$sql ="select locked from $t_users where user_id=$user_id";
$row = $dbo->getRow($sql);
if($row['locked']==1){
	session_destroy();
	trigger_error($m_langpackage->m_user_locked);//非法操作
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo  $m_langpackage->m_u_center;?></title>
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/style.css">
<script type="text/javascript" src="skin/<?php echo  $SYSINFO['templates'];?>/js/changeStyle.js"></script>
<script type="text/javascript" src="skin/<?php echo  $SYSINFO['templates'];?>/js/userchangeStyle.js"></script>
<style type="text/css">
td span { color:red; }
#reg_step { width:770px; height:29px; margin: 12px auto 20px; line-height: 29px; }
#reg_step ol li { width: 154px; float: left; padding:0 0 3px; font-size: 14px; font-weight: bold; background-color:#ececec; color:#333; text-align:center; }
#reg_step ol li span, #reg_step ol li strong { display: block; text-align:center; }
#reg_step ol li.current { background:url(skin/default/images/steps_bg.gif) left top no-repeat; padding-top:4px; margin-top:-4px; color:#FFF; }
#reg_step ol li.last_current { background-color: #F6A248; color: #fff; background-position: right -145px; }
td { text-align:left; }
</style>
</head>
<body>
<?php  require("shop/index_header.php");?>
<div class="site_map"> <?php echo $m_langpackage->m_current_position;?><A href="index.php"><?php echo $SYSINFO['sys_name'];?></A>/<a href="modules.php"><?php echo $m_langpackage->m_u_center;?></a>/&nbsp;&nbsp;<?php echo  $m_langpackage->m_order_info;?> </div>
<div class="clear"></div>
<?php  require("modules/left_menu.php");?>
<div class="main_right">
	<div class="right_top"></div>
	<div class="cont">
		<div ><h3 class="cont_title">确定收款</h3></div>
   <hr />
		<form action="do.php?act=shop_sure_recevi&id=<?php echo $order_id;?>" method="post" >
		<table class="form_table_02" width="100%" border="0" cellspacing="0">
		<?php if($row1['pay_id']=='4' || $row1['pay_id']=='5') {?>
			<tr>
				<th>收款账户:</th>
				<td><input type="text" id="shipping_name" name="receiv_account" maxlength="50"/></td>
			</tr>
		<?php }?>
			<tr>
		        <td></td>
		        <td><input type="submit" value="确认付款"/>
					<a href="modules.php?app=shop_my_order&order_id=<?php echo $order_id;?>">返回</a>
				</td>
		    </tr>
		</table>
	</form>
	</div>
</div>
<div class="clear"></div>
<?php  require("shop/index_footer.php");?>

</body>
</html><?php } ?>