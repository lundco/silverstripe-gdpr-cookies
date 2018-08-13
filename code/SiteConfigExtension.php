<?php

namespace Lundco\SilverstripeGDPRCookies;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{
    private static $has_one = [
    	'PrivacyPolicyLink' => SiteTree::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Policies', FieldList::create(array(
            TreeDropdownField::create('PrivacyPolicyLinkID', _t('Lundco_GDPR_PrivacyCenter.PrivacyPolicyLink', 'Privacy Policy Link'), SiteTree::class),
        )));
    }
}
