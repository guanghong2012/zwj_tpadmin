<?php
namespace Common\Model;
use Think\Model;
class ConfModel extends Model
{

    /**
     * 获取配置信息写入缓存
     */
    public function setting_cache() {
		$setting = array();
        $res = $this->getField("name,value");
        foreach ($res as $key=>$val) {
            $setting[$key] = unserialize($val) ? unserialize($val) : $val;
        }
        F('setting', $setting);
        return $setting;
    }

    /**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('setting', NULL);
    }
}