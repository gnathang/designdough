$('.cat-list_item').on('click', function () {
	console.log('Category:', $(this).data('slug'));
	console.log('Post Type:', $(this).data('post-type'));
	$('.cat-list_item').removeClass('active');
	$('.cat-list_item').closest('li').removeClass('active');

	$(this).addClass('active');
	$(this).closest('li').addClass('active');

	// Show loader before making AJAX request
	$('.loader').show();

	$.ajax({
		type: 'POST',
		url: '/wp-admin/admin-ajax.php',
		dataType: 'html',
		data: {
			action: 'filter_projects',
			category: $(this).data('slug'),
			post_type: $(this).data('post-type'),
		},
		success: function (res) {
			// Hide loader after receiving AJAX response
			$('.loader').hide();

			$('.posts_layout_wrapper').html(res);
			// Reinitialize functions after updating content
			// this is because we are not reloading the DOM, but still need to reboot onscreen js.
			initialiseCursors();
			initSlideShows();
			fadeInElement();
			onlyBrandDigitalTags();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			// Hide loader in case of AJAX error
			$('.loader').hide();
			initSlideShows();
			console.error('AJAX Error:', errorThrown);
		},
	});
});
