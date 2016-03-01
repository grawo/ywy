<?php if (!defined('THINK_PATH')) exit();?><table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
	<tr>
		<th>业务员姓名 :</th>
		<td><input name="user_name" id='user_name' type="text" class="easyui-textbox"
			style="height: 30px;" value="<?php echo ($deps['note']); ?>" data-options="required:true"></td>
	</tr>
	<tr>
		<th>所属部门 :</th>
		<td><select name="department_id" id="department_id" style="height: 30px;" onchange="changecode()">
				<option value="" >请选择</option>
				<?php if(is_array($dep)): $i = 0; $__LIST__ = $dep;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deps): $mod = ($i % 2 );++$i; $key=$key+2; ?>
				<option value="<?php echo ($key); ?>"><?php echo ($deps["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select></td>
	</tr>
	<tr>
		<th>业务员代码 :</th>
		<td><input name="user_code" id='user_code' type="text" class="easyui-textbox"
			style="height: 30px;" value="<?php echo ($code); ?>" readonly /></td>
	</tr>
	<!-- <tr>
		<th>密码 :</th>
		<td><input name="password" type="password" class="easyui-textbox"
			style="height: 30px;" value="" data-options="required:true"></td>
	</tr> -->
	<tr>
		<th>手机号:</th>
		<td><input name="mobile_phone" type="text" class="easyui-textbox"
			style="height: 30px;" value="" data-options="required:true"></td>
	</tr>
	<tr>
		<th>性别 :</th>
		<td><select name="sex" style="height: 30px;">
				<option value="">请选择</option>
				<option value="1">男</option>
				<option value="0">女</option>
		</select></td>
	</tr>
	
	<tr>
		<th>状态 :</th>
		<td><select name="status" style="height: 30px;">
				<option value="">请选择</option>
				<option value="1">启用</option>
				<option value="0">停用</option>
		</select></td>
	</tr>
	<tr>
		<th>角色 :</th>
		<td><select name="role_range" style="height: 30px;">
				<option value="">请选择</option>
				<option value="0">普通会员</option>
				<option value="1">业务员</option>
				<option value="2">门店店主</option>
				<option value="3">供应商</option>
				<option value="4">兼职业务员</option>
		</select></td>
	</tr>
</table>

<script>
function changecode(){
		var str1 = $("#department_id option:selected").val();
		$.post("<?php echo U('User/querycode');?>",{'id':str1,},function(str){
			$("#user_code").textbox('setValue',str);
		})
		
		/* var url='/index.php/Admin/User/querycode';
		var data=str1;
		$.ajax({
			url:url,
			data:data,
			type:'post',
			dataType:'json',
			success:function(str){
				$("#user_code").textbox('setValue',str);
			}
		}) */
}
</script>