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
		<td class="tableleft">SMTP服务器:</td>
		
		<td class="item_input"><input type="text" class="textbox" name="MAIL_HOST" value="<?php echo ($conf['MAIL_HOST']); ?>" /></td>
	</tr>
	
	<tr>
		<td class="tableleft">SMTP认证:</td>
		<td class="item_input">
			<select name="MAIL_SMTPAUTH">
				<option value="false" <?php if($conf['MAIL_SMTPAUTH'] == false): ?>selected="selected"<?php endif; ?> >关闭</option>
				<option value="true" <?php if($conf['MAIL_SMTPAUTH'] == true): ?>selected="selected"<?php endif; ?> >开启</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="tableleft">发件人:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="MAIL_FROMNAME" value="<?php echo ($conf['MAIL_FROMNAME']); ?>" />
		</td>
	</tr>
	<tr>
		<td class="tableleft">您的邮箱:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="MAIL_USERNAME" value="<?php echo ($conf['MAIL_USERNAME']); ?>" />
		</td>
	</tr>
	
	<tr>
		<td class="tableleft">发件人地址:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="MAIL_FROM" value="<?php echo ($conf['MAIL_FROM']); ?>" />
		</td>
	</tr>
	
	<tr>
		<td class="tableleft">邮箱密码:</td>
		<td class="item_input">
			<input type="password" class="textbox" name="MAIL_PASSWORD" value="<?php echo ($conf['MAIL_PASSWORD']); ?>" />
		</td>
	</tr>
	<tr>
		<td class="tableleft">邮件编码:</td>
		<td class="item_input">
			<input type="text" class="textbox" name="MAIL_CHARSET" value="<?php echo ($conf['MAIL_CHARSET']); ?>" />
		</td>
	</tr>
	
	<tr>
		<td class="tableleft">格式邮件:</td>
		<td class="item_input">
			<select name="MAIL_ISHTML">
				<option value="true" <?php if($conf['MAIL_ISHTML'] == true): ?>selected="selected"<?php endif; ?> >HTML</option>
				<option value="false" <?php if($conf['MAIL_ISHTML'] == false): ?>selected="selected"<?php endif; ?> >TXT</option>
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