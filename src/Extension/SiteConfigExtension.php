<?php

namespace Lundco\Silverstripe\GDPRCookies\Extension;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;
use Lundco\SilverStripe\GdprCookies\Model\Consent;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;

class SiteConfigExtension extends DataExtension
{
    private static $has_one = array(
        'PrivacyPage' => \Page::class,
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.GDPR', [
            TreeDropdownField::create('PrivacyPageID', 'Privacy/Cookies info', SiteTree::class),
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
