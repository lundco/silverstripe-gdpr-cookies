<?php

class Policy extends dataobject
{

	private static $db = array(
		'Title' => 'Varchar'
	);

	private static $has_many = array(
		'PolicyVersions' => 'PolicyVersion'
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
}
