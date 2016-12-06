<?php
namespace Common\Model;
use Think\Model;
class RecordModel extends PublicModel
{
	public function _after_insert($data,$options){
		
		$user = M("User");
		
		if($data["type"] == 1){
			$value = "money";//余额处理
		}else{
			$value = "integral";//积分处理
		}
		if($data["status"] == 0){
			$user->where("id = %d",$data["user_id"])->setDec($value,$data["price"]);
		}else{
			$user->where("id = %d",$data["user_id"])->setInc($value,$data["price"]);
		}
		
	}
	/**
     * 新增记录
     * @access public
     * @param mixed $data 数据
     * @return mixed
     */
	public function record($data=''){
		
		if(empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if(!empty($this->data)) {
                $data           =   $this->data;
                // 重置数据
                $this->data     = array();
            }else{
                $this->error    = L('_DATA_TYPE_INVALID_');
                return false;
            }
        }else{
        	$this->data = $data;
        }
        $data = $this->create($data);
        $result = $this->add($data);//调用新增记录
        return $result;
	}
}