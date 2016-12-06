<?php
return array (
		// '配置项'=>'配置值'

	'TMPL_FILE_DEPR'        =>  '_', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
	'DEFAULT_V_LAYER'       =>  'View/default', // 默认的视图层名称
	'TMPL_PARSE_STRING'=>array(
		'__UPLOADS__'=>__ROOT__.'/Uploads',
		'__HOME__'=>__ROOT__.'/App/Home/View/default',
		'__CSS__'=> __ROOT__.'/App/Home/View/default/css',
		'__JS__'=> __ROOT__.'/App/Home/View/default/js',
		'__IMAGES__'=> __ROOT__.'/App/Home/View/default/image',
	),
	

	'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
	'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则     
		// 定义格式1 数组方式     '静态地址'    =>     array('静态规则', '有效期', '附加规则'),      
		// 定义格式2 字符串方式     '静态地址'    =>     '静态规则', 
		'*'=>array('{$_SERVER.REQUEST_URI|md5}_{id|isMobile}'),
	)
);