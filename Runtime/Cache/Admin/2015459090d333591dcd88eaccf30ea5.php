<?php if (!defined('THINK_PATH')) exit();?><div id="<?php echo ($ModelInfo['name']); ?>_Bar" class="Bar_tools">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-viewlist',plain:true" onclick="Data_Reload('<?php echo ($ModelInfo['name']); ?>_Data_List');"><span>列表or刷新</span></a>
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-search',plain:true" onclick="Data_Search('<?php echo ($ModelInfo['name']); ?>_Search_From','<?php echo ($ModelInfo['name']); ?>_Data_List');"><span>搜索</span></a>
<if condition="Is_Auth('Admin/<?php echo ($ModelInfo['name']); ?>/add')">
<a class='easyui-linkbutton' href='JavaScript:void(0);' data-options="iconCls:'iconfont icon-add',plain:true" onclick="Submit_Form('<?php echo ($ModelInfo['name']); ?>_Form','<?php echo ($ModelInfo['name']); ?>_Data_List','{:U('add')}','','新增数据','');"><span>新增</span></a>
</if>
</div>
<div style="display: none">
<form id="<?php echo ($ModelInfo['name']); ?>_Form" class="update_from" style="width:600px; height:320px;"></form>
</form>
  <form id="<?php echo ($ModelInfo['name']); ?>_Search_From" class="search_from">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
    <?php if(is_array($_Search)): $i = 0; $__LIST__ = $_Search;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field_one): $mod = ($i % 2 );++$i;?><tr>
			<th><?php echo ($field_one['title']); ?> : </th>
			<td><?php echo ($field_one['form']); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </form>
</div>

<table id="<?php echo ($ModelInfo['name']); ?>_Data_List"></table>

<script type="text/javascript">
$(function() {
	$("#<?php echo ($ModelInfo['name']); ?>_Data_List").datagrid({
		url : "{:U('<?php echo ($ModelInfo['name']); ?>/index')}",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#<?php echo ($ModelInfo["name"]); ?>_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40,sortable:true},
<?php foreach ($_List as $key => $field_one ) {?>
            {field : '<?php echo $field_one["name"];?>',title : '<?php echo $field_one["title"];?>',width : <?php if($field_one["l_width"]!=''){echo $field_one["l_width"];}else{echo "100";}?>,sortable:true},
<?php }?>
			{field : 'operate',title : '操作',width : 200}
		]]
	});
})
</script>