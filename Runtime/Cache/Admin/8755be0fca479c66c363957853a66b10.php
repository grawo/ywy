<?php if (!defined('THINK_PATH')) exit();?><div style="margin:10px 0 10px 0;"></div>
	<div class="easyui-tabs" style="width:80%px;height:600px">
		<div title="我的帐户" style="padding:10px">
			<table id="gd"></table>
		</div>
		<div title="分享效果" style="padding:10px">
			<table id="sh"></table>
		</div>
	</div>

<script>
$(function(){
	$("#gd").datagrid({
		url : "<?php echo U('UserCenter/orderlist');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 10,
		pageList : [ 10],
		pageNumber : 1,
		sortName : 'order_id',
		sortOrder : 'desc',
		singleSelect : true,
		columns : [ [ {
			field : 'order_sn',
			title : '时间',
			width : 200,
			sortable : true
		}, {
			field : 'consignee',
			title : '总订单数',
			width : 100,
			sortable : true
		}, {
			field : 'add_time',
			title : '总成交数',
			width : 150,
			sortable : true
		}, {
			field : 'mobile',
			title : '交易失败数',
			width : 100,
			sortable : true
		}, {
			field : 'goods_amount',
			title : '卡成交单数',
			width : 100,
			sortable : true
		}, {
			field : 'shipping_name',
			title : '其它商品单数',
			width : 130,
			sortable : true
		}, {
			field : 'pay_status',
			title : '成交总金额',
			width : 130,
			sortable : true
		}, {
			field : 'shipping_status',
			title : '总提成（待开发）',
			width : 100,
			sortable : true
		}, {
			field : 'order_status',
			title : '总业绩（待开发）',
			width : 100,
			sortable : true
		}]]
	})}

)

$(function(){
	$("#sh").datagrid({
		url : "<?php echo U('UserCenter/orderlist');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 10,
		pageList : [ 10],
		pageNumber : 1,
		sortName : 'order_id',
		sortOrder : 'desc',
		singleSelect : true,
		columns : [ [ {
			field : 'order_sn',
			title : '时间',
			width : 200,
			sortable : true
		}, {
			field : 'consignee',
			title : '转发链接',
			width : 100,
			sortable : true
		}, {
			field : 'add_time',
			title : '转发量',
			width : 150,
			sortable : true
		}]]
	})}
)
</script>
 
<!-- <script src="/Public/Admin/js/daterangepicker.js"></script>
<script src="/Public/Admin/js/salesCenter.js"></script> -->