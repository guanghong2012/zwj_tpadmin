<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<tagLib name="Html" />
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

<script type="text/javascript" src="/zwj_tpadmin/Public/Admin/js/adddate.js"></script>
<?php function get_admin_user($id,$deal) { return $deal[$id]; } function getStatus($t){ if($t == 1){ return "操作成功"; }else{ return "操作失败"; } } ?>

<div class="form-inline definewidth m20">  
	<div class="search_row">
		<div class="blank5"></div>
		<form name="search" action="" method="get">	
			<level>管理员：
				<select name="log_admin" >
					<option value="">全  部</option>
					<?php if(is_array($admin_name)): $i = 0; $__LIST__ = $admin_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i); ?>" <?php if($i == $_REQUEST['log_admin']): ?>selected<?php endif; ?> ><?php echo ($v); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</level>
			<level>操作模块：<input type='text' style='width:80px;' name='model' value='<?php echo ($_REQUEST["model"]); ?>' ></level>
			<level>操作时间：
				<input type='text' name='start_time' style='width:100px;' value='<?php echo ($_REQUEST["start_time"]); ?>' id="start_time" onclick="SelectDate(this,'yyyy-MM-dd')" >
				 - 
				<input type='text' name='end_time' value='<?php echo ($_REQUEST["end_time"]); ?>' style='width:100px;' id="end_time" onclick="SelectDate(this,'yyyy-MM-dd')">
			</level>
			<button type="submit" class="btn btn-primary">查询</button>
			
			<input type="button" class="btn" style="float:right;" value="刷新" onclick="window.location.reload()">
		</form>
	</div>
</div>

<div class="blank5"></div>

	<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="table table-bordered table-hover definewidth m10" cellpadding=0 cellspacing=0 ><tr><td colspan="11" class="topTd" style="padding:2px 10px;" ><a href="javascript:;" style="float:right;" onclick="window.location.reload()" class="icon-refresh"></a></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px    "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('log_admin','<?php echo ($sort); ?>','index')" title="按照操作管理员    <?php echo ($sortType); ?> ">操作管理员    <?php if(($order) == "log_admin"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('module','<?php echo ($sort); ?>','index')" title="按照操作模块    <?php echo ($sortType); ?> ">操作模块    <?php if(($order) == "module"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('action','<?php echo ($sort); ?>','index')" title="按照操作方法    <?php echo ($sortType); ?> ">操作方法    <?php if(($order) == "action"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('log_time','<?php echo ($sort); ?>','index')" title="按照操作时间    <?php echo ($sortType); ?> ">操作时间    <?php if(($order) == "log_time"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('log_ip','<?php echo ($sort); ?>','index')" title="按照操作IP    <?php echo ($sortType); ?> ">操作IP    <?php if(($order) == "log_ip"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('log_info','<?php echo ($sort); ?>','index')" title="按照操作说明    <?php echo ($sortType); ?> ">操作说明    <?php if(($order) == "log_info"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('log_status','<?php echo ($sort); ?>','index')" title="按照操作状态 <?php echo ($sortType); ?> ">操作状态 <?php if(($order) == "log_status"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr class="row" ><td><input type="checkbox" name="key"	value="<?php echo ($user["id"]); ?>"></td><td><?php echo ($user["id"]); ?></td><td><?php echo (get_admin_user($user["log_admin"],$admin_name)); ?></td><td><?php echo ($user["module"]); ?></td><td><?php echo ($user["action"]); ?></td><td><?php echo (to_date($user["log_time"])); ?></td><td><?php echo ($user["log_ip"]); ?></td><td><?php echo ($user["log_info"]); ?></td><td><?php echo (getStatus($user["log_status"])); ?></td><td><a href="javascript:foreverdel('<?php echo ($user["id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="11" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->


  <div id="example_paginate" class="inline pull-right page"><?php echo ($page); ?></div>
  
</body>
</html>