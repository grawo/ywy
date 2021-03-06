<?php if (!defined('THINK_PATH')) exit();?><div id="Model_Bar" class="Bar_tools">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('Model_Data_List');"><span>列表or刷新</span></a>
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-search',plain:true" onclick="Data_Search('Model_Search_From','Model_Data_List');"><span>搜索</span></a>
<?php if(Is_Auth('Admin/Model/add')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="Submit_Form('Model_Form','Model_Data_List','<?php echo U('add');?>','','新增','');"><span>新增</span></a><?php endif; ?>
<?php if(Is_Auth('Admin/Model/generate')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewgallery',plain:true" onclick="Submit_Form('Model_Form','Model_Data_List','<?php echo U('generate');?>','','系统化数据模型','');"><span>系统化数据模型</span></a><?php endif; ?>
</div>
<div style="display: none">
<form id="Model_Form" class="update_from" style="width:600px; height:350px;"></form>
  <form id="Model_Search_From" class="search_from">
    <table>
      <tr>
        <th>标识 : </th>
        <td><input name="s_name" type="text" class="easyui-textbox"></td>
      </tr>
      <tr>
        <th>名称 : </th>
        <td><input name="s_title" type="text" class="easyui-textbox"></td>
      </tr>
      <tr>
        <th>表名 : </th>
        <td><input name="s_table_name" type="text" class="easyui-textbox"></td>
      </tr>
      <tr>
        <th>允许子模型 : </th>
        <td><select name="s_is_extend" class="easyui-combobox" data-options="value:'',multiple:false,required:false,editable:false">
            <option value="" >----</option>
            <option value="1" >是</option>
            <option value="0" >否</option>
          </select></td>
      </tr>
      <tr>
        <th>继承的模型 : </th>
        <td><select name="s_extend" class="easyui-combobox" data-options="value:'',url:'<?php echo U("Admin/Function/get_extend_model");?>&r_type=json',valueField:'id',textField:'title',multiple:false,required:false,editable:false"></select></td>
      </tr>
      <tr>
        <th>列表类型 : </th>
        <td><select name="s_list_type" class="easyui-combobox" data-options="value:'',multiple:false,required:false,editable:false">
            <option value="" >----</option>
            <option value="0" >普通</option>
            <option value="1" >树形</option>
          </select></td>
      </tr>
      <tr>
        <th>创建时间 : </th>
        <td><input name="s_create_time_min" type="text" class="easyui-datetimebox"> - <input name="s_create_time_max" type="text" class="easyui-datetimebox"></td>
      </tr>
      <tr>
        <th>更新时间 : </th>
        <td><input name="s_update_time_min" type="text" class="easyui-datetimebox"> - <input name="s_update_time_max" type="text" class="easyui-datetimebox"></td>
      </tr>
      <tr>
        <th>状态 : </th>
        <td><select name="s_status" class="easyui-combobox" data-options="value:'',multiple:false,required:false,editable:false">
            <option value="" >----</option>
            <option value="0" >禁用</option>
            <option value="1" >启用</option>
          </select></td>
      </tr>
      <tr>
        <th>数据库引擎 : </th>
        <td><select name="s_engine_type" class="easyui-combobox" data-options="multiple:false,required:false,editable:false">
            <option value="" >----</option>
            <option value="MyISAM" >MyISAM</option>
            <option value="InnoDB" >InnoDB</option>
            <option value="MEMORY" >MEMORY</option>
            <option value="BLACKHOLE" >BLACKHOLE</option>
            <option value="MRG_MYISAM" >MRG_MYISAM</option>
            <option value="ARCHIVE" >ARCHIVE</option>
          </select></td>
      </tr>
    </table>
  </form>
</div>
<table id="Model_Data_List">
</table>
<script type="text/javascript">
$(function() {
	$("#Model_Data_List").datagrid({
		url : "<?php echo U('Model/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#Model_Bar',
		singleSelect : true,
		columns : [[
            {field : 'name',title : '标识',width : 100,sortable:true},
            {field : 'title',title : '名称',width : 100,sortable:true},
            {field : 'is_extend',title : '允许子模型',width : 80,sortable:true},
            {field : 'extend',title : '继承的模型',width : 100,sortable:true},
            {field : 'list_type',title : '列表类型',width : 60,sortable:true},
            {field : 'status',title : '状态',width : 40,sortable:true},
            {field : 'engine_type',title : '数据库引擎',width : 70,sortable:true},
			{field : 'operate',title : '操作',width : 200}
		]]
	});
})
</script>