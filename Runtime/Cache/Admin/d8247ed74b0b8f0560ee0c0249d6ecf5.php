<?php if (!defined('THINK_PATH')) exit();?><div id="usercenter_Bar" class="Bar_tools">
	<?php
 $str=''; if($perdata['role_range']==1){ $str='业务员'; }elseif($perdata['role_range']==2){ $str='门店店主'; }elseif($perdata['role_range']==3){ $str='供应商'; }else{ $str='兼职业务员'; } $sex=''; if($perdata['sex']==1){ $sex='男'; }else{ $sex='女'; } ?>

<div>
<table>
 	<tr>
       	<th>业务员头像 : </th>
       	<td>
       		<img alt="" src="../Uploads/<?php echo ($perdata["img"]); ?>" width="70px" height="70px" />
       	</td>
       	<td>
			<form action="/ywy/index.php/Admin/Usercenter/upload" enctype="multipart/form-data" method="post" >
				<input type="text" name="name" />
				<input type="file" name="photo" />
				<input type="submit" value="提交" >
				
			</form>
		</td>
	</tr>
	</table>
 </div> 

 <form id="ff" method="post" action="<?php echo U('Usercenter/update');?>">
 	<table>
 	<div>
 		<tr>
 		<th>业务员编号: </th>
 			<td></td>
 			<td>
        		<input class="easyui-validatebox" value="<?php echo ($perdata["user_code"]); ?>" type="text" id="user_code" name="user_code" data-options="" disabled />
        	</td>
        </tr>  
    </div> 
    <div>  
        <tr>
        <th>用户名: </th>
        	<td></td>
        	<td>
        		<input class="easyui-validatebox" value="<?php echo ($perdata["user_name"]); ?>" type="text" id="user_name" name="user_name" data-options="required:true" disabled />  
        	</td>
        </tr>
    </div>  
    <div>  
        <tr>
        <th>邮箱: </th>
        	<td></td>
        	<td>
        		<input class="easyui-validatebox" value="<?php echo ($perdata["email"]); ?>" type="text" id="email" name="email" data-options="validType:'email'" />
        	</td>
        </tr>  
    </div>
    
    <div>  
        <tr>
        <th>性别: </th>
        	<td></td>
        	<td>
        		<input class="easyui-validatebox" value="<?php echo ($sex); ?>" type="text" id="sex" name="sex" data-options="required:true" />
        	</td>
        </tr>  
    </div> 
    <div>  
        <tr>
        <th>手机号: </th>
        	<td></td>
        	<td> 
        		<input class="easyui-validatebox" type="text" value="<?php echo ($perdata["mobile_phone"]); ?>" id="phone_mobile" name="phone_mobile" data-options="validType:'mobile'" disabled />
        	</td>
        </tr>  
    </div> 
    <div>  
        <tr>
        <th>角色: </th>
        	<td></td>
        	<td> 
        		<input class="easyui-validatebox" value="<?php echo ($str); ?>" type="text" name="role" data-options="" disabled />
        	</td>
        </tr>  
    </div> 
    <div>  
        <tr>
        <th>最后一次登陆:</th>
        	<td></td>
        	<td> 
        		<input class="easyui-validatebox" type="text" value="<?php echo ($perdata["last_time"]); ?>" name="last_login" data-options="" disabled />
        	</td>
        	<td></td>
        	<td>
        		<input type="hidden" id="user_id" name="user_id" value="<?php echo ($perdata["user_id"]); ?>">
    			<input type="submit" id="subto" value="提交" >
    		</td>
        </tr>  
    </div>
    </table>      
</form>
<!-- <a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('usercenter_Data_List');"><span>列表or刷新</span></a>
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-search',plain:true" onclick="Data_Search('usercenter_Search_From','usercenter_Data_List');"><span>搜索</span></a>
<?php if(Is_Auth('Admin/usercenter/add')): ?><a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="Submit_Form('usercenter_Form','usercenter_Data_List','<?php echo U('add');?>','','新增数据','');"><span>新增</span></a> --><?php endif; ?>
</div>
<div style="display: none">
<form id="usercenter_Form" class="update_from" style="width:600px; height:320px;"></form>
</form>
  <form id="usercenter_Search_From" class="search_from">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
        </table>
        
  </form>
</div>
<div id="tanchu"></div>

<table id="usercenter_Data_List"></table>

<!-- 弹出窗 -->
<div id="win1" class="easyui-window" title="My Window" closed="true" style="width:400px;height:200px;"  
        data-options="iconCls:'icon-save',modal:true">  
    你的用户名已经被占用了哎！
</div> 

<div id="win2" class="easyui-window" title="My Window" closed="true" style="width:400px;height:200px;"  
        data-options="iconCls:'icon-save',modal:true">  
    你的用户名没有改变呦！
</div> 

<script type="text/javascript">
$(function(){
	$('#user_name').change(function(){
		var $str=$('#user_name').val();
		var $strid=$('#user_id').val();
		$.post("<?php echo U('Usercenter/check');?>",{
			user_name:$str,
			user_id  :$strid
		},
		function(json){
			//alert(json.dat)
			if(json.dat=='2'){
				$('#win1').window('open');
			}else if(json.dat=='1'){
				$('#win2').window('open');
			}else{
				return;
			}
		})
	})
})
</script>