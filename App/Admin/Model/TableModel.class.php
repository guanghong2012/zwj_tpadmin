<?php
namespace Admin\Model;
use Think\Model;
class TableModel extends Model
{
    public function addition(){

		$data = $this->data;//数据
		import("Admin.Util.MysqlManage");//加载处理表的类
		$object = new \MysqlManage();
		$table = C('DB_PREFIX').$data['table'];
		
		$check = $object->checkTable($table);//查看表是否已创建

		$table_data = $data['data'];

		$type_info = array(
			1=>array("type"=>"varchar","length"=>50),
			2=>array("type"=>"int","length"=>11),
			3=>array("type"=>"varchar","length"=>32),
			4=>array("type"=>"varchar","length"=>255),
			5=>array("type"=>"text","length"=>0),
			6=>array("type"=>"varchar","length"=>100),
			7=>array("type"=>"int","length"=>11),
			8=>array("type"=>"int","length"=>11),
			9=>array("type"=>"tinyint","length"=>3),
			10=>array("type"=>"varchar","length"=>255),
			11=>array("type"=>"varchar","length"=>255),
			12=>array("type"=>"varchar","length"=>11),
			13=>array("type"=>"varchar","length"=>50),
			14=>array("type"=>"double","length"=>"10,2"),
			15=>array("type"=>"int","length"=>11),
			16=>array("type"=>"varchar","length"=>100),
		);

		if($check){//已创建
			foreach($table_data as $val){
				/*
				 * 字段信息数组处理，供添加更新字段时候使用
				 * info[name]   字段名称
				 * info[type]   字段类型
				 * info[length]  字段长度
				 * info[isNull]  是否为空
				 * info['default']   字段默认值
				 * info['comment']   字段备注
				 */
				$info = array(
					"name"=>$val['field'],
					"type"=>$type_info[$val['type']]['type'],
					"length"=>$type_info[$val['type']]['length'],
					"isNull"=>$val['notempty']?0:1,
					"default"=>$val['default'],
					"comment"=>$val['name']
				);
				$field = $val['field'];
				$check_field = $object->checkField($table,$field);//查看字段是否存在
				if($check_field){
					$object->editField($table,$info);
				}else{//未创建
					$object->addField($table,$info);
				}
			}
		}else{//未创建
			$object->createTable($table);//创建表
		}
    }
    public function get_table(){
    	$table = $this->distinct(true)->field("table")->select();
    	$where["table"] = 1;
    	foreach ($table as $key => $value) {
    		$where["model"] = $value["table"];
    		$name = M("Menu")->where($where)->getField("name");
    		if(!empty($name)){
    			$table[$key]["name"] = $name;
    		}else{
    			unset($table[$key]);
    		}
    	}
    	return $table;
    }
	//删除表字段
	public function del_table($table,$field){
		import("Admin.Util.MysqlManage");//加载处理表的类
		$object = new \MysqlManage();
		$table = C('DB_PREFIX').$table;
		$check_field = $object->checkField($table,$field);//查看字段是否存在
		$check_field && $object -> dropField($table,$field);
	}
}