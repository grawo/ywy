<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理控制台 | <?php echo C('GMS_NAME');?></title>
<link href="/Public/Admin/images/favicon.ico" mce_href="/Public/Admin/images/favicon.ico" rel="bookmark" type="image/x-icon" /> 
<link href="/Public/Admin/images/favicon.ico" mce_href="/Public/Admin/images/favicon.ico" rel="icon" type="image/x-icon" /> 
<link href="/Public/Admin/images/favicon.ico" mce_href="/Public/Admin/images/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
<link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/metro/easyui.css">
<link rel="stylesheet" href="/Public/Static/Font/iconfont.css">
<link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/color.css">
<link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/demo.css">
<link rel="stylesheet" href="/Public/Static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="/Public/Static/kindeditor/themes/simple/simple.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css">
<script type="text/javascript" src="/Public/Static/Jquery/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Static/Easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/Public/Static/Easyui/locale/easyui-lang-zh_CN.js"></script>
<script charset="utf-8" src="/Public/Static/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/Static/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/Public/Static/Echarts/echarts.js"></script>
<script type="text/javascript" src="/Public/Admin/js/main.js"></script>

<!-- 部门管理bootstrap  彬彬-->

<script type="text/javascript" src="/Public/Admin/js/moment.js"></script>
<script type="text/javascript" src="/Public/Admin/js/daterangepicker.js"></script>
<!-- <script type="text/javascript" src="/Public/Admin/js/salesCenter.js"></script> -->
<!-- <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script> -->

<!-- <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/topLeft.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/sectorsManage.css">

<script>
var ke_pasteType=2;
var ke_fileManagerJson="<?php echo U('Admin/FilesUpdata/filemanager');?>";
var ke_uploadJson="<?php echo U('Admin/FilesUpdata/upload');?>";
var ke_Uid='<?php echo session(C("AUTH_KEY"));;?>';
var Root='';
</script>
</head>
<body class="easyui-layout" id="Main_Layout_Box">
<div id="Main_Layout_North" data-options="region:'north',split:false">
  <div id="header_logo"> 
  		<a href="<?php echo U('Admin/Index/index');?>">
  		<?php echo C('GMS_NAME');?>
  		</a> 
  		<i class="opacity-80">
  		v1.1</i> 
  		<a class="justify" href="javascript:void(0);"></a></div>
  <ul id="header_nav" class="header_nav">
    <?php if(is_array($AdminMenu)): $i = 0; $__LIST__ = $AdminMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="JavaScript:void(0);" onclick="
    			<?php if($v['show_type'] == 0 ): ?>G_Ajax(this,'ul','Main_Layout_West','<?php echo U('Index/menu',array('pid'=>$v['id']));?>')
    			<?php else: ?>
    				G_Dialog(this,'Dialog_Main_<?php echo ($v['id']); ?>','<?php echo ($v['url']); ?>')<?php endif; ?>
    		">
    		<li>
    			<?php echo ($v['title']); ?>
    		</li>
    </a><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
  <ul class="header_nav" style="float:right">
    <a href="#"><li id="inuser"><?php echo ($UserInfo['user_name']); ?></li></a>
    <a href="<?php echo U('Index/cache');?>"><li>缓存更新</li></a>
    <a href="<?php echo U('Public/logout');?>"><li>退出</li></a>
  </ul>
</div>
<div id="Main_Layout_South" data-options="region:'south',split:false">Powered by <a href="<?php echo C('GMS_SITE');?>" style="color:#666"><?php echo C('GMS_NAME');?> v <?php echo C('GMS_VERSION');?></a> | Copyright © <a href="<?php echo C('GMS_AUTHOR_SITE');?>" style="color:#666"><?php echo C('GMS_AUTHOR');?></a> All rights reserved.</div>
<div id="Main_Layout_West" data-options="region:'west',split:false"></div>
<div id="Main_Layout_Center" data-options="region:'center',split:false" style="padding:5px;">
  <div id="MainTabs" class="easyui-tabs" data-options="fit:true,border:false">
    <div title="控制台" data-options="closable:false,id:-1,iconCls:'iconfont icon-all',bodyCls:'tabs_box'" style="padding: 5px;">
	<!-- <?php echo hook('AdminIndex');?> -->
    <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
    <tr><th>业务员头像 : </th>
    	<td>
    		<div>
    		<img src="./Uploads/<?php echo ($list["img"]); ?>" width="100px" height="100px"></img>
    		</div>
    	</td>
	</tr>
    <tr><th>业务员编号 : </th>
		<td><?php echo ($list["user_code"]); ?></td>
	</tr>
	<tr><th>用户名 : </th>
		<td><?php echo ($list["user_name"]); ?></td>
	</tr><tr>
		<th>性别 : </th>
		<td><?php if($list["user_name"] == 0): ?>男
		<?php elseif($list["user_name"] == 1): ?>女
		<?php else: endif; ?></td>
	</tr><tr>
		<th>手机号 : </th>
		<td><?php echo ($list["mobile_phone"]); ?></td>
	</tr><tr>
		<th>角色 : </th>
		<td>
		<?php if($list["role_range"] == 1): ?>业务员
		<?php elseif($list["role_range"] == 2): ?>门店店主
		<?php elseif($list["role_range"] == 3): ?>供应商
		<?php elseif($list["role_range"] == 4): ?>兼职业务员
		<?php else: endif; ?>
		</td>
	</tr><tr>
		<th>最后一次登陆 : </th>
		<td><?php echo ($list["last_login"]); ?></td>
	</tr></table>
    </div>
  </div>
</div>



</body>
</html>
<script>
$(document).ready(function(){
	G_Ajax(this,'ul','Main_Layout_West','<?php echo U("Index/menu",array("pid"=>1));?>');
})

</script>