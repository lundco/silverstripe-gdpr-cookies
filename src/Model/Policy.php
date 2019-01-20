<?php

namespace Lundco\SilverStripe\GdprCookies\Model;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\ORM\DataObject;

class Policy extends Dataobject
{

    private static $table_name = 'SilverStripe_Gdpr_Policy';

	private static $db = array(
		'Title' => 'Varchar'
	);

	private static $has_many = array(
		'PolicyVersions' => PolicyVersion::class
	);

	private static $summary_fields = array(
		'Title'             => 'Policy',
		'getCurrentRelease' => 'Last published',
		'versionCount'      => 'Number of published versions'
	);

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->removeByName('PolicyVersions');

		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		)->removeComponentsByType('GridFieldAddExistingAutocompleter');

		$gridField = new GridField("PolicyVersions", "Policy Version", $this->PolicyVersions(), $gridFieldConfig);
		$fields->addFieldToTab("Root.Main", $gridField);

		return $fields;
	}

	public function getCurrentRelease()
	{
		$version = $this->PolicyVersions()->filter('Status', 'Published')->sort('Published', 'DESC')->first();

		if ($version) {
			return $version->Published;
		}
		return '';
	}

	public function versionCount()
	{
		return count($this->PolicyVersions()->filter('Status', 'Published'));
	}

	public function Slug(){
		return SiteTree::create()->generateURLSegment($this->Title);
	}

	public function PolicyContent(){
		return $this->PolicyVersions()->filter('Status', 'Published')->sort('Published', 'DESC')->first()->Content;
	}
}
