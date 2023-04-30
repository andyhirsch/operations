<?php

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined ('TYPO3')) {
	die ('Access denied.');
}

$extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('operations');

return [
	'ctrl' => [
                'title' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation',
                'label' => 'title',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                //'sortby' => 'sorting',
                'default_sortby' => 'ORDER BY begin DESC',
                'versioningWS' => true,
                'origUid' => 't3_origuid',
                'languageField' => 'sys_language_uid',
                'transOrigPointerField' => 'l10n_parent',
                'transOrigDiffSourceField' => 'l10n_diffsource',
                'delete' => 'deleted',
                'enablecolumns' => [
                        'disabled' => 'hidden',
                        'starttime' => 'starttime',
                        'endtime' => 'endtime',
                ],
                'searchFields' => 'number,title,location,begin,end,report,longitude,latitude,zoom,media,type,assistance,vehicles,resources,',
                'typeicon_classes' => ['default' => 'ext-operations-operation'],
    ],
	'types' => [
		'0' => [
            'showitem' => 'sys_language_uid;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language,l10n_parent;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent,l10n_diffsource,hidden;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden,--palette--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.paletteTitle.meta;paletteMeta,title,path_segment,location,--palette--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.paletteTitle.time;paletteTime,teaser,report,--div--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.divTitle.map,--palette--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.paletteTitle.coordinates;paletteMap,--div--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.divTitle.relations,assistance,vehicles,resources,--div--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.divTitle.media,--palette--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.paletteTitle.media;paletteImg,--div--;LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tabs.categories,category'
        ],
    ],
	'palettes' => [
		'paletteMap' => [
			'showitem' => 'latitude,--linebreak--,longitude,
			--linebreak--,zoom',
			'canNotCollapse' => 'TRUE'
        ],
		'paletteImg' => [
			'showitem' => 'media',
			'canNotCollapse' => 'TRUE'
        ],
		'paletteTime' => [
			'showitem' => 'begin,end',
			'canNotCollapse' => 'TRUE'
        ],
		'paletteMeta' => [
			'showitem' => 'number, type, onlyEld',
			'canNotCollapse' => 'TRUE'
        ],
    ],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => ['type' => 'language'],
        ],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
                'renderType' => 'selectSingle',
                'eval' => 'int',
                'items' => [
					['', 0],
                ],
				'foreign_table' => 'tx_operations_domain_model_operation',
				'foreign_table_where' => 'AND tx_operations_domain_model_operation.pid=###CURRENT_PID### AND tx_operations_domain_model_operation.sys_language_uid IN (-1,0)',
                'default' => 0
            ],
        ],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
            ]
        ],
		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
            ],
        ],
		'starttime' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'eval' => 'datetime',
                'renderType' => 'inputDateTime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
                'behaviour' => ['allowLanguageSynchronization' => true],
            ],
        ],
		'endtime' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'eval' => 'datetime',
                'renderType' => 'inputDateTime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
                'behaviour' => ['allowLanguageSynchronization' => true],
            ],
        ],
		'number' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.number',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim,required'
            ],
        ],
		'onlyEld' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.onlyEld',
			'config' => [
				'type' => 'check',
            ],
        ],
		'title' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.title',
			'config' => [
				'type' => 'input',
				'size' => 60,
				'eval' => 'trim,required'
            ],
        ],
        'path_segment' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.path_segment',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                    'fieldSeparator' => '/',
                    'prefixParentPageSlug' => true
                ],
                'fallbackCharacter' => '-',
                'eval' => $extensionConfiguration['slugBehaviour'],
            ]
        ],
		'location' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.location',
			'config' => [
				'type' => 'text',
				'cols' => 60,
				'rows' => 3,
				'eval' => 'trim,required'
            ],
        ],
		'begin' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.begin',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
                'renderType' => 'inputDateTime',
				'checkbox' => 1,
				'default' => time()
            ],
        ],
		'end' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.end',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
                'renderType' => 'inputDateTime',
				'checkbox' => 1,
				'default' => time()
            ],
        ],
		'teaser' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.teaser',
			'config' => [
				'type' => 'text',
				'cols' => 60,
				'rows' => 5,
				'eval' => 'trim'
            ],
        ],
		'report' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.report',
			'config' => [
				'type' => 'text',
                'enableRichtext' => true,
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
            ],
        ],
		'longitude' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.longitude',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'latitude' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.latitude',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'zoom' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.zoom',
			'config' => [
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
            ],
        ],
		'media' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.media',
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig('media', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference'
                ],
                // custom configuration for displaying fields in the overlay/reference table
                'overrideChildTca' => [
                    'types' => [
                        '0' => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_TEXT => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_IMAGE => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_AUDIO => [
                            'showitem' => '
                                --palette--;;audioOverlayPalette,
                                --palette--;;filePalette'
                        ],
                        File::FILETYPE_VIDEO => [
                            'showitem' => '
                                --palette--;;videoOverlayPalette,
                                --palette--;;filePalette'
                        ],
                    ],
                ],
            ], $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'])
        ],
		'type' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.type',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_operations_domain_model_type',
                'foreign_table_where' => 'AND tx_operations_domain_model_type.sys_language_uid = ###REC_FIELD_sys_language_uid###',
				'MM' => 'tx_operations_operation_type_mm',
				'size' => 1,
				'autoSizeMax' => 40,
				'minItems' => 0,
				'maxitems' => 1,
				'multiple' => 0,
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.choose','0']
                ]
            ],
        ],
		'assistance' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.assistance',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_operations_domain_model_assistance',
				'MM' => 'tx_operations_operation_assistance_mm',
                'foreign_table_where' => 'AND tx_operations_domain_model_assistance.sys_language_uid = ###REC_FIELD_sys_language_uid###',
				'size' => 10,
				'autoSizeMax' => 40,
				'minitems' => 0,
				'maxitems' => 9999,
				'multiple' => 0,
				'renderType' => 'selectMultipleSideBySide',
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.edit',
                        ],
                    ],
                    'addRecord' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.createNew',
                        ],
                    ],
                ],
            ],
        ],
		'vehicles' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.vehicles',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_operations_domain_model_vehicle',
				'MM' => 'tx_operations_operation_vehicle_mm',
                'foreign_table_where' => 'AND tx_operations_domain_model_vehicle.sys_language_uid = ###REC_FIELD_sys_language_uid###',
				'size' => 10,
				'autoSizeMax' => 40,
				'minitems' => 0,
				'maxitems' => 9999,
				'multiple' => 0,
				'renderType' => 'selectMultipleSideBySide',
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.edit',
                        ],
                    ],
                    'addRecord' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.createNew',
                        ],
                    ],
                ],
            ],
        ],
		'resources' => [
			'exclude' => 1,
            'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tx_operations_domain_model_operation.resources',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_operations_domain_model_resource',
				'MM' => 'tx_operations_operation_resource_mm',
                'foreign_table_where' => 'AND tx_operations_domain_model_resource.sys_language_uid = ###REC_FIELD_sys_language_uid###',
				'size' => 10,
				'autoSizeMax' => 40,
				'minitems' => 0,
				'maxitems' => 9999,
				'multiple' => 0,
				'renderType' => 'selectMultipleSideBySide',
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.edit',
                        ],
                    ],
                    'addRecord' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.createNew',
                        ],
                    ],
                ],
            ],
        ],
        'category' => [
            'exclude' => 1,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:operations/Resources/Private/Language/locallang_db.xlf:tca.fieldLabel.category',
            'config' => [
                'type' => 'category',
                'treeConfig' => [
                    'startingPoints' => '###SITE:settings.operations.rootCategory###',
                    'appearance' => [
                        'expandAll' => TRUE,
                        'showHeader' => TRUE,
                    ],
                ],
                'size' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ],
        ],
    ],
];
