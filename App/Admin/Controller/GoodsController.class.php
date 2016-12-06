<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends PublicController {
    public function _initialize() {
        parent::_initialize();
       	$this->_mod = D(CONTROLLER_NAME);  
    }
	//商品属性
	public function attr($goods_id){

		$goods_attr = M("GoodsAttr");

		$type_id = $goods_attr->where("goods_id = %d",$goods_id)->getField("attr_id");
		$type = M("GoodsType")->field("id,name")->where("is_effect = 1")->select();

		$count = $goods_attr->where("goods_id = %d",$goods_id)->count();
		if($count){
			$attr_html = $this->attr_html($type_id,$goods_id);
			$this->assign("attr_html",$attr_html);
		}
		
		$this->assign("type",$type);
		$this->assign("goods_id",$goods_id);
		$this->assign("type_id",$type_id);
		$this->display();
	}
	//生成属性
	public function attr_html($type_id,$goods_id){
		$goods_attr = M("GoodsAttr");
		$attr_type = M("AttrType");
		$html  = "";
		$attr_list = $attr_type->where("type_id = %d",$type_id)->order("sort desc")->select();
		foreach ($attr_list as $key => $val) {
			
			$html  .= "<tr>";
			$html  .= '<td class="tableleft">'.$val['name'].':</td>';
			if($val['attr_input'] == 1 ){//手工录入
				switch ( $val['attr_type'] ) {
					case 1:		//唯一属性
						$attr_value = $goods_attr->where("goods_id = %d and attr_id = %d",$goods_id,$val["id"])->find();
						$html  .= '<td class="tableright">
									<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
									<input type="text" name="attr_value_list[]" value="'.$attr_value['attr_value'].'" />
									<input type="hidden" name="attr_price_list[]" value="0" />
								</td>';
						break;
					default:	//多选属性
						$attr_value = $goods_attr->where("goods_id = %d and attr_id = %d",$goods_id,$val["id"])->select();
						$tr = "";
						if(count($attr_value) > 0){
							foreach ($attr_value as $k => $v) {
								if($k == 0){
									$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<input type="text" style="width:100px;"  name="attr_value_list[]" value="'.$v['attr_value'].'" />
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="'.$v['attr_value'].'" /></td>
										<td class="tableright"><a href="javascript:;" onclick="add_attr(this)"><label style="width:30px;" >添加</label></a></td>
									</tr>';
								}else{
									$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<input type="text" style="width:100px;"  name="attr_value_list[]" value="" />
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="'.$v['attr_value'].'" /></td>
										<td class="tableright"><a href="javascript:;" onclick="del_attr(this)"><label style="width:30px;" >删除</label></a></td>
									</tr>';
								}
							}
						}else{
							$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<input type="text" style="width:100px;"  name="attr_value_list[]" value="" />
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="0" /></td>
										<td class="tableright"><a href="javascript:;" onclick="add_attr(this)"><label style="width:30px;" >添加</label></a></td>
									</tr>';
						}
						$html  .= '<td class="tableright">
									<table class="table table-bordered" style="width:200px;" cellpadding=0 cellspacing=0>
										'.$tr.'
									</table>
								</td>';
						break;
				}
			}elseif($val['attr_input'] == 2 ){//列表中选择
				
				$attr_id_values = explode(",", $val["attr_content"]);
				
				
				switch ( $val['attr_type'] ) {
					case 1:		//唯一属性
						$attr_value = $goods_attr->where("goods_id = %d and attr_id = %d",$goods_id,$val["id"])->find();
						$select_option = "";
						foreach ($attr_id_values as $v) {
							$select = "";
							$v9 = trim($v9);
							if($v9 == trim($v["attr_value"]) ) $select = "selected";
							$select_option .= '<option value="'.$v9.'" '.$select.' >'.$v9.'</option>';
						}
						$html  .= '<td class="tableright">
									<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
									<select name="attr_value_list[]">
										'.$select_option.'
									</select>
									<input type="hidden" name="attr_price_list[]" value="0" />
								</td>';
						break;
					default:	//多选属性

						$attr_value = $goods_attr->where("goods_id = %d and attr_id = %d",$goods_id,$val["id"])->select();
						$tr = "";
						if(count($attr_value) > 0){
							foreach ($attr_value as $k => $v) {
		
								$select_option = "";
								foreach ($attr_id_values as $v9) {
									$select = "";
									$v9 = trim($v9);
									if($v9 == trim($v["attr_value"]) ) $select = "selected";
									$select_option .= '<option value="'.$v9.'" '.$select.' >'.$v9.'</option>';
								}

								if($k == 0){

									$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<select name="attr_value_list[]">
												'.$select_option.'
											</select>
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="'.$v['attr_price'].'" /></td>
										<td class="tableright"><a href="javascript:;" onclick="add_attr(this)"><label style="width:30px;" >添加</label></a></td>
									</tr>';
								}else{
									$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<select name="attr_value_list[]">
												'.$select_option.'
											</select>
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="'.$v['attr_price'].'" /></td>
										<td class="tableright"><a href="javascript:;" onclick="del_attr(this)"><label style="width:30px;" >删除</label></a></td>
									</tr>';
								}
							}
						}else{
							$select_option = "";
							foreach ($attr_id_values as $v9) {
								$select = "";
								$v9 = trim($v9);
								$select_option .= '<option value="'.$v9.'" '.$select.' >'.$v9.'</option>';
							}
							$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<select name="attr_value_list[]">
												'.$select_option.'
											</select>
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="0" /></td>
										<td class="tableright"><a href="javascript:;" onclick="add_attr(this)"><label style="width:30px;" >添加</label></a></td>
									</tr>';
						}

						$html  .= '<td class="tableright">
									<table class="table table-bordered" style="width:200px;" cellpadding=0 cellspacing=0>
										'.$tr.'
									</table>
								</td>';
						break;
				}
			}else{//多选文本
				switch ( $val['attr_type'] ) {
					case 1:		//唯一属性
						$attr_value = $goods_attr->where("goods_id = %d and attr_id = %d",$goods_id,$val["id"])->find();
						$html  .= '<td class="tableright">
									<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
									<textarea  name="attr_value_list[]"  row="5" >'.$attr_value['attr_value'].'</textarea>
									<input type="hidden" name="attr_price_list[]" value="0" />
								</td>';
						break;
					default:	//多选属性
						$attr_value = $goods_attr->where("goods_id = %d and attr_id = %d",$goods_id,$val["id"])->select();
						$tr = "";
						if(count($attr_value) > 0){
							foreach ($attr_value as $k => $v) {
								if($k == 0){
									$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<textarea  name="attr_value_list[]" >'.$v['attr_value'].'</textarea>
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="'.$v['attr_price'].'" /></td>
										<td class="tableright"><a href="javascript:;" onclick="add_attr(this)"><label style="width:30px;" >添加</label></a></td>
									</tr>';
								}else{
									$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<textarea  name="attr_value_list[]" >'.$v['attr_value'].'</textarea>
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="'.$v['attr_price'].'" /></td>
										<td class="tableright"><a href="javascript:;" onclick="del_attr(this)"><label style="width:30px;" >删除</label></a></td>
									</tr>';
								}
							}
						}else{
							$tr .= '<tr>
										<td class="tableright">
											<input type="hidden" name="attr_id_list[]" value="'.$val['id'].'" />
											<textarea  name="attr_value_list[]" ></textarea>
										</td>
										<td class="tableleft"><label style="width:70px;" >属性价格:</label></td>
										<td class="tableright"><input type="text" style="width:50px;" name="attr_price_list[]" value="0" /></td>
										<td class="tableright"><a href="javascript:;" onclick="add_attr(this)"><label style="width:30px;" >添加</label></a></td>
									</tr>';
						}

						$html  .= '<td class="tableright">
									<table class="table table-bordered" style="width:200px;" cellpadding=0 cellspacing=0>
										'.$tr.'
									</table>
								</td>';
						break;
				}
			}

			$html  .= "</tr>";
		}
		if(IS_AJAX){
			echo $html;
		}else{
			return $html;
		}
		
	}
	//处理商品属性
	public function attr_save(){
		$type_id		= I("post.type_id");
		$goods_id		= I("post.goods_id");
		$attr_id_list	= I("post.attr_id_list");
		$attr_value_list= I("post.attr_value_list");
		$attr_price_list= I("post.attr_price_list");

		$good_name = M("goods")->where("id = %d ",$goods_id)->getField("name");
		$mod = M("GoodsAttr");
		if($type_id && $goods_id){
			if($attr_value_list){
				//记录日记
                
                save_log("编辑商品《".$good_name."》的商品属性！",1);

				//删除该商品的所有属性
				$where_delete["goods_id"] = $goods_id;
				$mod->where($where_delete)->delete();

				foreach ($attr_value_list as $key => $val) {
					$data = array();
					$data["goods_id"] = $goods_id;
					$data["attr_id"] = $attr_id_list[$key];
					$data["attr_value"] = $val;
					$data["attr_price"] = $attr_price_list[$key];
					$mod->add($data);
				}
				$this->success("编辑成功！");
			}
		}else{
			//记录日记
            save_log("编辑商品《".$good_name."》的商品属性！",0);

			$this->error("参数丢失！");
		}
	}
}