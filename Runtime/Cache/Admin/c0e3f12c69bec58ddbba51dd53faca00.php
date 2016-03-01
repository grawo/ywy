<?php if (!defined('THINK_PATH')) exit();?><table border="0" cellpadding="0" cellspacing="0" style="width:100%">
  <tr>
    <th>用户权限 : </th>
    <td><select name="group[]" class="easyui-combotree" style="height:30px;" data-options="value:'<?php echo ($_group_id); ?>',url:'<?php echo U("Admin/Function/get_auth_group");?>&r_type=json',valueField:'user_id',textField:'text',multiple:true,cascadeCheck:false,required:false,editable:false"></select></td>
  </tr>
</table>
<input name="user_id" type="hidden" value="<?php echo ($_info["user_id"]); ?>" />