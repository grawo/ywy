<?php if (!defined('THINK_PATH')) exit();?><table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tr>
		<th>用户组标题 : </th>
		<td><input name="title" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:false"></td>
	</tr><tr>
		<th>用户组状态 : </th>
		<td><select name="status" class="easyui-combobox" style="height:30px;" data-options="value:'1',url:'<?php echo U("Admin/Function/get_config");?>&cname=USERGROUP_STATUS_TYPE|status|title&r_type=json',valueField:'status',textField:'title',multiple:false,required:false,editable:false"></select></td>
	</tr><tr>
		<th>用户权限 : </th>
		<td><select name="rules[]" class="easyui-combotree" style="height:30px;" data-options="value:'',url:'<?php echo U("Admin/Function/get_auth_rule");?>&r_type=json',valueField:'id',textField:'text',multiple:true,cascadeCheck:false,required:false,editable:false"></select></td>
	</tr><tr>
		<th>排序 : </th>
		<td><input name="sort" value="1" type="text" class="easyui-numberbox" style="height:30px;" data-options="precision:'0',decimalSeparator:'.',groupSeparator:',',required:false"></td>
	</tr></table>