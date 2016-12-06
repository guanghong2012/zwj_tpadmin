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

<div class="form-inline definewidth m20">  
    <button type="button" class="btn btn-success" onclick="add();"><?php echo L('ADD');?></button>
    <button type="button" class="btn" onclick="foreverdel();"><?php echo L('DEL');?></button>
</div>

<div class="blank5"></div>

	<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="table table-bordered table-hover definewidth m10" cellpadding=0 cellspacing=0 ><tr><td colspan="9" class="topTd" style="padding:2px 10px;" ><a href="javascript:;" style="float:right;" onclick="window.location.reload()" class="icon-refresh"></a></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px    "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('title','<?php echo ($sort); ?>','index')" title="按照模块名称    <?php echo ($sortType); ?> ">模块名称    <?php if(($order) == "title"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','index')" title="按照标识    <?php echo ($sortType); ?> ">标识    <?php if(($order) == "name"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="400px    "><a href="javascript:sortBy('description','<?php echo ($sort); ?>','index')" title="按照描述<?php echo ($sortType); ?> ">描述<?php if(($order) == "description"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('status','<?php echo ($sort); ?>','index')" title="按照是否启用     <?php echo ($sortType); ?> ">是否启用     <?php if(($order) == "status"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('create_time','<?php echo ($sort); ?>','index')" title="按照创建时间    <?php echo ($sortType); ?> ">创建时间    <?php if(($order) == "create_time"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr class="row" ><td><input type="checkbox" name="key"	value="<?php echo ($user["id"]); ?>"></td><td><?php echo ($user["id"]); ?></td><td><?php echo ($user["title"]); ?></td><td><?php echo ($user["name"]); ?></td><td><?php echo ($user["description"]); ?></td><td><?php echo (get_is_effect($user["status"],$user['id'])); ?></td><td><?php echo (to_date($user["create_time"])); ?></td><td><a href="javascript:config('<?php echo ($user["id"]); ?>')">设置</a>&nbsp;<a href="javascript: foreverdel('<?php echo ($user["id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="9" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->


  <div id="example_paginate" class="inline pull-right page"><?php echo ($page); ?></div>
<script>
//添加跳转
function add()
{
	location.href = ROOT+"/"+CONTROLLER_NAME+"/create.html";
}
function config(id){
	location.href = ROOT+"/"+CONTROLLER_NAME+"/config/id/"+id+".html";
}
</script>
</body>
</html>