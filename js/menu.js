jQuery(document).ready(function() {
	jQuery('.toggle-nav').click(function(e) {
			jQuery(this).toggleClass('active');
			jQuery('#main-nav ul').toggleClass('active');

			if (jQuery(this).hasClass('active')){
				jQuery(this).html("&#10006;");
			} else {
				jQuery(this).html("&#9776;");
			}
			e.preventDefault();
	});
});
