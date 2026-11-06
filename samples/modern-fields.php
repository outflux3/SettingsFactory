<?php namespace ProcessWire;

/**
 * Settings Factory sample: current core inputfields, and what each one stores.
 *
 * Point a settings page at "../modules/SettingsFactory/samples/modern-fields.php",
 * or copy this file into /site/templates/settings/ and edit it.
 *
 * Things to know:
 * - "value" is the default, used until the screen is first saved. For a checkbox,
 *   use "checked" => true for a default of on ("value" is what it submits when checked).
 * - "columnWidth" sets the width. "width" does nothing (older samples used it).
 * - showIf / requiredIf work as in any ProcessWire form.
 * - File and image fields cannot be used: they need a page to store files on.
 *   Select a page that holds the image instead (InputfieldPageListSelect).
 * - This file is only loaded by the admin screen. Keep it to building inputfields,
 *   with no output.
 */

$tab = new InputfieldWrapper();
$tab->attr('title', __('General'));
$tab->attr('class', 'WireTab');
$tab->add([
	[
		'name' => 'site_tagline',
		'type' => 'InputfieldText',
		'label' => __('Tagline'),
		'useLanguages' => true, // one value per language when LanguageSupport is installed
		'value' => '',
		'columnWidth' => 50,
	],
	[
		'name' => 'items_per_page',
		'type' => 'InputfieldInteger',
		'label' => __('Items per page'),
		'inputType' => 'number',
		'min' => 1,
		'max' => 100,
		'value' => 12, // stores an integer
		'columnWidth' => 25,
	],
	[
		'name' => 'show_banner',
		'type' => 'InputfieldToggle', // stores 1, 0 or '' (no selection)
		'label' => __('Show banner'),
		'columnWidth' => 25,
	],
	[
		'name' => 'banner_text',
		'type' => 'InputfieldTinyMCE', // stores HTML
		'label' => __('Banner text'),
		'showIf' => 'show_banner=1',
	],
	[
		'name' => 'maintenance_mode',
		'type' => 'InputfieldCheckbox', // stores 1 when checked, '' when not
		'label' => __('Maintenance mode'),
		'checked' => false,
		'columnWidth' => 50,
	],
	[
		'name' => 'launch_date',
		'type' => 'InputfieldDatetime', // stores a Unix timestamp
		'label' => __('Launch date'),
		'datepicker' => InputfieldDatetime::datepickerFocus,
		'dateInputFormat' => 'Y-m-d',
		'columnWidth' => 50,
	],
]);

$fieldset = new InputfieldFieldset();
$fieldset->label = __('Pages and tags');
$fieldset->icon = 'sitemap';
$fieldset->add([
	[
		'name' => 'featured_pages',
		'type' => 'InputfieldPage', // stores an array of page IDs
		'label' => __('Featured pages'),
		'inputfield' => 'InputfieldAsmSelect',
		'findPagesSelector' => 'parent=1, include=hidden',
		'labelFieldName' => 'title',
		'columnWidth' => 50,
	],
	[
		'name' => 'logo_page',
		'type' => 'InputfieldPageListSelect', // stores one page ID
		'label' => __('Page holding the logo image'),
		'columnWidth' => 50,
	],
	[
		'name' => 'keywords',
		'type' => 'InputfieldTextTags', // stores a space-separated string
		'label' => __('Keywords'),
		'allowUserTags' => true,
	],
]);
$tab->add($fieldset);

$tab2 = new InputfieldWrapper();
$tab2->attr('title', __('Services'));
$tab2->attr('class', 'WireTab');
$tab2->add([
	[
		'name' => 'maps_api_key',
		'type' => 'InputfieldText',
		'label' => __('Maps API key'),
		'notes' => __('Stored in the module config, in the database.'),
	],
	[
		'name' => 'notify_users',
		'type' => 'InputfieldAsmSelect', // stores an array of option values
		'label' => __('Notify these users'),
		// options can be built at runtime; this runs as the current user, so include=all
		'options' => wire('users')->find('roles=superuser, include=all')->explode('name', ['key' => 'id']),
	],
]);

$inputfields = new InputfieldWrapper();
$inputfields->add($tab);
$inputfields->add($tab2);
return $inputfields;
