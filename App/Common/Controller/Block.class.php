<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace Common\Controller;

/**
 * 插件类
 * @author yangweijie <yangweijiester@gmail.com>
 */
abstract class Block{
    /**
     * 视图实例对象
     * @var view
     * @access protected
     */
    protected $view = null;


    public $info                =   array();
    public $block_path          =   '';
    public $config_file         =   '';
    public $custom_config       =   '';
    public $admin_list          =   array();
    public $custom_adminlist    =   '';
    public $access_url          =   array();

    public function __construct(){
        $this->view         =   \Think\Think::instance('Think\View');
        $this->block_path   =   ZWJ_BLOCK_PATH.$this->getName().'/';
        $TMPL_PARSE_STRING = C('TMPL_PARSE_STRING');
        $TMPL_PARSE_STRING['__ADDONROOT__'] = __ROOT__ . '/Block/'.$this->getName();
        C('TMPL_PARSE_STRING', $TMPL_PARSE_STRING);
        if(is_file($this->block_path.'config.php')){
            $this->config_file = $this->block_path.'config.php';
        }
    }

    /**
     * 模板主题设置
     * @access protected
     * @param string $theme 模版主题
     * @return Action
     */
    final protected function theme($theme){
        $this->view->theme($theme);
        return $this;
    }

    //显示方法
    final protected function display($template=''){
        if($template == '')
            $template = CONTROLLER_NAME;
        echo ($this->fetch($template));
    }

    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return Action
     */
    final protected function assign($name,$value='') {
        $this->view->assign($name,$value);
        return $this;
    }


    //用于显示模板的方法
    final protected function fetch($templateFile = CONTROLLER_NAME){
        if(!is_file($templateFile)){
            $templateFile = $this->block_path.$templateFile.C('TMPL_TEMPLATE_SUFFIX');
            if(!is_file($templateFile)){
                throw new \Exception("模板不存在:$templateFile");
            }
        }
        return $this->view->fetch($templateFile);
    }

    final public function getName(){
        $class = get_class($this);
        return substr($class,strrpos($class, '\\')+1, -5);
    }

    final public function checkInfo(){
        $info_check_keys = array('name','title','description','status','author','version');
        foreach ($info_check_keys as $value) {
            if(!array_key_exists($value, $this->info))
                return FALSE;
        }
        return TRUE;
    }

    /**
     * 获取插件的配置数组
     */
    final public function getConfig($name=''){
        static $_config = array();
        if(empty($name)){
            $name = $this->getName();
        }
        if(isset($_config[$name])){
            return $_config[$name];
        }
        $config =   array();
        $map['name']    =   $name;
        $map['status']  =   1;
        $config  =   M('Block')->where($map)->getField('config');
        if($config){
            $config   =   json_decode($config, true);
        }else{
            $temp_arr = include $this->config_file;
            foreach ($temp_arr as $key => $value) {
                if($value['type'] == 'group'){
                    foreach ($value['options'] as $gkey => $gvalue) {
                        foreach ($gvalue['options'] as $ikey => $ivalue) {
                            $config[$ikey] = $ivalue['value'];
                        }
                    }
                }else{
                    $config[$key] = $temp_arr[$key]['value'];
                }
            }
        }
        $_config[$name]     =   $config;
        return $config;
    }

    //必须实现安装
    abstract public function install();

    //必须卸载插件方法
    abstract public function uninstall();
    /*
    *处理模块数据
    */
    public function _data($name = ""){
        if(empty($name)){
            $name = $this->getName();
        }
        $config = $this->getConfig();

        $select = D($config["table"]);
        $temp_dir  = ZWJ_BLOCK_PATH.$name."/".$name.".html";
        $temp      = file_get_contents($temp_dir);
        preg_match_all('/\{\$vo.(.+?)\}/sim',$temp,$m); 
        !empty($m[1]) && $select->field(implode(",", $m[1]));
        !empty($config["where"]) && $select->where($config["where"]);
        !empty($config["limit"]) && $select->limit($config["limit"]);
        !empty($config["order"]) && $select->order($config["order"]["field"] .' '. $config["order"]["sort"]);

        $list = $select->_select();

        $this->assign("list",$list);
    }
}
