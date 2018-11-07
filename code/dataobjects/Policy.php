<?php

class Policy extends dataobject
{

	private static $db = array(
		'Title'   => 'Varchar',
		'Content' => 'HTMLText'
	);

	private static $summary_fields = array(
		'Title'       => 'Policy',
		'LastEdited' => 'Last Updated'
	);

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		return $fields;
	}
}
