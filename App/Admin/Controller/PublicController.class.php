<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends backendController {
    public function _initialize() {
        parent::_initialize();
       	$this->_mod = D(CONTROLLER_NAME); 
		
    }
	public function index(){
		
		$map = $this->_search();
      	

        $mod = D(CONTROLLER_NAME);

        !empty($mod) && $this->_list($mod, $map);
		
		
        $this->display();
	}

	/**
     * 获取请求参数生成条件数组
     */
    protected function _search() {
        //生成查询条件
        $mod = D(CONTROLLER_NAME);
        $map = array();
        $table = M("table");
		//getDbFields（）方法用来获取当前数据对象的全部字段信息
		$Fields = $table->field("type,field")->where(array("table"=>CONTROLLER_NAME))->select();
		
        foreach ($Fields as $key => $val) {
            
            if($val["type"] == 1){
            	if(I('request.'.$val['field']) != "") $map[$val['field']] = array("like","%".I('request.'.$val['field'])."%");
            }elseif( $val["type"] == 14 ){
            	$start = I('request.start_'.$val['field']);
	            $end = I('request.end_'.$val['field']);
	            !empty($start) && $map[$val['field']][] = array("egt",$start);
	            !empty($end) && $map[$val['field']][] = array("elt",$end);
            }elseif($val["type"] == 15){
            	$start = I('request.start_'.$val['field']);
	            $end = I('request.end_'.$val['field']);
	            !empty($start) && $map[$val['field']][] = array("egt",strtotime($start));
	            !empty($end) && $map[$val['field']][] = array("elt",strtotime($end));
            }else{
            	
            	if(I('request.'.$val['field']) != "") $map[$val['field']] = I('request.'.$val['field']);
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
      
        if (I("request._sort")) {
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

		$this->_table($list);//生成列表
        
        $this->assign('list', $list);

    }


	public function _table($data){
		
		
		$oder = intval(I("get._order"));//正序或倒序

		$sort = I("get._sort");//排序字段

		if($oder){
			$oder = 0;
			$img = '<img src="'.__ROOT__.'/Public/Admin/images/desc.gif" width="12" height="17" border="0" align="absmiddle">';
		}else{
			$oder = 1;
			$img = '<img src="'.__ROOT__.'/Public/Admin/images/asc.gif" width="12" height="17" border="0" align="absmiddle">';
		}

		$mod = M('table');
		
		$table = strtolower(CONTROLLER_NAME);

		$lists = $mod -> where(array("table"=>$table,'show'=>1))->order('sort asc')->select();

		$operate = M("operate")->where(array("table"=>$table,"menu_id"=>$this->menuid,'show'=>1))->order("sort asc")->select();

		$colspan = count($operate)?count($lists)+4:count($lists)+3;
		
		$html = '<table id="dataTable" class="table table-bordered table-hover definewidth m10" cellspacing="0" cellpadding="0">';
		$html .= '<tbody><tr><td class="topTd" colspan="'.$colspan.'" style="padding:2px 10px;" ><a href="javascript:;" style="float:right;" onclick="window.location.reload()" class="icon-refresh"></a></td></tr>'; 

		$tr = "<tr class='row'>";
		
		$th = $tr."<th width=\"8\"><input id=\"check\" type=\"checkbox\" onclick=\"CheckAll('dataTable')\"></th>";
		$td = $tr."<td><input type='checkbox' value='\$id' name='key'></td>";
		if($sort == "id"){
			$th .= "<th width=\"50\"><a title=\"按照编号升序排列\" href=\"javascript:sortBy('id','".$oder."','index')\" >编号".$img."</a></td>";
		}else{
			$th .= "<th width=\"50\"><a title=\"按照编号升序排列\" href=\"javascript:sortBy('id','".$oder."','index')\" >编号</a></td>";
		}
		$td .= "<td>\$id</td>";

		$search = "";

		foreach ($lists as $key => $val) {
			
			if($val['field'] == $sort){
				$sortimg = $img;
			}else{
				$sortimg = "";
			}
			
			if(in_array($val['type'], array(7,9,10))){
				$dd = explode("|", $val['data']);
				$da = array();
				foreach ($dd as $k => $v) {
					$ddd = explode("=", $v);
					$da[$ddd[0]] = $ddd[1];
				}
				if($val["search"] == 1){
					$get = I("get.".$val['field']);
					$select = "<level>".$val['name']."：<select name='".$val['field']."'>";
					$select .= "<option value='' selected >全部</option>";
					foreach ($da as $k => $v) {
						$selected = ($k == $get && $get != "") ?"selected":"";
						$select .= "<option value='".$k."' ".$selected." >".$v."</option>";
					}
					$select .= "</select></level>";
					$search .= $select;
				}
				$fields = "fields".$val['field'];
				$$fields = $da;
				$td .= "<td>\$".$fields."[\$".$val['field']."]</td>";
				$th .= "<th><a title=\"按照".$val['name']."升序排列\" href=\"javascript:sortBy('".$val['field']."','".$oder."','index')\" >".$val['name'].$sortimg."</a></th>";
			}elseif(in_array($val['type'], array(8,11))){
				//关联表
				$th .= "<th><a title=\"按照".$val['name']."升序排列\" href=\"javascript:sortBy('".$val['field']."','".$oder."','index')\" >".$val['name'].$sortimg."</a></th>";
				
				$dd = explode("|", $val['data']);

				$da = M($dd[0])->getField("id,".$dd[1]);
				
				if($dd[0] == strtolower(CONTROLLER_NAME)) $da[0] = "<span style='color:red;'>顶级分类</span>";
				
				if($val["search"] == 1){
					$get = I("get.".$val['field']);
					$select = "<level>".$val['name']."：<select name='".$val['field']."'>";
					
					if($dd[0] == strtolower(CONTROLLER_NAME)){
						$select .= "<option value='' selected >顶级分类</option>";
					}else{
						$select .= "<option value='' selected >全部</option>";
					}

					$tree = new \Think\Tree();
					$daf = M($dd[0])->select();
					foreach($daf as $r) {
			            $r['selected'] = ($r["id"] == $get && $get != "") ?"selected":"";
			            $r['title'] = $r[$dd[1]];
			            $array[] = $r;
			        }
			        $str  = "<option value='\$id' \$selected>\$spacer \$title</option>";
			        $tree->init($array);
			        $select_menus = $tree->get_tree(0, $str);
			        $select .= $select_menus;

					$select .= "</select></level>";
					$search .= $select;
				}
				$fields = "fields".$val['field'];
				$$fields = $da;
				$td .= "<td>\$".$fields."[\$".$val['field']."]</td>";

			
			}elseif($val['type'] == 6){//显示图片
				$td .= "<td><a href='".__ROOT__."/Uploads/\$".$val['field']."' target='_blank'><img width='100' src='".__ROOT__."/Uploads/\$".$val['field']."' /></a></td>";
				$th .= "<th width=\"85\" >".$val['name']."</th>";
			}elseif($val['type'] == 14){

				if($val["search"] == 1){
					$start_get = I("get.start_".$val['field']);
					$end_get = I("get.end_".$val['field']);
					$search .= "<level>".$val['name']."：<input type='text' style='width:100px;' name='start_".$val['field']."' value='".$start_get."' > - <input type='text' style='width:100px;' name='end_".$val['field']."' value='".$end_get."' ></level>";
				}
				$td .= "<td>\$".$val['field']."</td>";
				$th .= "<th><a title=\"按照".$val['name']."升序排列\" href=\"javascript:sortBy('".$val['field']."','".$oder."','index')\">".$val['name'].$sortimg."</a></th>";
			}elseif($val['type'] == 15){
				if($val["search"] == 1){
					$this->assign("adddate",true);
					$start_get = I("get.start_".$val['field']);
					$end_get = I("get.end_".$val['field']);
					$search .= "<level>".$val['name']."：<input type='text' style='width:100px;' name='start_".$val['field']."' id='start_".$val['field']."' value='".$start_get."' onclick='SelectDate(this,\"yyyy-MM-dd\")' > - <input type='text' style='width:100px;' id='end_".$val['field']."' name='end_".$val['field']."' value='".$end_get."' onclick='SelectDate(this,\"yyyy-MM-dd\")' ></level>";
				}
				$td .= "<td>\$".$val['field']."</td>";
				$th .= "<th><a title=\"按照".$val['name']."升序排列\" href=\"javascript:sortBy('".$val['field']."','".$oder."','index')\">".$val['name'].$sortimg."</a></th>";
			}else{
				if($val["search"] == 1){
					$get = I("get.".$val['field']);
					$search .= "<level>".$val['name']."：<input type='text' style='width:120px;' name='".$val['field']."' value='".$get."' ></level>";
				}
				$td .= "<td>\$".$val['field']."</td>";
				$th .= "<th><a title=\"按照".$val['name']."升序排列\" href=\"javascript:sortBy('".$val['field']."','".$oder."','index')\">".$val['name'].$sortimg."</a></th>";
			}
			
		}

		if(count($operate)){
			$th .= "<th>操作</th>";
			$oper = "";
			foreach ($operate as $key => $val) {
				$op[] = "<a href='".$val['url']."'>".$val['name']."</a>";
			}

			$oper .= implode(" | ", $op);
			$td .= "<td>".$oper."</td>";
		}

		$date_field = $mod -> where(array("table"=>$table,"type"=>15))->getField("field",true);
		$price_field = $mod -> where(array("table"=>$table,"type"=>14))->getField("field",true);

		foreach ($data as $key => $val) {
			foreach ($val as $k => $v) {
				if(in_array($k, $date_field)) $v = to_date($v);
				if(in_array($k, $price_field)) $v = format_price($v);
				$$k = $v;
			}
			eval("\$tdnew = \"$td\";");
			$td_list .= $tdnew;
		}

		$th .= "</tr>";
		$td .= "</tr>";
		
		$html .= $th.$td_list.'<tr><td class="topTd" height="5" colspan="'.$colspan.'"></td></tr></tbody></table>'; 
		$this->assign("search_list",$search);
		$this->assign("html_list",$html);
					
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
            $this->_table_tr();
            $this->display();
            
        }
    }

    //插入数据前操作
    public function _before_insert($data){
    	$mod = M('table');
		$table = strtolower(CONTROLLER_NAME);
		$lists = $mod -> where(array("table"=>$table))->order('sort asc')->select();
		foreach ($lists as $key => $value) {
			if(!empty($data[$value["field"]])){
				if($value["type"] == 5){
					$data[$value["field"]] = $_POST[$value["field"]];
				}elseif($value["type"] == 6){
					//处理图片，把图片状态设置为已使用
					M("Image")->where("file = '".$data[$value["field"]]."'")->setField("is_effect",1);
				}elseif($value["type"] == 10 || $value["type"] == 11){//复选
					$ids = I($value["field"]);
					$data[$value["field"]] = implode(",", $ids);
				}elseif($value["type"] == 15){//把时间格式转为时间戳
					$data[$value["field"]] = strtotime($data[$value["field"]]);
				}elseif ($value["type"] == 16) {
					$ids = I($value["field"]);
					$data[$value["field"]] = implode(",", $ids);
					$where["id"] = array("in",$ids);
					M("Image")->where($where)->setField("is_effect",1);
				}
			}
			if($value["notempty"] == 1){
				if(empty($data[$value["field"]])){
					$this->error($value["name"]."不能为空！");
				}
			}
			if($value["only"] == 1){
				$where[$value["field"]] = $data[$value["field"]];
				$check = $this->_mod->where($where)->find();
				if($check){
					$this->error($value["name"]."已经存在！");
				}
			}
		}
		return $data;
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

            $this->_table_tr($info);
            $this->assign('info', $info);
            $this->display();
        }
    }
    //插入数据前操作
    public function _before_update($data){
    	$mod = M('table');
		$table = strtolower(CONTROLLER_NAME);
		$lists = $mod -> where(array("table"=>$table))->order('sort asc')->select();
		foreach ($lists as $key => $value) {
			if(!empty($data[$value["field"]])){
				if($value["type"] == 5){
					$data[$value["field"]] = $_POST[$value["field"]];
				}elseif($value["type"] == 6){
					//处理图片，把图片状态设置为已使用
					M("Image")->where("file = '".$data[$value["field"]]."'")->setField("is_effect",1);
				}elseif($value["type"] == 10 || $value["type"] == 11){//复选
					$ids = I($value["field"]);
					$data[$value["field"]] = implode(",", $ids);
				}elseif($value["type"] == 15){//把时间格式转为时间戳
					$data[$value["field"]] = strtotime($data[$value["field"]]);
				}elseif ($value["type"] == 16) {
					$ids = I($value["field"]);
					$data[$value["field"]] = implode(",", $ids);
					$where["id"] = array("in",$ids);
					M("Image")->where($where)->setField("is_effect",1);
				}
			}
			if($value["notempty"] == 1){
				if(empty($data[$value["field"]])){
					$this->error($value["name"]."不能为空！");
				}
			}
			if($value["only"] == 1){
				$where[$value["field"]] = $data[$value["field"]];
				$check = $this->_mod->where($where)->find();
				if($check){
					$this->error($value["name"]."已经存在！");
				}
			}
		}
		return $data;
    }
    public function _table_tr($info = array()){
    	
    	$adddate = false;//是否开启时间格式
    	$editor = false;//是否开启编辑框
    	$uploadify = false;//是否开启图片上传

    	$mod = M('table');
		$table = strtolower(CONTROLLER_NAME);
		$lists = $mod -> where(array("table"=>$table))->order('sort asc')->select();

		$td = "";

		foreach ($lists as $key => $val) {
			
			if($val["hide"])continue;
			if($val["notempty"]){
				$val["name"] = "<span style='color:red'>*</span>".$val["name"];
			}
			if(empty($val["explain"])){
		   		$explain = '';
		   	}else{
		   		$explain = '<span class="red" style="margin-left:10px;">'.$val["explain"].'</span>';
		   	}
			switch ($val["type"]){
			  	
			  	case "1": // 字符串
				   	$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><input type="text"  name="'.$val["field"].'" '.$val["attr"].' value="'.$info[$val["field"]].'" />'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "2": // 数值型
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><input type="text"  name="'.$val["field"].'" '.$val["attr"].'  value="'.$info[$val["field"]].'" />'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "3": // 密码框
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><input type="password"  name="'.$val["field"].'"  '.$val["attr"].'  value="'.$info[$val["field"]].'" />'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "4": // 文本框
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><textarea class="span4" name="'.$val["field"].'"  '.$val["attr"].' >'.$info[$val["field"]].'</textarea>'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "5": // 富文本框
					$editor = true;
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><div style="width:900px;" >
						<script type="text/plain" id="'.$val["field"].'" name="'.$val["field"].'>'.$info[$val["field"]].'</script>
				        <script type="text/javascript">
				            UE.getEditor("'.$val["field"].'");
				        </script>
				        </div>'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "6": // 文件上传
					$uploadify = true;
					$imageid = M("image")->where("file = '".$info[$val["field"]]."'")->getField("id");
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >';
				    $t .= '<div style="float:left;position: relative;"><input type="file" id="'.$val["field"].'" name="'.$val["field"].'" repetition="0" /></div>';
				    $t .= '<div style="float:left;margin-left:20px;height:50px;line-height:45px" name="'.$val["field"].'_show">';
				    if($info[$val["field"]]) $t .= '<img style="margin-left:10px;" src="'.__ROOT__."/Uploads/".$info[$val["field"]].'" width="50" height="45" onclick="delimage(this,\''.$imageid.'\')"/><input type="hidden" name="'.$val["field"].'" value="'.$info[$val["field"]].'" />';
				    $t .= '</div>';
				    $t .= '</td>';
				   	$t .= '</tr>';
				   	break;
				case "7": // 下拉框
					$dd = explode("|", $val['data']);
					$da = array();
					foreach ($dd as $k => $v) {
						$ddd = explode("=", $v);
						$da[$ddd[0]] = $ddd[1];
					}
					$get =$info[$val['field']];
					$select = "<select name='".$val['field']."' ".$val["attr"]."  >";
					$select .= "<option value='' selected >全部</option>";
					foreach ($da as $k => $v) {
						$selected = ($k == $get && $get != "") ?"selected":"";
						$select .= "<option value='".$k."' ".$selected." >".$v."</option>";
					}
					$select .= "</select>";
					$search .= $select;
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >'.$select.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "8": // 下拉框(关联表)
					$dd = explode("|", $val['data']);

					$da = M($dd[0])->getField("id,".$dd[1]);

					$get =$info[$val['field']];
					$select = "<select name='".$val['field']."' ".$val["attr"]." >";
					
					if($dd[0] == strtolower(CONTROLLER_NAME)){
						$select .= "<option value='' selected >顶级分类</option>";
					}else{
						$select .= "<option value='' selected >全部</option>";
					}
					

					$tree = new \Think\Tree();
					$daf = M($dd[0])->select();
					foreach($daf as $r) {
			            $r['selected'] = ($r["id"] == $get && $get != "") ?"selected":"";
			            $r['title'] = $r[$dd[1]];
			            $array[] = $r;
			        }
			        $str  = "<option value='\$id' \$selected>\$spacer \$title</option>";
			        $tree->init($array);
			        $select_menus = $tree->get_tree(0, $str);
			        $select .= $select_menus;

					$select .= "</select>";
					$search .= $select;
			
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >'.$select.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "9": // 单选
					$dd = explode("|", $val['data']);
					$da = array();
					foreach ($dd as $k => $v) {
						$ddd = explode("=", $v);
						$da[$ddd[0]] = $ddd[1];
					}
					$get = explode(",",$info[$val['field']]);
					$radio = "";
					foreach ($da as $k => $v) {
						if(in_array($k, $get)){
							$radio .='<label>'.$v.'<input type="radio" name="'.$val['field'].'" '.$val["attr"].' value="'.$k.'" checked="checked" /></label>';
						}else{
							$radio .='<label>'.$v.'<input type="radio" name="'.$val['field'].'" value="'.$k.'" /></label>';
						}
					}
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >'.$radio.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "10": // 复选
					$dd = explode("|", $val['data']);
					$da = array();
					foreach ($dd as $k => $v) {
						$ddd = explode("=", $v);
						$da[$ddd[0]] = $ddd[1];
					}
					$get = explode(",",$info[$val['field']]);
					$checkbox = "";
					foreach ($da as $k => $v) {
						if(in_array($k, $get)){
							$checkbox .='<label>'.$v.'<input type="checkbox" name="'.$val['field'].'[]" '.$val["attr"].' value="'.$k.'" checked="checked" /></label>';
						}else{
							$checkbox .='<label>'.$v.'<input type="checkbox" name="'.$val['field'].'[]" '.$val["attr"].' value="'.$k.'" /></label>';
						}
					}
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >'.$checkbox.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "11": // 复选(关联表)
					$dd = explode("|", $val['data']);

					$da = M($dd[0])->getField("id,".$dd[1]);

					$get = explode(",",$info[$val['field']]);
					$checkbox = "";
					foreach ($da as $k => $v) {
						if(in_array($k, $get)){
							$checkbox .='<label>'.$v.'<input type="checkbox" name="'.$val['field'].'[]" '.$val["attr"].' value="'.$k.'" checked="checked" /></label>';
						}else{
							$checkbox .='<label>'.$v.'<input type="checkbox" name="'.$val['field'].'[]" '.$val["attr"].' value="'.$k.'" /></label>';
						}
					}
			
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >'.$checkbox.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "12": // 手机格式
				   	$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><input type="text"  name="'.$val["field"].'" '.$val["attr"].' value="'.$info[$val["field"]].'" />'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "13": // 邮箱格式
				   	$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><input type="text"  name="'.$val["field"].'" '.$val["attr"].' value="'.$info[$val["field"]].'" />'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "14": // 价格格式
				   	$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><span class="input-icon">
								<span class="icon red">￥</span>
								<input type="text" name="'.$val["field"].'" id="'.$val["field"].'" '.$val["attr"].' value="'.$info[$val["field"]].'" />
							</span>'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "15": // 时间格式
				   	$adddate = true;
				   	$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" ><span class="input-icon">
							<i class="icon-calendar bigger-110 "></i>
							<input type="text" style="width:150px" name="'.$val["field"].'" id="'.$val["field"].'" value="'.to_date($info[$val["field"]]).'" onclick="SelectDate(this,\'yyyy-MM-dd hh:mm:ss\')" />
						</span>
						<span class="input-group-btn">
							<button class="btn btn-sm btn-default" type="button" onclick="$(\'#'.$val["field"].'\').val(\'\');">
								<i class="icon-trash bigger-110"></i>
							</button>
						</span>'.$explain.'</td>';
				   	$t .= '</tr>';
				   	break;
				case "16": // 多图上传
					$uploadify = true;
					$info[$val["field"]]?$dd = explode(",", $info[$val["field"]]):$dd = "";
					$t = '<tr>';
				   	$t .= '<td class="tableleft" width="15%">'.$val["name"].':</td>';
				    $t .= '<td class="tableright" width="85%" >';
				    $t .= '<div style="float:left;position: relative;"><input type="file" id="'.$val["field"].'" name="'.$val["field"].'" repetition="1" /></div>';
				    $t .= '<div style="float:left;margin-left:20px;height:50px;line-height:45px" name="'.$val["field"].'_show">';
				    if(!empty($dd)){
				    	foreach ($dd as $k => $v) {
				    		$t .= '<img style="margin-left:10px;" name="'.$val["field"].'" src="'.__ROOT__.'/Uploads/'.image($v).'" width="50" height="45" onclick="delimage(this,\''.$v.'\')"/>';
				    		$t .= '<input type="hidden" name="'.$val["field"].'[]" value="'.$v.'" />';
				    	}
				    }
				    $t .= '</div>';
				    $t .= '</td>';
				   	$t .= '</tr>';
				   	break;
			}
			$td .= $t;
		}

		$this->assign("uploadify",$uploadify);
		$this->assign("adddate",$adddate);
		$this->assign("editor",$editor);
		$this->assign("td",$td);
    }
    //图片删除
    public function delimg(){
        $mod = M("image");
        $id  = I('imageid');
        $name = I('name');
        $gid = I('gid');
        $image = $mod->where(array('id'=>$id))->find();

        $img = './Uploads/'.$image['file'];
        $img_water = get_img_file($img);//水印图片
        $img_thumb = get_img_file($img,'_thumb');//缩略图片

        if(unlink($img)){
            unlink($img_water);
            unlink($img_thumb);
            if($image["repetition"] == 1){
            	if($gid){
            		$nn = $this->_mod->where("id = %d",$gid)->getField($name);
            		$n = explode(",", $nn);
            		$r = array();
            		foreach ($nn as $v) {
            			if($v != $id)
            				$r[] = $v;
            		}
            		$this->_mod->where("id = %d",$gid)->setField($name,implode(",", $r));
            	}
            }else{
            	if($gid) $this->_mod->where("id = %d",$gid)->setField($name,"");
            }
            $mod->where(array('id'=>$id))->delete();
            $this->ajaxReturn(1,'删除成功！');
        }else{
            $this->ajaxReturn(0,'删除失败！');
        }
    }
}