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
<style type="text/css">
	.check-tips {
	    margin-left: 8px;
	    color: #aaa;
	    font-weight: normal;
	}
	.controls {
	    overflow: hidden;
	    padding: 5px 5px 5px 0;
	}
	.dragsort li {
	    margin-bottom: 5px;
	    padding: 0 6px;
	    height: 30px;
	    width:25%;
	    line-height: 30px;
	    border: 1px solid #eee;
	    background-color: #fff;
	    overflow: hidden;
	}
	.dragsort li b {
	    display: none;
	    float: right;
	    padding: 0 6px;
	    font-weight: bold;
	    color: #000;
	    width:10px;
	}
</style>
<div class="main">
<div class="main_title"><?php echo L('ADD');?> <a href="<?php echo u(CONTROLLER_NAME."/hooks");?>" class="back_list"><?php echo L('BACK_LIST');?></a></div>
<div class="blank5"></div>
<form name="edit" action="<?php echo U('updateHook');?>" class="definewidth" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	
	<tr>
		<td class="tableleft">钩子名称</td>
		<td class="tableright">
			<input type="text" class="textbox require" name="name" value="<?php echo ($info["name"]); ?>" />
			<span class="check-tips">（需要在程序中先添加钩子，否则无效）</span>
		</td>
	</tr>
	<tr>
		<td class="tableleft">钩子描述</td>
		<td class="tableright">
			<textarea name="description" rows="6"><?php echo ($info["description"]); ?></textarea><span class="check-tips">（钩子的描述信息）</span>
		</td>
	</tr>
	<tr>
		<td class="tableleft">是否启用:</td>
		<td class="tableright">
			<label><?php echo L('IS_EFFECT_1');?><input type="radio" name="status" value="1" <?php if(($info["status"]) == "1"): ?>checked="checked"<?php endif; ?> /></label>
			<label><?php echo L('IS_EFFECT_0');?><input type="radio" name="status" value="0" <?php if(($info["status"]) == "0"): ?>checked="checked"<?php endif; ?> /></label>
		</td>
	</tr>
	<?php if(isset($info)): ?><tr>
		<td class="tableleft">钩子挂载的插件排序</td>
		<td class="tableright">
			<span class="check-tips">（拖动后保存顺序，影响同一个钩子挂载的插件执行先后顺序）</span>
			<div class="controls">
				<input type="hidden" name="addons" value="<?php echo ($info["addons"]); ?>" readonly>
				<?php if(empty($info["addons"])): ?>暂无插件，无法排序
				<?php else: ?>
				<ul id="sortUl" class="dragsort">
					<?php $_result=explode(',',$info['addons']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addons_vo): $mod = ($i % 2 );++$i;?><li class="getSort" style="cursor: pointer;"><b>&times;</b><em><?php echo ($addons_vo); ?></em></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<script type="text/javascript">
					$(function(){
						$("#sortUl").dragsort({
                            dragSelector:'li',
                            placeHolderTemplate: '<li class="draging-place">&nbsp;</li>',
                            dragEnd:function(){
                            	updateVal();
                            }
                        });

						$('#sortUl li b').click(function(){
                        	$(this).parent().remove();
                        	updateVal();
                        });
						$('#sortUl li').hover(function(){
	                        $(this).children("b").show();
	                    },function(){
	                        $(this).children("b").hide();
                        });
						// 更新排序后的隐藏域的值
                        function updateVal() {
                        	var sortVal = [];
                        	$('#sortUl li').each(function(){
                        		sortVal.push($('em',this).text());
                        	});
                            $("input[name='addons']").val(sortVal.join(','));
                        }
					})
				</script><?php endif; ?>
			</div>
		</td>
	</tr><?php endif; ?>
	<tr>
		<td class="tableleft"></td>
		<td class="tableright">
			<!--隐藏元素-->
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
			<!--隐藏元素-->
			<button type="submit" class="btn btn-primary" type="button">提交</button> &nbsp;&nbsp;
			<a href="<?php echo u(CONTROLLER_NAME."/index");?>" class="btn btn-success">返回列表</a>
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>	 
</form>
</div>
<?php if(isset($info)): ?><script type="text/javascript" src="/zwj/Public/Admin/js/jquery.dragsort-0.5.1.min.js"></script><?php endif; ?>
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
						var str = "<img style='margin-left:10px;' src='/zwj/Uploads/"+v.data.file+"' width='50' height='50' onclick='delimage(this,"+v.data.id+")'>";
						
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
	if(confirm('确定要该图片删除吗？'))
	$.post('<?php echo U(CONTROLLER_NAME."/delimg");?>',{imageid:id},function(data){
		if(data.status == 1){
			alert(data.msg);
			obj.remove();
		}else{
			alert(data.msg);
		}
	},"json");
}
</script><?php endif; ?>

</html>