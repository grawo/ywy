<?php if (!defined('THINK_PATH')) exit();?><div style="margin: 10px 0 0 0"></div>
		<div class="easyui-tabs" style="width:80%;height:600px">
			<div title="基本资料" style="padding:10px">
			<ul>
					<li>
						<p style="margin-bottom: 35px;">业务员头像：</p>
						<span><img class="doubi" src="/Uploads/<?php echo ($data["img"]); ?>" /></span>
					</li>
					<li>
						<p>业务员编码：</p>
						<span><?php echo ($data['user_code']); ?></span>
					</li>
					<li>
						<p>姓名：</p>
						<span><?php echo ($data['user_name']); ?></span>
					</li>
					<li>
						<p>区域：</p>
						<span><?php echo ($data['note']); ?></span>
					</li>
					<li>
						<p>部门：</p>
						<span><?php echo ($data['name']); ?></span>
					</li>
					<li>
			</ul>
			</div>
			<div title="个人信息" style="padding:10px">
				<ul>
					<form action="<?php echo U('UserCenter/update');?>" method="post">
					<li>
						<p>手机号码：</p>
						<input type="tel" class="form-control" name="mobile_phone" placeholder="请输入手机号" value="<?php echo ($data["mobile_phone"]); ?>">
					</li>
					<li>
						<p class="sr">生日：</p>
						<input type="date" class="form-control" name="birthday">
					</li>
					<li>
						<p class="sr">地址：</p>
						<input type="text" class="form-control" name="address">
					</li>
					<li>
						<p class="sr">邮箱：</p>
						<input type="email" class="form-control" name="email">
					</li>
					<li>
						<p class="sr">微信：</p>
						<input type="text" class="form-control" name="weixin">
					</li>
					<li>
						<p>QQ帐号：</p>
						<input type="text" class="form-control" name="qq">
					</li>
					<li>
						<p>个人简介：</p>
						<textarea name="introduce" id="" cols="45" rows="7" placeholder="至少50字" style="margin: 5px 0 0 100px; border: 1px solid #ffd7d7;"></textarea>
					</li>
					<li>
						<input class="btn btn3" type="submit" value="保存修改">
					</li>
					</form>
				</ul>
			</div>
			<div title="更改密码" style="padding:10px">
						<form action="<?php echo U('UserCenter/modifyPwd');?>" method="post">
								<p>原密码：</p>
								<input type="password" class="form-control" name="password" placeholder="请输入原密码">
						
					
								<p>新密码：</p>
								<input type="password" class="form-control" name="pwd1" placeholder="请输入新密码">
			
						
								<p>确认密码：</p>
								<input type="password" class="form-control" name="pwd2" placeholder="请确认新密码">
						
							<input type="submit" class="btn btn2" value="确认修改" />
						</form>
				
			
		</div>
</div>