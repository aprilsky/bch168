<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/modules/goods/gallery.html
 * 如果您的模型要进行修改，请修改 models/modules/goods/gallery.php
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
if(filemtime("templates/default/modules/goods/gallery.html") > filemtime(__file__) || (file_exists("models/modules/goods/gallery.php") && filemtime("models/modules/goods/gallery.php") > filemtime(__file__)) ) {
	tpl_engine("default","modules/goods/gallery.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
if(!$IWEB_SHOP_IN) {
	trigger_error('Hacking attempt');
}

require("foundation/acheck_shop_creat.php");
require("foundation/module_goods.php");
require("foundation/module_gallery.php");

//引入语言包
$m_langpackage=new moduleslp;
$i_langpackage=new indexlp;
$s_langpackage=new shoplp;
//数据表定义区
$t_goods = $tablePreStr."goods";
$t_goods_gallery = $tablePreStr."goods_gallery";
$t_users = $tablePreStr."users";
$goods_id = intval(get_args('id'));
if(!$goods_id) {
	trigger_error($m_langpackage->m_handle_err);
}

//读写分离定义方法
$dbo = new dbex;
dbtarget('r',$dbServs);
//判断商品是否锁定
include("foundation/fgoods_locked.php");
//判断用户是否锁定，锁定则不许操作
$sql ="select locked from $t_users where user_id=$user_id";
$row = $dbo->getRow($sql);
if($row['locked']==1){
	session_destroy();
	trigger_error($m_langpackage->m_user_locked);//非法操作
}
// 判断用户操作的是自己店铺下的商品。
$goods_info = get_goods_info($dbo,$t_goods,'is_set_image',$goods_id,$shop_id);
if(empty($goods_info)) { trigger_error($m_langpackage->m_handle_err);}

$gallery_list = get_gallery_list($dbo,$t_goods_gallery,$goods_id);

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
th{background:#EFEFEF}
.red { color:red;}
td div {float:left; text-align:center; border: 1px solid #DADADA; margin: 5px; padding:2px; width:130px;}
td span {display:block; margin-left:10px;}
.imga {display:block; margin-bottom:4px; height:100px;}
</style>
</head>
<body onload="menu_style_change('goods_list');changeMenu();">
<?php  require("shop/index_header.php");?>
    <div class="site_map">
	  <?php echo $m_langpackage->m_current_position;?><A href="index.php"><?php echo $SYSINFO['sys_name'];?></A>/<a href="modules.php"><?php echo $m_langpackage->m_u_center;?></a>/&nbsp;&nbsp;<?php echo  $m_langpackage->m_goods_image;?>
	</div>
    <div class="clear"></div>
	<?php  require("modules/left_menu.php");?>
    <div class="main_right">
    	<div class="right_top"></div>
			<div class="cont">
				<div class="cont_title">
					<span class="tr_op">
					<a href="modules.php?app=goods_list" >
				<?php echo  $m_langpackage->m_back_goodslist;?></a>
					</span>
					<?php echo  $m_langpackage->m_goods_image;?>
				</div>
				<hr />
			<form action="do.php?act=goods_gallery_update" method="post" name="form_goods_gallery_update" enctype="multipart/form-data">
				<table style="border:0" width="100%">
					<thead><tr><td class="center">
					<?php  if(!empty($gallery_list)){
						foreach($gallery_list as $value) {?>
					<div id="gallery_<?php echo  $value['img_id'];?>">
						<a href="javascript:;" onclick="if (confirm('<?php echo  $m_langpackage->m_sure_delimg;?>'))
							dropImg('<?php echo  $value['img_id'];?>')">[<?php echo  $m_langpackage->m_del;?>]</a>
						<?php  if($value['is_set']) {
		                	echo $m_langpackage->m_is_img;
		                } else { ?>
							<a href="do.php?act=goods_gallery_set&id=<?php echo  $value['img_id'];?>&gid=<?php echo  $value['goods_id'];?>">
							[<?php echo  $m_langpackage->m_set_img;?>]</a>
						<?php }?><br />
						<input type="hidden" name="imgid_<?php echo  $value['img_id'];?>" value="<?php echo  $value['img_id'];?>" />
						<a href="<?php echo  $value['img_original'];?>" target="_blank" class="imga">
						<img src="<?php echo  $value['thumb_url'];?>" class="img" onerror="this.src='../skin/default/images/nopic.gif'"/></a>
						<input type="text" value="<?php echo  $value['img_desc'];?>" size="15" name="old_img_desc[<?php echo  $value['img_id'];?>]" maxlength="50" style="width:110px;"/>
		            </div>
					<?php  }}else {
						echo "<?php echo  $m_langpackage->m_not_uploadimg;?>";
					}?>
					</td></tr></thead>
                    <tbody id="upload_img">
					<tr><td class="textleft">
					<a href="javascript:addNewUploadSpan();" style=" text-decoration:none">[+]</a> <?php echo  $m_langpackage->m_img_desc;?>:
						<input type="text" name="img_desc[]" maxlength="50" /> <?php echo  $m_langpackage->m_upload_file;?>:
						<input type="file" name="attach[]" />
					</td></tr>
                    </tbody>
					<tfoot><tr><td class="left"><input type="hidden" name="goods_id" value="<?php echo  $goods_id;?>" />
					<input class="submit" type="submit" name="submit" value="<?php echo  $m_langpackage->m_update_goodsimg;?>" /></td></tr></tfoot>
				</table>
			</form>
        </div>
    </div>
<div class="clear"></div>
<?php  require("shop/index_footer.php");?>
<script language="JavaScript" src="servtools/ajax_client/ajax.js"></script>
<script language="JavaScript">
<!--
<?php foreach($gallery_list as $value){
	if($value['is_set']) {
		echo "var is_set_img_id = '".$value['img_id']."';";
	}
}?>

function addNewUploadSpan() {
	var upload_img = document.getElementById("upload_img");
	var newspan = document.createElement("tr");
	var newtd = document.createElement("td");
	newtd.innerHTML = '<a href="javas'+'cript:removeUploadSpan();" style=" text-decoration:none">[-]&nbsp;</a>  ';
	newtd.innerHTML += '<?php echo  $m_langpackage->m_img_desc;?>: <input type="text" name="img_desc[]" maxlength="50" /> ';
	newtd.innerHTML += '<?php echo  $m_langpackage->m_upload_file;?>: <input type="file" name="attach[]" />';
	newspan.appendChild(newtd);
	upload_img.appendChild(newspan);
}

function removeUploadSpan() {
	var upload_img = document.getElementById("upload_img");
	var number = upload_img.children.length;
	var delnode = upload_img.children[number-1];
	upload_img.removeChild(delnode);
}

function dropImg(id) {
	var s = 0;
	var imgid = 'imgid_'+id;
	var is_set_img_id =document.getElementsByName("imgid").value;
	if(is_set_img_id == id) {
		s = 1;
	}
	ajax("do.php?act=goods_gallery_drop","POST","id="+id+"&s="+s+"&gid=<?php echo $goods_id;?>",function(data){
		if(data==1) {
			document.getElementById("gallery_"+id).style.display='none';
		} else {
			alert('<?php echo   $m_langpackage->m_delfail_tryagain;?>');
		}
	});
}

function resetimgwh() {
	var imgarray = document.getElementsByTagName("img");
	var top_height = 0;
	for(var i=0; i<imgarray.length; i++) {
		if(imgarray[i].className="img") {
			if(imgarray[i].width > imgarray[i].height) {
				imgarray[i].width = 100;
				top_height = Math.ceil((100-imgarray[i].height*100/imgarray[i].width)/2);
				imgarray[i].style.marginTop = top_height+'px';
			} else {
				imgarray[i].height = 100;
			}
		}
	}
}
//-->
</script>
</body>
</html><?php } ?>