<?php if (!defined('THINK_PATH')) exit();?><div class="slideTxtBox">
<div id="content" class="easyui-panel" title="">
	<div class="hd">
		<ul>
			<li class="on">收藏商品</li>
		</ul>
	</div>
	<div class="bd">
		<div class="bd-top">
			<input type="checkbox" class="hgcheckbox copy-input allChecked" name="allChecked"/>&nbsp;&nbsp;
			全选<a href="#" onclick="allDelete();">取消收藏</a>
		</div>
	</div>
	<div class="sp" name="sp">
       <ul id="spe">
			<?php if(is_array($data)): foreach($data as $key=>$vo): ?><li>
				<div class="aaan" id="aa">
					<a href="/index.php?controller=site&action=products&id=<?php echo ($vo["goods_id"]); ?>">					
					<input type="checkbox" class="hgcheckbox smallCheck" name="check" value="<?php echo ($vo["goods_id"]); ?>"> <img
						src="<?php echo ($vo["goods_thumb"]); ?>" alt="" width="180" height="180">
					</a>
					<div class="promo-words"><?php echo ($vo["goods_name"]); ?></div>
					<div class="p-price">
						￥<em class="number-hg"><?php echo ($vo["market_price"]); ?></em>
					</div>
					<div class="item-option clearfix">
						<button class="add-carts" onclick="Open_Dialog()" id="test">推广商品</button>
						<a href="javascript:void(0);" onclick="doDelete()" class="cancel">取消收藏</a>
					</div>
				</div>
			</li><?php endforeach; endif; ?>
		</ul>
	</div>
	</div>
	
</div>
<div id='a' class="easyui-pagination" closed="true" style="border:1px solid #ccc; margin-left:30px;"  
        data-options="   
            total: <?php echo ($total); ?>,   
            pageSize: 10, 
            onSelectPage: function(pageNumber, pageSize){
			 $('#content').panel('refresh','<?php echo U('UserCenter/goods/');?>&page='+pageNumber);
            }">  
		</div>
<script type="text/javascript" src="/Public/Admin/js/copyToClipboard.js"></script> 
<div id="mydialog" style="display:none;padding:5px;width:400px;height:100px;" title="链接复制">
	 <input type="text" name="text" id="text" style="width:320px;" />   
	 <a href="javascript:void(0)" id="dynamic">复制</a>  
		<label id="lbmsg" runat="server"></label> 
</div>
<script type="text/javascript"> 
	$(function(){
		$("#dynamic").click(function(){
		var Url=$("#text").text();
		copyToClipboard(Url);
		})
	})		
</script>
<!--<script src="/Public/Admin/js/jquery.min.js"></script>
<script src="/Public/Admin/js/moment.js"></script> -->
<script language="javascript" type="text/javascript"> 
function Open_Dialog() {
var obj=document.getElementsByName('check'); 
var s=''; 
for(var i=0; i<obj.length; i++){ 
if(obj[i].checked) {s+=obj[i].value;
$('input[name="check"]:checked').attr("checked", false);
}
} 
str = "/index.php?controller=site&action=products&id="+s;
$("#text").attr("value",str);
if(s==0){
	alert("你还没有选择任何内容！");
	document.getElementById('mydialog').style.display = "none";}
else{
$('#mydialog').show(); 
$('#mydialog').dialog({ 
collapsible: true, 
minimizable: true, 
maximizable: true, 

buttons: [{ 
text: '关闭', 
iconCls: 'icon-ok', 
handler: function() { 
$('#mydialog').window('close'); 
} 
}] 
}); 
}
}
</script> 
<script>
function doDelete(){
	
	var obj=document.getElementsByName('check'); 
	var s=''; 
	for(var i=0; i<obj.length; i++){ 
		if(obj[i].checked) 
		{
			s+=obj[i].value;
			$('input[name="check"]:checked').attr("checked", false);
		}
	} 
	if(s==0){
		alert("你还没有选择任何内容！");
		document.getElementById('mydialog').style.display = "none";}
	else{
		
		if (confirm("确认取消收藏")){
			$.ajax({                                                                                                                                                                      
				   url: "<?php echo U('UserCenter/delete_collection');?>",
				   type: "POST",
				   data: {id:s},
				   success: function(data){
					  $("#aa").remove();
					  alert("取消收藏成功!"); 
				   }
				});
		}	 
	}
}
</script>
<script>
function allDelete(){
	var obj=document.getElementsByName('check');
	var val = []
	for(i=0;i<obj.length;i++){
		if(obj[i].name=="check" && obj[i].checked == true){
			val[i]=obj[i].value;
		}
		
	}
	var ids = val.join(",");
	ids=ids.replace(new RegExp(',+',"gm"),',');
	if(val==0){
		alert("你还没有选择任何内容！");
		document.getElementById('mydialog').style.display = "none";}
	else{
		if (confirm("确认全部取消收藏")){
			$.ajax({                                                                                                                                                     
				   url: "<?php echo U('UserCenter/all_deletecollection');?>",
				   type: "POST",
				   data: {id:ids},
				   success: function(data){
					 var tt = $('.smallCheck');
					 for(var i=0;i<tt.length;i++){
						if(tt[i].checked){
							$(tt[i]).parents('.aaan').remove();
							}
						}
					  $('input[name="allChecked"]:checked').attr("checked", false);
					  alert("取消收藏成功!"); 
				   }
				});
		}
		 
	}
}
</script>