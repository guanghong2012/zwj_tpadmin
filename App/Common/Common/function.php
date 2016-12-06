<?php

header("Content-type: text/html; charset=utf-8");

const ZWJ_VERSION    = '1.0';
const ZWJ_BLOCK_PATH = './Block/';

include_once 'pinyin.php';
function curl_get($url){
	$binfo =array('Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; InfoPath.2; AskTbPTV/5.17.0.25589; Alexa Toolbar)','Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET4.0C; Alexa Toolbar)','Mozilla/4.0(compatible; MSIE 6.0; Windows NT 5.1; SV1)',$_SERVER['HTTP_USER_AGENT']);
	$cip = '218.242.124.'.mt_rand(0,254);
	$xip = '218.242.124.'.mt_rand(0,254);
	$header = array('CLIENT-IP:'.$cip, 'X-FORWARDED-FOR:'.$xip);
	
	$ch=curl_init();
	$timeout=5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt ($ch, CURLOPT_USERAGENT, $binfo[mt_rand(0,3)]);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}

//获取内容
function get_sub_content($str, $start, $end,$a=0,$b=1){
	if ( $start == '' || $end == '' ){
		return;
	}
	$str = explode($start, $str);
	@$str = explode($end, $str[$a]);
	return $str[$b];
}

//过滤特殊字符
function rp($f_str)
{
	
	$f_str = preg_replace("/and/i","&#97;nd",$f_str);
	$f_str = preg_replace("/execute/i","&#101;xecute",$f_str);
	$f_str = preg_replace("/update/i","&#117;pdate",$f_str);
	$f_str = preg_replace("/count/i","&#99;ount",$f_str);
	$f_str = preg_replace("/chr/i","&#99;hr",$f_str);
	$f_str = preg_replace("/mid/i","&#109;id",$f_str);
	$f_str = preg_replace("/master/i","&#109;aster",$f_str);
	$f_str = preg_replace("/truncate/i","&#116;runcate",$f_str);
	$f_str = preg_replace("/char/i","&#99;har",$f_str);
	$f_str = preg_replace("/declare/i","&#100;eclare",$f_str);
	$f_str = preg_replace("/select/i","&#115;elect",$f_str);
	$f_str = preg_replace("/create/i","&#99;reate",$f_str);
	$f_str = preg_replace("/delete/i","&#100;elete",$f_str);
	$f_str = preg_replace("/insert/i","&#105;nsert",$f_str);
	$f_str = stripcslashes($f_str);		//防止单引号双号引被转义
	$f_str = str_replace('<','&lt;',$f_str);
	$f_str = str_replace(">",'&gt;',$f_str);
	$f_str = str_replace('\'','&#39;',$f_str);
	$f_str = str_replace('"','&quot;',$f_str);
	$f_str = str_replace('　','　',$f_str);
	$f_str = trim($f_str);
   //echo $f_str;
   return $f_str;
}

//过滤特殊字符
function rp_1($f_str)
{
	
	//$f_str = htmlentities($f_str,ENT_QUOTES);
	/*
	$f_str = str_replace("and","&#97;nd",$f_str);
	$f_str = str_replace("execute","&#101;xecute",$f_str);
	$f_str = str_replace("update","&#117;pdate",$f_str);
	$f_str = str_replace("count","&#99;ount",$f_str);
	$f_str = str_replace("chr","&#99;hr",$f_str);
	$f_str = str_replace("mid","&#109;id",$f_str);
	$f_str = str_replace("master","&#109;aster",$f_str);
	$f_str = str_replace("truncate","&#116;runcate",$f_str);
	$f_str = str_replace("char","&#99;har",$f_str);
	$f_str = str_replace("declare","&#100;eclare",$f_str);
	$f_str = str_replace("select","&#115;elect",$f_str);
	$f_str = str_replace("create","&#99;reate",$f_str);
	$f_str = str_replace("delete","&#100;elete",$f_str);
	$f_str = str_replace("insert","&#105;nsert",$f_str);
	*/
	$f_str = preg_replace("/and/i","&#97;nd",$f_str);
	$f_str = preg_replace("/execute/i","&#101;xecute",$f_str);
	$f_str = preg_replace("/update/i","&#117;pdate",$f_str);
	$f_str = preg_replace("/count/i","&#99;ount",$f_str);
	$f_str = preg_replace("/chr/i","&#99;hr",$f_str);
	$f_str = preg_replace("/mid/i","&#109;id",$f_str);
	$f_str = preg_replace("/master/i","&#109;aster",$f_str);
	$f_str = preg_replace("/truncate/i","&#116;runcate",$f_str);
	$f_str = preg_replace("/char/i","&#99;har",$f_str);
	$f_str = preg_replace("/declare/i","&#100;eclare",$f_str);
	$f_str = preg_replace("/select/i","&#115;elect",$f_str);
	$f_str = preg_replace("/create/i","&#99;reate",$f_str);
	$f_str = preg_replace("/delete/i","&#100;elete",$f_str);
	$f_str = preg_replace("/insert/i","&#105;nsert",$f_str);
	$f_str = str_replace('<','&lt;',$f_str);
	$f_str = str_replace(">",'&gt;',$f_str);
	$f_str = str_replace('\'','&#39;',$f_str);
	$f_str = str_replace('"','&quot;',$f_str);
   //echo $f_str;
   return $f_str;
}

//显示特殊字符
function show_rp($f_str)
{
	$f_str = str_replace('&#97;nd','and',$f_str);
	$f_str = str_replace('&#101;xecute','execute',$f_str);
	$f_str = str_replace('&#117;pdate','update',$f_str);
	$f_str = str_replace('&#99;ount','count',$f_str);
	$f_str = str_replace('&#99;hr','chr',$f_str);
	$f_str = str_replace('&#109;id','mid',$f_str);
	$f_str = str_replace('&#109;aster','master',$f_str);
	$f_str = str_replace('&#116;runcate','truncate',$f_str);
	$f_str = str_replace('&#99;har','char',$f_str);
	$f_str = str_replace('&#100;eclare','declare',$f_str);
	$f_str = str_replace('&#115;elect','select',$f_str);
	$f_str = str_replace('&#99;reate','create',$f_str);
	$f_str = str_replace('&#100;elete','delete',$f_str);
	$f_str = str_replace('&#105;nsert','nsert',$f_str);
	$f_str = str_replace('&lt;','<',$f_str);
	$f_str = str_replace('&gt;','>',$f_str);
	$f_str = str_replace('&#39;','\'',$f_str);
	$f_str = str_replace('&quot;','"',$f_str);
	$f_str = trim($f_str);
    return $f_str;
}

function str_to_lower_num($f_value) {
	$f_value1 = array('０','１','２','３','４','５','６','７','８','９','Ａ','Ｂ','Ｃ','Ｄ','Ｅ','Ｆ','Ｇ','Ｈ','Ｉ','Ｊ','Ｋ','Ｌ','Ｍ','Ｎ','Ｏ','Ｐ','Ｑ','Ｒ','Ｓ','Ｔ','Ｕ','Ｖ','Ｗ','Ｘ','Ｙ','Ｚ');
	$f_value2 = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$f_len = count($f_value1);
		for ($f_i = 0; $f_i < $f_len; $f_i++)
		{
		$f_value = str_replace($f_value1[$f_i],$f_value2[$f_i],$f_value);
		}
	$f_value = strtolower($f_value);
	$l_value = $f_value;
	return $l_value;
}

//跳转
function go_to($f_show_id,$f_value){
	switch ($f_show_id)
	{
	case 1:
	  echo '<script language="javascript">window.history.go(-1);</script>';
	  break;
	case 2:
	  echo '<script language="javascript">window.history.go(-2);</script>';
	  break; 
	case 3:
	  echo '<script language="javascript">window.close();</script>';
	  break;
	case 4:
	  echo '<script language="javascript">window.self.location="'.$f_value.'";</script>';
	  break;
	default:
	}
	exit();
}

//过滤html代码
function RemoveHTML($document)
{
	$document = trim($document);
	if (strlen($document) <= 0)
	{
	   return $document;
	}
	$search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
					  "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
					  "'([\r\n])[\s]+'",                // 去掉空白字符
					  "'&(quot|#34);'i",                // 替换 HTML 实体
					  "'&(amp|#38);'i",
					  "'&(lt|#60);'i",
					  "'&(gt|#62);'i",
					  "'&(nbsp|#160);'i"
					  );                    // 作为 PHP 代码运行

	$replace = array ("",
					   "",
					   "\\1",
					   "\"",
					   "&",
					   "<",
					   ">",
					   " "
					   );
	return @preg_replace ($search, $replace, $document);
}

//显示信息
function show_msg($f_msg_value,$f_go_to,$f_go_to_url) {
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	if (!$f_go_to) $f_go_to=0;
	echo '<script language="javascript">';
	if ($f_msg_value) echo 'alert("'.$f_msg_value.'");';
	if ($f_go_to == 1) echo 'window.history.go(-1);';
	if ($f_go_to == 2) echo 'window.history.go(-2);';
	if ($f_go_to == 3) echo 'window.close();';
	if ($f_go_to == 4) echo 'window.self.location="'.$f_go_to_url.'";';
	echo '</script>';
	exit();
}

//二维数组排序
function array_sort($arr,$keys,$type='asc'){ 
	if(empty($arr)) return $arr;
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array; 
} 

function del_html($html){//20150122
	$html =  preg_replace("/&nbsp;/",' ',$html);//将HTML的&nbsp;替换成空格键
	$html =  preg_replace("/<br \/>/","\r\n",$html);
	$html = strip_tags($html);//过虑掉HTML代码
	return $html;
}
//删除文件和文件夹
function deldir($dir) {
  //先删除目录下的文件：
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }
  closedir($dh);
  //删除当前文件夹：
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}



//清除整个文件夹下的文件  $path 文件夹路径 例如：public/runtime/admin/Cache/
function clear_dir_file($path)
{
   if ( $dir = opendir( $path ) )
   {
		while ( $file = readdir( $dir ) )
		{
			$check = is_dir( $path. $file );
			if ( !$check )
			{
				@unlink( $path . $file );                       
			}
			else 
			{
				if($file!='.'&&$file!='..')
				{
					clear_dir_file($path.$file."/");              			       		
				} 
			 }           
		}
		closedir( $dir );
		rmdir($path);
		return true;
   }
}

//过滤SQL注入
function filter_injection(&$request)
{
	$pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])/i";
	foreach($request as $k=>$v)
	{
		if(preg_match($pattern,$k,$match))
		{
			die("SQL Injection denied!");
		}

		if(is_array($v))
		{					
			filter_injection($v);
		}
		else
		{					
			if(preg_match($pattern,$v,$match))
			{
				die("SQL Injection denied!");
			}					
		}
	}
}
//过滤请求
function filter_request(&$request)
{
	if(MAGIC_QUOTES_GPC)
	{
		foreach($request as $k=>$v)
		{
			if(is_array($v))
			{
				filter_request($v);
			}
			else
			{
				$request[$k] = stripslashes(trim($v));
			}
		}
	}
}
////mysql_real_escape_string() 函数转义 SQL 语句中使用的字符串中的特殊字符。
function quotes($content)
{
	//if $content is an array
	if (is_array($content))
	{
		foreach ($content as $key=>$value)
		{
			$content[$key] = mysql_real_escape_string($value);
		}
	} else
	{
		//if $content is not an array
		mysql_real_escape_string($content);
	}
	return $content;
}
//request转码
function convert_req(&$req)
{
	foreach($req as $k=>$v)
	{
		if(is_array($v))
		{
			convert_req($req[$k]);
		}
		else
		{
			if(!is_u8($v))
			{
				$req[$k] = iconv("gbk","utf-8",$v);
			}
		}
	}
}

function is_u8($string)
{
	return preg_match('%^(?:
		 [\x09\x0A\x0D\x20-\x7E]            # ASCII
	   | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
	   |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	   | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
	   |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	   |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
	   | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	   |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
   )*$%xs', $string);
}

function unicode_encode($name) {//to Unicode
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for($i = 0; $i < $len - 1; $i = $i + 2) {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0) {// 两个字节的字
            $cn_word = '\\'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
            $str .= strtoupper($cn_word);
        } else {
            $str .= $c2;
        }
    }
    return $str;
}

function unicode_decode($name) {//Unicode to
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches)) {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++) {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0) {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            } else {
                $name .= $str;
            }
        }
    }
    return $name;
}

//utf8 字符串截取
function msubstr($str, $start=0, $length=15, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr"))
    {
        $slice =  mb_substr($str, $start, $length, $charset);
        if($suffix&$slice!=$str) return $slice."…";
    	return $slice;
    }
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix&&$slice!=$str) return $slice."…";
    return $slice;
}
//验证手机号码
function check_mobile($mobile)
{
	if(!empty($mobile) && !preg_match("/^1[3|5|7|8|][0-9]{9}$/",$mobile))
	{
		return false;
	}
	else
	return true;
}

//邮件格式验证的函数
function check_email($email)
{
	if(!preg_match("/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/",$email))
	{
		return false;
	}
	else
	return true;
}
//跳转
function app_redirect($url,$time=0,$msg='')
{
    //多行URL地址支持
    $url = str_replace(array("\n", "\r"), '', $url);    
    if(empty($msg))
        $msg    =   "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if(0===$time) {
        	if(substr($url,0,1)=="/")
        	{        		
        		header("Location:".get_domain().$url);
        	}
        	else
        	{
        		header("Location:".$url);
        	}
            
        }else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    }else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if($time!=0)
            $str   .=   $msg;
        exit($str);
    }
}

/**
 * 验证访问IP的有效性
 * @param ip地址 $ip_str
 * @param 访问页面 $module
 * @param 时间间隔 $time_span
 * @param 数据ID $id
 */
function check_ipop_limit($ip_str,$module,$time_span=0,$id=0)
{
	
	$op = session($module."_".$id."_ip");
	if(empty($op))
	{
		$check['ip']	=	 get_client_ip();
		$check['time']	=	time();
		session($module."_".$id."_ip",$check);    		
		return true;  //不存在session时验证通过
	}
	else 
	{   
		$check['ip']	=	 get_client_ip();
		$check['time']	=	time();    
		$origin	=	session($module."_".$id."_ip");
		
		if($check['ip']==$origin['ip'])
		{
			if($check['time'] - $origin['time'] < $time_span)
			{
				return false;
			}
			else 
			{
				session($module."_".$id."_ip",$check);
				return true;  //不存在session时验证通过    				
			}
		}
		else 
		{
			session($module."_".$id."_ip",$check);
			return true;  //不存在session时验证通过
		}
	}
}



/**
 * utf8字符转Unicode字符
 * @param string $char 要转换的单字符
 * @return void
 */
function utf8_to_unicode($char)
{
	switch(strlen($char))
	{
		case 1:
			return ord($char);
		case 2:
			$n = (ord($char[0]) & 0x3f) << 6;
			$n += ord($char[1]) & 0x3f;
			return $n;
		case 3:
			$n = (ord($char[0]) & 0x1f) << 12;
			$n += (ord($char[1]) & 0x3f) << 6;
			$n += ord($char[2]) & 0x3f;
			return $n;
		case 4:
			$n = (ord($char[0]) & 0x0f) << 18;
			$n += (ord($char[1]) & 0x3f) << 12;
			$n += (ord($char[2]) & 0x3f) << 6;
			$n += ord($char[3]) & 0x3f;
			return $n;
	}
}
/**
 * utf8字符串分隔为unicode字符串
 * @param string $str 要转换的字符串
 * @param string $depart 分隔,默认为空格为单字
 * @return string
 */
function str_to_unicode_word($str,$depart=' ')
{
	$arr = array();
	$str_len = mb_strlen($str,'utf-8');
	for($i = 0;$i < $str_len;$i++)
	{
		$s = mb_substr($str,$i,1,'utf-8');
		if($s != ' ' && $s != '　')
		{
			$arr[] = 'ux'.utf8_to_unicode($s);
		}
	}
	return implode($depart,$arr);
}

/**
 * utf8字符串分隔为unicode字符串
 * @param string $str 要转换的字符串
 * @return string
 */
function str_to_unicode_string($str)
{
	$string = str_to_unicode_word($str,'');
	return $string;
}

//分词
function div_str($str)
{
	require_once APP_ROOT_PATH."system/libs/words.php";
	$words = words::segment($str);
	$words[] = $str;	
	return $words;
}
//金钱
function format_price($v)
{
	return "¥".number_format($v,2);
}
function strim($str)
{
	return quotes(htmlspecialchars(trim($str)));
}
function btrim($str)
{
	return quotes(trim($str));
}
//过滤HTML标签
function valid_tag($str)
{
	return preg_replace("/<(?!div|ol|ul|li|sup|sub|span|br|img|p|h1|h2|h3|h4|h5|h6|\/div|\/ol|\/ul|\/li|\/sup|\/sub|\/span|\/br|\/img|\/p|\/h1|\/h2|\/h3|\/h4|\/h5|\/h6|blockquote|\/blockquote|strike|\/strike|b|\/b|i|\/i|u|\/u)[^>]*>/i","",$str);
}
//分页中间部分
function multipage($page,$count,$url){
	$multipage = '';
	if($page == 1){
		$multipage .= '<div class="pageoff"><a>上一页</a></div>';
	}else{
		$multipage .= '<div class="pageoff"><a href="'.$url.($page-1).'">上一页</a></div>';
	}
	$page_num = 2;//要显示的条数
	$page_begin = $page - $page_num;//开始页
	$page_end = $page + $page_num;//结束页

	if ($page_end - $page_begin < $page_num)
	{
		$page_begin = $page - ($page_num);
		
		$page_end = $page + ($page_num);
		
	}
	if ($page_begin < 1){
		$page_end = $page_end - $page_begin;
		$page_begin = 1;
	}else{
		$multipage .= '<div class="pageoff"><a href="?'.$url.'&p=1">1</a></div>';
		$multipage .= '<div class="pageetc">...</div>';
	}
	if ($page_end > $count) $page_end = $count;

	for($i=$page_begin;$i<=$page_end;$i++){
		if($i == $page){
			$multipage .= '<div class="pageon">'.$i.'</div>';
		}else{
			$multipage .= '<div class="pageoff"><a href="'.$url.$i.'">'.$i.'</a></div>';
		}
	}
	if($count > $page_end){
		$multipage .= '<div class="pageetc">...</div>';
		$multipage .= '<div class="pageoff"><a href="'.$url.$count.'">'.$count.'</a></div>';
	}
	if($count == $page){
		$multipage .= '<div class="pageoff"><a>下一页</a>';
	}else{
		$multipage .= '<div class="pageoff"><a href="'.$url.($page+1).'">下一页</a>';
	}
	echo $multipage;
}

function to_date($utc_time, $format = 'Y-m-d H:i:s') {
	if (empty ( $utc_time )) {
		return '';
	}
	$timezone = intval(C('TIME_ZONE'));
	$time = $utc_time + $timezone * 3600; 
	return date ($format, $time );
}

//获取缩略图文件路径
function get_img_file($file,$name = '_water'){
	$imgs = explode('/', $file);
    $images = $imgs[count($imgs)-1];
    $img_file='';//图片原路径
    for ($i=0; $i < count($imgs) - 1; $i++) { 
       $img_file .= $imgs[$i].'/';
    }
    $imgs_name = explode('.', $images);
    $name = $imgs_name[0].$name.'.'.$imgs_name[1];
    return $img_file.$name;
}

//根据图片ID返回图片路径
function image($id){
	$file = M("Image")->where("id =".$id)->getField("file");
	return $file;
}

//复选框处理，多个值已逗号分格
function CheckBox($data){
	return implode(",", $data);
}

//获取文件目录列表,该方法返回数组
function getDir($dir) {
    $dirArray[]=NULL;
    if (false != ($handle = opendir ( $dir ))) {
        $i=0;
        while ( false !== ($file = readdir ( $handle )) ) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            if ($file != "." && $file != ".."&&!strpos($file,".")) {
                $dirArray[$i]=$file;
                $i++;
            }
        }
        //关闭句柄
        closedir ( $handle );
    }
    return $dirArray;
}
 
//获取文件列表
function getFile($dir) {
    $fileArray[]=NULL;
    if (false != ($handle = opendir ( $dir ))) {
        $i=0;
        while ( false !== ($file = readdir ( $handle )) ) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            if ($file != "." && $file != ".."&&strpos($file,".")) {
                $fileArray[$i]= $file;
                if($i==100){
                    break;
                }
                $i++;
            }
        }
        //关闭句柄
        closedir ( $handle );
    }
    return $fileArray;
}
/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_encrypt($data, $key = '', $expire = 0) {
    $key  = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data = base64_encode($data);
    $x    = 0;
    $len  = strlen($data);
    $l    = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time():0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
    }
    return str_replace(array('+','/','='),array('-','_',''),base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key  加密密钥
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_decrypt($data, $key = ''){
    $key    = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data   = str_replace(array('-','_'),array('+','/'),$data);
    $mod4   = strlen($data) % 4;
    if ($mod4) {
       $data .= substr('====', $mod4);
    }
    $data   = base64_decode($data);
    $expire = substr($data,0,10);
    $data   = substr($data,10);

    if($expire > 0 && $expire < time()) {
        return '';
    }
    $x      = 0;
    $len    = strlen($data);
    $l      = strlen($key);
    $char   = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

/**
 * 处理插件钩子
 * @param string $hook   钩子名称
 * @param mixed $params 传入参数
 * @return void
 */
function hook($hook,$params=array()){
    \Think\Hook::listen($hook,$params);
}
/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_block_class($name){
    $class = "Block\\{$name}\\{$name}Block";
    return $class;
}
/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_addon_class($name){
    $class = "Addons\\{$name}\\{$name}Addon";
    return $class;
}
/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function str2arr($str, $glue = ','){
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function arr2str($arr, $glue = ','){
    return implode($glue, $arr);
}

/**
* @param $expTitle 导出Excel标题
* @param $expCellName 导出字段标题
*		格式
*		array(
*			array('id','账号序列'),
*			array('account','登录账户'),
*			array('nickname','账户昵称'),
*			array('字段名','字段标题')
*		);
* @param $expTableData 导出数据 二维数据
*/
//导出Excel
function exportExcel($expTitle,$expCellName,$expTableData){
    
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = date('YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);

    if($cellNum < 1 || $dataNum < 1){
    	return false;
    }

    vendor("PHPExcel.PHPExcel");
		vendor("PHPExcel.PHPExcel.IOFactory");
		$objPHPExcel = new \PHPExcel();
		$IOFactory = new \PHPExcel_IOFactory();

    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    
    $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  

    for($i=0;$i<$cellNum;$i++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
    } 
    // Miscellaneous glyphs, UTF-8   
    for($i=0;$i<$dataNum;$i++){
      for($j=0;$j<$cellNum;$j++){
        $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
      }             
    }  
    ob_end_clean();//清除缓冲区
    header('pragma:public');
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Pragma: no-cache");
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = $IOFactory::createWriter($objPHPExcel, 'Excel5');  
    $objWriter->save('php://output'); 
    exit;
}
/**
*	@param $_FILES 上传文件 name 要为 import
*   @return array
*/
//批量导入Ecxel
function importExcel($file){
	
	if (!empty($file)) {
		
		$upload = new \Think\Upload();
		$upload->exts = array('xlsx','xls');
		$upload_path = 'xls/';
		$upload->savePath = $upload_path;
		$upload->saveRule = "uniqid";
		
		$result = $upload->uploadOne($file["import"]);

		vendor("PHPExcel.PHPExcel");

		if($result["ext"] == "xlsx"){
			//如果excel文件后缀名为.xlsx，导入这下类
			vendor("PHPExcel.PHPExcel.Reader.Excel2007");
			$PHPReader=new \PHPExcel_Reader_Excel2007();

		}else{
			vendor("PHPExcel.PHPExcel.Reader.Excel5");
			$PHPReader=new \PHPExcel_Reader_Excel5();
		}
		$file_name = "Uploads/".$result['savepath'].$result['savename'];
		//载入文件
		$PHPExcel=$PHPReader->load($file_name);
		//获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
		$currentSheet=$PHPExcel->getSheet(0);
		//获取总列数
		$allColumn=$currentSheet->getHighestColumn();
		//获取总行数
		$allRow=$currentSheet->getHighestRow();
		//循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
		for($currentRow=2;$currentRow<=$allRow;$currentRow++){
			//从哪列开始，A表示第一列
			for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
				//数据坐标
				$address=$currentColumn.$currentRow;
				//读取到的数据，保存到数组$arr中
				$arr[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
			}
		}
		
		unlink($file_name);
		
		return $arr;
		
	}else{
		return array();
	}
	
}

?>