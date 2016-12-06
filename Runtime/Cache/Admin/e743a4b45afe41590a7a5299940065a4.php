<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

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
<link href="/zwj/Public/Admin/assets/css/main-min.css" rel="stylesheet" type="text/css" />
<script>
	function ss(){
		var select = $('#medium').val();
		if(select == 0){
			$('.noicon').hide();
			$('.icon').show();
		}else{
			$('.icon').hide();
			$('.noicon').show();
		}
	}
</script>

<div class="main_title m10"><?php echo L('EDIT');?> <a href="<?php echo u(CONTROLLER_NAME."/index");?>" class="back_list"><?php echo L('BACK_LIST');?></a></div>

<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover m10">
	<tr>
        <td width="10%" class="tableleft">上级</td>
        <td>
            <select name="pid" id="medium" onchange="ss();">
            <option value="0">一级菜单</option>
			<?php echo ($select_menus); ?>
			</select>
        </td>
    </tr>
	<input type="hidden" name="id" value="<?php echo ($id); ?>"/>
    <tr>
        <td class="tableleft">名称</td>
        <td><input type="text" name="name" value="<?php echo ($info["name"]); ?>"/></td>
    </tr>
	
	<tr class="noicon">
        <td class="tableleft">MODEL</td>
        <td><input type="text" name="model" value="<?php echo ($info["model"]); ?>" /></td>
    </tr>
    <tr class="noicon">
        <td class="tableleft">ACTION</td>
        <td><input type="text" name="action" value="<?php echo ($info["action"]); ?>" /></td>
    </tr>
	<tr class="noicon">
        <td class="tableleft">DATA</td>
        <td><input type="text" name="data" value="<?php echo ($info["data"]); ?>" /></td>
    </tr>

	<tr>
        <td class="tableleft">排序</td>
        <td><input type="text" name="num" value="<?php echo ($info["num"]); ?>" /></td>
    </tr>
    <tr>
        <td class="tableleft">备注</td>
        <td><input type="text" name="info" value="<?php echo ($info["info"]); ?>" /></td>
    </tr>
	<tr class="icon">
        <td class="tableleft">图标</td>
        <td>
			<label class="nav-item-inner nav-home"><input type="radio" <?php if(($info["icon"]) == "home"): ?>checked<?php endif; ?> name="icon" value="home" /></label>
			<label class="nav-item-inner nav-order"><input type="radio" <?php if(($info["icon"]) == "order"): ?>checked<?php endif; ?> name="icon" value="order" /></label>
			<label class="nav-item-inner nav-goods"><input type="radio" <?php if(($info["icon"]) == "goods"): ?>checked<?php endif; ?> name="icon" value="goods" /></label>
			<label class="nav-item-inner nav-monitor"><input type="radio" <?php if(($info["icon"]) == "monitor"): ?>checked<?php endif; ?> name="icon" value="monitor" /></label>
			<label class="nav-item-inner nav-cost"><input type="radio" <?php if(($info["icon"]) == "cost"): ?>checked<?php endif; ?> name="icon" value="cost" /></label>
			<label class="nav-item-inner nav-user"><input type="radio" <?php if(($info["icon"]) == "user"): ?>checked<?php endif; ?> name="icon" value="user" /></label>
			<label class="nav-item-inner nav-permission"><input type="radio" <?php if(($info["icon"]) == "permission"): ?>checked<?php endif; ?> name="icon" value="permission" /></label>
			<label class="nav-item-inner nav-inventory"><input type="radio" <?php if(($info["icon"]) == "inventory"): ?>checked<?php endif; ?> name="icon" value="inventory" /></label>
			<label class="nav-item-inner nav-register"><input type="radio" <?php if(($info["icon"]) == "register"): ?>checked<?php endif; ?> name="icon" value="register" /></label>
			<label class="nav-item-inner nav-package"><input type="radio" <?php if(($info["icon"]) == "package"): ?>checked<?php endif; ?> name="icon" value="package" /></label>
			<label class="nav-item-inner nav-certification"><input type="radio" <?php if(($info["icon"]) == "certification"): ?>checked<?php endif; ?> name="icon" value="certification" /></label>
			<label class="nav-item-inner nav-supplychain"><input type="radio" <?php if(($info["icon"]) == "supplychain"): ?>checked<?php endif; ?> name="icon" value="supplychain" /></label>
		</td>
    </tr>

    <tr>
        <td class="tableleft">设计表</td>
        <td>
            <label style="float:left;margin-left:10px;"><input type="radio" name="table" value="1" <?php if($info["table"] == 1): ?>checked<?php endif; ?> /> 启用</label>
            <label style="float:left;margin-left:10px;"><input type="radio" name="table" value="0" <?php if($info["table"] == 0): ?>checked<?php endif; ?>/> 禁用</label>
        </td>
    </tr>

    <tr>
        <td class="tableleft">状态</td>
        <td>
            <label style="float:left;margin-left:10px;"><input type="radio" name="status" value="1" <?php if($info["status"] == 1): ?>checked<?php endif; ?> /> 启用</label>
            <label style="float:left;margin-left:10px;"><input type="radio" name="status" value="0" <?php if($info["status"] == 0): ?>checked<?php endif; ?>/> 禁用</label>
        </td>
    </tr>

    <tr>
        <td class="tableleft"></td>
        <td>
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
<?php if(!empty($uploadify)): ?><script language="javascript" type="text/javascript">
    //防止客户端缓存文件，造成uploadify.js不更新，而引起的“喔唷，崩溃啦”  
    document.write("<script type='text/javascript' " +
    "src='/zwj/uploadify/jquery.uploadify.min.js?" +
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
				'swf'      : "/zwj/uploadify/uploadify.swf",
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
						var str = "<img style='margin-left:10px;' name='"+ name +"' src='/zwj/Uploads/"+v.data.file+"' width='50' height='50' onclick='delimage(this,"+v.data.id+")'>";
						
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
<script>
    $(function () {       
		var select = $('#medium').val();
		if(select == 0){
			$('.noicon').hide();
		}else{
			$('.icon').hide();
		}
    });
	
</script>