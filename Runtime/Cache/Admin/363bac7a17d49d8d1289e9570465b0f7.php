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
	
	#FieldShow span {
	    margin-bottom: 5px;
	    padding: 0 6px;
	    height: 30px;
	    line-height: 30px;
	    overflow: hidden;
	    float: left;
	}
	.table tr .centered {
		text-align: center;
	}
</style>
<div class="main">
<div class="main_title"><?php echo L('ADD');?> <a href="<?php echo u(CONTROLLER_NAME."/index");?>" class="back_list"><?php echo L('BACK_LIST');?></a></div>
<div class="blank5"></div>
<form name="edit" action="<?php echo U('build');?>" class="definewidth" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	
	<tr>
		<td class="tableleft"><span style='color:red'>*</span>标识名:</td>
		<td class="tableright">
			<input type="text" class="textbox require" name="info[name]" />
			<span class="check-tips">（请输入插件标识）</span>
		</td>
	</tr>
	<tr>
		<td class="tableleft">模块名称:</td>
		<td class="tableright">
			<input type="text" class="text" name="info[title]" value="">
			<span class="check-tips">（请输入模块名称）</span>
		</td>
	</tr>

	<tr>
		<td class="tableleft">描述:</td>
		<td class="tableright">
			<textarea name="info[description]" rows="5" >这是一个临时描述</textarea>
			<span class="check-tips">（请输入描述）</span>
		</td>
	</tr>
	<tr>
		<td class="tableleft">调用数据:</td>
		<td class="tableright">
			<select name="info[config][table]" id="table" onchange="getField(this)">
				<option value="">--请选择--</option>
				<?php if(is_array($tables)): $i = 0; $__LIST__ = $tables;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><option value="<?php echo ($t["table"]); ?>"><?php echo ($t["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<span class="check-tips">（请选择调用数据）</span>
		</td>
	</tr>
	<tr class="tempshow" style="display:none;">
		<td class="tableleft">显示条数:</td>
		<td class="tableright"><input type="text" class="textbox" name="info[config][limit]" value="<?php echo ($info['limit']?$info['limit']:10); ?>" /></td>
	</tr>
	<tr class="tempshow" style="display:none;">
		<td class="tableleft">数据排序:</td>
		<td class="tableright">
			<select name="info[config][order][field]" id="order_show" >
				<?php if(is_array($field)): $i = 0; $__LIST__ = $field;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><option value="<?php echo ($f["field"]); ?>" <?php if($f['field'] == $info['order']['field']): ?>selected<?php endif; ?> ><?php echo ($f["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select> 
			<select name="info[config][order][sort]">
				<option value="asc" <?php if('asc' == $info['order']['sort']): ?>selected<?php endif; ?> >正序</option>
				<option value="desc" <?php if('desc' == $info['order']['sort']): ?>selected<?php endif; ?> >倒序</option>
			</select>
		</td>
	</tr>
	<tr class="tempshow" style="display:none;">
		<td class="tableleft">查询条件:</td>
		<td class="tableright">
			<table class="table table-bordered" id="info_extend_field_box" style="width:60%" cellpadding=0 cellspacing=0>
				<tr><td colspan="4" class="centered"><a href="javascript:;" onclick="add_where();">添加查询条件</a></td></tr>
				<tr>
					<th>查询字段</th>
					<th>表达表</th>
					<th>查询值</th>
					<th>操作</th>
				</tr>
				
			</table>
		</td>
	</tr>
	<tr class="tempshow" style="display:none;" >
		<td class="tableleft">静态模板:</td>
		<td class="tableright">
			<textarea name="temp" id="TempShow" rows="10" style="width:60%;" ></textarea>
			<span class="check-tips">（请输入静态模板描述）</span>
			<div class="controls" id="FieldShow">
			</div>
		</td>
	</tr>

	<tr>
		<td class="tableleft">实现的钩子方法:</td>
		<td class="tableright">
			<div class="controls">
				<select class="select" name="hook[]" size="10" multiple required>
					<?php if(is_array($Hooks)): $i = 0; $__LIST__ = $Hooks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>" title="<?php echo ($vo["description"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</td>
	</tr>

	<tr>
		<td class="tableleft"></td>
		<td class="tableright">
			<!--隐藏元素-->
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
<table style="display:none">
<tr id="wt">
	<td>
		<select name="config[where][field][]" class="show_field" onchange="show_val(this)">
			<?php if(is_array($field)): $i = 0; $__LIST__ = $field;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><option value="<?php echo ($f["field"]); ?>" xxx="<?php echo ($f["type"]); ?>" ><?php echo ($f["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
	</td>
	<td>
		<select name="config[where][expr][]">
			<option value="like">模糊查询</option>
			<option value="eq">等于</option>
			<option value="neq">不等于</option>
			<option value="gt">大于</option>
			<option value="egt">大于等于</option>
			<option value="lt">小于</option>
			<option value="elt">小于等于</option>
			<option value="in">包含(IN)</option>
			<option value="not in">不包含</option>
		</select>
	</td>
	<td class="val"><input name="config[where][val][]" type="text" class="textbox" value="" /></td>
	<td><a href="javascript:;" onclick="del_info_extend_field(this)">删除</a></td>
</tr>
</table>
</div>
<script type="text/javascript" src="/zwj/Public/Admin/js/codemirror/codemirror.js"></script>
<script type="text/javascript" src="/zwj/Public/Admin/js/codemirror/xml.js"></script>
<script type="text/javascript" src="/zwj/Public/Admin/js/codemirror/javascript.js"></script>
<script type="text/javascript" src="/zwj/Public/Admin/js/codemirror/clike.js"></script>
<script type="text/javascript" src="/zwj/Public/Admin/js/codemirror/php.js"></script>

<script type="text/javascript">
	
	// 在光标处插入字符串 
	// myField 文本框对象 
	// 要插入的值 
	function insertAtCursor(myField, myValue) 
	{ 
		myField = document.getElementById(myField);
		myValue = myValue.replace(/<volist>/ , '<volist name="list" id="vo">');//Volist标签转换
		//IE support 
		if (document.selection) 
		{
			myField.focus(); 
			sel = document.selection.createRange(); 
			sel.text = myValue; 
			sel.select(); 
		} 
		//MOZILLA/NETSCAPE support 
		else if (myField.selectionStart || myField.selectionStart == '0') 
		{ 
			var startPos = myField.selectionStart; 
			var endPos = myField.selectionEnd; 
			// save scrollTop before insert 
			var restoreTop = myField.scrollTop; 
			myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos,myField.value.length); 
			if (restoreTop > 0) 
			{ 
				// restore previous scrollTop 
				myField.scrollTop = restoreTop; 
			} 
			myField.focus(); 
			myField.selectionStart = startPos + myValue.length; 
			myField.selectionEnd = startPos + myValue.length; 
		} else { 
			myField.value += myValue; 
			myField.focus(); 
		} 
	}

	function getField(obj){
		var table = obj.value;
		var field = "";
		if(table){
			$.post("<?php echo U('Block/field_conf');?>",{table:table,field:field},function(data){
				$("#FieldShow").html(data.data.field);
				$(".show_field").html(data.data.field_show);
				$("#order_show").html(data.data.order_show);
				$(".tempshow").show();
			},"json");
		}else{
			$(".tempshow").hide();
		}
	}
	$('.ajax-post_custom').click(function(){
        var target,query,form;
        var target_form = $(this).attr('target-form');
        var check_url = '<?php echo U('checkForm');?>';
		$.ajax({
		   type: "POST",
		   url: check_url,
		   dataType: 'json',
		   async: false,
		   data: $('#form').serialize(),
		   success: function(data){
		    	if(data.status){
			        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
			            form = $('.'+target_form);
			            if ( form.get(0).nodeName=='FORM' ){
			                target = form.get(0).action;
			                query = form.serialize();
			            }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
			                query = form.serialize();
			            }else{
			                query = form.find('input,select,textarea').serialize();
			            }
			            $.post(target,query).success(function(data){
			                if (data.status==1) {
			                    if (data.url) {
			                        updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
			                    }else{
			                        updateAlert(data.info + ' 页面即将自动刷新~');
			                    }
			                    setTimeout(function(){
			                        if (data.url) {
			                            location.href=data.url;
			                        }else{
			                        	location.reload();
			                        }
			                    },1500);
			                }else{
			                    updateAlert(data.info);
			                }
			            });
			        }
		    	}else{
		    		updateAlert(data.info);
				}
		   }
		});

        return false;
    });

	function add_where(){
		var table = document.getElementById('info_extend_field_box');
		var tr = table.insertRow(-1);
		var td = document.getElementById('wt').innerHTML;
		tr.innerHTML = td;
	}
	function del_info_extend_field(obj){
		$(obj).parent().parent().remove();
	}
	function show_val(obj){
		var table = $("#table").find("option:selected").val();
		var type = $(obj).find("option:selected").attr("xxx");
		if((type > 6 && type < 12) || type == 15){
			$.post("<?php echo U('Block/field_val');?>",{table:table,type:type},function(data){
				$(obj).parent().siblings(".val").html(data);
			});
		}else{
			$(obj).parent().siblings(".val").html('<input name="config[where][val][]" type="text" class="textbox" value="" />');
		}
	}
</script>
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