<?php
namespace Common\Model;
use Think\Model;
class PublicModel extends Model
{

	public function __construct($name='',$tablePrefix='',$connection=''){
		parent::__construct($name,$tablePrefix,$connection);
		//自动验证 _validate
		/*$_validate array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),*/
		//自动验证
		/*$_auto array(完成字段1,完成规则,[完成条件,附加规则])*/
		$mod = M('table');
		$lists = $mod -> where(array("table"=>$this->name))->order('sort asc')->select();
		foreach ($lists as $key => $val) {
			//非空验证
			if($val["notempty"] == 1){

				$_validate[] = array($val['field'],'require',$val["name"].'必须！',1,'',1);

			}
			//唯一验证
			if($val["only"] == 1 && $val["notempty"] == 1){
				
				$_validate[] = array($val['field'],'',$val["name"].'已经存在！',1,'unique',1);

			}

			if($val["type"] == 2){//整数验证
				
				$_validate[] = array($val['field'],'number',$val["name"].'为整数！');
			
			}elseif($val["type"] == 3){//密码验证
				
				$_validate[] = array($val['field'],'6,20',$val["name"].'密码长度为6-20位！',0,'length');
				$_auto[] = array($val['field'],'md5',3,'function');//自动给密码加密
			
			}elseif($val["type"] == 10 || $val["type"] == 11){//复选自动填充

				$_auto[] = array($val['field'],'CheckBox',3,'function');

			}elseif($val["type"] == 12 && $val["notempty"] == 1){//手机验证
				
				$_validate[] = array($val['field'],'/^1[3|5|7|8|][0-9]{9}$/',$val["name"].'格式不正确！',0,'regex');

			}elseif($val["type"] == 13 && $val["notempty"] == 1){//邮箱验证
				
				$_validate[] = array($val['field'],'email',$val["name"].'为邮箱！');

			}elseif($val["type"] == 14){
				
				$_validate[] = array($val['field'],'currency',$val["name"].'输入不正确！');

			}elseif($val["type"] == 15){

				$_auto[] = array($val['field'],'strtotime',3,'function');//把时间格式转成时间戳

			}
			if($val["hide"] == 1){
				if($val["type"] == 15){
					$_auto[] = array($val['field'],date("Y-m-d H:i:s"));
				}else{
					$_auto[] = array($val['field'],$val['default']);
				}
			}

		}

		$this->_validate = $_validate;
		$this->_auto = $_auto;
	}

	//数据查询
	public function _select(){
		$resultSet = $this->select();
		
		$mod = M('table');
		$table = $this->name;
		$lists = $mod -> where(array("table"=>$table))->order('sort asc')->select();
		foreach ($lists as $key => $val) {
			if(in_array($val['type'], array(7,9,10))){
				$dd = explode("|", $val['data']);
				$da = array();
				foreach ($dd as $k => $v) {
					$ddd = explode("=", $v);
					$da[$ddd[0]] = $ddd[1];
				}
				$fields = $val['field'];
				$$fields = $da;
			}elseif(in_array($val['type'], array(8,11))){
				
				$dd = explode("|", $val['data']);

				$da = M($dd[0])->getField("id,".$dd[1]);

				$fields = $val['field'];
				$$fields = $da;
			
			}elseif($val['type'] == 14){
				$fields = $val['field'];
				$$fields = "price";
			}elseif($val['type'] == 15){
				$fields = $val['field'];
				$$fields = "date";
			}
		}

		foreach ($resultSet as $key => $val) {
			foreach ($val as $k => $v) {
				$kk = $$k;
				if(is_array($kk)){
					$val[$k] =  $kk[$v];
				}elseif($kk == "price"){
					$val[$k] = format_price($v);
				}elseif($kk == "date"){
					$val[$k] = to_date($v);
				}
			}
			$resultSet[$key] = $val;
		}

		return $resultSet;
	}
    //删除前调用
    public function _before_delete($options){

    }
    //删除后调用
    public function _after_delete($data,$options){
    	$table = $this->name;//执行删除的表不带前缀
    	$map["data"] = array("like",$table."|%");
    	$list = M("table")->where($map)->select();
    	foreach ($list as $key => $val){
    		//删除所有关联数据
    		$where[$val['field']] = $options["where"]["id"];
    		D($val["table"])->where($where)->delete();
    	}
    }
}