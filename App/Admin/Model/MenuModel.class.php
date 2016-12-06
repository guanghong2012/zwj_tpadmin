<?php
namespace Admin\Model;
use Think\Model;
class MenuModel extends Model
{
	/**
     * 删除菜单也删除关联关系
     */
    protected function _after_delete($data, $options) {
        M('table')->where(array('table'=>strtolower($data['model'])))->delete();
		M('operate')->where(array('table'=>strtolower($data['model'])))->delete();
    }

}