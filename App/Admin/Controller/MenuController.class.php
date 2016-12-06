<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class MenuController extends backendController{
    public function _initialize(){
		parent::_initialize();
		
		$this->_mod = D('Menu');
	}
	public function index(){

		$menuname = I('menuname');
		if(!empty($menuname)){
			$where = 'name like "%'.$menuname.'%"';
			$this->assign('menuname',$menuname);
		}
		$tree = new \Think\Tree();
        $result = $this->_mod->where($where)->order('num')->select();
		
        $array = array();
        foreach($result as $r) {
            $r['selected'] = $r['id'] == $_GET['pid'] ? 'selected' : '';
			
			if($r['pid'] == 0){
				$r['add'] = '<a href="'.U("menu/add",array('pid'=>$r['id'])).'">添加子菜单</a> | <a href="'.U("menu/edit",array('id'=>$r['id'],'pid'=>$r['pid'])).'">编辑</a> | <a href="'.U("menu/del",array('id'=>$r['id'])).'">删除</a>';
			}else{
				$t = $r["table"]?' | <a href="'.U("menu/table",array('pid'=>$r['id'])).'">数据表</a>':'';
				$r['add'] = '<a href="'.U("menu/add",array('pid'=>$r['id'])).'">添加子菜单</a>'.$t.' | <a href="'.U("menu/edit",array('id'=>$r['id'],'pid'=>$r['pid'])).'">编辑</a> | <a href="'.U("menu/del",array('id'=>$r['id'])).'">删除</a>';
			}
			$r['title'] = $r['name'];
			$r['status'] = $r['status'] == 1 ?'启用':'禁用';
            $array[] = $r;
        }
        $str  = "<tr><td><span style='color:red;'>\$spacer</span> \$title</td><td>\$model</td><td>\$action</td><td>\$data</td><td><span class='sort_span' onclick='set_sort(\$id,\$num,this);'>\$num</span></td><td><span class='status' onclick='set_effect(\$id,this);'>\$status</span></td><td>\$add</td></tr>";
        $tree->init($array);
        $select_menus = $tree->get_tree(0, $str);
		$this->assign('select_menus',$select_menus);
		$this->display();
	}
	public function _before_add(){ 
		
		$pid = I('get.pid','intval');
		/*上一级*/
		$tree = new \Think\Tree();
        $result = $this->_mod->order('num')->select();
        $array = array();
        foreach($result as $r) {
            $r['selected'] = $r['id'] == $_GET['pid'] ? 'selected' : '';
			$r['title'] = $r['name'];
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$title</option>";
        $tree->init($array);
        $select_menus = $tree->get_tree(0, $str);
        $this->assign('select_menus', $select_menus);
		
        $this->assign('pid', $pid);
    }
	public function _before_edit()
    {
		$pid = I('get.pid','intval');
		
		/*上一级*/
		$tree = new \Think\Tree();
        $result = $this->_mod->where('pid <> '.$pid)->order('num')->select();
        $array = array();
        foreach($result as $r) {
            $r['selected'] = $r['id'] == $_GET['pid'] ? 'selected' : '';
			$r['title'] = $r['name'];
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$title</option>";
        $tree->init($array);
        $select_menus = $tree->get_tree(0, $str);
        $this->assign('select_menus', $select_menus);
		
        $this->assign('pid', $pid);
    }

	public function del(){
		$id = I('get.id','intval');
		if(!$this->_mod->find($id)){
			$this->error('非法操作！');
		}else{
			if($this->_mod->where('id =%d',$id)->delete()){
				if($this->_mod->where('pid =%d',$id)->find()){
					if($this->_mod->where('pid =%d',$id)->delete()){
						$this->success('成功');
					}else{
						$this->error('失败');
					}
				}else{
					$this->success('成功');
				}
			}else{
				$this->error('删除失败');
			}
		}
	}
	//创建数据表
	public function table(){
		
		if(IS_POST){
			
			$data['data'] = I("zl");
			$table = strtolower(I("post.table"));
			$mod = D('table');
			$success = 0;
			$data['table'] = $table;

			$mod->data($data)->addition();
			
			foreach ($data['data'] as $key => $value) {
				if(!empty($value['name'])){
					$value['table'] = $table;//存入的表

					$value['show'] = $value['show']?1:0;
					$value['hide'] = $value['hide']?1:0;
					$value['notempty'] = $value['notempty']?1:0;
					$value['search'] = $value['search']?1:0;
					$value['only'] = $value['only']?1:0;

					is_array($value['data']) && $value['data'] = implode("|",$value['data']);

					if(empty($value['field'])) $value['field'] = pinyin($value['name']);//没有字段名就采用名称的拼音
					if($value = $mod->create($value)) {
						if($value['id']){
							//修改
							if($mod->where("id = ".$value['id'])->data($value)->save()){
								$success++;
							}
						}else{
							//增加
							if($mod->data($value)->add()){
								$success++;
							}
						}
					}
				}
			}

			$operate['data'] = I("op");

			$op = D('operate');
			foreach ($operate['data'] as $key => $value) {
				if(!empty($value['name'])){
					$value['table'] = $table;
					$value['menu_id'] = $this->menuid;
					$value['show'] = $value['show']?$value['show']:false;
					if($value = $op->create($value)) {
						if($value['id']){
							if($op->where("id = ".$value['id'])->data($value)->save()){
								$success++;
							}
						}else{
							if($op->data($value)->add()){
								$success++;
							}
						}
					}
				}
			}

			if($success){
				$this->success('数据更新成功！');
			}else{
				$this->error('没有更新任何数据！');
			}
		}else{
			$id = I('pid');
			
			$table = $this->_mod->where("id = $id")->getField('model');
			
			$info = M("table")->where(array("table"=>$table))->order("sort asc")->select();

			$sort = M("table")->where(array("table"=>$table))->order("id desc")->getField("id");

			$operate_where = array("table"=>$table);
			$id && $operate_where["menu_id"] = $id;

			$operate = M("operate")->where($operate_where)->order("sort asc")->select();

			$operatesort = M("operate")->where($operate_where)->order("id desc")->getField("id");

			$this->assign('info',$info);
			
			$this->assign('sort',intval($sort));

			$this->assign('operate',$operate);
			
			$this->assign('operatesort',intval($operatesort));
			
			$this->assign('table',$table);

			$where = array();
			//$where["table"] = array("neq",$table); 
			$table_list = M("table")->distinct(true)->where($where)->getField('table',true);
			$menu = M("menu");
			$menu_table = "";
			foreach ($table_list as $val) {
				
				$table_name = $menu->where(array("model"=>$val))->getField("name");
				$menu_table .= "<option value=\"".$val."\" >".$table_name."表"."</option>";
			}
			$this->assign('menu_table',$menu_table);

			$this->assign('menu_id',$id);

			$this->display();
		}
	}
	public function del_field(){
		$mod = D('table');
        $pk = $mod->getPk();
        $id = trim(I('request.'.$pk));
       
        if ($id) {
            $info = $mod->find($id);
			if (false !== $mod->delete($id)) {
				$table = strtolower($info['table']);
				$field = $info['field'];
				$mod->del_table($table,$field);
				IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }
	}
	public function del_operate(){
		$mod = D('operate');
        $pk = $mod->getPk();
        $id = trim(I('request.'.$pk));
        
        if ($id) {
            $info = $mod->find($id);
			if (false !== $mod->delete($id)) {
				IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }
	}
	//获取表的字段
	public function field(){
		$table = I("post.table");
		$info = M("table")->field("field,name")->where(array("table"=>$table))->order("sort asc")->select();
		$option = "";
		foreach ($info as $key => $val) {
			if($val){
				$option .="<option value='".$val['field']."'>".$val["name"]."</option>";
			}
		}
		exit($option);
	}
}