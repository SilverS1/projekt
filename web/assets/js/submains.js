$(document).ready(function() {

	$('.submain-title-wrapper h5').on('click', function() {

		var submainWrapper = $('.submain-title-wrapper');

		if($(submainWrapper).hasClass("open")) {

			$(submainWrapper).next().slideUp('slow');
			$(submainWrapper).toggleClass("open");

		} else {
			
			$(submainWrapper).next().slideDown('slow');
			$(submainWrapper).toggleClass("open");
		}

	});
});