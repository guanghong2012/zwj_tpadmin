<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends backendController {
    public function _initialize() {
        parent::_initialize();
       	$this->_mod = D(CONTROLLER_NAME);  
    }
	public function _before_index(){
		$role_name = M("role")->where("is_effect")->getField("id,name");
		$this->assign("role_name",$role_name);
	}
	//回收站的管理员
	public function delete_index(){

        $map['is_delete'] = 1;//删除的项目
        $mod = $this->_mod;
        
        !empty($mod) && $this->_list($mod, $map);
        $role_name = M("role")->where("is_effect")->getField("id,name");
		$this->assign("role_name",$role_name);
        $this->display();
	}
	public function _search(){
        $map = array();
        $map['is_delete'] = 0;
        return $map;        
    }
	public function _before_add(){
		$role_name = M("role")->where("is_effect")->Field("id,name")->select();
		$this->assign("role_name",$role_name);
	}
	public function _before_insert($data){
    	if($data['adm_password']){
    		$data['adm_password'] = MD5($data['adm_password']);
    	}else{
			$this->error('密码不能为空！');
		}
  		return $data;
    }
	public function _before_edit(){
		$role_name = M("role")->where("is_effect")->Field("id,name")->select();
		$this->assign("role_name",$role_name);
	}
	public function _before_update($data){
    	if(!$data['adm_password']){
			unset($data['adm_password']);
		}else{
			$data['adm_password'] = MD5($data['adm_password']);
		}
  		return $data;
    }
	public function pwd(){
		$id = session("adm_data.adm_id");
		$info = $this->_mod->find($id);
		if(IS_POST){
			$password = MD5(trim(I("post.password")));
			$adm_name = I("post.adm_name");
			if($info["adm_password"] != $password){
				$this->error("对不起，你输入的原密码不正确！");
			}
			$data = array(
				"id"=>trim(I("post.id")),
				"adm_password"=>MD5(trim(I("post.adm_password"))),
				"adm_name"=>$adm_name
			);
			if($this->_mod->data($data)->save()){
				$this->success("修改密码成功！",U("Index/Index"));
			}else{
				$this->error("修改失败！");
			}
		}else{
			$this->assign("info",$info);
			$this->display();
		}
		
	}
}