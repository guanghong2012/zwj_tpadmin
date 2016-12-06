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
<div class="main">
<div class="main_title"><?php echo L('ADD');?> <a href="<?php echo u(CONTROLLER_NAME."/attr_list",array("type_id"=>$info['type_id']));?>" class="back_list"><?php echo L('BACK_LIST');?></a></div>
<div class="blank5"></div>
<form name="edit" action="" class="definewidth" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="tableleft">属性名称:</td>
		<td class="tableright"><input type="text" class="textbox require" name="name" value="<?php echo ($info["name"]); ?>" /></td>
	</tr>

	<tr>
		<td class="tableleft">商品类型:</td>
		<td class="tableright">
				<select name="type_id">
					<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $info['type_id']): ?>selected<?php endif; ?>  ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
		</td>
	</tr>
	
	<tr>
		<td class="tableleft">排	序:</td>
		<td class="tableright"><input type="text" class="textbox" style="width:100px;" name="sort" value="<?php echo ($info["sort"]); ?>" /></td>
	</tr>

	<tr>
		<td class="tableleft">是否可选:</td>
		<td class="tableright">
			<label><input type="radio" name="attr_type" value="1" <?php if(($info["attr_type"]) == "1"): ?>checked="checked"<?php endif; ?> />唯一属性</label>
			<label><input type="radio" name="attr_type" value="2" <?php if(($info["attr_type"]) == "2"): ?>checked="checked"<?php endif; ?> />单选属性</label>
			<label><input type="radio" name="attr_type" value="3" <?php if(($info["attr_type"]) == "3"): ?>checked="checked"<?php endif; ?> />复选属性</label>
		</td>
	</tr>

	<tr>
		<td class="tableleft">录入方式:</td>
		<td class="tableright">
			<label><input type="radio" name="attr_input" onclick="attr_b()" value="1" <?php if(($info["attr_input"]) == "1"): ?>checked="checked"<?php endif; ?> />手工录入</label>
			<label><input type="radio" name="attr_input" onclick="attr_b()" value="2" <?php if(($info["attr_input"]) == "2"): ?>checked="checked"<?php endif; ?> />列表中选择（一行代表一个可选值）</label>
			<label><input type="radio" name="attr_input" onclick="attr_b()" value="3" <?php if(($info["attr_input"]) == "3"): ?>checked="checked"<?php endif; ?> />多行文本框</label>
		</td>
	</tr>

	<tr>
		<td class="tableleft">可选值列表:</td>
		<td class="tableright">
			<textarea name="attr_content" rows="5"><?php echo ($info["attr_content"]); ?></textarea>
		</td>
	</tr>

	<tr>
		<td class="tableleft"></td>
		<td class="tableright">
			<!--隐藏元素-->
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
			<!--隐藏元素-->
			<button type="submit" class="btn btn-primary" type="button">编辑</button> &nbsp;&nbsp;
			<a href="<?php echo u(CONTROLLER_NAME."/index");?>" class="btn btn-success">返回列表</a>
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>	 
</form>
</div>
<script type="text/javascript">
	function attr_b(){
		var v = $("input[name=attr_input]:checked").val();
		if(v == 2){
			$("textarea[name=attr_content]").attr("disabled",false);
		}else{
			$("textarea[name=attr_content]").attr("disabled",true);
		}

	}
	attr_b();
</script>
</body>
<?php if(!empty($uploadify)): ?><script language="javascript" type="text/javascript">
    //防止客户端缓存文件，造成uploadify.js不更新，而引起的“喔唷，崩溃啦”  
    document.write("<script type='text/javascript' " +
    "src='/zwj_tpadmin/uploadify/jquery.uploadify.min.js?" +
    Math.random() +
    "'></s" +
    "cript>");
</script>

<script language="javascript" type="text/javascript">
//图片上传
$(function(){
	setTimeout(function(){
		$('[type=file]').each(function(){
			var name = $(this).attr('name');
			var rep = $(this).attr('repetition');
			$(this).uploadify({
				'formData'     : {
					'name' : name,
					'repetition':rep
					
				},
				'swf'      : "/zwj_tpadmin/uploadify/uploadify.swf",
				'uploader' : '<?php echo U(CONTROLLER_NAME."/uploads");?>',
				'buttonText': '图片上传',
				'buttonClass':'btn btn-info',
				'width':65,
				'height':28,
				'onUploadSuccess': function(file, data, response){
					var v = eval('('+data+')');
					if (v.status == '1') {
						alert(v.msg);
						//$('[name=' + name + '_show]').attr('src',v.info);
						$('[name=' + name + ']').val(v.data.file);
						var str = "<img style='margin-left:10px;' name='"+ name +"' src='/zwj_tpadmin/Uploads/"+v.data.file+"' width='50' height='50' onclick='delimage(this,"+v.data.id+")'>";
						
						if(rep == 1){
							str += '<input type="hidden" name="' + name + '[]" value="'+v.data.id+'" />';
							$('[name=' + name + '_show]').append(str);
						}else{
							str += '<input type="hidden" name="' + name + '" value="'+v.data.file+'" />';
							$('[name=' + name + '_show]').html(str);
						}
					}else {
						alert(v.msg);
					}
				},
				'onUploadError' : function(file, errorCode, errorMsg, errorString) {
					alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
				},
			});
		});
	}, 10);
});
function delimage(obj,id){
	var name = $(obj).attr("name");
	var gid  = $("input[name=id]").val();
	if(confirm('确定要该图片删除吗？'))
	$.post('<?php echo U(CONTROLLER_NAME."/delimg");?>',{imageid:id,name:name,gid:gid},function(data){
		if(data.status == 1){
			alert(data.msg);
			$(obj).next("input[type=hidden]").remove();
			obj.remove();
		}else{
			alert(data.msg);
		}
	},"json");
}
</script><?php endif; ?>

</html>