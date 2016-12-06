<?php
//判断是否是手机访问
function isMobile(){
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        return 1;
 
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
        return 1;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? 1 : 0;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return 1;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return 1;
        }
    }
    return 0;
}
// 验证验证码
function check_verify($code, $id = "") {
    $verify = new \Think\Verify ();
    return $verify->check ( $code, $id );
}
// 检查是否登陆
function is_login() {
    if (session ( '?login_user' ))
        return true;
    else
        return false;
}
// 保存用户到session
function save_session_user($user) {
    session ( 'login_user', $user );
}
// 注销session
function release_session_user() {
    session ( 'login_user', null );
}
// 获取session中的用户
function get_session_user() {
    if (session ( '?login_user' )) {
        $user = session ( 'login_user' );
        return $user;
    } else {
        // $this->error ( '登陆超时，请重新登陆' );
        return null;
    }
}
function get_session_user_id() {
    $user = get_session_user ();
    return $user ['id'];
}
// 刷新session用户信息
function refreash_session_user() {
    $user = get_login_user ();
    save_session_user ( $user );
}
// 获取数据库中当前登陆的用户数据
function get_login_user() {
    $suser = get_session_user ();
    $suser_id = $suser ['id'];
    
    $map ['id'] = $suser_id;
    $user = M ( 'user' )->where ( $map )->find ();
    return $user;
}
 //在线交易订单支付处理函数
 //函数功能：根据支付接口传回的数据判断该订单是否已经支付成功；
 //返回值：如果订单已经成功支付，返回true，否则返回false；
 function checkorderstatus($ordid){
    $Ord=M('Order');
    $ordstatus = $Ord->where(array("order_id"=>$ordid))->getField('status');
    if($ordstatus==1){
        return true;
    }else{
        return false;    
    }
 }
//处理订单函数
//更新订单状态，写入订单支付后返回的数据
function orderhandle($parameter){
    $ordid = $parameter['out_trade_no'];

}

//增减余额或积分
/*
    $msg  记录说明
    $price 金额
    $user_id 会员ID
    $type 1余额记录 2积分记录
    $status 0 减少  1 增加
*/
function record($msg,$user_id,$price = 0,$type =1 ,$status = 0){
    if(!$user_id)
        return false;//会员ID不能为空 
    $user_info = M("user")->where("id = %d",$user_id)->find();
    if(!$user_info)
        return false;//会员不存在 
    $record = D("record");
    $data = array(
        "msg"=>$msg,
        "price"=>$price,
        "user_id"=>$user_id,
        "type"=>$type,
        "status"=>$status
    );
    $id = $record->data($data)->record();
    return $id;
}
?>