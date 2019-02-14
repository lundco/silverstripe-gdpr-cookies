<?php

class Consent extends dataobject
{
	private static $db = array(
		'UID'                => 'Varchar',
		'PerformanceCookies' => 'Boolean',
		'FunctionalCookies'  => 'Boolean',
		'TargetingCookies'   => 'Boolean',
		'Policies'           => 'Varchar',
		'AnonIP'             => 'Varchar'
	);

	private static $summary_fields = array(
		'UID'                   => 'GDPR Token ID',
		'LastEdited'            => 'GDPR Accepted',
		'AnonIP'                => 'IP',
		'getPerformanceCookies' => 'Performance',
		'getFunctionalCookies'  => 'Functional',
		'getTargetingCookies'   => 'Targeting'
	);

	private static $defaults = [
		'PerformanceCookies' => false,
		'FunctionalCookies'  => false,
		'TargetingCookies'   => false
	];

	public function getPerformanceCookies()
	{

		if ($this->getField('PerformanceCookies')) {
			return 'Active';
		}

		return 'Disabled';
	}

	public function getFunctionalCookies()
	{
		if ($this->getField('FunctionalCookies')) {
			return 'Active';
		}

		return 'Disabled';
	}

	public function getTargetingCookies()
	{
		if ($this->getField('TargetingCookies')) {
			return 'Active';
		}

		return 'Disabled';
	}
}
