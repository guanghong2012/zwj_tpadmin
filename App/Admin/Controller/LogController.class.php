<?php
namespace Admin\Controller;
use Think\Controller;
class LogController extends backendController {
    public function _initialize() {
        parent::_initialize();
       	$this->_mod = D(CONTROLLER_NAME);  
    }
	
	public function _before_index(){
		$admin_name = M("Admin")->getField("id,adm_user");
		$this->assign("admin_name",$admin_name);
	}
	public function _search(){
		$map = array();
		$log_admin = I("log_admin");
		$model = I("model");
		$start_time = I("start_time");
		$end_time = I("end_time");
		!empty($log_admin) && $map["log_admin"] = $log_admin; 
		!empty($model) && $map["module"] = trim($model);
		!empty($start_time) && $map["log_time"][] = array("gt",strtotime($start_time));
		!empty($end_time) && $map["log_time"][] = array("lt",strtotime($end_time)+86399);
		return $map;
	}
}