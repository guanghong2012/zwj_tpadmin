<?php
namespace Admin\Controller;
use Think\Controller;
class ConfController extends backendController {
    public function _initialize() {
        parent::_initialize();
        $conf = M('conf')->select();
        foreach ($conf as $key => $value) {
            $conf[$value['name']] = $value['value'];
        }
        $this->assign('conf',$conf);
    }
    public function index(){
		$logo = M("image")->where(array("action"=>CONTROLLER_NAME,"name"=>"LOGO"))->field("id,file")->select();

		if($logo && $logo[0]['file'] == C("LOGO")){
			M("image")->where("id = '".$logo[0]['id']."'")->setField("is_effect",1);
		}else{
			$logo = array();
		}
        $this->assign("uploadify",true);
		$this->assign('logo',$logo);
		$this->display();
    }
    public function image(){
		$water = M("image")->where(array("action"=>CONTROLLER_NAME,"name"=>"WATER_IMG",'file'=>C('WATER_IMG')))->field("id,file")->select();
		if($water && $water[0]['file'] == C("WATER_IMG")){
			M("image")->where("id = '".$water[0]["id"]."'")->setField("is_effect",1);
		}else{
			$water = array();
		}
        $this->assign("uploadify",true);
		$this->assign('water',$water);
		$this->display();
    }
    //邮箱设置
    public function mail(){
        $this->display();
    }
	//测试发送邮箱
	public function checksendemail(){
		$to = trim(I('email'));
		$return = $this->sendMail($to,"测试发送邮箱","测试发送邮箱内容");
		var_dump($return);
	}
    public function insert(){
    	$conf_db = M('conf');
    	$infos  = I('post.');//获取POST过来的数据 
		foreach ($infos as $key => $value) {
    		$data  = array('name' => $key, 'value'=>$value);
    		if($data = $conf_db->create($data)){
    			if($id =$conf_db->where(array('name'=>$key))->getField()){
    				$conf_db->data($data)->where(array('id'=>$id))->save();
    			}else{
    				$conf_db->data($data)->add();
    			}
    		}
    	}
        F('setting',null);//清除配置缓存
    	$this->success('更改成功！');
    }
  
}