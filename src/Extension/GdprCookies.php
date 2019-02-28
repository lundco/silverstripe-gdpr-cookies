<?php
namespace Lundco\SilverStripe\GdprCookies\Extension;

use SilverStripe\Control\Cookie;
use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

class GdprCookies extends DataExtension
{

    public function onAfterInit()
    {
        Requirements::javascript('lundco/silverstripe-gdpr-cookies: js/min/main.js');
        Requirements::css('lundco/silverstripe-gdpr-cookies: css/main.css');

        // Always include GTM. Scripts and events are fired based on cookie settings.
        $this->includeGTM();
    }

    public function PrivacyCenter()
    {
        $config = Config::inst();

        $strictlyConfig = $config->get('PrivacyCenter', 'StrictlyCookies');
        $strictlyCookies = array();

        if($strictlyConfig){
            foreach ($strictlyConfig as $item) {
                array_push($strictlyCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $performanceConfig = $config->get('PrivacyCenter', 'PerformanceCookies');
        $performanceCookies = array();
        if($performanceConfig){
            foreach ($performanceConfig as $item) {
                array_push($performanceCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $functionalConfig = $config->get('PrivacyCenter', 'FunctionalCookies');
        $functionalCookies = array();
        if($functionalConfig){
            foreach ($functionalConfig as $item) {
                array_push($functionalCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $targetingConfig = $config->get('PrivacyCenter', 'TargetingCookies');
        $targetingCookies = array();
        if($targetingConfig){
            foreach ($targetingConfig as $item) {
                array_push($targetingCookies, ArrayData::create(['Text' => $item]));
            }
        }

        $googleTagID = $config->get('PrivacyCenter', 'TagID');

        return $this->owner->customise(array(
            'StrictlyCookies' => ArrayList::create($strictlyCookies),
            'PerformanceCookies' => ArrayList::create($performanceCookies),
            'FunctionalCookies' => ArrayList::create($functionalCookies),
            'TargetingCookies' => ArrayList::create($targetingCookies),
            'TagID' => $googleTagID[0]
        ))->renderWith('PrivacyCenter');
    }

    public function CookiePopup(){

		if(!Cookie::get('GDPRToken')){
			$hash = sha1(microtime());
			Cookie::set('GDPRToken', $hash, 365,null,null,false,false);
			Cookie::set('performanceCookies', 'pending', 365,null,null,false,false);
			Cookie::set('functionalCookies', 'pending', 365,null,null,false,false);
			Cookie::set('targetingCookies', 'pending', 365,null,null,false,false);
		}

		$config = Config::inst();

		$strictlyConfig = $config->get('PrivacyCenter', 'StrictlyCookies');
		$strictlyCookies = array();

		if($strictlyConfig){
			foreach ($strictlyConfig as $item) {
				array_push($strictlyCookies, ArrayData::create(['Text' => $item]));
			}
		}

		$performanceConfig = $config->get('PrivacyCenter', 'PerformanceCookies');
		$performanceCookies = array();
		if($performanceConfig){
			foreach ($performanceConfig as $item) {
				array_push($performanceCookies, ArrayData::create(['Text' => $item]));
			}
		}

		$functionalConfig = $config->get('PrivacyCenter', 'FunctionalCookies');
		$functionalCookies = array();
		if($functionalConfig){
			foreach ($functionalConfig as $item) {
				array_push($functionalCookies, ArrayData::create(['Text' => $item]));
			}
		}

		$targetingConfig = $config->get('PrivacyCenter', 'TargetingCookies');
		$targetingCookies = array();
		if($targetingConfig){
			foreach ($targetingConfig as $item) {
				array_push($targetingCookies, ArrayData::create(['Text' => $item]));
			}
		}

		$privacyLink = '';

		if(SiteConfig::get()->first()->PrivacyPage){
		    $privacyLink = SiteConfig::get()->first()->PrivacyPage->Link();
        }

    	//Remember to include services used
		$page = $this->owner->customise([
			'isNotGoogleBot' => $this->isNotGoogleBot(),
			'EssentialCookies' => ArrayList::create($strictlyCookies),
			'PerformanceCookies' => ArrayList::create($performanceCookies),
			'FunctionalCookies' => ArrayList::create($functionalCookies),
			'TargetingCookies' => ArrayList::create($targetingCookies),
            'CookiesLink' => $privacyLink
		]);

		return $page->renderWith('CookiePopup');
    }

	public static function isNotGoogleBot()
	{
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(strpos($ua,'googlebot') === false && strpos($ua,'mediapartners-google') === false)return true;
		return false;
	}

    protected function includeGTM()
    {
        $config = Config::inst();
        $googleTagID = $config->get('PrivacyCenter', 'TagID');

        // Inject GTM script
        Requirements::insertHeadTags("<!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','".$googleTagID[0]."');</script>
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
