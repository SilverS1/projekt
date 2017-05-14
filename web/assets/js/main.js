$(document).ready(function() {

	$('.main-wrapper h3').on('click', function() {

		var mainWrapper = $(this).parent();

		if($(mainWrapper).hasClass("open")) {
			$(mainWrapper).find('p').slideUp('slow');
			$(mainWrapper).toggleClass("open");

		} else {
			$(mainWrapper).find('p').slideDown('slow');
			$(mainWrapper).toggleClass("open");
		}

	});
});