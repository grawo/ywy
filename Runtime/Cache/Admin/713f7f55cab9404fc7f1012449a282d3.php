<?php if (!defined('THINK_PATH')) exit();?><table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tr>
		<th>业务员姓名 : </th>
		<td><input name="user_name" type="text" class="easyui-textbox" style="height:30px;" value="<?php echo ($_info["user_name"]); ?>" data-options="required:false"></td>
	</tr><tr>
		<th>业务员代码 : </th>
		<td><input name="user_code" type="text" class="easyui-textbox" style="height:30px;" value="<?php echo ($_info["user_code"]); ?>" data-options="required:false" disabled></td>
	</tr><tr>
		<th>密码 : </th>
		<td><input name="password" type="password" class="easyui-textbox" style="height:30px;" value="<?php echo ($_info["password"]); ?>" data-options="required:false"></td>
	</tr><!-- <tr>
		<th>邮箱 : </th>
		<td><input name="email" type="text" class="easyui-textbox" style="height:30px;" value="<?php echo ($_info["email"]); ?>" data-options="required:false"></td>
	</tr> --><tr>
		<th>手机 : </th>
		<td><input name="mobile_phone" type="text" class="easyui-textbox" style="height:30px;" value="<?php echo ($_info["mobile_phone"]); ?>" data-options="required:false"></td>
	</tr></table>
<input name="user_id" type="hidden" value="<?php echo I('get.user_id');?>" />