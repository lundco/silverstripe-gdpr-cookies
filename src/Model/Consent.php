<?php

namespace Lundco\SilverStrioe\GdprCookies\Model;

use Lundco\SilverStripe\GdprCookies\Model\Policy;
use SilverStripe\ORM\DataObject;

class Consent extends Dataobject
{

    private static $table_name = 'SilverStripe_Gdpr_Consent';

    private static $db = array(
        'UID'                => 'Varchar',
        'PerformanceCookies' => 'Boolean',
        'FunctionalCookies'  => 'Boolean',
        'TargetingCookies'   => 'Boolean',
        'Policies'           => 'Varchar',
        'AnonIP'             => 'Varchar'
    );

    private static $summary_fields = array(
        'UID'                => 'GDPR Token ID',
        'LastEdited'         => 'GDPR Accepted',
        'AnonIP'             => 'IP',
        'PerformanceCookies' => 'Performance',
        'FunctionalCookies'  => 'Functional',
        'TargetingCookies'   => 'Targeting',
        'listPolicies'       => 'Accepted Policies'
    );

    private static $defaults = [
        'PerformanceCookies' => false,
        'FunctionalCookies'  => false,
        'TargetingCookies'   => false
    ];

    public function getPerformanceCookiesState()
    {

        if ($this->PerformanceCookies) {
            return 'Active';
        }

        return 'Disabled';
    }

    public function getFunctionalCookiesState()
    {
        if ($this->FunctionalCookies) {
            return 'Active';
        }

        return 'Disabled';
    }

    public function getTargetingCookiesState()
    {
        if ($this->TargetingCookies) {
            return 'Active';
        }

        return 'Disabled';
    }

    public function listPolicies()
    {
        $policies = json_decode($this->getField('Policies'));
        $list = '';

        if ($policies) {
            foreach ($policies as $key => $policy) {
                $data = Policy::get()->byID($key);
                $version = $data->PolicyVersions()->filter('ID', $policy)->first();
                $list .= $data->Title . ' - V.' . $version->VersionCount . ',';
            }
        }

        return $list;
    }
}
