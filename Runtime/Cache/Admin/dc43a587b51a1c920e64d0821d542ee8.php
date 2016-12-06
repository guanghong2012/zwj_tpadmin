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
<form name="edit" action="<?php echo U('conf/insert');?>" class="definewidth m20" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10" >
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="tableleft" style="width:180px;">水印图片:</td>
		<td class="item_input">
			<div style="float:left;position: relative;"><input type="file" id="WATER_IMG" name="WATER_IMG" repetition="0" /></div><div style="float:left;margin-left:20px;height:50px;line-height:45px" name="WATER_IMG_show"><?php if(is_array($water)): $i = 0; $__LIST__ = $water;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img style="margin-left:10px;" src="/zwj_tpadmin/Uploads/<?php echo (addslashes($vo["file"])); ?>" width="50" height="45" onclick="delimage(this,'<?php echo (addslashes($vo["id"])); ?>')"/><?php endforeach; endif; else: echo "" ;endif; ?></div>
		</td>
	</tr>
	<tr>
		<td class="tableleft">水印透明度:</td>
		
		<td class="item_input"><input type="text" class="textbox" name="WATER_ALPHA" value="<?php echo ($conf['WATER_ALPHA']); ?>" /></td>
	</tr>
	<tr>
		<td class="tableleft">水印位置:</td>
		<td class="item_input">
			<select name="WATER_POSITION">
				<option value="1" <?php if($conf['WATER_POSITION'] == 1): ?>selected="selected"<?php endif; ?> >左上角</option>
				<option value="2" <?php if($conf['WATER_POSITION'] == 2): ?>selected="selected"<?php endif; ?> >上居中</option>
				<option value="3" <?php if($conf['WATER_POSITION'] == 3): ?>selected="selected"<?php endif; ?> >右上角</option>
				<option value="4" <?php if($conf['WATER_POSITION'] == 4): ?>selected="selected"<?php endif; ?> >左居中</option>
				<option value="5" <?php if($conf['WATER_POSITION'] == 5): ?>selected="selected"<?php endif; ?> >居中</option>
				<option value="6" <?php if($conf['WATER_POSITION'] == 6): ?>selected="selected"<?php endif; ?> >右居中</option>
				<option value="7" <?php if($conf['WATER_POSITION'] == 7): ?>selected="selected"<?php endif; ?> >左下角</option>
				<option value="8" <?php if($conf['WATER_POSITION'] == 8): ?>selected="selected"<?php endif; ?> >下居中</option>
				<option value="9" <?php if($conf['WATER_POSITION'] == 9): ?>selected="selected"<?php endif; ?> >右下角</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="tableleft">开启水印:</td>
		<td class="item_input">
			<select name="WATER">
				<option value="0" <?php if($conf['WATER'] == 0): ?>selected="selected"<?php endif; ?> >关闭</option>
				<option value="1" <?php if($conf['WATER'] == 1): ?>selected="selected"<?php endif; ?> >开启</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="tableleft">上传图片大小(字节):</td>
		<td class="item_input">
			<input type="text" class="textbox" name="IMG_SIXE" value="<?php echo ($conf['IMG_SIXE']); ?>" />
		</td>
	</tr>

	<tr>
		<td class="tableleft">上传图片类型:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="IMG_TYPE" value="<?php echo ($conf['IMG_TYPE']); ?>" />
		</td>
	</tr>
	<tr>
		<td class="tableleft">开启缩略图:</td>
		<td class="item_input">
			<select name="THUMB">
				<option value="0" <?php if($conf['THUMB'] == 0): ?>selected="selected"<?php endif; ?> >关闭</option>
				<option value="1" <?php if($conf['THUMB'] == 1): ?>selected="selected"<?php endif; ?> >开启</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="tableleft">缩略图长:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="THUMB_WIDTH" value="<?php echo ($conf['THUMB_WIDTH']); ?>" />
		</td>
	</tr>
	<tr>
		<td class="tableleft">缩略图高:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="THUMB_HEIGHT" value="<?php echo ($conf['THUMB_HEIGHT']); ?>" />
		</td>
	</tr>
	<tr>
		<td class="tableleft">缩略图类型:</td>
		<td class="item_input">
			<select name="THUMB_TYPE">
				<option value="1" <?php if($conf['THUMB_TYPE'] == 1): ?>selected="selected"<?php endif; ?> >等比例缩放</option>
				<option value="2" <?php if($conf['THUMB_TYPE'] == 2): ?>selected="selected"<?php endif; ?> >缩放后填充</option>
				<option value="3" <?php if($conf['THUMB_TYPE'] == 3): ?>selected="selected"<?php endif; ?> >居中裁剪</option>
				<option value="4" <?php if($conf['THUMB_TYPE'] == 4): ?>selected="selected"<?php endif; ?> >左上角裁剪</option>
				<option value="5" <?php if($conf['THUMB_TYPE'] == 5): ?>selected="selected"<?php endif; ?> >右下角裁剪</option>
				<option value="6" <?php if($conf['THUMB_TYPE'] == 6): ?>selected="selected"<?php endif; ?> >固定尺寸缩放</option>
			</select>
		</td>
	</tr>

	<tr>
        <td class="tableleft"></td>
        <td>
			<input type="submit" class="btn btn-primary" value="<?php echo L('EDIT');?>" />
			<input type="reset" class="btn btn-success" class="button" value="<?php echo L('RESET');?>" />
        </td>
    </tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>		 
</form>

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