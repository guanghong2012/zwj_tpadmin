<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends backendController {
    
	public function index(){

		$menu = M('menu');
		
		$menus = $menu->where('status = 1 and pid = 0')->order("num asc")->select();
		$arr = '';
		foreach($menus as $key=>$val){
			$pid_menu = $menu->where('status = 1 and pid = '.$val['id'])->order("num asc")->select();
			
			foreach($pid_menu as $k=>$v){
				$pid_menu[$k]['pid_zi_menu'] = $menu->where('status = 1 and pid = '.$v['id'])->order("num asc")->select();
			}
			$menus[$key]['pid_menu'] = $pid_menu;
			
			$arr .= '{id:"'.$val['id'].'",homePage :"'.$pid_menu[0]['pid_zi_menu'][0]['id'].'",menu:[';
			
			foreach($pid_menu as $i=>$vs){
				$arr .='{text:"'.$vs['name'].'",items:[';
				foreach($vs['pid_zi_menu'] as $vc){
					$vc['data'] = $vc['data'] ? $vc['data']."&menu_id=".$vc["id"]:"menu_id=".$vc["id"];
					$arr  .='{id:"'.$vc['id'].'",text:"'.$vc['name'].'",href:"'.U($vc['model'].'/'.$vc['action'],$vc['data']).'"},';
				}
				$arr  .=']},';
			}

			$arr .=']},';

		}
		
		$arr = substr($arr,0,-1);

		$this->assign('menus',$menus);
		
		$this->assign('arr',$arr);
		
		$this->display();
		
    }
    public function home(){
    	
		$D = new DataController;
		$path = $D->config['path'];
    	$fileArr = $D->MyScandir($path,1);
		$fileName = $fileArr[0];
		$fileTime = date('Y年m月d日 H:i:s', filemtime($path . '/' . $fileName));
		$this->assign("fileTime",$fileTime);//上次备份时间
    	$this->display();

    }
    public function login(){

		if(IS_POST){
			
			$username = rp(I('post.username'));
            $password = I('post.password');
			
			$condition['adm_user'] = $username;
			$condition['is_effect'] = 1;
			$condition['is_delete'] = 0;
            $adm_data = M('admin')->where($condition)->find();
			
            if (!$adm_data) {
                $this->error('用户不存在！');
            }

            if ($adm_data['adm_password'] != md5($password)) {
                $this->error('密码输入不正确，请重登陆！');
            }

			$adm_session['adm_user'] = $adm_data['adm_user'];
			$adm_session['adm_id'] = $adm_data['id'];
			$adm_session['adm_role_id'] = $adm_data['role_id'];
			session('adm_data',$adm_session);
	
			//重新保存记录
			$adm_data['login_ip'] = get_client_ip();
			$adm_data['login_time'] = time();
			
			//记录日记
			save_log($adm_data['adm_user']."登陆成功！",1);

			M("Admin")->save($adm_data);

            $this->success('登陆成功！',U('Index/index'));
		}else{
			$this->display();
		}
    }
    public function logout(){
		//记录日记
		save_log(session('adm_data.adm_user')."退出登陆！",1);
		session_unset(session('adm_data'));
        $this->success('登出成功！', U('Index/login'));
        exit;
	}
}