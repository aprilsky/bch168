<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/modules/user/remind.html
 * 如果您的模型要进行修改，请修改 models/modules/user/remind.php
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
if(filemtime("templates/default/modules/user/remind.html") > filemtime(__file__) || (file_exists("models/modules/user/remind.php") && filemtime("models/modules/user/remind.php") > filemtime(__file__)) ) {
	tpl_engine("default","modules/user/remind.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
if(!$IWEB_SHOP_IN) {
	die('Hacking attempt');
}

//require("foundation/module_remind.php");

//引入语言包
$m_langpackage=new moduleslp;
$i_langpackage=new indexlp;

//数据表定义区
$t_remind = $tablePreStr."remind";
$t_remind_user = $tablePreStr."remind_user";
$t_users = $tablePreStr."users";
//定义读操作
dbtarget('r',$dbServs);
$dbo=new dbex;
//判断用户是否锁定，锁定则不许操作
$sql ="select locked from $t_users where user_id=$user_id";
$row = $dbo->getRow($sql);
if($row['locked']==1){
	session_destroy();
	trigger_error($m_langpackage->m_user_locked);//非法操作
}
$sql="select * from $t_remind where enable=1 order by remind_type";
$remind_rs=$dbo->getRs($sql);

$sql="select * from $t_remind_user where user_id=$user_id";
$remind_user_rs=$dbo->getRs($sql);

$remind_user_arr=array();
foreach($remind_user_rs as $val){
	$remind_user_arr[$val['remind_id']]=$val;
}


$type=array(
	"1"=>$m_langpackage->m_buy_prompt,
	"2"=>$m_langpackage->m_sell_prompt,
);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo  $m_langpackage->m_u_center;?></title>
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/modules.css">
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/layout.css">
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/style.css">
<script type="text/javascript" src="skin/<?php echo  $SYSINFO['templates'];?>/js/changeStyle.js"></script>
<script type="text/javascript" src="skin/<?php echo  $SYSINFO['templates'];?>/js/userchangeStyle.js"></script>

<style type="text/css">

</style>
</head>
<body onload="menu_style_change('user_remind');changeMenu();">
	<?php  require("shop/index_header.php");?>
	<div class="site_map">
	  <?php echo $m_langpackage->m_current_position;?><A href="index.php"><?php echo $SYSINFO['sys_name'];?></A>/<a href="modules.php"><?php echo $m_langpackage->m_u_center;?></a>/&nbsp;&nbsp;<?php echo  $m_langpackage->m_remind_setting;?>
	</div>

    <div class="clear"></div>
    <?php  require("modules/left_menu.php");?>
        <div class="main_right">
        	<div class="right_top"></div>
            <div class="cont">
                <div class="cont_title"><?php echo  $m_langpackage->m_remind_setting;?></div>
                <hr />
				<form action="do.php?act=user_remind_upd" method="post" name="form_profile">
				<table width="100%" border="0" cellspacing="0">
					<tr class="center">
						<th width="80"><?php echo $m_langpackage->m_rem_type;?></th>
						<th><?php echo $m_langpackage->m_rem_name;?></th>
						<th width="60"><?php echo $m_langpackage->m_site_rem;?></th>
						<th width="60"><?php echo $m_langpackage->m_email_reminder;?></th>
						<!-- <th>iwebIM</th>
						<th>手机</th> -->
					</tr>
				<?php foreach($remind_rs as $val){?>
					<?php if($val['remind_type']==2){?>
					<tr class="center">
						<td><?php echo $type[$val['remind_type']];?></td>
						<td class="left"><?php echo $val['remind_name'];?></td>
						<td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[site]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['site']) && $remind_user_arr[$val['remind_id']]['site']=='1'){ echo "checked";}?> /></td>
						<td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[mail]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['mail']) && $remind_user_arr[$val['remind_id']]['mail']=='1'){ echo "checked";}?> <?php if(!$SYSINFO['sys_smtpusermail'] or !$SYSINFO['sys_smtpuser']){ echo "disabled";}?> /></td>
						<!-- <td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[im]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['im']) && $remind_user_arr[$val['remind_id']]['im']=='1'){ echo "checked";}?> <?php if($SYSINFO['im_enable']=='false'){ echo "disabled";}?> /></td>
						<td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[mobile]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['mobile']) && $remind_user_arr[$val['remind_id']]['mobile']=='1'){ echo "checked";}?> disabled /></td> -->
					</tr>
					<?php }?>
				<?php }?>
				<?php foreach($remind_rs as $val){?>
					<?php if($val['remind_type']==1){?>
					<tr class="center">
						<td><?php echo $type[$val['remind_type']];?></td>
						<td class="left"><?php echo $val['remind_name'];?></td>
						<td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[site]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['site']) && $remind_user_arr[$val['remind_id']]['site']=='1'){ echo "checked";}?> /></td>
						<td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[mail]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['mail']) && $remind_user_arr[$val['remind_id']]['mail']=='1'){ echo "checked";}?> <?php if(!$SYSINFO['sys_smtpusermail'] or !$SYSINFO['sys_smtpuser']){ echo "disabled";}?> /></td>
						<!-- <td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[im]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['im']) && $remind_user_arr[$val['remind_id']]['im']=='1'){ echo "checked";}?> <?php if($SYSINFO['im_enable']=='false'){ echo "disabled";}?> /></td>
						<td><input type="checkbox" name="<?php echo  $val['remind_id'];?>[mobile]" value="1" <?php if(isset($remind_user_arr[$val['remind_id']]['mobile']) && $remind_user_arr[$val['remind_id']]['mobile']=='1'){ echo "checked";}?> disabled /></td> -->
					</tr>
					<?php }?>
				<?php }?>
					<tr><td colspan="4" class="center"><input class="submit" type="submit" value="<?php echo $m_langpackage->m_remind_setting;?>" /></td></tr>
				</table>
				</form>
          </div>
          <div class="clear"></div>
          <div class="right_bottom"></div>
          <div class="back_top"><a href="#"></a></div>
      </div>
<?php  require("shop/index_footer.php");?>
</body>
</html><?php } ?>