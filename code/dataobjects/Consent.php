<?php

class Consent extends dataobject
{
	private static $db = array(
		'UID'                => 'Varchar',
		'PerformanceCookies' => 'Boolean',
		'FunctionalCookies'  => 'Boolean',
		'TargetingCookies'   => 'Boolean'
	);

	private static $many_many = array(
		'Policies' => 'Policy'
	);

	private static $defaults = [
		'PerformanceCookies' => false,
		'FunctionalCookies'  => false,
		'TargetingCookies'   => false
	];
}
