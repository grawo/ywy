<?php if (!defined('THINK_PATH')) exit();?><div id="User_Bar" class="Bar_tools">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('User_Data_List');"><span>列表or刷新</span></a>
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-search',plain:true" onclick="Data_Search('User_Search_From','User_Data_List');"><span>搜索</span></a>
<?php if(Is_Auth('Admin/User/add')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="Submit_Form('User_Form','User_Data_List','<?php echo U('add');?>','','新增数据','');"><span>新增</span></a><?php endif; ?>
</div>
<div style="display: none">
<form id="User_Form" class="update_from" style="width:600px; height:320px;"></form>

  <form id="User_Search_From" class="search_from">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
    <tr>
		<th>业务员姓名 : </th>
		<td><input name="s_user_name" type="text" class="easyui-textbox" style="height:30px;"></td>
	</tr>
	<tr>
		<th>业务员代码: </th>
		<td><input name="s_user_code" type="text" class="easyui-textbox" style="height:30px;"></td>
	</tr>
	
	<tr>
		<th>状态: </th>
		<td><select name="s_status" class="easyui-combobox" style="height:30px;" data-options="value:'',url:'<?php echo U("Admin/Function/get_config");?>&cname=USER_STATUS_TYPE|type|title&r_type=json',valueField:'type',textField:'title',multiple:false,required:false,editable:false"></select></td>
	</tr>
	
</table>
  </form>
</div>

<table id="User_Data_List"></table>

<script type="text/javascript">
$(function() {
	$("#User_Data_List").datagrid({
		url : "<?php echo U('User/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'user_id',
		sortOrder : 'desc',
		toolbar : '#User_Bar',
		singleSelect : true,
		columns : [[
            {field : 'user_id',title : 'ID',width : 40,sortable:true},
            {field : 'name',title : '所属部门',width : 40,sortable:true},
            {field : 'user_name',title : '业务员姓名',width : 100,sortable:true},
            {field : 'user_code',title : '业务员代码',width : 100,sortable:true},
            {field : 'mobile_phone',title : '手机',width : 150,sortable:true},
            {field : 'last_login',title : '上次登录时间',width : 130,sortable:true},
            {field : 'reg_time',title : '创建时间',width : 130,sortable:true},
            {field : 'sex',title : '性别',width : 100,sortable:true},
            {field : 'role_range',title : '角色',width : 100,sortable:true},
            {field : 'status',title : '状态',width : 60,sortable:true},
			{field : 'operate',title : '操作',width : 200}
		]]
	});
})
</script>