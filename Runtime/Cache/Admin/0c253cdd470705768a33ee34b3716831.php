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
<div class="main_title"><?php echo L('EDIT');?> <a href="<?php echo u("Role/index");?>" class="back_list"><?php echo L('BACK_LIST');?></a></div>
<div class="blank5"></div>
<form name="edit" class="definewidth" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="tableleft" style="font-size: 24px;text-align: center;">权限:</td>
		<td class="tableright">
			<table class="access_list" cellpadding=0 cellspacing=0 width="99%">
			<?php if(is_array($access_list)): foreach($access_list as $key=>$access_item): ?><tr>
					<td class="access_left" style="width:180px;">
					<span title="<?php echo ($access_item["module"]); ?>"><?php echo ($access_item["name"]); ?></span>&nbsp;&nbsp;<input type="checkbox" value="<?php echo ($access_item["id"]); ?>_0" name="role_access[]" class="check_all" <?php if(in_array(($access_item["id"]), is_array($menu_ids)?$menu_ids:explode(',',$menu_ids))): ?>checked="checked"<?php endif; ?> onclick="check_module(this);" />
					
					</td>
					<td>

						<?php if(is_array($access_item["node_list"])): foreach($access_item["node_list"] as $key=>$node_item): ?><label style="padding:5px;"><span title="<?php echo ($node_item["action"]); ?>"><?php echo ($node_item["name"]); ?>&nbsp;</span><input type="checkbox" value="<?php echo ($access_item["id"]); ?>_<?php echo ($node_item["id"]); ?>" name="role_access[]" class="node_item" <?php if(in_array(($node_item["id"]), is_array($menu_ids)?$menu_ids:explode(',',$menu_ids))): ?>checked="checked"<?php endif; ?>  onclick="check_is_all(this);" /></label><?php endforeach; endif; ?>

					</td>
				</tr><?php endforeach; endif; ?>
			</table>
		</td>
	</tr>
	
	<tr>
		<td class="tableleft"></td>
		<td class="tableright">
			<!--隐藏元素-->
			<input type="hidden" name="role_id" value="<?php echo trim($_REQUEST['role_id']);?>" />
			<!--隐藏元素-->
			<button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;
			<a href="<?php echo u(CONTROLLER_NAME."/index");?>" class="btn btn-success">返回列表</a>
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>	 
</form>
</div>
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