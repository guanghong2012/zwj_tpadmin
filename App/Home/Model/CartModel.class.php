<?php
namespace Home\Model;
use Think\Model;
class CartModel extends \Common\Model\PublicModel
{
    // 商品表名称
    protected $goodsname             =   'goods';

    public function __construct($name='',$tablePrefix='',$connection=''){
        parent::__construct($name,$tablePrefix,$connection);
        //登陆中的用户
        if(!isset($_SESSION['cart'])){
            $cartlist = $this->where("user_id  = %d",3)->select();
            foreach ($cartlist as $key => $val) {
                $_SESSION['cart'][$val['goods_id']] = $val;
            }
        }
    }

    /*
    添加商品
    param int $id 商品主键
          string $name 商品名称
          float $price 商品价格
          int $num 购物数量
    */
    public  function addItem($id,$num) {
        //如果该商品已存在则直接加其数量
        if (isset($_SESSION['cart'][$id])) {
            $this->incNum($id,$num);
            return;
        }
        $item = array();
        $item['goods_id'] = $id;
        $item['user_id'] = session("login_user.id");
        $item['price'] = M($this->goodsname)->where("id = %d",$id)->getField("price");
        $item['num'] = $num;
        if($item['id'] = $this->add($item)){

            $_SESSION['cart'][$id] = $item;
            return true;
        }
        else{
            return false;
        }
    }

    /*
    修改购物车中的商品数量
    int $id 商品主键
    int $num 某商品修改后的数量，即直接把某商品
    的数量改为$num
    */
    public function modNum($id,$num=1) {
        if(!$num) $num = 1;
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        if($this->where("id = %d",$id)->setField("num",$num)){
            $_SESSION['cart'][$id]['num'] = $num;
            return true;
        }else{
            return false;
        }

    }

    /*
    商品数量+1
    */
    public function incNum($id,$num=1) {
        if (isset($_SESSION['cart'][$id])) {
            if($this->where("id = %d",$id)->setInc("num",$num)){
                $_SESSION['cart'][$id]['num'] += $num;
                return true;
            }else{
                return false;
            }
        }
    }

    /*
    商品数量-1
    */
    public function decNum($id,$num=1) {
        if (isset($_SESSION['cart'][$id])) {
            if($this->where("id = %d",$id)->setDec("num",$num)){
                $_SESSION['cart'][$id]['num'] -= $num;
                return true;
            }else{
                return false;
            }
        }

        //如果减少后，数量为0，则把这个商品删掉
        if ($_SESSION['cart'][$id]['num'] < 1) {
            $this->delItem($id);
        }
    }

    /*
    删除商品
    */
    public function delItem($id) {
        $this->where("id = %d",$id)->delete();
        unset($_SESSION['cart'][$id]);
    }
    
    /*
    获取单个商品
    */
    public function getItem($id) {
        return $_SESSION['cart'][$id];
    }

    /*
    查询购物车中商品的种类
    */
    public function getCnt() {
        return count($_SESSION['cart']);
    }
    
    /*
    查询购物车中商品的个数
    */
    public function getNum(){
        if ($this->getCnt() == 0) {
            //种数为0，个数也为0
            return 0;
        }

        $sum = 0;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $sum += $item['num'];
        }
        return $sum;
    }

    /*
    购物车中商品的总金额
    */
    public function getPrice($data = array()) {
        //数量为0，价钱为0
        if ($this->getCnt() == 0) {
            return 0;
        }
        $price = 0.00;
        empty($data) && $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $price += $item['num'] * $item['price'];
        }
        return sprintf("%01.2f", $price);
    }

    /*
    清空购物车
    */
    public function clear() {
        $this->where("user_id = %d",session("login_user.id"))->delete();
        $_SESSION['cart'] = array();
    }

}