<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:tp3_openhours/Resources/Private/Language/locallang_db.xlf:tx_tp3openhours_domain_model_openhour',
        'label' => 'day',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'day,open_time,close_time',
        'iconfile' => 'EXT:tp3_openhours/Resources/Public/Icons/tx_tp3openhours_domain_model_openhour.gif',
         'typeicon_classes' => [
            'default' => 'ext-tp3_businessview-wizard-icon'
        ],
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, day, open_time, close_time',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, day, open_time, close_time, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_tp3openhours_domain_model_openhour',
                'foreign_table_where' => 'AND tx_tp3openhours_domain_model_openhour.pid=###CURRENT_PID### AND tx_tp3openhours_domain_model_openhour.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
		'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
		'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'renderType' => 'inputDateTime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'renderType' => 'inputDateTime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'day' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3_openhours/Resources/Private/Language/locallang_db.xlf:tx_tp3openhours_domain_model_openhour.day',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'items' => [
                    ['-- Label --', 0],
                    ['Mo', 1],
                    ['Di', 2],
                    ['Mi', 3],
                    ['Do', 4],
                    ['Fr', 5],
                    ['Sa', 6],
                    ['So', 7],
                    ['Mo-Fr', 8],
                    ['Sa-So', 9],
			    ],
			    'size' => 1,
			    'maxitems' => 1,
			    'eval' => 'required'
			],
	    ],
	    'open_time' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3_openhours/Resources/Private/Language/locallang_db.xlf:tx_tp3openhours_domain_model_openhour.open_time',
	        'config' => [
			    'type' => 'input',
			    'size' => 4,
			    'eval' => 'time,required',
			    'default' => time(),
                'renderType' => 'inputDateTime',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
			]
	    ],
	    'close_time' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3_openhours/Resources/Private/Language/locallang_db.xlf:tx_tp3openhours_domain_model_openhour.close_time',
	        'config' => [
			    'type' => 'input',
			    'size' => 4,
			    'eval' => 'time',
			    'default' => time(),
                'renderType' => 'inputDateTime',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
			]
	    ],
        'ttaddress' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
