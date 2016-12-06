<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
<head>
    <title>后台管理系统</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="/zwj_tpadmin/Public/Admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/zwj_tpadmin/Public/Admin/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/zwj_tpadmin/Public/Admin/css/style.css" />

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
        .nav-item-inner{
            width:35px;float:left;
        }
        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>
    <script type="text/javascript" src="/zwj_tpadmin/Public/Admin/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/zwj_tpadmin/Public/Admin/js/bootstrap.js"></script>
	<script type="text/javascript" src="/zwj_tpadmin/Public/Admin/js/ckform.js"></script>
	<script type="text/javascript" src="/zwj_tpadmin/Public/Admin/js/common.js"></script>
	<script type="text/javascript">
		var CONTROLLER_NAME     =   '<?php echo CONTROLLER_NAME; ?>';
		var ACTION_NAME =   '<?php echo ACTION_NAME; ?>';
		var CURRENT_URL = '<?php echo trim($_SERVER['REQUEST_URI']);?>';
		var ROOT = '/zwj_tpadmin/admin.php';   
		var ROOT_PATH = "__ADMIN__";
	</script>

	<script language="javascript" type="text/javascript">
		document.write("<script type='text/javascript' " +
		"src='/zwj_tpadmin/Public/Admin/js/script.js?" +
		Math.random() +
		"'></s" +
		"cript>");
	</script>
</head>
<body>
<div class="qbt_nidelikai">
<div class="form-inline definewidth m20">
  <span><span class="txtt">后台管理</span></span>
</div>

<table class="table table-bordered table-hover definewidth m10" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td width="30%" height="30" align="right">系统版本：</td>
	<td width="70%" height="30">v<?php echo SYSTEM_VER; ?></td>
  </tr>
  <tr>
	<td width="30%" height="30" align="right">最近备份数据日期：</td>
	<td width="70%" height="30"><?php echo ($fileTime); ?></td>
  </tr>
  <tr>
	<td width="30%" height="30" align="right">空间大小：</td>
	<td width="70%" height="30"><?php echo number_format(disk_free_space('../')/1024/1024,2,'.','').'M'.'/'.number_format(disk_total_space('../')/1024/1024,2,'.','').'M';?></td>
  </tr>
  <tr>
	<td width="30%" height="30" align="right">当前时间：</td>
	<td width="70%" height="30"><?php echo date("Y");?>年<?php echo date("m");?>月<?php echo date("d");?>日　<?php echo date("G:i:s");?></td>
  </tr>
  <tr>
	<td height="30" align="right">当前IP地址：</td>
	<td height="30"><?php echo $_SERVER["REMOTE_ADDR"];?></td>
  </tr>
  <tr>
	<td height="30" align="right">服务器名称：</td>
	<td height="30"><?php echo $_SERVER["SERVER_SOFTWARE"];?></td>
  </tr>
  <tr>
	<td height="30" align="right">屏幕分辨率：</td>
	<td height="30">
	<script language="javascript">
	<!--
	document.write(screen.width+"*"+screen.height)
	//-->
	</script>
	</td>
  </tr>
</table>

</div>
</body>
</html>