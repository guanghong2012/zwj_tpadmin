<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<tagLib name="Html" />
<html>
<head>
    <title>后台管理系统</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="/zwj/Public/Admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/zwj/Public/Admin/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/zwj/Public/Admin/css/style.css" />

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
    <script type="text/javascript" src="/zwj/Public/Admin/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/zwj/Public/Admin/js/bootstrap.js"></script>
	<script type="text/javascript" src="/zwj/Public/Admin/js/ckform.js"></script>
	<script type="text/javascript" src="/zwj/Public/Admin/js/common.js"></script>
	<script type="text/javascript">
		var CONTROLLER_NAME     =   '<?php echo CONTROLLER_NAME; ?>';
		var ACTION_NAME =   '<?php echo ACTION_NAME; ?>';
		var CURRENT_URL = '<?php echo trim($_SERVER['REQUEST_URI']);?>';
		var ROOT = '/zwj/admin.php';   
		var ROOT_PATH = "__ADMIN__";
	</script>

	<script language="javascript" type="text/javascript">
		document.write("<script type='text/javascript' " +
		"src='/zwj/Public/Admin/js/script.js?" +
		Math.random() +
		"'></s" +
		"cript>");
	</script>
</head>
<body>

<div class="form-inline definewidth m20">  
    <button type="button" class="btn btn-success" onclick="backup();">备份数据</button>
    <button type="button" class="btn" onclick="optimize();">优化表</button>
    <button type="button" class="btn" onclick="repair();">修复表</button>
</div>

<div class="blank5"></div>

	<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="table table-bordered table-hover definewidth m10" cellpadding=0 cellspacing=0 ><tr><td colspan="7" class="topTd" style="padding:2px 10px;" ><a href="javascript:;" style="float:right;" onclick="window.location.reload()" class="icon-refresh"></a></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','tablist')" title="按照数据表名     <?php echo ($sortType); ?> ">数据表名     <?php if(($order) == "name"): ?><img src="/zwj/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('rows','<?php echo ($sort); ?>','tablist')" title="按照总记录     <?php echo ($sortType); ?> ">总记录     <?php if(($order) == "rows"): ?><img src="/zwj/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('create_time','<?php echo ($sort); ?>','tablist')" title="按照创建日期     <?php echo ($sortType); ?> ">创建日期     <?php if(($order) == "create_time"): ?><img src="/zwj/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('collation','<?php echo ($sort); ?>','tablist')" title="按照数据编码   <?php echo ($sortType); ?> ">数据编码   <?php if(($order) == "collation"): ?><img src="/zwj/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr class="row" ><td><input type="checkbox" name="key"	value="<?php echo ($user["id"]); ?>"></td><td><?php echo ($user["name"]); ?></td><td><?php echo ($user["rows"]); ?></td><td><?php echo ($user["create_time"]); ?></td><td><?php echo ($user["collation"]); ?></td><td><a href="javascript:backup('<?php echo ($user["id"]); ?>')">备份</a>&nbsp;<a href="javascript:optimize('<?php echo ($user["id"]); ?>')">优化</a>&nbsp;<a href="javascript:repair('<?php echo ($user["id"]); ?>')">修复</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="7" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->


  <div id="example_paginate" class="inline pull-right page"><?php echo ($page); ?></div>
  
<script>
function backup(id)
{
	
	if(!id)
	{
		
		idBox = $(":checkbox:checked");
		if(idBox.length == 0)
		{
			if(confirm('确定要备份整个数据库吗？'))
			$.ajax({
				url: ROOT+"/"+CONTROLLER_NAME+"/backall.html", 
				data: "ajax=1",
				dataType: "json",
				success: function(obj){
					if(obj.status==1)
					alert(obj.msg);
					//location.href = obj.data;
				}
			});
			return false;
		}
		idArray = new Array();
		$.each( idBox, function(i, n){
			idArray.push($(n).val());
		});
		id = idArray.join(",");
	}

	if(confirm('确定要备份选择的表吗？'))
	$.ajax({
		url: ROOT+"/"+CONTROLLER_NAME+"/backtables.html?tab="+id, 
		data: "ajax=1",
		dataType: "json",
		success: function(obj){
			if(obj.status==1)
			alert(obj.msg);
			//location.href = obj.data;
		}
	});
}
function optimize(id)
{
	
	if(!id)
	{
		
		idBox = $(":checkbox:checked");
		if(idBox.length == 0)
		{
			alert("请选择所要优化的表！");
			return false;
		}
		idArray = new Array();
		$.each( idBox, function(i, n){
			idArray.push($(n).val());
		});
		id = idArray.join(",");
	}

	if(confirm('确定要优化选择的表吗？'))
	$.ajax({
		url: ROOT+"/"+CONTROLLER_NAME+"/optimize.html?table="+id, 
		data: "ajax=1",
		dataType: "json",
		success: function(obj){
			if(obj.status==1)
			alert(obj.msg);
			//location.href = obj.data;
		}
	});
}
function repair(id)
{
	
	if(!id)
	{
		
		idBox = $(":checkbox:checked");
		if(idBox.length == 0)
		{
			alert("请选择所要修复的表！");
			return false;
		}
		idArray = new Array();
		$.each( idBox, function(i, n){
			idArray.push($(n).val());
		});
		id = idArray.join(",");
	}

	if(confirm('确定要修复选择的表吗？'))
	$.ajax({
		url: ROOT+"/"+CONTROLLER_NAME+"/repair.html?table="+id, 
		data: "ajax=1",
		dataType: "json",
		success: function(obj){
			if(obj.status==1)
			alert(obj.msg);
			//location.href = obj.data;
		}
	});
}
</script>
</body>
</html>