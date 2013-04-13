(function($) {$.fn.assignDirectors = function(params) {

	if (params == undefined) params = {};

	return this.each(function(){

		var widget = $(this);
		if (!widget.hasClass('is-plugin')) {
			widget.addClass('is-plugin');

			if ((params.assignAjaxUrl!=undefined)) {

				widget.delegate('.ajax-assign','click',function(){

					var form = $(this).closest('.assign-form');
					if (form.length) {

						var directorIdElement = form.find('[name="director_id"]');
						if (directorIdElement.length) {
							$.post(params.assignAjaxUrl,
								{ managerId: form.data('manager-id'), directorId:directorIdElement.val() },
								function(){
									widget.find('.grid-view').yiiGridView('update');
								}
							);

						}
					}
				});
			}

		}
	});

};})(jQuery);
