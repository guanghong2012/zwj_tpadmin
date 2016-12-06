<?php
return array(
    'TMPL_ACTION_SUCCESS' => 'public:success',
    'TMPL_ACTION_ERROR' => 'public:error',
	'APP_AUTOLOAD_PATH' => '@.Pintag,@.Pinlib,@.ORG', //自动加载项目类库
    'DATA_CACHE_SUBDIR'=>true, //缓存文件夹
    'DATA_PATH_LEVEL'=>3, //缓存文件夹层级
    
    'DEFAULT_CHARSET' =>  'utf-8', // 默认输出编码
    'SHOW_PAGE_TRACE' => false,
	'LOAD_EXT_CONFIG' => 'alipay,wxpay,user', //扩展配置
	
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效

    'AUTOLOAD_NAMESPACE' => array('Block' => ZWJ_BLOCK_PATH), //扩展模块列表

	'DB_TYPE'=>'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'zwjlyh',//数据库名
    'DB_USER' => 'root',//数据库用户,一般不用改 
    'DB_PWD' => 'root',      //数据库密码
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'lyh_',
);