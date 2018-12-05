<?php

class GdprCookies extends DataExtension
{

    public function onAfterInit()
    {
        Requirements::javascript('silverstripe-gdpr-cookies/js/min/main.js');
        Requirements::css('silverstripe-gdpr-cookies/css/main.css');

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

        $GoogleTagID = $config->get('PrivacyCenter', 'TagID');

        return $this->owner->customise(array(
            'StrictlyCookies' => ArrayList::create($strictlyCookies),
            'PerformanceCookies' => ArrayList::create($performanceCookies),
            'FunctionalCookies' => ArrayList::create($functionalCookies),
            'TargetingCookies' => ArrayList::create($targetingCookies),
            'TagID' => $GoogleTagID[0]
        ))->renderWith('PrivacyCenter');
    }

    public function CookiePopup(){
		//Set current policie versione as session
		$policies = Policy::get();
		$activePolicies = [];
		foreach ($policies as $policy){
			$active = $policy->PolicyVersions()->filter('Status','Published')->sort('VersionCount','DESC')->first();
			if($active){
				$activePolicies[$policy->ID] = $active->ID;
			}
		}

		$encoded = json_encode($activePolicies);
		Cookie::set('GDPRPolicyVersions',$encoded,1,null,null,false,false);

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

    	//Remember to include services used
		$page = $this->owner->customise([
			'Policies' => Policy::get()->filter('PolicyVersions.Status','Published'),
			'isNotGoogleBot' => $this->isNotGoogleBot(),
			'EssentialCookies' => ArrayList::create($strictlyCookies),
			'PerformanceCookies' => ArrayList::create($performanceCookies),
			'FunctionalCookies' => ArrayList::create($functionalCookies),
			'TargetingCookies' => ArrayList::create($targetingCookies)
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
        $GoogleTagID = $config->get('PrivacyCenter', 'TagID');

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
