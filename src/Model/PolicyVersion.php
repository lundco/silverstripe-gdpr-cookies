<?php

namespace Lundco\SilverStripe\GdprCookies\Model;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class PolicyVersion extends Dataobject
{
    private static $table_name = 'SilverStripe_Gdpr_Policy_Version';

	private static $db = [
		'Content'      => 'HTMLText',
		'Status'       => "Enum('Draft,Published','Draft')",
		'Published'    => 'Date',
		'Title'        => 'Varchar',
		'VersionCount' => 'Int'
	];

	private static $defaults = [
		'VersionCount' => null
	];

	private static $has_one = [
		'Policy' => Policy::class
	];

	private static $summary_fields = [
		'Title'        => 'Internal name',
		'Status'       => 'Status',
		'VersionCount' => 'Version',
		'Published'    => 'Published'
	];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->removeByName([
			'Published',
			'PolicyID',
			'VersionCount',
			'Content',
			'Status',
			'Title'

		]);

		if ($this->Status === 'Draft' || !$this->ID) {
			$fields->addFieldsToTab('Root.Main', [
				TextField::create('Title', 'Internal name'),
				DropdownField::create('Status', 'Status', singleton('Lundco\SilverStripe\GdprCookies\Model\PolicyVersion')->dbObject('Status')->enumValues()),
				HtmlEditorField::create('Content', 'Content')
			]);
		}else {
			$fields->addFieldsToTab('Root.Main', [
				LiteralField::create('1Title', 'Title: ' . $this->Title . '<br><br>'),
				LiteralField::create('2Status', 'Status: ' . $this->Status . '<br><br>'),
				LiteralField::create('3Content', 'Content: <br />' . $this->Content)
			]);
		}


		return $fields;
	}

	public function getCurrentRelease()
	{
		return 'date';
	}

	protected function onBeforeWrite()
	{
		parent::onBeforeWrite();

		if ($this->Status === 'Published' && !$this->VersionCount) {
			$this->VersionCount = self::get()->filter('PolicyID',$this->PolicyID)->max('VersionCount') + 1;
			$this->Published = Date('d-m-Y');
		}
	}
}
