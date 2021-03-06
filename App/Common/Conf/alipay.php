<?php
return array (
	//支付宝配置参数
	'alipay_config'=>array(
		'partner' =>'',   //这里是你在成功申请支付宝接口后获取到的PID；
		'key'=>'',//这里是你在成功申请支付宝接口后获取到的Key
		'sign_type'=>strtoupper('MD5'),
		'input_charset'=> strtolower('utf-8'),
		'cacert'=> getcwd().'\\cacert.pem',
		'transport'=> 'http',
	),
	//以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
		
	'alipay'   =>array(
		//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
		'seller_email'=>'',
		//这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
		'notify_url'=>'网站/Home/Pay/notifyurl.html', 
		//这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
		'return_url'=>'网站/Home/Pay/returnurl.html',
		//支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
		'successpage'=>'网站/Home/Pay/myorder.html?ordtype=payed',   
		//支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
		'errorpage'=>'网站/Home/Pay/myorder.html?ordtype=unpay', 
	),
);