<?php if (!defined('THINK_PATH')) exit();?><div style="margin: 10px"></div>
<div class="helpCenter">
	<div class="helpCenter-title">
		<ul class="list-inline list-unstyled">
			<li class="activeHelp purchase-li"><a href="javascript:void(0);">所有订单</a>
			</li>
			<li class="purchase-li"><a href="javascript:void(0);">卡类订单</a></li>
			<li class="purchase-li"><a href="javascript:void(0);">合约产品</a></li>
		</ul>
	</div>
	<div class="helpContent">
		<!--所有订单-->
		<div class="standMessage tabToggleOrder" style="display: block;">
			<div class="messages">
				<!-- <div class="tc-15-calendar-select">
					<input class="tc-15-simulate-select m" id="config-demo-1">
					<button class="searchImg">
						<img src="/Public/Admin/images/saleImgs/search01.png" />
					</button>
				</div> -->
				<!--表格-->
				<div class="allIndent">
					<!--所有订单-->
					<div style="display:none;">
						<form id="User_Form" class="update_from" style="width:600px; height:320px;"></form>
					</div>
					<table id="dg"></table>
				</div>
			</div>
		</div>
		<!--所有订单-->
		<!--卡类订单-->
		<div class="standMessage tabToggleOrder" style="display: none;">
			<div class="messages">
				<div class="tc-15-calendar-select">
					<input class="tc-15-simulate-select m" id="config-demo-2">
					<button class="searchImg">
						<img src="/Public/Admin/images/saleImgs/search01.png" />
					</button>
				</div>
				<!--表格-->
				<div class="allIndent">
					<!--卡类订单-->
					<table id="dgg"></table>
				</div>
				<!--表格-->

			</div>
		</div>
		<!--卡类订单-->
		<!--合约产品-->
		<div class="tabToggleOrder" style="display: none;">
			<div class="messages">
				<div class="tc-15-calendar-select">
					<input class="tc-15-simulate-select m" id="config-demo-3">
					<button class="searchImg">
						<img src="/Public/Admin/images/saleImgs/search01.png" />
					</button>
				</div>
				<!--表格-->
				<div class="allIndent">
					<!--合约产品-->
				</div>
				<!--表格-->
				<div class="all-select">
					<div class="all-check"></div>
					<div class="turnPage"></div>
				</div>
			</div>
		</div>
		<!--合约产	品-->
	</div>
</div>

<script>
	$(function() {
		$("#dg").datagrid({
			url : "<?php echo U('UserCenter/orderlist');?>",
			fit : false,
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
				title : '订单号',
				width : 200,
				sortable : true
			}, {
				field : 'consignee',
				title : '收货人',
				width : 100,
				sortable : true
			}, {
				field : 'add_time',
				title : '下单时间',
				width : 150,
				sortable : true
			}, {
				field : 'mobile',
				title : '收货人联系电话',
				width : 100,
				sortable : true
			}, {
				field : 'goods_amount',
				title : '总金额',
				width : 100,
				sortable : true
			}, {
				field : 'shipping_name',
				title : '配送方式',
				width : 130,
				sortable : true
			}, {
				field : 'pay_status',
				title : '付款状态',
				width : 130,
				sortable : true
			}, {
				field : 'shipping_status',
				title : '发货状态',
				width : 100,
				sortable : true
			}, {
				field : 'order_status',
				title : '订单状态',
				width : 100,
				sortable : true
			}, {
				field : 'operate',
				title : '操作',
				width : 170
			} ] ]
		});

		 /* $("#dgg").datagrid({
			url : "<?php echo U('UserCenter/orderlist');?>",
			fit : false,
			striped : true,
			border : false,
			pagination : true,
			pageSize : 20,
			pageList : [ 10, 20, 50 ],
			pageNumber : 1,
			sortName : 'order_id',
			sortOrder : 'desc',
			singleSelect : true,
			columns : [ [ {
				field : 'order_sn',
				title : '订单号',
				width : 200,
				sortable : true
			}, {
				field : 'consignee',
				title : '收货人',
				width : 100,
				sortable : true
			}, {
				field : 'add_time',
				title : '下单时间',
				width : 150,
				sortable : true
			}, {
				field : 'mobile',
				title : '收货人联系电话',
				width : 100,
				sortable : true
			}, {
				field : 'goods_amount',
				title : '总金额',
				width : 100,
				sortable : true
			}, {
				field : 'shipping_name',
				title : '配送方式',
				width : 130,
				sortable : true
			}, {
				field : 'pay_status',
				title : '付款状态',
				width : 130,
				sortable : true
			}, {
				field : 'shipping_status',
				title : '发货状态',
				width : 100,
				sortable : true
			}, {
				field : 'order_status',
				title : '订单状态',
				width : 100,
				sortable : true
			}, {
				field : 'operate',
				title : '操作',
				width : 170
			} ] ]
		}); */
	})
</script>
<!-- <script src="/Public/Admin/js/jsAddress.js"></script> -->
<script src="/Public/Admin/js/daterangepicker.js"></script>
<script src="/Public/Admin/js/salesCenter.js"></script>