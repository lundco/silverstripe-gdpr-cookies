<?php

class Consent extends dataobject
{
	private static $db = array(
		'UID'                => 'Varchar',
		'PerformanceCookies' => 'Boolena',
		'FunctionalCookies'  => 'Boolean',
		'TargetingCookies'   => 'Boolean'
	);

	private static $defaults = [
		'PerformanceCookies' => false,
		'FunctionalCookies'  => false,
		'TargetingCookies'   => false
	];
}
