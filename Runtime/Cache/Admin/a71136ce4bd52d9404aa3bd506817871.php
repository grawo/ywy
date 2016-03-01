<?php if (!defined('THINK_PATH')) exit();?><div id="AuthGroup_Bar" class="Bar_tools">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('AuthGroup_Data_List');"><span>列表or刷新</span></a>
<?php if(Is_Auth('Admin/AuthGroup/add')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="Submit_Form('AuthGroup_Form','AuthGroup_Data_List','<?php echo U('add');?>','','新增数据','');"><span>新增</span></a><?php endif; ?>
</div>
<div style="display: none">
<form id="AuthGroup_Form" class="update_from" style="width:600px; height:320px;"></form>
</div>
<table id="AuthGroup_Data_List"></table>
<script type="text/javascript">
$(function() {
	$("#AuthGroup_Data_List").treegrid({
		url : "<?php echo U('AuthGroup/index');?>",
		fit : true,
		striped : true,
		border : false,
		idField:'id',
		treeField:'title',
		pagination : false,
		toolbar : '#AuthGroup_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40},
            {field : 'title',title : '用户组标题',width : 120},
            {field : 'status',title : '用户组状态',width : 100},
            {field : 'sort',title : '排序',width : 100},
			{field : 'operate',title : '操作',width : 200}
		]],
	});
})
</script>