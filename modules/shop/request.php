<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/modules/shop/request.html
 * 如果您的模型要进行修改，请修改 models/modules/shop/request.php
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
if(filemtime("templates/default/modules/shop/request.html") > filemtime(__file__) || (file_exists("models/modules/shop/request.php") && filemtime("models/modules/shop/request.php") > filemtime(__file__)) ) {
	tpl_engine("default","modules/shop/request.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
if(!$IWEB_SHOP_IN) {
	trigger_error('Hacking attempt');
}

//引入语言包
$m_langpackage=new moduleslp;
$i_langpackage=new indexlp;

//数据表定义区
$t_shop_request = $tablePreStr."shop_request";
$t_shop_info = $tablePreStr."shop_info";

//读写分离定义方法
$dbo=new dbex;
dbtarget('r',$dbServs);

$sql = "select * from `$t_shop_request` where user_id='$user_id'";
$shopsql="select * from `$t_shop_info` where user_id='$user_id'";

$request_info = $dbo->getRow($sql);
$shop_info = $dbo->getRow($shopsql);
$privilege=get_sess_privilege();
if($privilege) {
	$user_privilege = unserialize($privilege);
}

if($request_info&&$request_info['status']=='0'&&$shop_info){
	echo '<script language="JavaScript">location.href="modules.php?app=shop_message&status=0"</script>';
	exit;
}
if($request_info&&$request_info['status']=='1'&&$shop_info){
	echo '<script language="JavaScript">location.href="modules.php?app=shop_message&status=1"</script>';
	exit;
}

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
.red{color:red;}
</style>
</head>
<body onload="changeMenu();">
	<?php  require("shop/index_header.php");?>
	<div class="site_map">
	  <?php echo $m_langpackage->m_current_position;?><A href="index.php"><?php echo $SYSINFO['sys_name'];?></A>/<a href="modules.php"><?php echo $m_langpackage->m_u_center;?></a>/&nbsp;&nbsp;<?php echo  $m_langpackage->m_hiserver_member;?>
	</div>
    <div class="clear"></div>
	<?php  require("modules/left_menu.php");?>
		<div class="main_right">
            <div class="right_top"></div>
            <div class="cont">
                <div class="cont_title"><?php echo  $m_langpackage->m_hiserver_member;?></div>
			     <div id="stepTip">
			      <ul class="list_step clearfix">
			     <li  class="now"><?php echo  $m_langpackage->m_u_first;?>:<br /><?php echo  $m_langpackage->m_a_info;?></li>
			     <li><?php echo  $m_langpackage->m_u_secound;?>:<br /><?php echo  $m_langpackage->m_a_shop_info;?></li>
			     <li><?php echo  $m_langpackage->m_u_third;?>:<br /><?php echo  $m_langpackage->m_a_manager_info;?></li>
			     <li style="padding-right:0"><?php echo  $m_langpackage->m_u_fore;?>:<br /><?php echo  $m_langpackage->m_accomplish;?></li>
			     </ul>
			     </div>
                <hr />
				<form action="do.php?act=shop_request" method="post" name="form_shop_request" onsubmit="return check_form(this)" enctype="multipart/form-data">
				<table width="100%" border="0" cellspacing="0">
				
					<?php  if($request_info['status']=='1'){?>
						<tr><td align="center"><?php echo  $m_langpackage->m_hiserver_member_suc;?></td></tr>
					<?php  }else {?>
						<?php  if($request_info['status']=='2'){?>
						<tr><td align="center" colspan="2"><font color="red"><B><?php echo  $m_langpackage->m_hiserver_member_fail;?></B></font></td></tr>
						<?php }?>
					<tr><td class="textright" width="40%"><?php echo  $m_langpackage->m_request_compayname;?>：</td><td><input type="text" name="company_name" value="<?php echo  $request_info['company_name'];?>" style="width:200px" /> <span class="red">*</span></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_personname;?>：</td><td><input type="text" name="person_name" value="<?php echo  $request_info['person_name'];?>" style="width:100px" /> <input type="hidden" name="request_id" value="<?php echo  $request_info['request_id'];?>" /></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_criedtype;?>：</td><td>
					<select name="credit_type">
					<option value="<?php echo  $m_langpackage->m_request_sfz;?>"><?php echo  $m_langpackage->m_request_sfz;?></option>
					<option value="<?php echo  $m_langpackage->m_request_jgz;?>"><?php echo  $m_langpackage->m_request_jgz;?></option>
					<option value="<?php echo  $m_langpackage->m_request_operatenum;?>"><?php echo  $m_langpackage->m_request_jgz;?></option>
					</select> <span class="red">*</span></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_criednum;?>：</td><td><input type="text" name="credit_num" value="<?php echo  $request_info['credit_num'];?>" maxlength="200" style="width:200px" /> <span class="red">*</span></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_paper_upload;?>：</td><td><input type="file" name="attach[]" /> <span class="red">*</span><?php echo  $m_langpackage->m_request_supporttype;?>（jpg,gif,png）</td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_comaddress;?>：</td><td><input type="text" name="company_area" maxlength="200" style="width:200px" value="<?php echo  $request_info['company_area'];?>" /> </td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_moraddress;?>：</td><td><input type="text" name="company_address" value="<?php echo  $request_info['company_address'];?>" maxlength="200" style="width:300px" /> <span class="red">*</span></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_zip;?>：</td><td><input type="text" name="zipcode" value="<?php echo  $request_info['zipcode'];?>" maxlength="10" style="width:100px" /> <span class="red">*</span></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_mobile;?>：</td><td><input type="text" name="mobile" value="<?php echo  $request_info['mobile'];?>" maxlength="20" style="width:200px" /> <span class="red">*</span></td></tr>
					<tr><td class="textright"><?php echo  $m_langpackage->m_request_phone;?>：</td><td><input type="text" name="telphone" value="<?php echo  $request_info['telphone'];?>" maxlength="20" style="width:200px" /> <span class="red">*</span></td></tr>
					<tr><td colspan="2" align="center"><input type="hidden" name="user_id" value="<?php echo  $user_id;?>" />
					<input type="submit" name="submit" value="<?php echo  $m_langpackage->m_post_app;?>" /></td></tr>
					<tr><td colspan="2" align="center"><?php echo  $m_langpackage->m_request_suc_correctnum;?></td></tr>
					<?php }?>
				</table>
				</form>
            </div>
            <div class="clear"></div>
			<div class="right_bottom"></div>
			<div class="back_top"><a href="#"></a></div>
        </div>
<?php  require("shop/index_footer.php");?>
</body>
</html>
<script language="JavaScript" type="text/javascript">
	function check_form(obj){
		if(obj.company_name.value==''){
			alert("<?php echo $m_langpackage->m_check_complay;?>");
			return false;
		}
		
		if(obj.credit_num.value==''){
			alert("<?php echo $m_langpackage->m_check_card;?>");
			return false;
		}
		if(isNaN(obj.credit_num.value.substr(0,obj.credit_num.value.length-1))){
			alert("<?php echo $m_langpackage->m_check_truecard;?>");
			return false;
		}
		if(obj.company_address.value==''){
			alert("<?php echo $m_langpackage->m_check_address;?>");
			return false;
		}
		if(obj.zipcode.value==''){
			alert("<?php echo $m_langpackage->m_check_postcode;?>");
			return false;
		}
		if(isNaN(obj.zipcode.value)){
			alert("<?php echo $m_langpackage->m_check_postcodeisnum;?>");
			return false;
		}
		if(obj.mobile.value==''){
			alert("<?php echo $m_langpackage->m_check_mobile;?>");
			return false;
		}
		if(isNaN(obj.mobile.value)){
			alert("<?php echo $m_langpackage->m_check_mobileisnum;?>");
			return false;
		}
		if(obj.telphone.value==''){
			alert("<?php echo $m_langpackage->m_check_phone;?>");
			return false;
		}
		if(isNaN(obj.telphone.value)){
			alert("<?php echo $m_langpackage->m_check_phoneisnum;?>");
			return false;
		}
	}
</script><?php } ?>