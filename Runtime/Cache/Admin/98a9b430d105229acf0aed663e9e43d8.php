<?php if (!defined('THINK_PATH')) exit();?><table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<?php if(is_array($Form)): $i = 0; $__LIST__ = $Form;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$FormShow): $mod = ($i % 2 );++$i;?><tr>
		<th><?php echo ($FormShow['title']); ?> : </th>
		<td><?php echo ($FormShow['form']); if(!empty($$FormShow['remark'])): ?><div class="f_tip"><?php echo ($FormShow['remark']); ?></div><?php endif; ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>