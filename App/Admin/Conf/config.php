<?php
return array(
	//'配置项'=>'配置值'
	//"TMPL_EXCEPTION_FILE"=>'Public/404.html'
	'TMPL_PARSE_STRING'=>array(
		'__CSS__'=> __ROOT__.'/Public/Admin/css',
		'__JS__'=> __ROOT__.'/Public/Admin/js',
		'__IMAGES__'=> __ROOT__.'/Public/Admin/imageas',
		'__UPLOADS__'=> __ROOT__.'/Uploads'
	),
	'DB_BACKUP'=>'Backup',
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
);