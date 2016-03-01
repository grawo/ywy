<?php if (!defined('THINK_PATH')) exit();?><div style="margin:10px 0 10px 0;"></div>
	<div class="easyui-tabs" style="width:90%;height:650px">
		<div title="站内信" style="padding:10px">
			<table id="mess">
			
			</table>
		</div>
		<div title="知识库" style="padding:10px">
			<table id="know">
			
			</table>
		</div>
		<div title="常见问题" data-options="closable:false" style="padding:10px">
			<table id="pro">
			
			</table>
		</div>
		<div id="tb" style="height:auto">
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="removeit()">写信</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit()">删除</a>
		</div>
		
</div>


<script>
$(function(){
	$("#mess").datagrid({
		url : "<?php echo U('UserCenter/orderlist');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 10,
		toolbar: '#tb',
		pageList : [ 10],
		pageNumber : 1,
		sortName : 'order_id',
		sortOrder : 'desc',
		checkOnSelect : true,
		columns : [ [ {
			field : 'ck',
			checkbox : true,
			width : 200,
			sortable : true
		}, {
			field : 'order_sn',
			title : '发件人',
			width : 200,
			sortable : true
		}, {
			field : 'consignee',
			title : '主题',
			width : 100,
			sortable : true
		}, {
			field : 'add_time',
			title : '创建时间',
			width : 150,
			sortable : true
		}, {
			field : 'mobile',
			title : '信息类型',
			width : 100,
			sortable : true
		}, {
			field : 'goods_amount',
			title : '标记为重要',
			width : 100,
			sortable : true
		}, {
			field : 'operate',
			title : '操作',
			width : 200,
			sortable : true
		}]]
	})}
)

function edit(){
			var str = $("#mess").datagrid("getChecked");
			if (editIndex == undefined){return}
			alert('asdf');
			$('#dg').datagrid('cancelEdit', editIndex)
					.datagrid('deleteRow', editIndex);
			editIndex = undefined;
		}
function removeit(){
			var str = $("#mess").datagrid("getChecked");
			if (editIndex == undefined){return}
			alert('asdf');
			$('#dg').datagrid('cancelEdit', editIndex)
					.datagrid('deleteRow', editIndex);
			editIndex = undefined;
		}

</script>


<!-- <script src="/Public/Admin/js/jquery.min.js"></script>
<script src="/Public/Admin/js/moment.js"></script> 
<script src="/Public/Admin/js/daterangepicker.js"></script>
<script src="/Public/Admin/js/salesCenter.js"></script>-->