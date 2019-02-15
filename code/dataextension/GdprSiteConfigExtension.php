<?php

class GdprSiteConfigExtension extends DataExtension
{

	private static $has_one = array(
		'PrivacyPage' => 'Page',
	);

	public function updateCMSFields(FieldList $fields)
	{
            $fields->addFieldsToTab('Root.GDPR', [
                TreeDropdownField::create('PrivacyPageID', 'Privacy/Cookies info', 'SiteTree'),
            ]);

        $fields->addFieldsToTab('Root.GDPR', FieldList::create(array(
            $consents = GridField::create(
                'Consents',
                'Consents',
                Consent::get(),
                GridFieldConfig_RelationEditor::create()
            )
        )));

        $consents->getConfig()
            ->removeComponentsByType('GridFieldAddNewButton')
            ->removeComponentsByType('GridFieldDeleteAction')
            ->removeComponentsByType('GridFieldAddExistingSearchButton')
            ->removeComponentsByType('GridFieldAddExistingAutocompleter')
            ->removeComponentsByType('GridFieldEditButton');

        parent::updateCMSFields($fields);
	}

}
