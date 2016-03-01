<?php if (!defined('THINK_PATH')) exit();?><h2 class="h_a">系统信息</h2>
<table border="0" cellpadding="0" cellspacing="0" class="update_from" style="width:100%">
<?php if(is_array($server_info)): $i = 0; $__LIST__ = $server_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
<th><?php echo ($key); ?> : </th>
<td><?php echo ($vo); ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<h2 class="h_a">开发团队</h2>
<table border="0" cellpadding="0" cellspacing="0" class="update_from" style="width:100%">
<tr><th>版权所有 : </th><td><a href="<?php echo C('GMS_SITE');?>" target="_blank"><?php echo C('GMS_NAME');?></a></span></td></tr>
<tr><th>负责人 : </th><td><?php echo C('GMS_NAME');?></td></tr>
<tr><th>版权所有 : </th><td><a href="<?php echo C('GMS_AUTHOR_SITE');?>" target="_blank"><?php echo C('GMS_AUTHOR');?></a></td></tr>
<tr><th>联系邮箱 : </th><td><?php echo C('GMS_AUTHOR_EMAIL');?></td></tr>
</table>