<?php

namespace Lundco\SilverstripeGDPRCookies;

use SilverStripe\Control\Cookie;
use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

class PrivacyCenterExtension extends DataExtension
{

    /**
     * On After init, based on config, include CookiePolicy items.
     */
    public function onAfterInit()
    {
        Requirements::javascript('lundco/silverstripe-gdpr-cookies:js/min/main.js');
        Requirements::css('lundco/silverstripe-gdpr-cookies:css/main.css');

        // Always include GTM. Scripts and events are fired based on cookie settings.
        //$this->includeGTM();
    }

    /**
     * @return string | Silverstripe rendered template
     */
    public function PrivacyCenter()
    {
        $config = Config::inst();

        $strictlyConfig = $config->get('Lundco\SilverstripeGDPRCookies\PrivacyCenter', 'StrictlyCookies');
        $strictlyCookies = array();

        if($strictlyConfig){
            foreach ($strictlyConfig as $item) {
                array_push($strictlyCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $performanceConfig = $config->get('Lundco\SilverstripeGDPRCookies\PrivacyCenter', 'PerformanceCookies');
        $performanceCookies = array();
        if($performanceConfig){
            foreach ($performanceConfig as $item) {
                array_push($performanceCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $functionalConfig = $config->get('Lundco\SilverstripeGDPRCookies\PrivacyCenter', 'FunctionalCookies');
        $functionalCookies = array();
        if($functionalConfig){
            foreach ($functionalConfig as $item) {
                array_push($functionalCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $targetingConfig = $config->get('Lundco\SilverstripeGDPRCookies\PrivacyCenter', 'TargetingCookies');
        $targetingCookies = array();
        if($targetingConfig){
            foreach ($targetingConfig as $item) {
                array_push($targetingCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $GoogleTagID = $config->get('Lundco\SilverstripeGDPRCookies\PrivacyCenter', 'TagID');

        return $this->owner->customise(array(
            'StrictlyCookies' => ArrayList::create($strictlyCookies),
            'PerformanceCookies' => ArrayList::create($performanceCookies),
            'FunctionalCookies' => ArrayList::create($functionalCookies),
            'TargetingCookies' => ArrayList::create($targetingCookies),
            'TagID' => $GoogleTagID[0]
        ))->renderWith('Lundco\SilverstripeGDPRCookies\PrivacyCenter');
    }

    /**
     * @return string | Silverstripe rendered template
     */
    public function CookiePopup(){
        if(!$this->accepted()){
            $privacysnippet = new ArrayData([]);
            $page = $this->owner->customise(array('CookiePopup' => $privacysnippet));
            return $page->renderWith('Lundco\SilverstripeGDPRCookies\CookiePopup');
        }
    }

    protected function includeGTM()
    {
        $config = Config::inst();
        $GoogleTagID = $config->get('Lundco\SilverstripeGDPRCookies\PrivacyCenter', 'TagID');

        // Inject GTM script
        Requirements::insertHeadTags("<!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','".$GoogleTagID[0]."');</script>
            <!-- End Google Tag Manager -->
            ");

    }

    /**
     * @return bool
     */
    public static function accepted()
    {
        // must check for string values, using filter_var.
        return filter_var(Cookie::get('cookie_decided'), FILTER_VALIDATE_BOOLEAN);
    }

}
