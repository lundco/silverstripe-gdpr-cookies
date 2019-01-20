<?php

namespace Lundco\SilverStripe\GdprCookies\Admin;

use Lundco\SilverStrioe\GdprCookies\Model\Consent;
use Lundco\SilverStripe\GdprCookies\Model\Policy;
use SilverStripe\Admin\ModelAdmin;

class GdprAdmin extends ModelAdmin
{
    private static $managed_models = [
        Policy::class,
        Consent::class
    ];

    private static $url_segment = 'gdpradmin';

    private static $menu_title = 'GDPR info';

    private static $menu_icon = 'lundco/silverstripe-gdpr-cookies: img/cookie.svg';

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        $member = $form->Fields()->fieldByName('Consent');
        if ($member) {
            $member->getConfig()->removeComponentsByType('GridFieldEditButton');
            $member->getConfig()->removeComponentsByType('GridFieldAddNewButton');
            $member->getConfig()->removeComponentsByType('GridFieldDeleteAction');
        }

        return $form;
    }
}
