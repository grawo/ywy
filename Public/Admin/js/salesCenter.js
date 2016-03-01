$('.menu-list').find('dd').click(function(){
	$(this).addClass('menu-two').siblings().removeClass('menu-two');
	$.each($('.menu-list').find('dd'), function(i,e) {
		$(e).find('a').removeClass('menu-active');
	});
	$(this).find('a').addClass('menu-active');
	//图标
	$($('.menu-list').find('i')[0]).css('background-position','0px 0');
	$($('.menu-list').find('i')[1]).css('background-position','-25px 0');
	$($('.menu-list').find('i')[2]).css('background-position','-51px 0');
	$($('.menu-list').find('i')[3]).css('background-position','-77px 0');
	$($('.menu-list').find('i')[4]).css('background-position','-103px 0');
	$($('.menu-list').find('i')[5]).css('background-position','-128px 0');
	$($('.menu-list').find('i')[6]).css('background-position','-153px 0');
	if($(this).index() == 0){
		$(this).find('i').css('background-position','-183px 0');
	}else if($(this).index() == 1){
		$(this).find('i').css('background-position','-208px 0');
	}else if($(this).index() == 2){
		$(this).find('i').css('background-position','-234px 0');
	}else if($(this).index() == 3){
		$(this).find('i').css('background-position','-260px 0');
	}else if($(this).index() == 4){
		$(this).find('i').css('background-position','-286px 0');
	}else if($(this).index() == 5){
		$(this).find('i').css('background-position','-311px 0');
	}else if($(this).index() == 6){
		$(this).find('i').css('background-position','-336px 0');
	}
	//主div
	$('.mainDiv').hide();
	$($('.mainDiv')[$(this).index()]).show();
});
var n = 0;
$('.btn-fold-menu').click(function(){
	n++;
	if(n == 1){
		$('.aside,.menu-list dd').css('width','0px');
		$('h2').first().hide();
		$('.retract').show();
		//$('.main').css('left','0px','');
		$('.main').css({'left':'0px','padding-left':'30px'});
		n = -1;
	}else{
		$('.aside').css('width','200px');
		$('.menu-list dd').css('width','199px');
		$('h2').first().show();
		$('.retract').hide();
		$('.main').css({'left':'200px','padding-left':'0px'});
	}
});

//站内信切换
$('.helpCenter-li').click(function(){
	$(this).addClass('activeHelp').siblings().removeClass('activeHelp');
});

//全选
	var flag = true;
	$('.allChecked').click(function(){
		if(flag){
			$.each($('.hgcheckbox'), function(i,e) {
				e.checked = true;
			});
			flag = false;
		}else{
			$.each($('.hgcheckbox'), function(i,e) {
				e.checked = false;
			});
			flag = true;
		}
		getAllMoney()
	});
	$('.smallCheck').click(function(){
		var tt = $('.smallCheck');
		var flags = true;
		for(var i=0;i<tt.length;i++){
			if(!tt[i].checked){
				flags = false;//未选中
				flag = true;
			}
		}
		$.each($('.allChecked'), function(i,e) {
			if(flags){
				e.checked = true;
			}else{
				e.checked = false;
			}
		});
		getAllMoney()
	});
	//全选
	//删除选中商品
	$('.remove-batch').click(function(){
		var tt = $('.smallCheck');
		for(var i=0;i<tt.length;i++){
			if(tt[i].checked){
				$('.smallCheck').length > 1 ? $(tt[i]).parents('.cart-list').remove() : alert('至少要留一个哦！');
			}
		}
		getAllMoney();
	});
	
//帮助中心切换
$('.helpCenter-li').click(function(){
	$(this).addClass('activeHelp').siblings().removeClass('activeHelp');
	$($('.tabToggleMy')[$(this).index()]).show().siblings().hide();
});
//数据切换
$('.data-li').click(function(){
	$(this).addClass('activeHelp').siblings().removeClass('activeHelp');
	$($('.standMessages')[$(this).index()]).show().siblings().hide();
});

$('.datum-li').click(function(){
	$(this).addClass('activeHelp').siblings().removeClass('activeHelp');
	$($('.datum-table')[$(this).index()]).show().siblings().hide();
});

//订单中心
$('.purchase-li').click(function(){
	$(this).addClass('activeHelp').siblings().removeClass('activeHelp');
	$($('.tabToggleOrder')[$(this).index()]).show().siblings().hide();
});
$('#config-demo-1').daterangepicker({lang:'ch'}, function(start, end, label) {});
$('#config-demo-2').daterangepicker({lang:'ch'}, function(start, end, label) {});
$('#config-demo-3').daterangepicker({lang:'ch'}, function(start, end, label) {});
$('#config-demo-4').daterangepicker({lang:'ch'}, function(start, end, label) {});