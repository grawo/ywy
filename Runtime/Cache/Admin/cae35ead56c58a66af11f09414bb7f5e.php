<?php if (!defined('THINK_PATH')) exit();?><div class="left_box_2">
  <?php if(is_array($LeftMenu)): $i = 0; $__LIST__ = $LeftMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl id="Left_<?php echo ($vo['id']); ?>_box">
      <dt><a href="JavaScript:void(0);" onclick="LeftMenuClick2('<?php echo ($vo['id']); ?>')"><i class="icon iconfont <?php echo ($vo['icon']); ?>"></i><i><?php echo ($vo['title']); ?></i></a></dt>
      <dd >
        <ul>
          <?php if(is_array($vo['children'])): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><a href="JavaScript:void(0);" onclick="<?php if($vo2['show_type'] == 0 ): ?>LeftMenuClick('<?php echo ($vo2['name']); ?>','<?php echo ($vo2['title']); ?>','<?php echo ($vo2['url']); ?>','<?php echo ($vo2['icon']); ?>')
            <?php else: ?>
            LeftMenuClick_IF('<?php echo ($vo2['name']); ?>','<?php echo ($vo2['title']); ?>','<?php echo ($vo2['url']); ?>','<?php echo ($vo2['icon']); ?>')<?php endif; ?>
            ">
            <li><i class="icon iconfont <?php echo ($vo2['icon']); ?>"></i><?php echo ($vo2['title']); ?></li>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </dd>
    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<script>
$(document).ready(function(){
	$(".left_box_2 dl:eq(0) dd").show();
})
</script>