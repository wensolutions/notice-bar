jQuery( function( $ ){

	$( "#nb-admin-settings-form" ).validate({

		rules: {
			'_nb_plugin_settings[theme_default_settings][message]': "required",
			'_nb_plugin_settings[theme_default_settings][font_size]': {
				
				required: true,
				number: true,
				min: 1

			}
		}

	});

});