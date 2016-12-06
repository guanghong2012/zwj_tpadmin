$(document).ready(function(){
	init_word_box();
	$("#info").ajaxStart(function(){
		 $(this).html(LANG['AJAX_RUNNING']);
		 $(this).show();
	});
	$("#info").ajaxStop(function(){
		
		$("#info").oneTime(2000, function() {				    
			$(this).fadeOut(2,function(){
				$("#info").html("");				
			});			    	
		});	
	});
	$("form").bind("submit",function(){
		var doms = $(".require");
		var check_ok = true;
		$.each(doms,function(i, dom){
			if($.trim($(dom).val())==''||$(dom).val()=='0')
			{						
					var title = $(dom).parent().parent().find(".item_title").html();
					if(!title)
					{
						title = '';
					}
					if(title.substr(title.length-1,title.length)==':')
					{
						title = title.substr(0,title.length-1);
					}
					if($(dom).val()=='')
					TIP = LANG['PLEASE_FILL'];
					if($(dom).val()=='0')
					TIP = LANG['PLEASE_SELECT'];						
					alert(TIP+title);
					$(dom).focus();
					check_ok = false;
					return false;						
			}
		});
		if(!check_ok)
		return false;
	});
	
});
//排序
function sortBy(field,sortType,action_name)
{
	location.href = ROOT+"/"+CONTROLLER_NAME+"/"+ACTION_NAME+".html?_order="+sortType+"&_sort="+field;
}
//添加跳转
function add()
{
	location.href = ROOT+"/"+CONTROLLER_NAME+"/add.html";
}
//编辑跳转
function edit(id)
{
	
	var url =  ROOT+"/"+CONTROLLER_NAME+"/edit/id/"+id+".html";

	location.href = url;
}
//全选
function CheckAll(tableID)
{
	$("#"+tableID).find("[name=key]").attr("checked",$("#check").is(":checked"));
}


//改变状态
function set_effect(id,domobj)
{

		$.ajax({ 
			url: ROOT+"/"+CONTROLLER_NAME+"/set_effect/id/"+id+".html",
			data: "ajax=1",
			dataType: "json",
			success: function(obj){

				if(obj.status=='1')
				{
					$(domobj).html('有效');
				}
				else if(obj.status=='0')
				{
					$(domobj).html('失效');
				}
				else if(obj.status=='')
				{
					
				}
				$("#info").html(obj.info);
			}
		});
}


function set_sort(id,sort,domobj)
{
	$(domobj).html("<input type='text' value='"+sort+"' id='set_sort' class='require' style='width:80px;' />");
	$("#set_sort").select();
	$("#set_sort").focus();
	$("#set_sort").bind("blur",function(){
		var newsort = $(this).val();
		$.ajax({ 
			url: ROOT+"/"+CONTROLLER_NAME+"/ajax_edit/id/"+id+"/val/"+newsort+".html", 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){
				if(obj.status)
				{
					$(domobj).html(newsort);
				}
				else
				{
					$(domobj).html(sort);
				}
			}
	});
});
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
		url: ROOT+"/"+CONTROLLER_NAME+"/delete.html?id="+id, 
		data: "ajax=1",
		dataType: "json",
		success: function(obj){
			$("#info").html(obj.info);
			if(obj.status==1)
			location.href=location.href;
		}
	});
}
//普通删除
function del(id)
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
			url: ROOT+"/"+CONTROLLER_NAME+"/del.html?id="+id, 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){
				$("#info").html(obj.info);
				if(obj.status==1){alert(obj.msg);}
				location.href=location.href;
			}
	});
}
//恢复
function restore(id)
{
	if(!id)
	{
		idBox = $(".key:checked");
		if(idBox.length == 0)
		{
			alert("请选择要恢复的选项");
			return;
		}
		idArray = new Array();
		$.each( idBox, function(i, n){
			idArray.push($(n).val());
		});
		id = idArray.join(",");
	}
	if(confirm("确定要恢复吗？"))
	$.ajax({ 
		
			url:  ROOT+"/"+CONTROLLER_NAME+"/restore/id/"+id+".html", 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){
				if(obj.status==1)
				location.href = location.href;
			}
	});
}

//节点全选
function check_node(obj)
{
	$(obj.parentNode.parentNode.parentNode).find(".node_item").attr("checked",$(obj).attr("checked"));
}
function check_is_all(obj)
{
	if($(obj.parentNode.parentNode.parentNode).find(".node_item:checked").length >0)
	{
		$(obj.parentNode.parentNode.parentNode).find(".check_all").attr("checked",true);
	}
	else
		$(obj.parentNode.parentNode.parentNode).find(".check_all").attr("checked",false);
}
function check_module(obj)
{

	if(obj.checked)
	{
		$(obj).parent().parent().find(".check_all").attr("checked",true);
		$(obj).parent().parent().find(".node_item").attr("checked",true);
	}
	else
	{
		$(obj).parent().parent().find(".check_all").attr("checked",false);
		$(obj).parent().parent().find(".node_item").attr("checked",false);	
	}
}


function init_word_box()
{
	$(".word-only").bind("keydown",function(e){
		if(e.keyCode<65||e.keyCode>90)
		{
			if(e.keyCode != 8)
			return false;
		}
	});
}


function search_supplier()
{
	var key = $("input[name='supplier_key']").val();
	if($.trim(key)=='')
	{
		alert(INPUT_KEY_PLEASE);
	}
	else
	{
		$.ajax({ 
			url: ROOT+"?"+VAR_MODULE+"=SupplierLocation&"+VAR_ACTION+"=search_supplier", 
			data: "ajax=1&key="+key,
			type: "POST",
			success: function(obj){
				$("#supplier_list").html(obj);
			}
		});
	}
}
userCard=(function(){	
	return {
		load : function(e,id){
	
				
			}
	  	};
})();


function open_upload(f_t_name,show_name)
{
	var url = ROOT+"/"+MODULE_NAME+"/"+CONTROLLER_NAME+"/uploads.html?t_name="+f_t_name+"&show_name="+show_name;

	window.open(url,"上传文件","toolbar=no,menubar=no,resizable=yes,top="+(screen.availHeight - parseFloat(300))/2+",left="+(screen.availWidth - parseFloat(500))/2+",width=500pt,height=300pt");
}


//打开图片
function openimg(id)
{
	window.open(document.getElementById("img_"+id).src);
}
function delimg(id)
{
	document.getElementById("img_"+id).onclick = function()
	{
		return false;
	}
	var img = document.getElementById("img_"+id).src;
	if(confirm('确定要该图片删除吗？'))
	$.ajax({ 
			url: ROOT+"/"+MODULE_NAME+"/"+CONTROLLER_NAME+"/delimg.html?id="+id, 
			data: "ajax=1",
			dataType: "json",
			success: function(obj){

				if(obj.status==1){
					alert("删除成功！");
					document.getElementById("img_"+id).src = ROOT_PATH+"/images/no_pic.gif";
					document.getElementById("img_del_"+id).style.display = "none";
				}else{
					alert("删除失败！");
				}
				

			}
	});
}