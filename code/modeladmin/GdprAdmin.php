<?php

class GdprAdmin extends ModelAdmin{
	private static $managed_models = array(
		'Policy',
		'Consent',
		'ForgetRequest'
	);

	private static $url_segment = 'gdpradmin';

	private static $menu_title = 'GDPR info';

	private static $menu_icon = 'privacycenter/img/cookie.svg';
}
