<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Think\Model;
/**
 * 扩展后台管理页面
 * @author yangweijie <yangweijiester@gmail.com>
 */
class BlockController extends backendController {

    public function _initialize(){
        parent::_initialize();
    }

    //创建向导首页
    public function create(){

        if(!is_writable(ZWJ_BLOCK_PATH))
            $this->error('您没有创建目录写入权限，无法使用此功能');

        $hooks = M('Hooks')->field('name,description')->select();
        $this->assign('Hooks',$hooks);
        
        $tables = D("table")->get_table();
        $this->assign('tables',$tables);

        L("ADD",'创建模块');
        $this->display('add');

    }

    //获取表字段
    //获取表的字段
    public function field(){
        $table = I("post.table");
        $info = M("table")->field("field,name")->where(array("table"=>$table))->order("sort asc")->select();
        $option = '<span>循环内容：<a href="javascript:;" onclick="insertAtCursor(\'TempShow\',\'<volist>\n\n</volist>\')" >[volist]...[/volist]</a></span>';
        foreach ($info as $key => $val) {
            if($val){
                $option .='<span>'.$val["name"].'：<a href="javascript:;" onclick="insertAtCursor(\'TempShow\',\'{$vo.'.$val['field'].'}\')" >$'.$val['field'].'</a></span>';
            }
        }
        exit($option);
    }

    public function field_conf(){
        $table = I("post.table");
        $field = I("post.field");
        $info = M("table")->field("field,type,name")->where(array("table"=>$table))->order("sort asc")->select();
        $option = '<span>循环内容：<a href="javascript:;" onclick="insertAtCursor(\'TempShow\',\'<volist>\n\n</volist>\')" >[volist]...[/volist]</a></span>';
        $option2 = '';
        $option3 = '';
        foreach ($info as $key => $val) {
            $selected = "";
            if($val){
                $val["field"] == $field && $selected = "selected";
                $option .='<span>'.$val["name"].'：<a href="javascript:;" onclick="insertAtCursor(\'TempShow\',\'{$vo.'.$val['field'].'}\')" >$'.$val['field'].'</a></span>';
                $option2 .= '<option value="'.$val["field"].'" '.$selected.' >'.$val["name"].'</option>';
                $option3 .= '<option value="'.$val["field"].'"  xxx="'.$val["type"].'" >'.$val["name"].'</option>';
            }
        }
        $data = array("field"=>$option,"field_show"=>$option3,"order_show"=>$option2);
        $this->ajaxReturn(1, L('operation_success'), $data);
    }
    //判断字段类型
    public function field_val(){
        $table = I("post.table");
        $type  = I("post.type");
        $data = M("table")->where(array("table"=>$table,"type"=>$type))->getField("data");

        if(in_array($type, array(7,9,10))){
            $dd = explode("|", $data);
            $html = '<select name="config[where][val][]" >';
            foreach ($dd as $k => $v) {
                $ddd = explode("=", $v);
                $html .= '<option value="'.$ddd[0].'">'.$ddd[1].'</option>';

            }
            $html .= '</select>';
        }elseif($type == 8){
            $dd = explode("|", $val['data']);
            $da = M($dd[0])->getField("id,".$dd[1]);
            $html = '<select name="config[where][val][]" >';
            foreach ($da as $k => $v) {
                $ddd = explode("=", $v);
                $html .= '<option value="'.$ddd[0].'">'.$ddd[1].'</option>';

            }
            $html .= '</select>';
        }elseif($type == 15){
            $html = '<input type="text" name="config[where][val][]" id="'.rand(1000,9999).'" value="" onclick="SelectDate(this,\'yyyy-MM-dd hh:mm:ss\')" />';
        }else{
            $html = '<input name="config[where][val][]" type="text" class="textbox" value="" />';
        }
        exit($html);
    }
    //生成字段类型
    public function field_html($table,$field,$value){

        $info = M("table")->where(array("table"=>$table,"field"=>$field))->field("type,data")->find();
        $type = $info["type"];
        $data = $info["data"];
        if(in_array($type, array(7,9,10))){
            $dd = explode("|", $data);
            $html = '<select name="config[where][val][]" >';
            foreach ($dd as $k => $v) {
                $ddd = explode("=", $v);
                $selected = ($ddd[0] == $value && $value != "") ?"selected":"";
                $html .= '<option value="'.$ddd[0].'" '.$selected.' >'.$ddd[1].'</option>';

            }
            $html .= '</select>';
        }elseif($type == 8){
            $dd = explode("|", $val['data']);
            $da = M($dd[0])->getField("id,".$dd[1]);
            $html = '<select name="config[where][val][]" >';
            foreach ($da as $k => $v) {
                $selected = ($k == $value && $value != "") ?"selected":"";
                $select .= "<option value='".$k."' ".$selected." >".$v."</option>";
            }
            $html .= '</select>';
        }elseif($type == 15){
            $html = '<input type="text" name="config[where][val][]" id="'.rand(1000,9999).'" value="'.to_date($value).'" onclick="SelectDate(this,\'yyyy-MM-dd hh:mm:ss\')" />';
        }else{
            if(is_array($value)){
                $value = implode(",", $value);
            }else{
                $value = str_replace("%", "", $value);
            }
            
            $html = '<input name="config[where][val][]" type="text" class="textbox" value="'.$value.'" />';
        }
        return $html;

    }
    public function checkForm(){
        $data                   =   $_POST;
        $data['info']['name']   =   trim($data['info']['name']);
        if(!$data['info']['name'])
            $this->error('模块标识必须');
        //检测插件名是否合法
        $block_dir             =   ZWJ_BLOCK_PATH;
        if(file_exists("{$block_dir}{$data['info']['name']}")){
            $this->error('模块已经存在了');
        }
        $this->success('可以创建');
    }
    //预览
    public function preview($output = true){
        $data                   =   $_POST;
        $name   =   trim($data['info']['name']);
        $extend                 =   array();

        $extend = implode('', $extend);
        $hook = '';
        foreach ($data['hook'] as $value) {
            $hook .= <<<str
        //实现的{$value}钩子方法
        public function {$value}(\$param){
            \$this->_data("{$name}");
            \$this->display("{$name}");
        }

str;
        }

        $tpl = <<<str
<?php

namespace Block\\{$data['info']['name']};
use Common\Controller\Block;

/**
 * {$data['info']['title']}插件
 * @author {$data['info']['author']}
 */

    class {$data['info']['name']}Block extends Block{

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

{$hook}
    }
str;
        if($output)
            exit($tpl);
        else
            return $tpl;
    }

    public function build(){
        $data                   =   $_POST;
        $data['info']['name']   =   trim($data['info']['name']);
        $addonFile              =   $this->preview(false);
        $block_dir             =   ZWJ_BLOCK_PATH;

        //创建目录结构
        $files          =   array();
        $block_dir      =   "$block_dir{$data['info']['name']}/";
        $files[]        =   $block_dir;
        $addon_name     =   "{$data['info']['name']}Block.class.php";
        $files[]        =   "{$block_dir}{$addon_name}";

        if(!empty($data["temp"]))
            $files[]    =   $block_dir."{$data['info']['name']}.html";

        $custom_adminlist = trim($data['custom_adminlist']);
        if($custom_adminlist)
            $data[]     =   "{$block_dir}{$custom_adminlist}";

        create_dir_or_files($files);

        //写文件
        file_put_contents("{$block_dir}{$addon_name}", $addonFile);

        if(!empty($data["temp"]))
            file_put_contents($block_dir."{$data['info']['name']}.html", $data["temp"]);

        $config = I("post.config");
        if($config["where"]){
            $where = array();
            foreach ($config["where"]["field"] as $key => $val) {
                $w = array();
                $expr = trim($config["where"]["expr"][$key]);
                $value = $config["where"]["val"][$key];

                $value=strtotime($value)?strtotime($value):$value;

                switch($expr){
                    case "like":
                        $w = array("like","%{$value}%");
                    case "in":
                        $value = trim($value);
                        $w = array("in",explode(",", $value));
                    case "not in":
                        $value = trim($value);
                        $w = array("not in",explode(",", $value));
                    default:
                       $w = array($expr,$value);
                }

                if(!empty($where[$val])){//已存在
                    if(count($where[$val]) > 2){
                        $where[$val][] = $w;
                    }else{
                        $where[$val] = array(
                            "0"=>$where[$val],
                            "1"=>$w
                        );
                    }
                }else{
                    $where[$val] = $w;
                }
            }
        }
        $data['info']['config']["where"] = $where;


        $data['info']['config']   =   json_encode($data['info']['config']);

        $Block = D("Block");
        $Block->data = $Block->create($data["info"]);
        if($Block->add()){//添加
            $hooks_update   =   D('Hooks')->updateHooks($data['info']['name']);
            S('hooks',null);
        }
        $this->success('创建成功',U('index'));
    }



    /**
     * 设置插件页面
     */
    public function config(){
        $id     =   (int)I('id');
        $addon  =   M('Block')->find($id);
        if(!$addon)
            $this->error('未找到该模块');
        $block_class = get_block_class($addon['name']);

        if(!class_exists($block_class))
            $this->error('未找到该模块');
        
        
        $data   =   new $block_class;
        $config = $data->getConfig();

        $temp_dir  = ZWJ_BLOCK_PATH.$addon['name']."/".$addon['name'].".html";
        $temp      = file_get_contents($temp_dir);
        L("ADD","设置模块");
        $where = array();//查询条件
        foreach ($config["where"] as $key => $val) {
            if(is_array($val[0])){

                foreach ($val as $k => $v) {

                    $where[] = array(
                        "field"=>$key,
                        "expr" =>trim($v[0]),
                        "val"  =>$this->field_html($config["table"],$key,$v[1])
                    );
                }
            }else{
                
                $where[] = array(
                    "field"=>$key,
                    "expr" =>trim($val[0]),
                    "val"  =>$this->field_html($config["table"],$key,$val[1])
                );
            }
        }

        $config["where"] = $where;

        $tables = D("table")->get_table();//查询所有可用的表
        $this->assign('tables',$tables);
        $field = M("table")->field("field,type,name")->where(array("table"=>$config['table']))->order("sort asc")->select();//查询当前使用表的所有字段
        $this->assign("field",$field);

        $this->assign("addon",$addon);
        $this->assign("temp",$temp);
        $this->assign("info",$config);
        $this->display();

    }

    /**
     * 保存插件设置
     */
    public function saveConfig(){
        $id     =   (int)I('id');
        $config =   I('config');
        if($config["where"]){
            $where = array();
            foreach ($config["where"]["field"] as $key => $val) {
                $w = array();
                $expr = trim($config["where"]["expr"][$key]);
                $value = $config["where"]["val"][$key];

                $value=strtotime($value)?strtotime($value):$value;

                switch($expr){
                    case "like":
                        $w = array("like","%{$value}%");
                    case "in":
                        $value = trim($value);
                        $w = array("in",explode(",", $value));
                    case "not in":
                        $value = trim($value);
                        $w = array("not in",explode(",", $value));
                    default:
                       $w = array($expr,$value);
                }

                if(!empty($where[$val])){//已存在
                    if(count($where[$val]) > 2){
                        $where[$val][] = $w;
                    }else{
                        $where[$val] = array(
                            "0"=>$where[$val],
                            "1"=>$w
                        );
                    }
                }else{
                    $where[$val] = $w;
                }
            }
        }
        $config["where"] = $where;
        $temp   =   $_POST["temp"]; 
        $name   =   M('Block')->where("id={$id}")->getField("name");
        $block_dir             =   ZWJ_BLOCK_PATH;
        if(!empty($temp))
            file_put_contents($block_dir."{$name}/{$name}.html", $temp);

        $flag = M('Block')->where("id={$id}")->setField('config',json_encode($config));
        if($flag !== false){
            $this->success('保存成功', U("index"));
        }else{
            $this->error('保存失败');
        }
    }

    /**
     * 解析数据库语句函数
     * @param string $sql  sql语句   带默认前缀的
     * @param string $tablepre  自己的前缀
     * @return multitype:string 返回最终需要的sql语句
     */
    public function sql_split($sql, $tablepre) {
        if ($tablepre != "onethink_")
            $sql = str_replace("onethink_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

        if ($r_tablepre != $s_tablepre)
            $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

    /**
     * 获取插件所需的钩子是否存在，没有则新增
     * @param string $str  钩子名称
     * @param string $addons  插件名称
     * @param string $addons  插件简介
     */
    public function existHook($str, $addons, $msg=''){
        $hook_mod = M('Hooks');
        $where['name'] = $str;
        $gethook = $hook_mod->where($where)->find();
        if(!$gethook || empty($gethook) || !is_array($gethook)){
            $data['name'] = $str;
            $data['description'] = $msg;
            $data['type'] = 1;
            $data['update_time'] = NOW_TIME;
            $data['addons'] = $addons;
            if( false !== $hook_mod->create($data) ){
                $hook_mod->add();
            }
        }
    }

    /**
     * 删除钩子
     * @param string $hook  钩子名称
     */
    public function deleteHook($hook){
        $model = M('hooks');
        $condition = array(
            'name' => $hook,
        );
        $model->where($condition)->delete();
        S('hooks', null);
    }

    /**
     * 钩子列表
     */
    public function hooks(){

        $map    =   $fields =   array();

        $list   =   $this->_list(D("Hooks"),$map);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();

    }

    public function addhook(){
        $this->assign('info', null);
        L("ADD","新增钩子");
        $this->display('edithook');
    }

    //钩子出编辑挂载插件页面
    public function edithook($id){
        $hook = M('Hooks')->field(true)->find($id);
        $this->assign('info',$hook);
        L("EDIT","编辑钩子");
        $this->display('edithook');
    }

    //超级管理员删除钩子
    public function delhook($id){
        if(M('Hooks')->delete($id) !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function updateHook(){
        $hookModel  =   D('Hooks');
        $data       =   $hookModel->create();
        if($data){
            if($data['id']){
                $flag = $hookModel->save($data);
                if($flag !== false){
                    S('hooks', null);
                    $this->success('更新成功', Cookie('__forward__'));
                }else{
                    $this->error('更新失败');
                }
            }else{
                $flag = $hookModel->add($data);
                if($flag){
                    S('hooks', null);
                    $this->success('新增成功', Cookie('__forward__'));
                }else{
                    $this->error('新增失败');
                }
            }
        }else{
            $this->error($hookModel->getError());
        }
    }

    public function _before_delete(){
        $mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        $ids = trim(I('request.'.$pk), ',');
        
        if ($ids) {
            S('hooks', null);
            $where["id"] = array("in",explode(",", $ids)); 
            $blocks = $mod->where($where)->getField("name",True);
            foreach ($blocks as $val) {
                D('Hooks')->removeHooks($val);
                $path = ZWJ_BLOCK_PATH.$val;
                deldir($path);//删除文件夹
            }
        }
    }

}
