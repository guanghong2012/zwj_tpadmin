<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsTypeController extends backendController {
    

    public function _initialize() {
        parent::_initialize();
       	$this->_mod = D(CONTROLLER_NAME);  
    }
	
	public function attr_list(){
		
		$map["type_id"] = I("type_id");

		$mod = D("AttrType");

        $this->_list($mod, $map);

		$type = $this->_mod->field("id,name")->where("is_effect = 1")->select();
		$type_name = array();
		foreach ($type as $key => $val) {
			$type_name[$val["id"]] = $val["name"];
		}

		$this->assign("type",$type);
		$this->assign("type_name",$type_name);
		$this->display();
	}
	//属性添加
	public function attr_add(){
		if(IS_POST){
			
			$mod = D("AttrType");

			if (false === $data = $mod->create()) {
                $this->error($mod->getError());
            }

            $attr_content = explode("\n", $data['attr_content']);

            $data['attr_content'] = implode(",", $attr_content);


            if( $id = $mod->add($data) ){
                //记录日记
                save_log("商品类型增加属性ID为".$id."的记录！",1);

                $this->success(L('operation_success'));
            } else { 
                //记录日记
                save_log("商品类型增加属性记录操作失败！",0);

                $this->error(L('operation_failure'));
            }
		}else{
			$type = $this->_mod->field("id,name")->where("is_effect = 1")->select();
			$this->assign("type",$type);
			$this->display();
		}
	}
	//属性编辑
	public function attr_edit(){
		$mod = D("AttrType");
        $pk = $mod->getPk();

		if(IS_POST){
			if (false === $data = $mod->create()) {
                $this->error($mod->getError());
            }

            $attr_content = explode("\n", $data['attr_content']);

            $data['attr_content'] = implode(",", $attr_content);

            if (false !== $mod->save($data)) {
               
                //记录日记
                save_log("商品类型编辑属性ID为".$data['id']."的记录！",1);
                $this->success(L('operation_success'));
            } else {
                //记录日记
                save_log("商品类型编辑属性记录操作失败！",0);
                $this->error(L('operation_failure'));
            }
		}else{
			$id = I('get.'.$pk, 'intval');
            $info = $mod->find($id);

            $attr_content = explode(",", $info['attr_content']);

            $info['attr_content'] = implode("\n", $attr_content);

            $this->assign('info', $info);

            $type = $this->_mod->field("id,name")->where("is_effect = 1")->select();
			
			$this->assign("type",$type);

			$this->display();
		}
	}
	//属性删除
	public function attr_delete(){

	}
}