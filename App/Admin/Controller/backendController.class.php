<?php
/**
 * 后台控制器基类
 *
 * @author andery
 */
namespace Admin\Controller;
use Think\Controller;

class backendController extends baseController
{

    protected $menuid = 0;
    public function _initialize() {
        parent::_initialize();
        
        $this->menuid = I("menu_id");
        $this->assign("menuid",$this->menuid);//菜单ID
        
        $this->check_priv();
    }

    /**
     * 列表页面
     */
    public function index() {
        $map = $this->_search();
      
        $mod = D(CONTROLLER_NAME);
       
        !empty($mod) && $this->_list($mod, $map);

        $this->display();
    }

    /**
     * 添加
     */
    public function add() {
		
		$mod = D(CONTROLLER_NAME);
		
		if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
			
            if( $id = $mod->add($data) ){
                if( method_exists($this, '_after_insert')){
                    $id = $mod->getLastInsID();
                    $this->_after_insert($id);
                }
                //记录日记
                save_log("表".CONTROLLER_NAME."增加ID为".$id."的记录！",1);

                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                $this->success(L('operation_success'));
            } else { 
                //记录日记
                save_log("表".CONTROLLER_NAME."增加记录操作失败！",0);

                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }

    /**
     * 修改
     */
    public function edit()
    {
		
		$mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }

            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            if (false !== $mod->save($data)) {
               
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                //记录日记
                save_log("表".CONTROLLER_NAME."编辑ID为".$data['id']."的记录！",1);

                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
                $this->success(L('operation_success'));
            } else {
                //记录日记
                save_log("表".CONTROLLER_NAME."编辑记录操作失败！",0);
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $id = I('get.'.$pk, 'intval');
            $info = $mod->find($id);
            $this->assign('info', $info);
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }

    /**
     * ajax修改单个字段值
     */
    public function ajax_edit()
    {
        //AJAX修改数据
        $mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        $id = I('get.'.$pk, 'intval');
        $field = I('get.field','num');
        $val = I('get.val','0');
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where(array($pk=>$id))->setField($field, $val);
        //记录日记
        save_log("修改表".CONTROLLER_NAME."的".$field."字段值！",1);

        $this->ajaxReturn(1);
    }

    /**
     * 删除
     */
    public function delete()
    {
        $mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        $ids = trim(I('request.'.$pk), ',');
        if ($ids) {
            if (false !== $mod->delete($ids)) {
                //记录日记
                save_log("删除表".CONTROLLER_NAME."的ID为".$ids."的记录！",1);

                IS_AJAX && $this->ajaxReturn(1, L('FOREVER_DELETE_SUCCESS'));
                $this->success(L('FOREVER_DELETE_SUCCESS'));
            } else {
                save_log("删除表".CONTROLLER_NAME."的记录失败！",0);
                IS_AJAX && $this->ajaxReturn(0, L('FOREVER_DELETE_FAILED'));
                $this->error(L('FOREVER_DELETE_FAILED'));
            }
        } else {
            save_log("删除表".CONTROLLER_NAME."的操作失败！",0);
            IS_AJAX && $this->ajaxReturn(0, L('INVALID_OPERATION'));
            $this->error(L('INVALID_OPERATION'));
        }
    }
    /**
     * 放回回收站
     */
    public function del()
    {
        $mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        $ids = trim(I('request.'.$pk), ',');
        if ($ids) {
            if (false !== $mod->where("id in(".$ids.")")->setField("is_delete",1)) {
                save_log("把表".CONTROLLER_NAME."的ID为".$ids."的记录，放入回收站！",1);
                IS_AJAX && $this->ajaxReturn(1, L('DELETE_SUCCESS'));
                $this->success(L('DELETE_SUCCESS'));
            } else {
                save_log("放入回收站失败！",0);
                IS_AJAX && $this->ajaxReturn(0, L('DELETE_FAILED'));
                $this->error(L('DELETE_FAILED'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('INVALID_OPERATION'));
            $this->error(L('INVALID_OPERATION'));
        }
    }
    /**
     * 回复回收站
     */
    public function restore()
    {
        $mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        $ids = trim(I('request.'.$pk), ',');
        if ($ids) {
            if (false !== $mod->where("id in(".$ids.")")->setField("is_delete",0)) {
                save_log("把表".CONTROLLER_NAME."的ID为".$ids."的记录，恢复成功！",1);
                IS_AJAX && $this->ajaxReturn(1, L('RESTORE_SUCCESS'));
                $this->success(L('RESTORE_SUCCESS'));
            } else {
                save_log("恢复成功记录失败！",1);
                IS_AJAX && $this->ajaxReturn(0, L('RESTORE_FAILED'));
                $this->error(L('RESTORE_FAILED'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('INVALID_OPERATION'));
            $this->error(L('INVALID_OPERATION'));
        }
    }
    
    /**
     * 获取请求参数生成条件数组
     */
    protected function _search() {
        //生成查询条件
        $mod = D(CONTROLLER_NAME);
        $map = array();
		//getDbFields（）方法用来获取当前数据对象的全部字段信息
        foreach ($mod->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_') {
                continue;
            }
            if(I('request.'.$val)) {
                $map[$val] = I('request.'.$val);
            }
        }
        return $map;
    }

    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据
     * @param string $sort_by  排序字段
     * @param string $order_by  排序方法
     * @param string $field_list 显示字段
     * @param intval $pagesize 每页数据行数
     */
    protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=20)
    {
        //排序
		
        $mod_pk = $model->getPk();//getPk()方法获取表中的主键
      
        if (I("request.sort")) {
            $sort = I("request._sort");
        } else if (!empty($sort_by)) {
            $sort = $sort_by;
        } else if ($this->sort) {
            $sort = $this->sort;
        } else {
            $sort = $mod_pk;
        }
        if (I("request._order")) {
            $order = "ASC";
        } else if (!empty($order_by)) {
            $order = $order_by;
        } else if ($this->order) {
            $order = $this->order;
        } else {
            $order = 'DESC';
        }

        //如果需要分页
        if ($pagesize) {
            $count = $model->where($map)->count($mod_pk);
            $pager = new \Think\Page($count, $pagesize);
            $pager->config['prev'] = '上一页';
            $pager->config['next'] = '下一页';
        }
        $select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;
			$select->page($nowPage.','.$pager->listRows);
            $page = $pager->show();
            $this->assign("page", $page);
        }
        $list = $select->select();
		
        $this->assign('list', $list);
        $this->assign('list_table', true);
    }
	//检测登陆
    public function check_priv() {
        if (MODULE_NAME == 'attachment') {
            return true;
        }

        if ( (!session('adm_data')) && !in_array(ACTION_NAME, array('login')) ) {
            $this->redirect('index/login');
        }
        if(session('adm_data.adm_id') == 1) {
            return true;
        }
    }
	//分页
	public function _page($mod,$where='',$order = 'id desc',$page){
		$count = $mod->where($where)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,$page);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->config['prev'] = '上一页';
		$Page->config['next'] = '下一页';
		$show = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$arr = $mod->where($where)->order($order)->page($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		return $arr;
	}

    protected function update_config($new_config, $config_file = '') {
        !is_file($config_file) && $config_file = CONF_PATH . 'home/config.php';
        if (is_writable($config_file)) {
            $config = require $config_file;
            $config = array_merge($config, $new_config);
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
            @unlink(RUNTIME_FILE);
            return true;
        } else {
            return false;
        }
    }

    /**
    *   ajax修改状态
    */
    public function set_effect(){
       
        $mod = D(CONTROLLER_NAME);
        $pk = $mod->getPk();
        $id = I('request.'.$pk, 'intval');
        $field = I('request.field');
        $field = $field?$field:'is_effect';
        $val = $mod->where(array($pk=>$id))->getField($field);
        $val = $val?0:1;

        $val = $val?$na="禁用":$na="启用";
        save_log("把表".CONTROLLER_NAME."的ID为".$id."的记录，".$na."！",1);
        //允许异步修改的字段列表  放模型里面去 TODO
        if($mod->where(array($pk=>$id))->setField($field, $val))
        $this->ajaxReturn($val);

    }

    //图片上传
    public function uploads(){
        
        if($_FILES['Filedata']['name']){
           
            $info = $this->_upload($_FILES['Filedata'],CONTROLLER_NAME);
            $action = CONTROLLER_NAME;
            $name = I('name');
            $user_id = intval(session('a_user_id'));
            $model = MODULE_NAME;
            $repetition = intval(I('repetition'));

            if(empty($info['error'])){
                $file = $info['info'];
                $data = array(
                    "file"=>$file,
                    "action"=>$action,
                    "name"=>$name,
                    "size"=>$_FILES["Filedata"]["size"],
                    "user_id"=>$user_id,
                    "repetition"=>$repetition,
                    "model"=>$model
                );

                if($repetition==1){
                    $id = M("image")->data($data)->add();//图片信息入库
                }else{
                    $where = array(
                        "action"=>$action,
                        "name"=>$name,
                        "user_id"=>$user_id,
                        "repetition"=>$repetition,
                        "model"=>$model
                    );
                    $info =  M("image")->where($where)->find();
					
                    if($info){
                        $id = $info['id'];
						$data['id'] = $id;
                        M("image")->data($data)->save();//修改入库图片信息

                        $img = './Uploads/'.$info['file'];
                        
                        $img_water = get_img_file($img);//水印图片
                        $img_thumb = get_img_file($img,'_thumb');//缩略图片
                        if(unlink($img)){ //清除图片
                            unlink($img_water);
                            unlink($img_thumb);
                        }
                    }else{
                        $id = M("image")->data($data)->add();//图片信息入库
                    }
                }
                
                $this->ajaxReturn(1,"上传成功！",array('id'=>$id,'file'=>$file));
            }else{
                $this->ajaxReturn(0,$info['info']);
            }
        }else{
            $this->ajaxReturn(0,'上传失败！');
        }
        
    }

    //图片删除
    public function delimg(){
        $mod = M("image");
        $id = I('imageid');
        $img = $mod->where(array('id'=>$id))->getField('file');
        $img = './Uploads/'.$img;
        $img_water = get_img_file($img);//水印图片
        $img_thumb = get_img_file($img,'_thumb');//缩略图片

        if(unlink($img)){
            unlink($img_water);
            unlink($img_thumb);
            $mod->where(array('id'=>$id))->delete();
            $this->ajaxReturn(1,'删除成功！');
        }else{
            $this->ajaxReturn(0,'删除失败！');
        }
    }
}
