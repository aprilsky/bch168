<?php
if(!$IWEB_SHOP_IN) {
	die('Hacking attempt');
}

//引入语言包
$a_langpackage=new adminlp;

//权限管理
$right=check_rights("shop_categories");
if (!$right){
	header('location:m.php?app=error');
	exit;
}
$right_update=check_rights("cat_update");
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
#divname{float:left; margin:0px;}
</style>
</head>
<body>
<input type="hidden" id="update_right" value="<?php echo $right_update; ?>" ></input>
<div id="maincontent">
	<div class="wrap">
	<div class="crumbs"><?php echo $a_langpackage->a_location; ?> &gt;&gt; <?php echo $a_langpackage->a_m_shop_mengament;?> &gt;&gt;  <?php echo $a_langpackage->a_shop_category ?></div>
        <hr />
	<div class="infobox">
	<h3>
	<span class="left"><?php echo $a_langpackage->a_shop_categories_export ?></span>
	<span class="right" style="margin-right:15px;"> 
	<a href="m.php?app=shop_categories_list" style="float:right;"><?php echo $a_langpackage->a_shop_category; ?></a>
	</span>
	</h3>
    <div class="content2">
	
	<form action="a.php?act=categories_export" method="post" id="cvsform" name='cvsform' >
					<table width="100%" style="border:0" cellspacing="0">
						<tr>
							<td width="120" align="right"><?php echo $a_langpackage->a_import_file;?>:</td>
							<td width="180"><input type="text" name="filename" value="" /></td>
							<td><?php echo $a_langpackage->a_export_file_msg;?></td>
						</tr>
						<tr><td></td>
							<td colspan="2">
								<input class="submit" type="submit" name="submit" value="<?php echo $a_langpackage->a_shop_categories_export;?>" />
							</td>
						</tr>
					</table>
			</form>

	  </div>
	 </div>
	</div>
</div>
</body>
</html>