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
<?php function get_attr_name($id,$data) { return $data[$id]; } function get_attr_input($tag){ $data = array("1"=>"手工录入","2"=>"列表中选择","3"=>"多行文本框"); return $data[$tag]; } ?>
<div class="form-inline definewidth m20">  
    <button type="button" class="btn btn-success" onclick="add(<?php echo ($_REQUEST['type_id']); ?>);"><?php echo L('ADD');?></button>
    <button type="button" class="btn" onclick="foreverdel();"><?php echo L('DEL');?></button>
</div>

<div class="form-inline definewidth m20">  
	<div class="search_row">
		<div class="blank5"></div>
		<form name="search" action="" method="get">	
			<level>商品类型：
				<select name="type_id" >
					<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $_REQUEST['type_id']): ?>selected<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</level>
			
			<button type="submit" class="btn btn-primary">查询</button>
			
		</form>
	</div>
</div>

<div class="blank5"></div>

	<!-- Think 系统列表组件开始 -->
<table id="dataTable" class="table table-bordered table-hover definewidth m10" cellpadding=0 cellspacing=0 ><tr><td colspan="9" class="topTd" style="padding:2px 10px;" ><a href="javascript:;" style="float:right;" onclick="window.location.reload()" class="icon-refresh"></a></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('dataTable')"></th><th width="50px    "><a href="javascript:sortBy('id','<?php echo ($sort); ?>','attr_list')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','attr_list')" title="按照属性名称<?php echo ($sortType); ?> ">属性名称<?php if(($order) == "name"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('type_id','<?php echo ($sort); ?>','attr_list')" title="按照商品类型    <?php echo ($sortType); ?> ">商品类型    <?php if(($order) == "type_id"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('attr_input','<?php echo ($sort); ?>','attr_list')" title="按照录入方式    <?php echo ($sortType); ?> ">录入方式    <?php if(($order) == "attr_input"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('attr_content','<?php echo ($sort); ?>','attr_list')" title="按照可选值列表    <?php echo ($sortType); ?> ">可选值列表    <?php if(($order) == "attr_content"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('sort','<?php echo ($sort); ?>','attr_list')" title="按照排序 <?php echo ($sortType); ?> ">排序 <?php if(($order) == "sort"): ?><img src="/zwj_tpadmin/Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr class="row" ><td><input type="checkbox" name="key"	value="<?php echo ($user["id"]); ?>"></td><td><?php echo ($user["id"]); ?></td><td><a href="javascript:edit    ('<?php echo (addslashes($user["id"])); ?>')"><?php echo ($user["name"]); ?></a></td><td><?php echo (get_attr_name($user["type_id"],$type_name)); ?></td><td><?php echo (get_attr_input($user["attr_input"])); ?></td><td><?php echo ($user["attr_content"]); ?></td><td><?php echo ($user["sort"]); ?></td><td><a href="javascript:edit('<?php echo ($user["id"]); ?>')">编辑</a>&nbsp;<a href="javascript: foreverdel('<?php echo ($user["id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="9" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->


  <div id="example_paginate" class="inline pull-right page"><?php echo ($page); ?></div>
  
</body>
<script type="text/javascript">
	function add(id){
		location.href = ROOT+"/"+CONTROLLER_NAME+"/attr_add/type_id/"+id+".html";
	}

	function edit(id){
		location.href = ROOT+"/"+CONTROLLER_NAME+"/attr_edit/id/"+id+".html";
	}

	//完全删除
	function foreverdel(id)
	{
		
		if(!id)
		{
			
			idBox = $(":checkbox:checked");
			if(idBox.length == 0)
			{
				alert('请选择要删除的选项');
				return;
			}
			idArray = new Array();
			$.each( idBox, function(i, n){
				idArray.push($(n).val());
			});
			id = idArray.join(",");
		}

		if(confirm('确定要删除吗？'))
		$.ajax({ 
			url: ROOT+"/"+CONTROLLER_NAME+"/attr_delete.html?id="+id, 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){
				$("#info").html(obj.info);
				if(obj.status==1)
				location.href=location.href;
			}
		});
	}
</script>
</html>