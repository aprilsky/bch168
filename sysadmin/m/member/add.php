<?php
if(!$IWEB_SHOP_IN) {
	die('Hacking attempt');
}
require_once("../foundation/module_users.php");
//引入语言包
$a_langpackage=new adminlp;

$user_id = intval(get_args('id'));
if(!$user_id) {
	trigger_error($a_langpackage->a_error);
}

//数据表定义区
$t_users = $tablePreStr."users";

//读写分离定义方法
$dbo = new dbex;
dbtarget('r',$dbServs);

$user_info = get_user_info($dbo,$t_users,$user_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="skin/css/admin.css">
<link rel="stylesheet" type="text/css" href="skin/css/main.css">
<style>
td span {color:red;}
.green {color:green;}
.red {color:red;}
</style>
</head>
<body>
<div class="title"><span class="more"><a href="m.php?app=member_list"><?php echo $a_langpackage->a_memeber_list;?></a>&nbsp;&nbsp;</span>
	&nbsp;&nbsp;<?php echo $a_langpackage->a_mana_center;?><span> - <?php echo $a_langpackage->a_memeber_info_update;?></span></div>
<form action="a.php?act=member_info_edit" method="post">
<table class="content">
	<tr>
		<td width="40%" class="right"><?php echo $a_langpackage->a_memeber_name;?>：</td>
		<td><input type="text" name="user_name" value="<?php echo $user_info['user_name']; ?>" /> <span id="user_email_message"></span></td>
	</tr>
	<tr>
		<td width="40%" class="right"><?php echo $a_langpackage->a_memeber_email;?>：</td>
		<td><input type="text" name="user_email" value="<?php echo $user_info['user_email']; ?>" /> <span id="user_email_message"></span></td>
	</tr>
	<tr>
		<td width="40%" class="right"><?php echo $a_langpackage->a_user_password;?>：</td>
		<td><input type="password" name="password" /><?php echo $a_langpackage->a_user_notupdate;?> </td>
	</tr>
	<tr>
		<td class="right"><?php echo $a_langpackage->a_email_check;?>：</td>
		<td><input type="checkbox" name="email_check" value="1" <?php if($user_info['email_check']) {echo 'checked';} ?> /><?php echo $a_langpackage->a_user_pass_verify;?></td>
	</tr>
	<tr>
		<input type="hidden" name="user_id" value="<?php echo $user_info['user_id'];?>">
		<td colspan="2" class="center"><input type="submit" name="submit" value="<?php echo $a_langpackage->a_update_user_info;?>" /></td>
	</tr>
</table>
</form>
<div class="copyright"><?php echo $a_langpackage->a_footer;?></div>
<script language="JavaScript" src="../servtools/ajax_client/ajax.js"></script>
<script>
var user_email_value = '<?php echo $user_info['user_email']; ?>';
var user_email = document.getElementsByName("user_email")[0];
var user_email_message = document.getElementById("user_email_message");
var submit = document.getElementsByName("submit")[0];
var user_email_reg = /^[0-9a-zA-Z_\-\.]+@[0-9a-zA-Z_\-]+(\.[0-9a-zA-Z_\-]+)*$/; 
user_email.onblur = function(){
	if(user_email.value=='') {
		user_email_message.innerHTML = '<?php echo $a_langpackage->a_email_null;?>';
		submit.disabled = true;
	} else if(!user_email.value.match(user_email_reg)) {
		user_email_message.innerHTML = '<?php echo $a_langpackage->a_email_error;?>';
		submit.disabled = true;
	} else if(user_email.value!=user_email_value) {
		user_email_message.innerHTML = '<?php echo $a_langpackage->a_email_checking;?>';
		submit.disabled = true;
		ajax("../a.php?act=user_check_useremail","POST","v="+user_email.value,function(data){
			if(data==1) {
				user_email_message.innerHTML = '';
				submit.disabled = false;
			} else {
				user_email_message.innerHTML = '<?php echo $a_langpackage->a_email_used;?>';
				submit.disabled = true;
			}
		});
	} else {
		submit.disabled = false;
	}
}
</script>
</body>
</html>