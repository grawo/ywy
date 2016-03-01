<?php if (!defined('THINK_PATH')) exit();?><div class="right_box">
  <?php if(is_array($LeftMenu)): $i = 0; $__LIST__ = $LeftMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl id="Left_<?php echo ($vo['id']); ?>_box">
      <dt><i><?php echo ($vo['title']); ?></i></dt>
      <dd>
        <ul>
          <?php if(is_array($vo['children'])): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><a href="JavaScript:void(0);" 
          	onclick="<?php if($vo2['show_type'] == 0 ): ?>LeftMenuClick('<?php echo ($vo2['name']); ?>',
          					  '<?php echo ($vo2['title']); ?>',
          					  '<?php echo ($vo2['url']); ?>',
          					  '<?php echo ($vo2['icon']); ?>')
            <?php else: ?>
            LeftMenuClick_IF('<?php echo ($vo2['name']); ?>',
            				  '<?php echo ($vo2['title']); ?>',
            				  '<?php echo ($vo2['url']); ?>',
            				  '<?php echo ($vo2['icon']); ?>')<?php endif; ?>
            ">
            <li><i class="icon iconfont <?php echo ($vo2['icon']); ?>"></i>
            <?php echo ($vo2['title']); ?>
            </li>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </dd>
    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<ul class="left_box">
  <?php if(is_array($LeftMenu)): $i = 0; $__LIST__ = $LeftMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="JavaScript:void(0);" 
  		id="Left_<?php echo ($vo['id']); ?>_nav" 
  		title="<span style='color:#fff;line-height:38px;'><?php echo ($vo['title']); ?></span>" 
  		class="Left_nav" 
  		onclick="LeftMenu('<?php echo ($vo['id']); ?>')">
    <li><i class="icon iconfont <?php echo ($vo['icon']); ?>"></i></li>
    </a><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<script>
$(document).ready(function(){
$(".left_box li:eq(0)").addClass("selected");
$(".right_box dl:eq(0)").addClass("selected");
$('.Left_nav').tooltip({
	position: 'right',
	deltaX:-12,
	deltaY:0,
	onShow: function(){
		$(this).tooltip('tip').css({
			backgroundColor: '#2b394a',
			borderColor: '#2b394a'
		});
	}
});
})
</script>