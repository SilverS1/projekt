$(document).ready(function() {
	// $('.submain-title').on('click', function() {
	// 	if($(this).hasClass('open')) {
	// 		$(this).next().slideUp();
	// 	} else {
	// 		$(this).addClass('open');
	// 		$(this).next().slideDown();
	// 	}
	// });

	$('.submain-title').on('click', function() {

		if($(this).hasClass("open")) {
			$(this).next().slideUp('slow');
			$(this).toggleClass("open");
			// $(this).next().not("p:last-of-type").toggleClass("border-bottom")
			// if($(this).next().is("p:last-of-type")) {
			// 	$(this).css("border-bottom", "none");
			// }
		} else {
			$(this).next().slideDown('slow');
			$(this).toggleClass("open");
			// $(this).next().not("p:last-of-type").toggleClass("border-bottom")
			// if($(this).next().is("p:last-of-type")) {
			// 	$(this).css("border-bottom", "1px solid black");
			// }
		}

	});
});