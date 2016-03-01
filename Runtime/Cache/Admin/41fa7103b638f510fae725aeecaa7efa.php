<?php if (!defined('THINK_PATH')) exit();?><div class="helpCenter">
	<div class="helpCenter-title">
		<ul class="list-inline list-unstyled">
			<li class="activeHelp order-li"><a href="javascript:void(0);">我的客户</a>
			</li>
		</ul>
	</div>
	<div class="helpContent">
		<!--卡类订单-->
		<div class="standMessage tabToggleOrder">
			<div class="messages">
				<div class="client-form">
					<form action="/index.php/Admin/UserCenter/customer" method="post">
						<label class="client-label fl"> 客户的姓名： </label> <input type="text"
							class="client-name fl" name="kehu_name" value="<?php echo ($params["kehu_name"]); ?>" /> <label
							class="client-label fl"> 电话号码： </label> <input type="text"
							class="client-name fl" name="mobile_phone" value="<?php echo ($params["mobile_phone"]); ?>"/> <label class="client-label fl">
							会员名： </label> <input type="text" class="client-name fl" name="vip_number" value="<?php echo ($params["vip_number"]); ?>"/>

						<button class="searchImg fl clientBtn">
							<img src="/Public/Admin/images/saleImgs/search01.png">
						</button>
					</form>
					<button class="add-client">
						<span class="add-span">+</span> 添加新客户
					</button>
					<div id="win" class="easyui-window" title="添加客户"
						style="width: 600px; height: 400px"
						data-options="iconCls:'icon-save',modal:true" closed="true">
						<form action="/index.php/Admin/UserCenter/add_customer" method="post">
							<table>
								<tr>
									<th style="padding: 10px 5px 10px 25px; width: 100px;">客户姓名：</th>
									<td style="width: 198px; padding: 10px 5px 10px 20px;"><input
										type="text" name="kehu_name"
										style="height: 30px; width: 198px;" /></td>
								</tr>
								<tr>
									<th style="padding: 10px 5px 10px 25px; width: 100px;">会员号：</th>
									<td style="width: 198px; padding: 10px 5px 10px 20px;"><input
										type="text" name="vip_number"
										style="height: 30px; width: 198px;" /></td>
								</tr>
								<tr>
									<th style="padding: 10px 5px 10px 25px; width: 100px;">手机号：</th>
									<td style="width: 198px; padding: 10px 5px 10px 20px;"><input
										type="text" name="mobile_phone"
										style="height: 30px; width: 198px;" /></td>
								</tr>
								<tr>
									<th style="padding: 10px 5px 10px 25px; width: 100px;">联系地址：</th>
									<td style="width: 198px; padding: 10px 5px 10px 20px;"><input
										type="text" name="address" style="height: 30px; width: 198px;" /></td>
								</tr>
								
								<tr>
									<th style="padding: 10px 5px 10px 25px; width: 100px;">备注：</th>
									<td style="width: 198px; padding: 10px 5px 10px 20px;"><textarea
											name="beizhu" rows="3" cols="30" /></textarea></td>
								</tr>
								<tr>
									<th></th>
									<td><input class="add-client" type="submit" value="确认添加"
										style="position: relative; top: 20px; left: -102px; width: 100px; padding: 0px;" /></td>
								</tr>

							</table>
						</form>


					</div>
				</div>
				<!--表格-->
				<div class="client-table">
					<table class="table table-bordered">
						<tr>
							<th>客户姓名</th>
							<th>会员号</th>
							<th>手机号</th>
							<th>联系地址</th>
							<th>成交单数</th>
							<th>备注</th>
						</tr>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$datas): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($datas["kehu_name"]); ?></td>
							<td><?php echo ($datas["vip_number"]); ?></td>
							<td><?php echo ($datas["mobile_phone"]); ?></td>
							<td><?php echo ($datas["address"]); ?></td>
							<td><?php echo ($datas["orders"]); ?></td>
							<td><?php echo ($datas["beizhu"]); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>

					</table>
				</div>
				<!--表格-->
				<div class="all-select">
					<div class="all-check"></div>
					<div class="turnPage">
						<div class="page-right">
							<a href="javascript:void(0);" title="第一页"
								class="tc-15-page-first"></a> <a href="javascript:void(0);"
								title="上一页" class="tc-15-page-pre"></a>
							<div class="tc-15-page-select">
								<a href="javascript:void(0);" class="tc-15-page-num"> 5/20 </a>
							</div>
							<a href="javascript:void(0);" title="下一页" class="tc-15-page-next"></a>
							<a href="javascript:void(0);" title="最后一页"
								class="tc-15-page-last"></a>&nbsp;&nbsp;&nbsp;&nbsp; <span
								class="tc-15-page-text">跳转至第</span> <input type="text"
								class="page-input" value="12" /> <span>页</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--卡类订单-->
	</div>
</div>
<script>
	$(function() {
		$('.add-client').click(function() {
			$('#win').window('open');
		})
	});
</script>