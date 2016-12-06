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
<?php function get_attr_count($id) { $count = M("AttrType")->where("type_id = %d",$id)->count(); return $count; } ?>
<div class="form-inline definewidth m20">  
    <button type="button" class="btn btn-success" onclick="add();"><?php echo L('ADD');?></button>
    <button type="button" class="btn" onclick="foreverdel();"><?php echo L('DEL');?></button>
</div>

<div class="blank5"></div>

	<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="table table-bordered table-hover definewidth m10" cellpadding=0 cellspacing=0 ><tr><td colspan="7" class="topTd" style="padding:2px 10px;" ><a href="javascript:;" style="float:right;" onclick="window.location.reload()" class="icon-refresh"></a></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px    "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','index')" title="按照类型名称<?php echo ($sortType); ?> ">类型名称<?php if(($order) == "name"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照属性数    <?php echo ($sortType); ?> ">属性数    <?php if(($order) == "id"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('is_effect','<?php echo ($sort); ?>','index')" title="按照是否启用 <?php echo ($sortType); ?> ">是否启用 <?php if(($order) == "is_effect"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr class="row" ><td><input type="checkbox" name="key"	value="<?php echo ($user["id"]); ?>"></td><td><?php echo ($user["id"]); ?></td><td><a href="javascript:edit    ('<?php echo (addslashes($user["id"])); ?>')"><?php echo ($user["name"]); ?></a></td><td><?php echo (get_attr_count($user["id"])); ?></td><td><?php echo (get_is_effect($user["is_effect"],$user['id'])); ?></td><td><a href="javascript:attr_list('<?php echo ($user["id"]); ?>')">属性列表</a>&nbsp;<a href="javascript: edit('<?php echo ($user["id"]); ?>')">编辑</a>&nbsp;<a href="javascript: foreverdel('<?php echo ($user["id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="7" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->


  <div id="example_paginate" class="inline pull-right page"><?php echo ($page); ?></div>
  
</body>
<script type="text/javascript">
	function attr_list(id){
		var url =  ROOT+"/"+CONTROLLER_NAME+"/attr_list/type_id/"+id+".html";
		location.href = url;
	}
</script>
</html>