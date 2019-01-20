<?php

namespace Lundco\SilverStripe\GdprCookies\Controllers;

use Lundco\SilverStrioe\GdprCookies\Model\Consent;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Cookie;

class Consent_Controller extends Controller
{

    private static $allowed_actions = array(
        'update',
        'save'
    );

    public function save()
    {
        $hash = Cookie::get('GDPRToken');
        $consent = Consent::get()->filter('UID', $hash)->first();

        if(!$consent){
            $consent = Consent::create();
        }

        $consent->PerformanceCookies = Cookie::get('performanceCookies');
        $consent->FunctionalCookies = Cookie::get('functionalCookies');
        $consent->TargetingCookies = Cookie::get('targetingCookies');
        $consent->Policies = Cookie::get('GDPRAcceptedPolicyVersions');
        $consent->UID = $hash;
        $consent->AnonIP = $this->getIP();
        $consent->write();

        Cookie::set('GDPRToken', $hash, 365,null,null,false,false);

        return true;
    }

    public function getIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        }elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        }else {
            $ip = $remote;
        }

        return substr($ip, 0, -3) . 'XXX';
    }
}
