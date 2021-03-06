<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/modules/goods/add_transport_template.html
 * 如果您的模型要进行修改，请修改 models/modules/goods/add_transport_template.php
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
if(filemtime("templates/default/modules/goods/add_transport_template.html") > filemtime(__file__) || (file_exists("models/modules/goods/add_transport_template.php") && filemtime("models/modules/goods/add_transport_template.php") > filemtime(__file__)) ) {
	tpl_engine("default","modules/goods/add_transport_template.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
	/*
	***********************************************
	*$ID:
	*$NAME:
	*$AUTHOR:E.T.Wei
	*DATE:Tue Mar 30 09:58:29 CST 2010
	***********************************************
	*/
	if(!$IWEB_SHOP_IN) {
		trigger_error("Hacking attempt");
	}
	//文件引入
	require("foundation/module_goods.php");
	require("foundation/module_areas.php");
	//引入语言包
	$m_langpackage=new moduleslp;
	$i_langpackage=new indexlp;
	//数据表定义区
	$t_goods_transport = $tablePreStr."goods_transport";
	$t_transport = $tablePreStr."transport";
	$t_areas = $tablePreStr."areas";
	//读写分类定义方法
	$dbo = new dbex;
	dbtarget('r',$dbServs);
	$area_list = get_area_list_bytype($dbo,$t_areas,1);
	//查询开启的配送方式
	$sql="select * from $t_transport where ifopen=1";
	$arr_list=$dbo->getRs($sql);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo  $m_langpackage->m_u_center;?></title>
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/modules.css">
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/layout.css">
<link rel="stylesheet" type="text/css" href="skin/<?php echo  $SYSINFO['templates'];?>/css/style.css">
<script type="text/javascript" src="skin/<?php echo  $SYSINFO['templates'];?>/js/userchangeStyle.js"></script>

</head>
<body onload="changeMenu();">
<?php  require("shop/index_header.php");?>
	<div class="site_map">
	  <?php echo $m_langpackage->m_current_position;?><A href="index.php"><?php echo $SYSINFO['sys_name'];?></A>/<a href="modules.php"><?php echo $m_langpackage->m_u_center;?></a>/&nbsp;&nbsp;<?php echo  $m_langpackage->m_add_transport_template;?>
	</div>
    <div class="clear"></div>
	<?php  require("modules/left_menu.php");?>
    <div class="main_right">
		<div class="right_top"></div>
		<div class="cont">
        <div class="cont_title">
				
			<?php echo  $m_langpackage->m_add_transport_template;?>
			</div>
		<hr />
			<form action="do.php?act=add_transport_template" method="post" name="form_transport_template" onsubmit="return checkForm(this);">
				<table id="boxtable" width="100%" style="border:0" cellspacing="0">
					<tr>
						<td width="100" align="right"><?php echo  $m_langpackage->m_transport_name;?>:</td><td width="150"><input type="text" name="transport_name" value="" maxlength="30"/></td><td align="left"><?php echo $m_langpackage->m_transport_name_message;?></td>
					</tr>
					<tr>
						<td align="right"><?php echo  $m_langpackage->m_transport_description;?>:</td><td><input type="text" name="description" value="" maxlength="50"/></td><td><?php echo $m_langpackage->m_transport_description_message;?></td>
					</tr>
					<tr>
						<td><b><?php echo  $m_langpackage->m_choose_transport_type;?></b></td>
						<td colspan="2"><?php echo  $m_langpackage->m_choose_transport_type_message;?></td>
					</tr>
					<?php if(is_array($arr_list)){?>
						<?php foreach($arr_list as $k=>$value){?>
							<tr><td></td>
								<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="transport_type[]" value="<?php echo $value['tranid'];?>" id="<?php echo $value['tranid'];?>" onclick="showtype('<?php echo $value['tranid'];?>')" /><?php echo $value['tran_name'];?>:</td>
							</tr>
							<tr id="<?php echo $value['tranid'];?>_box" style="display:none;"><td></td>
								<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;
									<?php echo $m_langpackage->m_transport_template_frist;?><input type="text" name="frist<?php echo $value['tranid'];?>" value="0.00" maxlength="10"/>
									<?php echo $m_langpackage->m_transport_template_second;?><input type="text" name="second<?php echo $value['tranid'];?>" value="0.00" maxlength="10"/><br />
									<ul id="wordbox_<?php echo $value['tranid'];?>">
		
									</ul>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="javascript:;" onclick="showareslist('<?php echo $value['tranid'];?>')" ><b><?php echo $m_langpackage->m_transport_cont;?></b></a>
								</td>
							</tr>
						<?php }?>
					<?php }?>
					<tr><td></td>
						<td colspan="2"><input class="submit" type="submit" name="sub" value="<?php echo $m_langpackage->m_shure;?>"  /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div class="clear"></div>
	<div id="bgdiv" style="display:none;"></div>
	<div id="category_select" style="display:none;">
		<div class="category_title_1"><span onclick="hidebgdiv();"><?php echo $m_langpackage->m_close;?></span><?php echo $m_langpackage->m_plss_select_cateogry;?></div>
		<ul id="select_first" class="ulselect">
		<?php if(isset($category_info)){?>
			<?php foreach($category_info as $k=>$v){?>
				<?php if($v['parent_id']==0){?>
				<li title="<?php echo  $v['cat_id'];?>"><?php echo  $v['cat_name'];?></li>
				<?php }?>
			<?php }?>
		<?php }?>
		</ul>
		<ul id="select_second" class="ulselect"></ul>
		<ul id="select_third" class="ulselect"></ul>
		<ul id="select_fourth" class="ulselect"></ul>
		<div class="category_com"><input type="button" value="<?php echo $m_langpackage->m_post;?>" onclick="postcatid();" /></div>
	</div>
	<div style="position:absolute;style:top:0px;left:0px; padding:5px; background:#f1f1f1; display:none; width:420px;" id="mydiv">
		<?php if(is_array($area_list)){?>
			<?php foreach($area_list as $k=>$value){?>
				<div style="float:left; width:75px;"><input type="checkbox" name="area[]" value="<?php echo $value['area_id'];?>"  /><?php echo $value['area_name'];?></div>
			<?php }?>
		<?php }?>
		<input type="hidden" name="hdnum" value="0" id="hdnum" />
		<input type="hidden" name="hdtxt" value="" id="hdtxt" />
		<input type="hidden" name="iseidt" id="iseidt" value="" />
		<input type="button" name="doselect" value="<?php echo $m_langpackage->m_shure;?>"  onclick="doselect()" />
	</div>
<div class="footer"><?php require("shop/index_footer.php");?></div>
</body>
</html>
<script language="JavaScript" type="text/javascript">
	function showtype(txt){
		var chosid = txt+"_box";
		var actobj = document.getElementById(txt);
		var obj = document.getElementById(chosid);
		if(actobj.checked){
			obj.style.display="";
		}else{
			obj.style.display="none";
		}
	}
	function showareslist(txt){
		var obj = document.getElementById('mydiv');
		var areaobj = document.getElementsByName("area[]");
		var inputname = "ord_item_dest"+txt+"[]";
		var conobj = document.getElementsByName(inputname);
		var arrstr = "";
		for(i=0;i<conobj.length;i++){
			arrstr+=conobj[i].value;
		}
		var arrstr = arrstr.substring(0,arrstr.length-1);
		var strarr = arrstr.split(",");
		if(arrstr.length>0){
			for (a=0;a<areaobj.length;a++){
				for(b=0;b<strarr.length;b++){
					if(areaobj[a].value==strarr[b]){
						areaobj[a].disabled=true;
					}
				}
			}
		}
		document.getElementById('hdtxt').value=txt;
		obj.style.display="";
		obj.style.left = document.body.clientWidth/2-(parseInt(500)/2)+"px";
		obj.style.top = document.body.clientHeight/2-(parseInt(300)/2)-30+document.documentElement.scrollTop/2+"px";
	}
	function doselect(){
		var obj = document.getElementsByName("area[]");
		var str="";
		var num=document.getElementById('hdnum').value;
		var hdtxt=document.getElementById('hdtxt').value;
		var idlist ="";
		for(i=0;i<obj.length;i++){
			if(obj[i].checked){
				str+=obj[i].nextSibling.nodeValue+",";
				idlist+=obj[i].value+",";
			}
			obj[i].disabled=false;
		}
		var boxid = "wordbox_"+hdtxt;
		var boxobj = document.getElementById(boxid);
		if(document.getElementById('iseidt').value==''){
			if(str.length>0){
				boxobj.innerHTML+="&nbsp;&nbsp;&nbsp;&nbsp;<li ><?php echo $m_langpackage->m_to;?><input type='text' name='ord_item_word"+(hdtxt)+"[]' value='"+str+"' "+"onclick=\"eidtarea('"+hdtxt+"','"+idlist+"','"+(num+1)+"')\""+" id='item"+(num+1)+"'  /><input type='hidden' id='itemvalue"+(num+1)+"' name='ord_item_dest"+(hdtxt)+"[]' value='"+idlist+"' />的<?php echo $m_langpackage->m_transport_template_frist;?><input type='text' name='ord_area_frist"+(hdtxt)+"[]' value='' /><?php echo $m_langpackage->m_transport_template_second;?><input type='text' name='ord_area_second"+(hdtxt)+"[]' value='' /></li><br />";

				document.getElementById('hdnum').value+=1;
				for(i=0;i<obj.length;i++){
					obj[i].checked=false;
				}
			}
		}else{
			var chosid = "itemvalue"+document.getElementById('iseidt').value;
			var chostext = "item"+document.getElementById('iseidt').value;
			var idobj = document.getElementById(chosid);
			var txtobj = document.getElementById(chostext);
			idobj.value=idlist;
			txtobj.value=str;
		}
		document.getElementById('iseidt').value='';
		document.getElementById('mydiv').style.display="none";
	}
	function remove(obj,dx){
		if(isNaN(dx)||dx>obj.length){
			return false;
		}
		for(i=0,n=0;i<obj.length;i++){
			if(obj[i]!=obj[dx]){
				obj[n++]=obj[i];
			}
		}
		obj.length-=1;
	}
	function eidtarea(txt,ids,num){
		var obj = document.getElementById('mydiv');
		var areaobj = document.getElementsByName("area[]");
		var strarr = ids.split(",");
		for(i=0;i<areaobj.length;i++){
			for(j=0;j<strarr.length;j++){
				if(areaobj[i].value==strarr[j]){
					areaobj[i].checked=true;
				}
			}
		}
		document.getElementById('iseidt').value=num;
		obj.style.display="";
	}
	function checkForm(obj){
		if(obj.transport_name.value==''){
			alert('<?php echo $m_langpackage->m_in_template_name;?>');
			return false;
		}
		if(obj.description.value==''){
			alert('<?php echo $m_langpackage->m_in_template_description;?>');
			return false;
		}
		var transport_type =document.getElementsByName('transport_type[]');
		var a=0;
		for(i=0;i<transport_type.length;i++){
			if(transport_type[i].checked){
				var frist = "frist" + transport_type[i].value;
				var second = "second" + transport_type[i].value;
				a++;
				if(parseInt(document.getElementsByName(frist)[0].value)==0||parseInt(document.getElementsByName(second)[0].value)==0){
					alert('<?php echo $m_langpackage->m_set_shipping_cost;?>');
					return false;
				}
			}
		}
		if(a==0){
			alert('<?php echo $m_langpackage->m_choose_shipping_method;?>');
			return false;
		}
	}
</script><?php } ?>