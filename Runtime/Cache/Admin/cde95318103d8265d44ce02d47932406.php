<?php if (!defined('THINK_PATH')) exit();?><div id="Config_Bar" class="Bar_tools">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('Config_Data_List');"><span>列表or刷新</span></a>
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-search',plain:true" onclick="Data_Search('Config_Search_From','Config_Data_List');"><span>搜索</span></a>
<?php if(Is_Auth('Admin/Config/add')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="Submit_Form('Config_Form','Config_Data_List','<?php echo U('add');?>','','新增数据','');"><span>新增</span></a><?php endif; ?>
</div>
<div style="display: none">
<form id="Config_Form" class="update_from" style="width:600px; height:320px;"></form>
</form>
  <form id="Config_Search_From" class="search_from">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
    <tr>
			<th>配置名称 : </th>
			<td><input name="s_name" type="text" class="easyui-textbox" style="height:30px;"></td>
		</tr><tr>
			<th>配置类型 : </th>
			<td><select name="s_type" class="easyui-combobox" style="height:30px;" data-options="value:'',url:'<?php echo U("Admin/Function/get_config");?>&cname=CONFIG_TYPE_LIST|type|title&r_type=json',valueField:'type',textField:'title',multiple:false,required:false,editable:false"></select></td>
		</tr><tr>
			<th>配置标题 : </th>
			<td><input name="s_title" type="text" class="easyui-textbox" style="height:30px;"></td>
		</tr><tr>
			<th>配置分组 : </th>
			<td><select name="s_group" class="easyui-combobox" style="height:30px;" data-options="value:'',url:'<?php echo U("Admin/Function/get_config");?>&cname=CONFIG_GROUP_LIST|group|title&r_type=json',valueField:'group',textField:'title',multiple:false,required:false,editable:false"></select></td>
		</tr><tr>
			<th>说明 : </th>
			<td><input name="s_remark" type="text" class="easyui-textbox" style="height:30px;"></td>
		</tr><tr>
			<th>状态 : </th>
			<td><select name="s_status" class="easyui-combobox" style="height:30px;" data-options="value:'',multiple:false,required:false,editable:false"><option value="" >请选择一个选项</option><option value="1" >启用</option><option value="0" >禁用</option></select></td>
		</tr><tr>
			<th>排序 : </th>
			<td><input name="s_sort" type="text" class="easyui-numberbox" style="height:30px;" data-options="min:'0',max:'999',precision:'0',decimalSeparator:'.',groupSeparator:',',required:false"></td>
		</tr>    </table>
  </form>
</div>

<table id="Config_Data_List"></table>

<script type="text/javascript">
$(function() {
	$("#Config_Data_List").datagrid({
		url : "<?php echo U('Config/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#Config_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40,sortable:true},
            {field : 'name',title : '配置名称',width : 100,sortable:true},
            {field : 'type',title : '配置类型',width : 100,sortable:true},
            {field : 'title',title : '配置标题',width : 100,sortable:true},
            {field : 'group',title : '配置分组',width : 100,sortable:true},
            {field : 'remark',title : '说明',width : 100,sortable:true},
            {field : 'status',title : '状态',width : 100,sortable:true},
            {field : 'sort',title : '排序',width : 100,sortable:true},
			{field : 'operate',title : '操作',width : 200}
		]]
	});
})
</script>