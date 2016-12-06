<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($site["title"]); ?></title>
<meta name="keywords" content="<?php echo ($site["keywords"]); ?>" />
<meta name="description" content="<?php echo ($site["description"]); ?>" />

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" /><!-- 防止IE8,7进入怪异模式 -->
<link rel="shortcut icon" href="/zwj/App/Home/View/default/image/favicon.ico">
<link rel="icon" href="/zwj/App/Home/View/default/image/favicon.gif" type="image/gif" >

<script type="text/javascript" src="/zwj/App/Home/View/default/js/jquery-1.11.1.min.js"></script>
<?php if(!empty($css)): if(is_array($css)): $i = 0; $__LIST__ = $css;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><link rel="stylesheet" type="text/css" href="/zwj/App/Home/View/default/css/<?php echo ($c); ?>" /><?php endforeach; endif; else: echo "" ;endif; endif; ?>


</head>
<body>
	<!-- 头部 -->
	
<div id="default_top">
	
		<div class="top">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script type="text/javascript" src="js/top_nav.js"></script>

<div class="top_wrap">

<div class="top1"><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" class="agy"> Hi！欢迎来到<?php echo ($site["title"]); ?> </td>
    
    <td height="33" align="right" class="agy top_nav_pro_rline">&nbsp;&nbsp;您好！&nbsp;<a href="login.php">登录</a>&nbsp;<a href="reg.php">注册</a><!--<b><a href="mem_home.php" class="ab">美三维</a></b>&nbsp;<a href="index.php">安全退出</a> &nbsp;<a href="mem_home.php">用户中心</a>--></td>
    <td width="80" align="right" nowrap="nowrap"  class="agy ">&nbsp;<a href="cart.php">我的订单<span class="ar">(5)</span></a> </td>
  </tr>
</table>
</div>
		</div>
	
</div>

<div id="default_banner">
	
</div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	<div id="default_left"></div>

<div id="default_right"></div>

<div id="default_body">
	
	
</div>
	<!-- /主体 -->

	<!-- 底部 -->
	
<div id="default_footer">
	
		<div class="footer">
			
		</div>
	
</div>
	<!-- /底部 -->
</body>
</html>