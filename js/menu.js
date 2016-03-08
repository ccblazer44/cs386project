jQuery(document).ready(function() {
	jQuery('.toggle-nav').click(function(e) {
			jQuery(this).toggleClass('active');
			jQuery('#main-nav ul').toggleClass('active');
			e.preventDefault();
	});
});
