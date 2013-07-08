<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/index.html
 * 如果您的模型要进行修改，请修改 models/index.php
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
if(filemtime("templates/default/index.html") > filemtime(__file__) || (file_exists("models/index.php") && filemtime("models/index.php") > filemtime(__file__)) ) {
	tpl_engine("default","index.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
header("content-type:text/html;charset=utf-8");
$IWEB_SHOP_IN = true;
require("foundation/asession.php");
require("configuration.php");
require("includes.php");
require("foundation/fstring.php");
require("foundation/module_tag.php");
require("foundation/module_nav.php");
require("foundation/module_goods.php");
require("foundation/module_brand.php");
// require("foundation/fcustom_domain.php");
/* 用户信息处理 */
//require 'foundation/alogin_cookie.php';
if(get_sess_user_id()) {
	$USER['login'] = 1;
	$USER['user_name'] = get_sess_user_name();
	$USER['user_id'] = get_sess_user_id();
	$USER['user_email'] = get_sess_user_email();
	$USER['shop_id'] = get_sess_shop_id();
} else {
	$USER['login'] = 0;
	$USER['user_name'] = '';
	$USER['user_id'] = '';
	$USER['user_email'] = '';
	$USER['shop_id'] = '';
}

//引入语言包
$i_langpackage=new indexlp;

$header['title'] = $i_langpackage->i_index." - ".$SYSINFO['sys_title'];
$header['keywords'] = $SYSINFO['sys_keywords'];
$header['description'] = $SYSINFO['sys_description'];

/* 定义文件表 */
$t_shop_info = $tablePreStr."shop_info";
$t_category = $tablePreStr."category";
$t_goods = $tablePreStr."goods";
$t_index_images = $tablePreStr."index_images";
$t_brand = $tablePreStr."brand";
$t_article = $tablePreStr."article";
$t_users = $tablePreStr."users";
$t_flink= $tablePreStr."flink";
$t_tag = $tablePreStr."tag";
$t_nav = $tablePreStr."nav";
$t_shop_request = $tablePreStr."shop_request";
/* 数据库操作 */
dbtarget('r',$dbServs);
$dbo=new dbex();

/* 处理系统分类 */
$sql_category = "select * from `$t_category` order by sort_order asc,cat_id asc,sort_order asc";
$result_category = $dbo->getRs($sql_category);

$CATEGORY = array();
if($result_category) {
	foreach($result_category as $v) {
		$CATEGORY[$v['parent_id']][$v['cat_id']] = $v;

	}
}

/* 轮显图片 */
$sql_images = "select * from `$t_index_images` where `status`=1 order by id asc limit 6";
$images_info = $dbo->getRs($sql_images);

if($images_info) {
	$images_order = '""';
	$images_array = '';
	$i = 1;
	foreach($images_info as $images) {
		$images_order .= ',"'.$i.'"';
		$images_array .= "imgLink[$i] = '$images[images_link]'; \n";
		$images_array .= "imgUrl[$i] = '$images[images_url]'; \n";
		$images_array .= "imgText[$i] = '$images[name]'; \n";
		$i++;
	}

}

/* 产品处理 */
$sql_promote = "SELECT * FROM $t_goods WHERE is_on_sale=1 AND is_admin_promote=1 and lock_flg=0 order by pv desc limit 10";
$sql_notice = "select * from $t_article where cat_id=3 and is_show=1 order by short_order desc limit 8;";
$sql_maller = "select * from $t_article where cat_id=6 and is_show=1 order by add_time desc limit 3;";
$sql_seller = "select * from $t_article where cat_id=7 and is_show=1 order by add_time desc limit 3;";
$sql_flink = "select * from $t_flink where is_show=1 and brand_logo!='' ORDER BY brand_id DESC limit 10";


$goods_promote = $dbo->getRs($sql_promote);
$goods_hot = get_hot_goods($dbo,$t_goods,8);
$brand_rs = get_brand_list($dbo,$t_brand,8);
$notice = $dbo->getRs($sql_notice);
$maller = $dbo->getRs($sql_maller);
$seller = $dbo->getRs($sql_seller);
$tag_list = get_tag_list($dbo,$t_tag,20);
/* 友情链接 */
$flink_rs = $dbo->getRs($sql_flink);
/* 商家信息 */
$sql_shop = "SELECT a.*,b.user_name FROM $t_shop_info as a,$t_users as b,$t_shop_request as c  where a.user_id = b.user_id and a.user_id = c.user_id and c.status=1 and a.shop_commend=1 and a.lock_flg=0 and a.open_flg=0 order by shop_commend desc,a.shop_id desc limit 7;";
$shop_info = $dbo->getRs($sql_shop);

/*导航位置*/
$nav_selected=1;
$nav_list = get_nav_list($t_nav,$dbo);
?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo  $header['title'];?></title>
<meta name="keywords" content="<?php echo  $header['keywords'];?>" />
<meta name="description" content="<?php echo  $header['description'];?>" />
<base href="<?php echo  $baseUrl;?>" />
<link href="<?php echo  $baseUrl;?>/css/css.css" type="text/css" rel="stylesheet" />
<link href="<?php echo  $baseUrl;?>/css/index.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="skin/<?php echo $SYSINFO['templates'];?>/js/changeStyle.js"></script>
<script src="skin/<?php echo $SYSINFO['templates'];?>/js/slide.js" type="text/javascript"></script>
</head>
<body>
  <?php  include("shop/index_header.php");?>
<div class="im">
<div class="iml">
<div class="imt">
宠物推荐
</div>
<ul>
<?php
$result = mysql_query("SELECT * FROM imall_goods  order by goods_id desc limit 0, 10");
while($row = mysql_fetch_array($result))
  {
?>
<li>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"  target="_blank"><?php echo $row['goods_name']; ?></a><br>
</li>
<?
  }
?>
</ul>
<div class="imf">
</div>
</div>
<div class="imm">
<script type="text/javascript">
	var swf_width=476;
	var swf_height=266;
	var config='5|0xffffff|0xC22003|80|0xffffff|0xC22003|0x000000';
	//-- config 参数设置 -- 自动播放时间(秒)|文字颜色|文字背景色|文字背景透明度|按键数字颜色|当前按键颜色|普通按键色彩 --
	var files='',links='', texts='';
	files+='|css/ad1.jpg';links+='|/';texts+='|百宠汇';
	files+='|css/ad2.jpg';links+='|/';texts+='|百宠汇';
	files+='|css/ad3.jpg';links+='|/';texts+='|百宠汇';
	files+='|css/ad4.jpg';links+='|/';texts+='|百宠汇';
	files+='|css/ad5.jpg';links+='|/';texts+='|百宠汇';
	files=files.substring(1);links=links.substring(1);texts=texts.substring(1);
	document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
	document.write('<param name="movie" value="css/focus.swf" />');
	document.write('<param name="quality" value="high" />');
	document.write('<param name="menu" value="false" />');
	document.write('<param name=wmode value="opaque" />');
	document.write('<param name="FlashVars" value="config='+config+'&bcastr_flie='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'" />');
	document.write('<embed src="css/focus.swf" wmode="opaque" FlashVars="config='+config+'&bcastr_flie='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu="false" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
	document.write('</object>');
	</script>

</div>
<div class="imr">
<div class="imt">
宠物新闻
</div>
<ul>
<marquee  scrollamount="1" direction="up" style="margin: 0 auto;padding: 0; width: 240px; height: 280px;">
<?php
$result = mysql_query("SELECT * FROM imall_article  order by article_id limit 0, 10");
while($row = mysql_fetch_array($result))
  {
?>
<li>
<a href="/article.php?id=<?php echo $row['article_id']; ?>"  target="_blank"><?php echo $row['title']; ?></a>
</li>
<?
  }
?>
</marquee >
</ul>
<div class="imf">
</div>
</div>
</div>

<div class="imc2">
<div class="iflt2" style="padding-left: 10px;">
<b>最新上架</b>
</div>
<div class="imcc2">
<ul id="wenchuan">

<?php $i=1;?>
<?php  foreach($goods_promote as $value){?>

<li>
<table><tr>
<td valign="top">
<a href="<?php echo  goods_url($value['goods_id']);?>"><img  src="<?php echo  $value['is_set_image'] ? str_replace('thumb_','',$value['goods_thumb']) : 'skin/default/images/nopic.gif';?>" alt="<?php echo  $value['goods_name'];?>" width="112" height="112" onerror="this.src='skin/default/images/nopic.gif'" border="0"/></a></td>
<td valign="top" style="padding-left:10px;line-height:22px;">
<a href="<?php echo  goods_url($value['goods_id']);?>"  target="_blank"><?php echo  $value['goods_name'];?></a><br>
品种：
<?php
$catids=$value['cat_id'];
$result = mysql_query("SELECT * FROM imall_category WHERE cat_id='$catids'");
while($row = mysql_fetch_array($result))
  {
  echo  "<font color=red><b>".$row['cat_name']."</b></font>";

  }
?>
<br>
<table><tr><td>
性别：<br>
血统：<br>
免疫：<br>
</td><td>
<?php
$goodsids=$value['goods_id'];
$result = mysql_query("SELECT * FROM imall_goods_attr  WHERE goods_id ='$goodsids'");
while($row = mysql_fetch_array($result))
  {
  echo  $row['attr_values']."<br>";

  }
?>
</td></tr></table>

价格：<font color="red" size="3"><b><?php echo $value['goods_price'];?></b></font> 元
</td>
</tr></table>
</li>
<?php $i++;?>
		<?php }?>

</ul>
    <!--<script type="text/javascript">
        var scrollnews = document.getElementById('wenchuan');
        var lis = scrollnews.getElementsByTagName('li');
        var ml = 0;
        var timer1 = setInterval(function(){
            var liHeight = lis[0].offsetHeight;
            var timer2 = setInterval(function(){
                scrollnews.scrollTop = (++ml);
                if(ml == liHeight){
                    clearInterval(timer2);
                    scrollnews.scrollTop = 0;
                    ml = 0;
                    lis[0].parentNode.appendChild(lis[0]);
                }
            },10);
        },2000);
    </script>-->
</div>
<div class="iflm">
</div>
</div>

   <?php  foreach(array_slice ($CATEGORY[0], 0, 5) as $key=>$cat){?>
<div class="ifl">
<div class="iflt">
<?php echo  $cat['cat_name'];?>
</div>
<?php if(isset($CATEGORY[$cat['cat_id']]) && $CATEGORY[$cat['cat_id']]){?>
<ul>
     <?php  foreach(array_slice ($CATEGORY[$cat['cat_id']], 0, 8) as $subcat){?>
<li><a href="<?php echo  category_url($subcat['cat_id']);?>" title="<?php echo  $cat['cat_name'];?>"><?php echo  $subcat['cat_name'];?></a></li>
  <?php }?>
</ul>
   <?php }?>
<div class="iflm">
</div>
</div>
<?php }?>

		

<div class="imc">
<div class="iflt2">
<div class="ifltl" style="padding-left: 13px;">
<b>金毛犬</b>
</div>
<div class="ifltr">
</div>
</div>
<div class="imcc">
<ul>
<?php
$result = mysql_query("SELECT * FROM imall_goods  WHERE cat_id='11'");
while($row = mysql_fetch_array($result))
  {
?>
<li>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"><img  src="<?php echo $row['goods_thumb']; ?>" alt=""  border="0"  class="itt"></a><br>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"  target="_blank"><?php echo $row['goods_name']; ?></a><br>
￥ <font color=#F11F0E size=6><b><?php echo $row['goods_price']; ?></b></font> 
<br>
<img src="/css/sold.jpg" border="0">&nbsp;已售<?php echo rand(31,56); ?>件&nbsp;&nbsp;
<img src="/css/hit.jpg" border="0">&nbsp;人气<?php echo rand(580,1960); ?><br>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>" target="_blank"><img src="/css/gm.jpg" border="0"></a>&nbsp;&nbsp;
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>" target="_blank"><img src="/css/sc.jpg" border="0"></a><br>
<img src="/css/rz.jpg" border="0">
</li>

<?
  }
?>
</ul>
</div>
<div class="iflm">
</div>
</div>

<div class="imc">
<div class="iflt2">
<div class="ifltl" style="padding-left: 13px;">
<b>泰迪犬</b>
</div>
<div class="ifltr">

</div>
</div>
<div class="imcc">
<ul>
<?php
$result = mysql_query("SELECT * FROM imall_goods  WHERE cat_id='8'");
while($row = mysql_fetch_array($result))
  {
?>
<li>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"><img  src="<?php echo $row['goods_thumb']; ?>" alt=""  border="0"  class="itt"></a><br>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"  target="_blank"><?php echo $row['goods_name']; ?></a><br>
￥ <font color=#F11F0E size=6><b><?php echo $row['goods_price']; ?></b></font> 
<br>
<img src="/css/sold.jpg" border="0">&nbsp;已售<?php echo rand(31,56); ?>件&nbsp;&nbsp;
<img src="/css/hit.jpg" border="0">&nbsp;人气<?php echo rand(580,1960); ?><br>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>" target="_blank"><img src="/css/gm.jpg" border="0"></a>&nbsp;&nbsp;
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>" target="_blank"><img src="/css/sc.jpg" border="0"></a><br>
<img src="/css/rz.jpg" border="0">
</li>

<?
  }
?>
</ul>
</div>
<div class="iflm">
</div>
</div>

<div class="imc">
<div class="iflt2">
<div class="ifltl" style="padding-left: 13px;">
<b>萨摩耶犬</b>
</div>
<div class="ifltr">
</div>
</div>
<div class="imcc">
<ul>
<?php
$result = mysql_query("SELECT * FROM imall_goods  WHERE cat_id='17'");
while($row = mysql_fetch_array($result))
  {
?>
<li>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"><img  src="<?php echo $row['goods_thumb']; ?>" alt=""  border="0"  class="itt"></a><br>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>"  target="_blank"><?php echo $row['goods_name']; ?></a><br>
￥ <font color=#F11F0E size=6><b><?php echo $row['goods_price']; ?></b></font> 
<br>
<img src="/css/sold.jpg" border="0">&nbsp;已售<?php echo rand(31,56); ?>件&nbsp;&nbsp;
<img src="/css/hit.jpg" border="0">&nbsp;人气<?php echo rand(580,1960); ?><br>
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>" target="_blank"><img src="/css/gm.jpg" border="0"></a>&nbsp;&nbsp;
<a href="/goods.php?id=<?php echo $row['goods_id']; ?>" target="_blank"><img src="/css/sc.jpg" border="0"></a><br>
<img src="/css/rz.jpg" border="0">
</li>

<?
  }
?>
</ul>
</div>
<div class="iflm">
</div>
</div>

<div class="ifl">
<div class="iflt">
友情链接
</div>
<div class="ilk">
<ul>
<?php
$result = mysql_query("SELECT * FROM imall_flink where is_show=1");
while($row = mysql_fetch_array($result))
  {
?>
<li>
<a href="/goods.php?id=<?php echo $row['site_url']; ?>"  target="_blank"><?php echo $row['brand_name']; ?></a><br>
</li>

<?

  //echo "<br />";友情链接
  }
?>
</ul>
</div>
<div class="iflm">
</div>
</div>
  <?php  include("shop/index_footer.php");?><?php } ?>