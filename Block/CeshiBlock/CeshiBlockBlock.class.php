<?php

namespace Block\CeshiBlock;
use Common\Controller\Block;

/**
 * 测试模块插件
 * @author 
 */

    class CeshiBlockBlock extends Block{

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的FirstHook钩子方法
        public function FirstHook($param){

            $this->_data("CeshiBlock");

            $this->display("CeshiBlock");
        }

    }