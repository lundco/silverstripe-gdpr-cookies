<?php

class GdprAdmin extends ModelAdmin{
	private static $managed_models = array(
		'Policy',
		'Consent'
	);

	private static $url_segment = 'gdpradmin';

	private static $menu_title = 'GDPR info';

	private static $menu_icon = 'privacycenter/img/cookie.svg';

	public function getEditForm($id = null, $fields = null)
	{
		$form = parent::getEditForm($id, $fields);

		$member = $form->Fields()->fieldByName('Consent');
		if($member){
			$member->getConfig()->removeComponentsByType('GridFieldEditButton');
			$member->getConfig()->removeComponentsByType('GridFieldAddNewButton');
			$member->getConfig()->removeComponentsByType('GridFieldDeleteAction');
		}

		return $form;
	}
}
