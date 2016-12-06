<?php
if (!defined('THINK_PATH')) exit();


define("AUTH_NOT_LOGIN", 1); //未登录的常量
define("AUTH_NOT_AUTH", 2);  //未授权常量

//后台日志记录
function save_log($msg,$status=0)
{
	$log_data['log_info'] = $msg;
	$log_data['log_time'] = time();
	$log_data['log_admin'] = intval(session('adm_data.adm_id'));
	$log_data['log_ip']	= get_client_ip();
	$log_data['log_status'] = $status;
	$log_data['module']	=	CONTROLLER_NAME;
	$log_data['action'] = 	ACTION_NAME;
	M("Log")->add($log_data);
	
}


//状态的显示
function get_toogle_status($tag,$id,$field)
{
	if($tag)
	{
		return "<span class='is_effect' onclick=\"toogle_status(".$id.",this,'".$field."');\">".l("YES")."</span>";
	}
	else
	{
		return "<span class='is_effect' onclick=\"toogle_status(".$id.",this,'".$field."');\">".l("NO")."</span>";
	}
}

//状态的显示
function get_is_effect($tag,$id)
{
	if($tag)
	{
		return "<span class='is_effect' onclick='set_effect(".$id.",this);'>".l("IS_EFFECT_1")."</span>";
	}
	else
	{
		return "<span class='is_effect' onclick='set_effect(".$id.",this);'>".l("IS_EFFECT_0")."</span>";
	}
}
function get_is($tag,$id)
{
	if($tag)
	{
		return "是";
	}
	else
	{
		return "否";
	}
}

//排序显示
function get_sort($sort,$id)
{
	if($tag)
	{
		return "<span class='sort_span' onclick='set_sort(".$id.",".$sort.",this);'>".$sort."</span>";
	}
	else
	{
		return "<span class='sort_span' onclick='set_sort(".$id.",".$sort.",this);'>".$sort."</span>";
	}
}

function get_admin_name($admin_id)
{
	$adm_name = M("Admin")->where("id=".$admin_id)->getField("adm_name");
	if($adm_name)
	return $adm_name;
	else
	return l("NONE_ADMIN_NAME");
}
function get_log_status($status)
{
	return l("LOG_STATUS_".$status);
}
//验证相关的函数
//验证排序字段
function check_sort($sort)
{
	if(!is_numeric($sort))
	{
		return false;
	}
	return true;
}
function check_empty($data)
{
	if(trim($data)=='')
	{
		return false;
	}
	return true;
}

function set_default($null,$adm_id)
{

	$admin_name = M("Admin")->where("id=".$adm_id)->getField("adm_name");
	if($admin_name == conf("DEFAULT_ADMIN"))
	{
		return "<span style='color:#f30;'>".l("DEFAULT_ADMIN")."</span>";
	}
	else
	{
		return "<a href='".u("Admin/set_default",array("id"=>$adm_id))."'>".l("SET_DEFAULT_ADMIN")."</a>";
	}
}
function get_all_files( $path )
{
		$list = array();
		$dir = @opendir($path);
	    while (false !== ($file = @readdir($dir)))
	    {
	    	if($file!='.'&&$file!='..')
	    	if( is_dir( $path.$file."/" ) ){
	         	$list = array_merge( $list , get_all_files( $path.$file."/" ) );
	        }
	        else 
	        {
	        	$list[] = $path.$file;
	        }
	    }
	    @closedir($dir);
	    return $list;
}
function get_send_type_msg($status)
{
	if($status==0)
	{
		return l("SMS_SEND");
	}
	else
	{
		return l("MAIL_SEND");
	}
}


function get_is_send($is_send)
{
	if($is_send==0)
	return L("NO");
	else
	return L("YES");
}
function get_send_result($result)
{
	if($result==0)
	{
		return L("FAILED");
	}
	else
	{
		return L("SUCCESS");
	}
}

function get_status($status)
{
	switch ($status)
	{
		case PROJECT_STATE_CANCEL:
			return '取消';
			break;
		case PROJECT_STATE_TEMP:
			return '准备';
			break;
		case PROJECT_STATE_PENDING:
			return '审核中';
			break;
		case PROJECT_STATE_GOING:
			return '进行中';
			break;
		case PROJECT_STATE_SUCCESS:
			return '成功';
			break;
		case PROJECT_STATE_FAULT:
			return '失败';
			break;
	}
}


function get_title($title)
{
	return "<span title='".$title."'>".msubstr($title)."</span>";

}

function get_send_status($status)
{
	return L("SEND_STATUS_".$status);
}

function get_send_type($send_type)
{
	return l("SEND_TYPE_".$send_type);
}
//基于数组创建目录和文件
function create_dir_or_files($files){
    foreach ($files as $key => $value) {
        if(substr($value, -1) == '/'){
            mkdir($value);
        }else{
            @file_put_contents($value, '');
        }
    }
}
?>