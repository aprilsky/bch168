<?php
/*
 * 注意：此文件由itpl_engine编译型模板引擎编译生成。
 * 如果您的模板要进行修改，请修改 templates/default/shop/index_footer.html
 * 如果您的模型要进行修改，请修改 models/shop/index_footer.php
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
if(filemtime("templates/default/shop/index_footer.html") > filemtime(__file__) || (file_exists("models/shop/index_footer.php") && filemtime("models/shop/index_footer.php") > filemtime(__file__)) ) {
	tpl_engine("default","shop/index_footer.html",1);
	include(__file__);
} else {
/* debug模式运行生成代码 结束 */
?><?php
if(!$IWEB_SHOP_IN) {
	trigger_error('Hacking attempt');
}

require_once("foundation/asystem_info.php");

function show_back_lp($def_lp){
	echo "<select name='langpackage' onchange='selectlangpackage (this.value)'>";
	$res=opendir("langpackage");
	while($lp_dir=readdir($res)){
		if(!preg_match("/^\./",$lp_dir)){
			$l_selected='';
			if($lp_dir==$def_lp){$l_selected="selected";}
			$lp_tip=trim(file_get_contents("langpackage"."/".$lp_dir."/"."tip.php"));
			echo "<option value='".$lp_dir."' ".$l_selected.">".$lp_tip."</option>";
		}
	}
	echo "</select>";	
}
?><script language="javascript" type="text/javascript">
function SetCookie (name, value) {
	var today = new Date();
	var expires = new Date();
	expires.setTime(today.getTime() + 1000 * 60 * 60 * 24 * 365);
	document.cookie = name + "=" + escape(value) + "; expires=" + expires.toGMTString();
}
function selectlangpackage(v){
	SetCookie ('language', v);
	window.location.reload();
}
</script>
</div>
<div class="ibq">
<div class="ibqc">
<ul style="width: 330px;">

</ul>
<ul>
<h3>支付方式</h3>
<li><a href="/fukuan.html#1" target="_blank">货到付款</a></li>
<li><a href="/fukuan.html#2" target="_blank">余额支付</a></li>
<li><a href="/fukuan.html#3" target="_blank">银行到账</a></li>
<li><a href="/fukuan.html#4" target="_blank">在线支付</a></li>
</ul>
<ul>
<h3>配送方式</h3>
<li><a href="/peisong.html#1" target="_blank">外包快递</a></li>
<li><a href="/peisong.html#2" target="_blank">物流运输</a></li>
<li><a href="/peisong.html#3" target="_blank">送货上门</a></li>
<li><a href="/peisong.html#4" target="_blank">上门自取</a></li>
</ul>
<ul style="width: 160px;" target="_blank">
<h3>购物指南</h3>
<li><a href="/zhinan.html#1" target="_blank">退换政策</a></li>
<li><a href="/zhinan.html#2" target="_blank">订单说明</a></li>
<li><a href="/zhinan.html#3" target="_blank">积分计算</a></li>
<li><a href="/zhinan.html#4" target="_blank">常见问题</a></li>
</ul>
<ul style="width: 120px;" target="_blank">
<h3>关于我们</h3>
<li><a href="/about.html#1" target="_blank">关于我们</a></li>
<li><a href="/about.html#2" target="_blank">代理加盟</a></li>
<li><a href="/about.html#3" target="_blank">人才招聘</a></li>
<li><a href="/about.html#1" target="_blank">联系我们</a></li>
</ul></div>
</div>
<div class="ift">
<div class="iftc">
 <!-- <?php echo $i_langpackage->i_language_ch;?>：<?php echo  show_back_lp($langpackage);?> 
    <?php echo $i_langpackage->i_language_ch;?><?php echo  show_back_lp($langpackage);?>-->
    <a href="<?php echo  article_url(2);?>"><?php echo $i_langpackage->i_question_see;?></a>|<a href="<?php echo  article_url(3);?>"><?php echo $i_langpackage->i_safe_compp;?></a>|<a href="<?php echo  article_url(4);?>"><?php echo $i_langpackage->i_process_of_purchase;?></a>|<a href="<?php echo  article_url(5);?>"><?php echo $i_langpackage->i_howto_pay;?></a>|<a href="<?php echo  article_url(6);?>"><?php echo $i_langpackage->i_contact_us;?></a>|<a href="<?php echo  article_url(7);?>"><?php echo $i_langpackage->i_make_a_proposal;?></a>|<a href="<?php echo  article_url(8);?>"><?php echo $i_langpackage->i_site_map;?></a></p>
  <p>Powered by <a href="http://www.bch168.com">BCH<?php echo  $SYSINFO['version'];?></a><?php echo  $SYSINFO['sys_company'];?></p>
  <?php echo  $SYSINFO['sys_copyright'];?> <?php echo  $SYSINFO['sys_icp'];?> <?php echo  $SYSINFO['sys_countjs'];?> 
</div>
</div>
</body>
</html>



<?php } ?>