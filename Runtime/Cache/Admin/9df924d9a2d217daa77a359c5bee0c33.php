<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>后台管理系统</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="/zwj_tpadmin/Public/Admin/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/zwj_tpadmin/Public/Admin/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
  <link href="/zwj_tpadmin/Public/Admin/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
        测试系统
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($_SESSION["adm_data"]["adm_user"]); ?></span><a href="<?php echo U('Index/logout');?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
    		<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="nav-item dl-selected"><div class="nav-item-inner nav-<?php echo ($v["icon"]); ?>"><?php echo ($v["name"]); ?></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
        <a class="dl-title" style="float:right;margin-right:10px;font-size:16px;" target="_blank" href="/zwj_tpadmin">查看网站</a>
      </ul>
      
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/zwj_tpadmin/Public/Admin/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/zwj_tpadmin/Public/Admin/assets/js/bui-min.js"></script>
  <script type="text/javascript" src="/zwj_tpadmin/Public/Admin/assets/js/common/main-min.js"></script>
  <script type="text/javascript" src="/zwj_tpadmin/Public/Admin/assets/js/config-min.js"></script>
  <script>
    BUI.use('common/main',function(){
      var config = [
	  <?php echo ($arr); ?>];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>