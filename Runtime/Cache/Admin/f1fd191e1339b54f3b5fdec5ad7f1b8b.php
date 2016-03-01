<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理控制台 | Gms管理系统</title>
<link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/metro/easyui.css">
<link rel="stylesheet" href="/Public/Static/Font/iconfont.css">
<link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/color.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css">
<script type="text/javascript" src="/Public/Static/Jquery/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Static/Easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/Public/Static/Easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/Public/Admin/js/main.js"></script>
</head>
<body><div style="padding:10px;">
    <!-- 标题栏 -->
    <div>
        <h2>数据备份</h2>
    </div>
    <!-- /标题栏 -->
<div id="AuthRule_Bar" class="Bar_tools">
	<a class='easyui-linkbutton' id="export" href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true"><span>立即备份</span></a>
	<a class='easyui-linkbutton' id="optimize" href="<?php echo U('optimize');?>" data-options="plain:true">优化表</a>
	<a class='easyui-linkbutton' id="repair" href="<?php echo U('repair');?>" data-options="plain:true">修复表</a>
</div>

    <!-- 应用列表 -->
        <form id="export-form" class="list_data" method="post" action="<?php echo U('export');?>">
  			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th width="48"></th>
                        <th>表名</th>
                        <th width="120">数据量</th>
                        <th width="120">数据大小</th>
                        <th width="160">创建时间</th>
                        <th width="160">备份状态</th>
                        <th width="120">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr>
                            <td>
                                <input class="ids" checked="chedked" type="checkbox" name="tables[]" value="<?php echo ($table["name"]); ?>">
                            </td>
                            <td><?php echo ($table["name"]); ?></td>
                            <td><?php echo ($table["rows"]); ?></td>
                            <td><?php echo (format_bytes($table["data_length"])); ?></td>
                            <td><?php echo ($table["create_time"]); ?></td>
                            <td class="info">未备份</td>
                            <td class="action">
                                <a href="<?php echo U('optimize?tables='.$table['name']);?>">优化表</a>&nbsp;
                                <a href="<?php echo U('repair?tables='.$table['name']);?>">修复表</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </form>
    <!-- /应用列表 -->
    
    <script type="text/javascript">
    (function($){
        var $form = $("#export-form"), $export = $("#export"), tables
            $optimize = $("#optimize"), $repair = $("#repair");

        $optimize.add($repair).click(function(){
            $.post(this.href, $form.serialize(), function(data){
                if(data.status){
					$.messager.alert('成功信息',data.info,'');
                } else {
					$.messager.alert('失败信息',data.info,'');
                }
                setTimeout(function(){
	                $('#top-alert').find('button').click();
	                $(that).removeClass('disabled').prop('disabled',false);
	            },1500);
            }, "json");
            return false;
        });

        $export.click(function(){
            $export.parent().children().addClass("disabled");
            $export.linkbutton({text:'正在发送备份请求...'});
            $.post(
                $form.attr("action"),
                $form.serialize(),
                function(data){
                    if(data.status){
                        tables = data.tables;
						$export.linkbutton({text:data.info + "开始备份，请不要关闭本页面！"});
                        backup(data.tab);
                        window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                    } else {
                        updateAlert(data.info,'alert-error');
                        $export.parent().children().removeClass("disabled");
						$export.linkbutton({text:"立即备份"});
                        setTimeout(function(){
        	                $('#top-alert').find('button').click();
        	                $(that).removeClass('disabled').prop('disabled',false);
        	            },1500);
                    }
                },
                "json"
            );
            return false;
        });

        function backup(tab, status){
            status && showmsg(tab.id, "开始备份...(0%)");
            $.get($form.attr("action"), tab, function(data){
                if(data.status){
                    showmsg(tab.id, data.info);
                    if(!$.isPlainObject(data.tab)){
                        $export.parent().children().removeClass("disabled");
						$.messager.alert('备份成功',"备份完成，点击重新备份",'');
						$export.linkbutton({text:"备份完成，点击重新备份"});
                        window.onbeforeunload = function(){ return null }
                        return;
                    }
                    backup(data.tab, tab.id != data.tab.id);
                } else {
                    updateAlert(data.info,'alert-error');
                    $export.parent().children().removeClass("disabled");
                    $export.linkbutton({text:"立即备份"});
                    setTimeout(function(){
    	                $('#top-alert').find('button').click();
    	                $(that).removeClass('disabled').prop('disabled',false);
    	            },1500);
                }
            }, "json");

        }

        function showmsg(id, msg){
            $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
        }
    })(jQuery);
    </script>
    </div>
</body>
</html>