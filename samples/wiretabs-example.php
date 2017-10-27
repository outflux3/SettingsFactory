<?php

/**
 * since you can only return 1 array to the module, you have to wrap 
 * the tabs in an inputfield wrapper
 */
$inputfields = new InputfieldWrapper();

//---------------------------------------------------
$general = [
    [
        'name' => 'site_name',
        'label' => __('Site Name'),
        'type' => 'InputfieldText',
        'required' => true,
        'value' => ''
    ],
    [
        'name' => 'email_address',
        'label' => __('E-mail'),
        'type' => 'InputfieldEmail',
        'required' => true,
        'value' => ''
    ],
    [
        'name' => 'telephone',
        'label' => __('Telephone'),
        'type' => 'InputfieldText',
        'required' => true,
        'value' => ''
    ],
    [
        'name' => 'fax',
        'label' => __('Fax'),
        'type' => 'InputfieldText',
        'value' => ''
    ],
];

$tab = new InputfieldWrapper();
$tab->attr('title', 'General');
$tab->attr('class', 'WireTab');
$tab->add($general);
$inputfields->append($tab);

//---------------------------------------------------
$location = [
    [
        'name' => 'address',
        'label' => __('Address'),
        'type' => 'InputfieldText',
        'required' => true,
        'value' => ''
    ],
    [
        'name' => 'postal_code',
        'label' => __('Postal code'),
        'type' => 'InputfieldText',
        'required' => true,
        'value' => '',
        'columnWidth' => 33
    ],
    [
        'name' => 'city',
        'label' => __('City'),
        'type' => 'InputfieldText',
        'required' => true,
        'value' => '',
        'columnWidth' => 67
    ],
];

$tab = new InputfieldWrapper();
$tab->attr('title', 'Location');
$tab->attr('class', 'WireTab');
$tab->add($location);
$inputfields->append($tab);

//---------------------------------------------------


return $inputfields;

