<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends backendController {
    public function _initialize() {
        parent::_initialize();
       	$this->_mod = D(CONTROLLER_NAME);  
    }
	public function role(){
		
		$role_id = I("REQUEST.role_id");
		!$role_id && $this->error("系统错误！！没有获取到权限标识！");
		$role_menu = M("role_menu");
		if(IS_POST){
			$menu = M("menu");
			$role_access = I("post.role_access");
			$menu_ids = array();
			foreach ($role_access as $v) {
				$access_ids = explode("_",$v);
				if($access_ids[1] == 0){
					$menu_id = $menu->where("pid = ".$access_ids[0])->getField("id",true);
					$menu_id[] = $access_ids[0];
				}else{
					$menu_id = $access_ids;
				}
				$menu_ids = array_merge($menu_ids,$menu_id);
			}
			$menu_ids = array_unique($menu_ids);//去掉相同的ID

			$role_menu->where("role_id = ".$role_id)->delete();//删除上一次保存的权限

			foreach($menu_ids as $menu_id){
				$role_menu->data(array("role_id"=>$role_id,"menu_id"=>$menu_id))->add();
			}
			$this->success("编辑成功！！");
		}else{
			$where["is_effect"] = 1;
			$tree = new \Think\Tree();
			$where["pid"] = 0;
			$pids =  M('menu')->where($where)->getField("id",true);
			$where["pid"] = array("in",$pids);
			$access_list = M('menu')->where($where)->order('num')->select();
			foreach ($access_list as $key => $value) {
				$where["pid"] = $value["id"];
				$access_list[$key]["node_list"] = M('menu')->where($where)->order('num')->select();
			}

			$menu_ids = $role_menu->where("role_id = ".$role_id)->getField("menu_id",true);
			$menu_ids = implode(",", $menu_ids);
			$this->assign('menu_ids',$menu_ids);
			$this->assign('access_list',$access_list);
			$this->display();
		}
		
	}
}