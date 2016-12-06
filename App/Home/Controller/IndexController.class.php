<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends baseController {
    public function index(){

    	print_r(C());die;
		
    	$this->good_attr(1);

    	$Ip = new \Org\Net\IpLocation(); // 实例化类 参数表示IP地址库文件
    	$area = $Ip->getlocation('119.119.119.85'); // 获取某个IP地址所在的位置
    	dump($area);die;
    	//缓存
    	$data = array("1"=>"测试缓存");
    	F("cache/ceshi",$data);
    	F("cache/ceshi",null);
    	//$u = M("user")->cache('key',600)->find();
    	//print_r($u);
    	//print_r(S('key'));die;
    	//print_r(F("cache/ceshi"));die;
		$this->display();
    }
	//测试弹窗插件
	public function popup(){
		$this->display();
	}

	//登录地址
	public function login($type = null){
		empty($type) && $this->error('参数错误');

		//加载ThinkOauth类并实例化一个对象
		$sns = \Org\ThinkSDK\ThinkOauth::getInstance($type);

		//跳转到授权页面
		redirect($sns->getRequestCodeURL());
	}

	//授权回调地址
	public function callback($type = null, $code = null){
		(empty($type) || empty($code)) && $this->error('参数错误');
		
		//加载ThinkOauth类并实例化一个对象
		$sns = \Org\ThinkSDK\ThinkOauth::getInstance($type);

		//腾讯微博需传递的额外参数
		$extend = null;
		if($type == 'tencent'){
			$extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
		}

		//请妥善保管这里获取到的Token信息，方便以后API调用
		//调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
		//如： $qq = ThinkOauth::getInstance('qq', $token);
		$token = $sns->getAccessToken($code , $extend);

		//获取当前登录用户信息
		if(is_array($token)){
			$user_info = A('Type', 'Event')->$type($token);

			echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
			echo("授权信息为：<br>");
			dump($token);
			echo("当前登录用户信息为：<br>");
			dump($user_info);
		}
	}

	public function good_attr($goods_id){
		$mod = M("GoodsAttr");

		$list = M()->table("__ATTR_TYPE__ a,__GOODS_ATTR__ g")->field("g.*,a.name as attr_name,a.attr_type,a.attr_input")->where("a.id = g.attr_id and g.goods_id = %d",$goods_id)->order("sort desc")->select();
		
		$attr_list = array();

		foreach ($list as $k => $v) {

			switch ($v["attr_type"]) {
				case '1':
					$attr_list["only"][$v['attr_name']] = $v;
					break;
				case '2':
					$attr_list["radio"][$v['attr_name']][] = $v;
					break;
				default:
					$attr_list["checkbox"][$v['attr_name']][] = $v;
					break;
			}
		}
		return $attr_list;
	}
}