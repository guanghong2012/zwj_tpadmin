<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="/zwj/Public/Admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/zwj/Public/Admin/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/zwj/Public/Admin/css/style.css" />
    <script type="text/javascript" src="/zwj/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/zwj/Public/Admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="/zwj/Public/Admin/js/ckform.js"></script>
    <script type="text/javascript" src="/zwj/Public/Admin/js/common.js"></script>

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
		.table th,
		.table td {
		  padding: 8px;
		  line-height: 20px;
		  text-align: center;
		  vertical-align: top;
		  border-top: 1px solid #dddddd;
		}
		input,textarea,.uneditable-input { width: 120px;}
		select{width: 120px;}
		input[type="checkbox"]{margin:0px;}
    </style>
</head>
<body>
	<form name="search" action="" method="post">	
	<div class="definewidth m20"><b style="color:red;">添加表字段</b></div>
	<table class="table table-bordered table-hover definewidth m10" id="info_extend_field_box" >
		<thead>
		<tr>
			<th>名称</th>
			<th>字段名(不可更改)</th>
			<th>说明</th>
			<th>排序</th>
			<th>显示</th>
			<th>隐藏</th>
			<th>非空</th>
			<th>搜索</th>
			<th>唯一</th>
			<th>类型</th>
			<th width="50px">默认</th>
			<th width="80px">附加属性</th>
			<th width="150px">数据<br/><span style="color:red" >用竖线分割,赋值可以用等于<br/>例如:1=深圳 | 2=广州</span></th>
			<th width="50px">操作</th>
		</tr>
		</thead>
		<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<input type="hidden" name="zl[<?php echo ($vo['id']); ?>][id]" class="input-default" value="<?php echo ($vo['id']); ?>" />
			<td><input type="text" name="zl[<?php echo ($vo['id']); ?>][name]" class="input-default" value="<?php echo ($vo['name']); ?>" /></td>
			<td><input type="text"  width="80px" readonly name="zl[<?php echo ($vo['id']); ?>][field]" style="width:80px" class="input-default" value="<?php echo ($vo['field']); ?>" /></td>
			<td><input type="text" name="zl[<?php echo ($vo['id']); ?>][explain]" class="input-default" value="<?php echo ($vo['explain']); ?>" /></td>
			<td><input type="text" name="zl[<?php echo ($vo['id']); ?>][sort]" class="input-default" style="width:50px" value="<?php echo ($vo['sort']); ?>" /></td>
			<td><input type="checkbox" value="true" <?php if(($vo['show']) == "1"): ?>checked<?php endif; ?> name="zl[<?php echo ($vo['id']); ?>][show]" /></td>
			<td><input type="checkbox" value="true" <?php if(($vo['hide']) == "1"): ?>checked<?php endif; ?> name="zl[<?php echo ($vo['id']); ?>][hide]" /></td>
			<td><input type="checkbox" value="true" <?php if(($vo['notempty']) == "1"): ?>checked<?php endif; ?> name="zl[<?php echo ($vo['id']); ?>][notempty]" /></td>
			<td><input type="checkbox" value="true" <?php if(($vo['search']) == "1"): ?>checked<?php endif; ?> name="zl[<?php echo ($vo['id']); ?>][search]" /></td>
			<td><input type="checkbox" value="true" <?php if(($vo['only']) == "1"): ?>checked<?php endif; ?> name="zl[<?php echo ($vo['id']); ?>][only]" /></td>
			<td>
				<select name="zl[<?php echo ($vo['id']); ?>][type]" onchange="data(this,<?php echo ($vo['id']); ?>)">
					<option <?php if(($vo['type']) == "1"): ?>selected<?php endif; ?> value="1">字符串</option>
					<option <?php if(($vo['type']) == "2"): ?>selected<?php endif; ?> value="2">数值型</option>
					<option <?php if(($vo['type']) == "3"): ?>selected<?php endif; ?> value="3">密码框</option>
					<option <?php if(($vo['type']) == "4"): ?>selected<?php endif; ?> value="4">文本框</option>
					<option <?php if(($vo['type']) == "5"): ?>selected<?php endif; ?> value="5">富文本框</option>
					<option <?php if(($vo['type']) == "6"): ?>selected<?php endif; ?> value="6">文件上传</option>
					<option <?php if(($vo['type']) == "16"): ?>selected<?php endif; ?> value="16">多图上传</option>
					<option <?php if(($vo['type']) == "7"): ?>selected<?php endif; ?> value="7">下拉框</option>
					<option <?php if(($vo['type']) == "8"): ?>selected<?php endif; ?> value="8">下拉框(关联表)</option>
					<option <?php if(($vo['type']) == "9"): ?>selected<?php endif; ?> value="9">单选</option>
					<option <?php if(($vo['type']) == "10"): ?>selected<?php endif; ?> value="10">复选</option>
					<option <?php if(($vo['type']) == "11"): ?>selected<?php endif; ?> value="11">复选(关联表)</option>
					<option <?php if(($vo['type']) == "12"): ?>selected<?php endif; ?> value="12">手机格式</option>
					<option <?php if(($vo['type']) == "13"): ?>selected<?php endif; ?> value="13">邮箱格式</option>
					<option <?php if(($vo['type']) == "14"): ?>selected<?php endif; ?> value="14">价格格式</option>
					<option <?php if(($vo['type']) == "15"): ?>selected<?php endif; ?> value="15">时间格式</option>
				</select>
			</td>
			<td><input type="text" style="width:45px" name="zl[<?php echo ($vo['id']); ?>][default]" class="input-default" value="<?php echo ($vo['default']); ?>" /></td>
			<td><input type="text" style="width:80px" name="zl[<?php echo ($vo['id']); ?>][attr]" class="input-default" value="<?php echo ($vo['attr']); ?>" /></td>
			<td width="200px" id="data<?php echo ($vo['id']); ?>" ><?php if(!empty($vo["data"])): ?><input type="text" name="zl[<?php echo ($vo['id']); ?>][data]" value="<?php echo ($vo['data']); ?>" style="width:150px;" size="10" /><?php endif; ?></td>
			<td><a href="javascript:;" onclick="del_field(<?php echo ($vo['id']); ?>)" style="width:50px;">删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="definewidth m20"><b style="color:red;">添加操作</b></div>
	<table class="table table-bordered table-hover definewidth m10" id="info_extend_operate_box" >
		<thead>
		<tr>
			<th width="200">操作名称</th>
			<th width="150">排序</th>
			<th width="50">显示</th>
			<th>链接<br/>
			<span style="color:red" >
				链接里可以使用字段里的变量需要在使用的变量前加个$,如：$id
				<br/>
				也可以使用已加载的JS函数如：javascript:edit($id);
			</span>
			</th>
			<th width="50px">操作</th>
		</tr>
		</thead>
		<?php if(is_array($operate)): $i = 0; $__LIST__ = $operate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<input type="hidden" name="op[<?php echo ($vo['id']); ?>][id]" class="input-default" value="<?php echo ($vo['id']); ?>" />
			<td><input type="text" name="op[<?php echo ($vo['id']); ?>][name]" class="input-default" value="<?php echo ($vo['name']); ?>" /></td>
			<td><input type="text" name="op[<?php echo ($vo['id']); ?>][sort]" class="input-default" style="width:50px" value="<?php echo ($vo['sort']); ?>" /></td>
			<td><input type="checkbox" value="true" <?php if(($vo['show']) == "1"): ?>checked<?php endif; ?> name="op[<?php echo ($vo['id']); ?>][show]" /></td>
			<td><input type="text" name="op[<?php echo ($vo['id']); ?>][url]" class="input-default" value="<?php echo ($vo['url']); ?>"  style="width:400px" /></td>
			<td><a href="javascript:;" onclick="del_operate(<?php echo ($vo['id']); ?>)">删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<input name="table" value="<?php echo ($table); ?>" type="hidden" >
	<input name="menu_id" value="<?php echo ($menu_id); ?>" type="hidden" >
	<div class="definewidth m20">  
		<button type="button" onclick="add_info_extend_field();" class="btn btn-primary">添加字段</button>
		<button type="button" onclick="add_info_extend_operate();" class="btn btn-primary">添加操作</button>
		<button type="submit" class="btn btn-success" style="float:right;" >提交信息</button>
	</div>
	</form>
</body>
</html>

<script type="text/javascript">
	var info_extend_field_id = <?php echo ($sort); ?>;
	var info_extend_operate_id = <?php echo ($operatesort); ?>;
	function add_info_extend_field(){
		info_extend_field_id++;
		var table = document.getElementById('info_extend_field_box');
		var tr = table.insertRow(-1);
		tr.id="info_extend_field_row_"+info_extend_field_id;
		
		var td1 = tr.insertCell(-1);
		td1.innerHTML = "<input type=\"text\" name=\"zl["+info_extend_field_id+"][name]\" class=\"input-default\" />";
		
		var td11 = tr.insertCell(-1);
		td11.innerHTML = "<input type=\"text\" name=\"zl["+info_extend_field_id+"][field]\" style=\"width:80px\" class=\"input-default\" />";
		
		var td12 = tr.insertCell(-1);
		td12.innerHTML = "<input type=\"text\" name=\"zl["+info_extend_field_id+"][explain]\" class=\"input-default\" />";
		
		var td2 = tr.insertCell(-1);
		td2.innerHTML = "<input type=\"text\" name=\"zl["+info_extend_field_id+"][sort]\" value=\""+(info_extend_field_id*10)+"\" style=\"width:50px\" />";
		
		var td13 = tr.insertCell(-1);
		td13.innerHTML = "<input type=\"checkbox\" value=\"true\" name=\"zl["+info_extend_field_id+"][show]\" />";

		var td3 = tr.insertCell(-1);
		td3.innerHTML = "<input type=\"checkbox\" value=\"true\" name=\"zl["+info_extend_field_id+"][hide]\" />";
		
		var td4 = tr.insertCell(-1);
		td4.innerHTML = "<input type=\"checkbox\" value=\"true\" name=\"zl["+info_extend_field_id+"][notempty]\" /></select>";
		
		var td5 = tr.insertCell(-1);
		td5.innerHTML = "<input type=\"checkbox\" value=\"true\" name=\"zl["+info_extend_field_id+"][search]\" />";
		
		var td6 = tr.insertCell(-1);
		td6.innerHTML = "<input type=\"checkbox\" value=\"true\" name=\"zl["+info_extend_field_id+"][only]\" />";

		var td7 = tr.insertCell(-1);
		td7.innerHTML = "<select name=\"zl["+info_extend_field_id+"][type]\" onchange=\"data(this,"+info_extend_field_id+")\"><option value=\"1\">字符串</option><option value=\"2\">数值型</option><option value=\"3\">密码框</option><option value=\"4\">文本框</option><option value=\"5\">富文本框</option><option value=\"6\">文件上传</option><option value=\"16\">多图上传</option><option value=\"7\">下拉框</option><option value=\"8\">下拉框(关联表)</option><option value=\"9\">单选</option><option value=\"10\">复选</option><option value=\"11\">复选(关联表)</option><option value=\"12\">手机格式</option><option value=\"13\">邮箱格式</option><option  value=\"14\">价格格式</option><option value=\"15\">时间格式</option></select>";

		var td15 = tr.insertCell(-1);
		td15.innerHTML = "<input type=\"text\" style=\"width:50px\" name=\"zl["+info_extend_field_id+"][attr]\" class=\"input-default\" />";

		var td8 = tr.insertCell(-1);
		td8.innerHTML = "<input type=\"text\" style=\"width:80px\" name=\"zl["+info_extend_field_id+"][default]\" class=\"input-default\" />";

		var td9 = tr.insertCell(-1);
		td9.width='200px';
		td9.id = 'data'+info_extend_field_id;
		//td9.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][title]\" size=\"10\" />";
		
		var td15 = tr.insertCell(-1);
		td15.innerHTML = "<a href=\"javascript:;\" onclick=\"del_info_extend_field("+info_extend_field_id+")\">删除</a>";
	}
	function add_info_extend_operate(){
		info_extend_operate_id++;
		var table = document.getElementById('info_extend_operate_box');
		var tr = table.insertRow(-1);
		tr.id="info_extend_operate_row_"+info_extend_operate_id;
		
		var td1 = tr.insertCell(-1);
		td1.innerHTML = "<input type=\"text\" name=\"op["+info_extend_operate_id+"][name]\" class=\"input-default\" />";
		
		var td11 = tr.insertCell(-1);
		td11.innerHTML = "<input type=\"text\" name=\"op["+info_extend_operate_id+"][sort]\" value=\""+(info_extend_operate_id*10)+"\" style=\"width:50px\" />";
		
		var td3 = tr.insertCell(-1);
		td3.innerHTML = "<input type=\"checkbox\" checked value=\"true\" name=\"op["+info_extend_operate_id+"][show]\" />";
		
		var td12 = tr.insertCell(-1);
		td12.innerHTML = "<input type=\"text\" name=\"op["+info_extend_operate_id+"][url]\" class=\"input-default\" style=\"width:400px\" />";
		
		var td15 = tr.insertCell(-1);
		td15.innerHTML = "<a href=\"javascript:;\" onclick=\"del_info_operate_field("+info_extend_operate_id+")\">删除</a>";
	}
	function del_info_extend_field(id){
		var t = document.getElementById('info_extend_field_box');
		var d = t.getElementsByTagName('tr');
		for(var i=0;i<d.length;i++){
			if(d[i].id=="info_extend_field_row_"+id){
				t.deleteRow(i);
			}
		}
	}
	function del_info_operate_field(id){
		var t = document.getElementById('info_extend_operate_box');
		var d = t.getElementsByTagName('tr');
		for(var i=0;i<d.length;i++){
			if(d[i].id=="info_extend_operate_row_"+id){
				t.deleteRow(i);
			}
		}
	}
	function data(obj,id){
		
		var index = obj.selectedIndex;
		
		var type = obj.options[index].value;
		
		var td = document.getElementById("data"+id);
		if(type == 8 || type == 11){
			td.innerHTML = '<select style=\"width:80px;\" name=\"zl['+id+'][data][table]\" onchange=\"field(this,'+id+')\" ><option>-请选择-</option><?php echo ($menu_table); ?></select>  <select id=\"field'+id+'\" name=\"zl['+id+'][data][field]\" style=\"width:80px;\" ><option value=\"\">关联字段</option></select>';
		}else if(type == 7 || type == 9 || type == 10){
			td.innerHTML = ' <input type=\"text\" name=\"zl['+id+'][data]\" style=\"width:200px;\" size=\"10\" />';
		}else{
			td.innerHTML = '';
		}
	}
	function field(obj,id){
		var index = obj.selectedIndex;
		var type = obj.options[index].value;
		var td = document.getElementById("field"+id);
		$.post("<?php echo U('Menu/field');?>",{table:type},function(html){
			td.innerHTML = '<select name=\"zl[data]['+id+'][field]\" >'+html+'</select>';
		});
		
	}
	function del_field(id){
		if(confirm('确认删除吗?删除后不能恢复！')){
			$.ajax({ 
			url: "<?php echo U('Menu/del_field');?>"+"?id="+id, 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){
				if(obj.status==1)
				location.href=location.href;
			}
			});
		}
	}
	function del_operate(id){
		if(confirm('确认删除吗?删除后不能恢复！')){
			$.ajax({ 
			url: "<?php echo U('Menu/del_operate');?>"+"?id="+id, 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){
				if(obj.status == 1)
				location.href=location.href;
			}
			});
		}
	}
</script>