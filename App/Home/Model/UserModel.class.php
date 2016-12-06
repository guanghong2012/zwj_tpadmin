<?php
namespace Home\Model;
use Think\Model;
class UserModel extends \Common\Model\PublicModel
{
    //用户登陆
    public function login($username,$password){
        
        $map ['username'] = $username;  //用户名
        $map ['email']    = $username;  //邮箱
        $map ['mobile']   = $username;  //手机
        
        $map['_logic'] = 'OR';
        
        $user = $this->where ( $map )->find ();

        if(!$user){
        	return -1;//用户名或邮箱或手机输入不正确
        }
        if($user["password"] != MD5(trim($password))){
        	return -2;//密码输入不正确
        }
        save_session_user ( $user );

        return $user["id"];
    }
    
    //用户UID登陆

    public function uid($uid){
    	$user  = $this->where("id = %d",$uid)->find();
    	if(!$user){
        	return -1;//没有找到该用户
        }
        save_session_user ( $user );

        return $user["id"];
    }

    //注册用户
    public function register($data = array()){
    	if($data)
    		$data = $this->data($data)->create();
    	else
    		$data = $this->create();
    	if($uid = $this->data($data)->add()){
    		$user = $this->where("id = %d",$uid)->find();
    		save_session_user ( $user );

        	return $user["id"];
    	}else{
    		return -1;
    	}
    }
    //退出登陆
    public function logout(){
    	release_session_user();
    }
}