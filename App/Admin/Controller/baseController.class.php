<?php
/**
 * 控制器基类
 *
 * @author andery
 */
namespace Admin\Controller;
use Think\Controller;

class baseController extends Controller
{
    protected function _initialize() {
        //消除所有的magic_quotes_gpc转义
        //Input::noGPC();
        //初始化网站配置
        if (false === $setting = F('setting')) {
           $setting = D('conf')->setting_cache();
        }
        C($setting);

    }
    
    public function _empty() {
        $this->_404();
    }
    
    protected function _404($url = '') {
        if ($url) {
            redirect($url);
        } else {
            send_http_status(404);
            $this->display(TMPL_PATH . '404.html');
            exit;
        }
    }

    /**
     * 上传文件默认规则定义
     */
    protected function _upload_init($upload) {
        $allow_max = C('IMG_SIXE'); //读取配置
        $allow_exts = explode(',', C('IMG_TYPE')); //读取配置
        $allow_max && $upload->maxSize = $allow_max;   //文件大小限制
        C('IMG_TYPE') && $upload->exts = $allow_exts;  //文件类型限制
        $upload->saveRule = 'uniqid';
        return $upload;
    }

    /**
     * 上传文件
     */
    protected function _upload($file, $dir = '',$water=true,$save_rule='uniqid') {
        $upload = new \Think\Upload();
        if ($dir) {
            $upload_path = $dir . '/';
            $upload->savePath = $upload_path;
        }
       
        //自定义上传规则
        //$upload = $this->_upload_init($upload);
        if( $save_rule!='uniqid' ){
            $upload->saveRule = $save_rule;
        }

        if ($result = $upload->uploadOne($file)) {
			if($water){
                $img_file = './Uploads/'.$result['savepath'].$result['savename'];
                $this->_images($img_file);//给上传的图片生成缩略图和加水印
            }
            return array('error'=>0, 'info'=>$result['savepath'].$result['savename']);
        } else {
            return array('error'=>1, 'info'=>$upload->getError());
        }
    }
    /**
     * 图像处理
     */
    public function _images($img){
        
        $image = new \Think\Image();
        $image->open($img);
        $imgs = explode('/', $img);
        $images = $imgs[count($imgs)-1];
        $img_file='';//图片原路径
        for ($i=0; $i < count($imgs) - 1; $i++) { 
           $img_file .= $imgs[$i].'/';
        }
        $imgs_name = explode('.', $images);
        $thumb = C('THUMB');
        if($thumb){//是否开启缩略图
            $thumb_width =  C('THUMB_WIDTH');//缩略图 长
            $thumb_height =  C('THUMB_HEIGHT');//缩略图 高
            $Image_thumb =  C('THUMB_TYPE')?C('THUMB_TYPE'):1;//1.等比例缩放类型 2.缩放后填充类型 3.居中裁剪类型 4.左上角裁剪类型  5.右下角裁剪类型 6.固定尺寸缩放类型
            $thumb_img = $imgs_name[0]."_thumb.".$imgs_name[1];//缩略图片
			if($image->width() > $thumb_width || $image->height() > $thumb_height){
                $image->thumb($thumb_width, $thumb_height,$Image_thumb)->save($img_file.$thumb_img);
            }
            
        }
        
        $water =  C('WATER');
        if($water){//是否开启水印
            $water_position = C('WATER_POSITION');//水印位置 1.左上角水印 2.上居中水印 3.右上角水印 4.左居中水印 5.居中水印 6.右居中水印 7.左下角水印 8.下居中水印 9.右下角水印
            $water_alpha = C('WATER_ALPHA');//水印透明度
            $water_img = $imgs_name[0]."_water.".$imgs_name[1];//水印图片

            $logo = './Uploads/'.C('WATER_IMG');//水印图片
            if(is_file($logo))
            $image->water($logo,$water_position,50)->save($img_file.$water_img); 
        }
    }

    /**
     * AJAX返回数据标准
     *
     * @param int $status
     * @param string $msg
     * @param mixed $data
     * @param string $dialog
     */
    protected function ajaxReturn($status=1, $msg='', $data='', $dialog='') {
        parent::ajaxReturn(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'dialog' => $dialog,
        ));
    }
	//邮件发送
	public function sendMail($to, $title, $content){
		vendor('PHPMailer.class#phpmailer');
		$mail = new \PHPMailer(); //实例化
		$mail->IsSMTP(); // 启用SMTP
		$mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
		$mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
		$mail->Username = C('MAIL_USERNAME'); //你的邮箱名
		$mail->Password = C('MAIL_PASSWORD'); //邮箱密码
		$mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
		$mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
		$mail->AddAddress($to,"尊敬的客户");
		$mail->WordWrap = 50; //设置每行字符长度
		$mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
		$mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
		$mail->Subject =$title; //邮件主题
		$mail->Body = $content; //邮件内容
		$mail->AltBody = C('SITE_NAME'); //邮件正文不支持HTML的备用显示
		return($mail->Send());
	}
}