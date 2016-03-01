<?php if (!defined('THINK_PATH')) exit();?><div id="AuthRule_Bar" class="Bar_tools">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('AuthRule_Data_List');"><span>列表or刷新</span></a>
<?php if(Is_Auth('Admin/AuthRule/add')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="UpdateTabs('AuthRule','<?php echo U('add');?>','','iconfont icon-add');"><span>新增</span></a><?php endif; ?>
</div>
<table id="AuthRule_Data_List">
</table>
<style>
#AuthRule_Data_List .tree-file {
	display: none
}
</style>
<script type="text/javascript">
$(function() {
	$("#AuthRule_Data_List").treegrid({
		url : "<?php echo U('AuthRule/index');?>",
		fit : true,
		striped : true,
		border : false,
		idField:'id',
		treeField:'title',
		pagination : false,
		toolbar : '#AuthRule_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40},
            {field : 'title',title : '菜单标题',width : 200},
            {field : 'name',title : '菜单名称',width : 200},
            {field : 'hide',title : '隐藏',width : 50},
            {field : 'status',title : '状态',width : 50},
            {field : 'sort',title : '排序',width : 50},
			{field : 'operate',title : '操作',width : 200}
		]],
	});
})
</script>