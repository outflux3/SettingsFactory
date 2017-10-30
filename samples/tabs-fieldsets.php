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
        'value' => ''
    ],
    [
        'name' => 'email_address',
        'label' => __('E-mail'),
        'type' => 'InputfieldEmail',
        'value' => ''
    ],
    [
        'name' => 'telephone',
        'label' => __('Telephone'),
        'type' => 'InputfieldText',
        'value' => ''
    ],
    [
        'name' => 'fax',
        'label' => __('Fax'),
        'type' => 'InputfieldText',
        'value' => ''
    ],
];



$general2 = [
    [
        'name' => 'set_1',
        'label' => __('Setting 1'),
        'type' => 'InputfieldText',
        'value' => ''
    ],
    [
        'name' => 'set_2',
        'label' => __('Setting 2'),
        'type' => 'InputfieldText',
        'value' => ''
    ]
];

$general3 = [
    [
        'name' => 'set_3',
        'label' => __('Setting 3'),
        'type' => 'InputfieldText',
        'value' => ''
    ],
    [
        'name' => 'set_4',
        'label' => __('Setting 4'),
        'type' => 'InputfieldText',
        'value' => ''
    ] 
];



$tab = new InputfieldWrapper();
$tab->attr('title', 'General');
$tab->attr('class', 'WireTab');




$advanced = new InputfieldFieldset();
$advanced->label = __('Advanced Settings');
$advanced->description = __('These settings are not required');
$advanced->columnWidth = 50;
$advanced->add($general2);
$tab->add($advanced);



$advanced = new InputfieldFieldset();
$advanced->label = __('Advanced Settings');
$advanced->description = __('These settings are not required');
$advanced->columnWidth = 50;
$advanced->add($general3);
$tab->add($advanced);



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