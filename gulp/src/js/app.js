jQuery(document).ready(function($){

	$('.nav-toggle').click(function(){
		$(this).children().toggleClass('active');
		$('.flyout-nav').slideToggle();
	});

});