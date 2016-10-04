jQuery(document).ready(function ($) {

	// Tabs
	$('.nav-tab-wrapper').each(function() {
		$(this).find('a').each(function(i) {
			$(this).click(function(){
				$(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active')
				.parents('#wpbody').find('div.panel').hide().end().find('div.panel:eq('+i+')').fadeIn(150);
				return false;
			});
		});
	});

	// FitVids
	$(".arrayvideo").fitVids();

});