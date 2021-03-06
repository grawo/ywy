<?php if (!defined('THINK_PATH')) exit();?><div id="ActionLog_Bar" class="Bar_tools"> <a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('ActionLog_Data_List');"><span>列表or刷新</span></a> <a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-search',plain:true" onclick="Data_Search('ActionLog_Search_From','ActionLog_Data_List');"><span>搜索</span></a>
  <?php if(Is_Auth('Admin/ActionLog/del')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-delete',plain:true" onclick="Data_Remove('<?php echo U ( 'del');?>','ActionLog_Data_List');"><span>清空日志</span></a><?php endif; ?>
</div>
<div style="display: none">
  <form id="ActionLog_Form" class="update_from" style="width:600px; height:320px;"></form>
  <form id="ActionLog_Search_From" class="search_from">
    <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
      <tr>
        <th>行为id : </th>
        <td><input name="s_action_id" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>执行用户id : </th>
        <td><input name="s_user_id" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>执行行为者ip : </th>
        <td><input name="s_action_ip" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>触发行为的表 : </th>
        <td><input name="s_model" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>触发行为的数据id : </th>
        <td><input name="s_record_id" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>日志备注 : </th>
        <td><input name="s_remark" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>状态 : </th>
        <td><input name="s_status" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
      <tr>
        <th>执行行为的时间 : </th>
        <td><input name="s_create_time" type="text" class="easyui-textbox" style="height:30px;"></td>
      </tr>
    </table>
  </form>
</div>
<table id="ActionLog_Data_List">
</table>
<script type="text/javascript">
$(function() {
	$("#ActionLog_Data_List").datagrid({
		url : "<?php echo U('ActionLog/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#ActionLog_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40,sortable:true},
            {field : 'action_title',title : '行为名称',width : 200,sortable:true},
            {field : 'user_nickname',title : '执行用户',width : 80,sortable:true},
            {field : 'remark',title : '日志备注',width : 360,sortable:true},
            {field : 'create_time',title : '执行行为的时间',width : 110,sortable:true},
			{field : 'operate',title : '操作',width : 100}
		]]
	});
})
</script>