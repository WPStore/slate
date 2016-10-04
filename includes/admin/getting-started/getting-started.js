jQuery(document).ready(function ($) {

	//Tabs
	$('.inline-list-links').each(function() {
		$(this).find('li').each(function(i) {
			$(this).click(function(){
				$(this).addClass('current').siblings().removeClass('current')
				.parents('#wpbody').find('div.panel').hide().end().find('div.panel:eq('+i+')').fadeIn(150);
				return false;
			});
		});
	});

	// FitVids
	$(".arrayvideo").fitVids();

});