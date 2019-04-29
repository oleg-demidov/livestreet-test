<?php
/**
 * Таблица БД
 */
$config['$root$']['db']['table']['test_test'] = '___db.table.prefix___test';
$config['$root$']['db']['table']['test_test_bilet'] = '___db.table.prefix___test_bilet';
$config['$root$']['db']['table']['test_test_category'] = '___db.table.prefix___category';
$config['$root$']['db']['table']['test_test_ask'] = '___db.table.prefix___test_ask';
$config['$root$']['db']['table']['test_test_ans'] = '___db.table.prefix___test_ans';
$config['$root$']['db']['table']['test_test_result'] = '___db.table.prefix___test_result';
/**
 * Роутинг
 */
$config['$root$']['router']['page']['test'] = 'PluginTest_ActionTest';


$config['ask'] = [
    'image' => [
        'width' => 500
    ],
    'list' => [
        'per_page' => 20
    ]
];

$config['test'] = [
    'hard' => [
        'count' => 100
    ]
];

$config['admin']['assets'] = [
    'js' => [
        //'assets/js/admin.js'
    ],
    'css' => [
        'assets/css/admin.css'
    ]
]; 
$config['admin']['components'] = [
    'wiki:editor'
]; 

$config['assets']['js'][]  = 'assets/js/init.js'; 

$config['$root$']['block']['rule_profile'] = array(
    'action' => array(
        'profile' => '{profile}'
    ),
    'blocks' => array(
        'profile' => array(
            'panel' => array('priority' => 99,'params' => array('plugin' => 'test', 'template' => 'profile', 'sTestCode' => 'pdd', 'avatar' => false))
        )
    ),
    'clear'  => false,
);
$config['$root$']['block']['test_panel'] = array(
    'action' => array(
        'test'
    ),
    'blocks' => array(
        'left' => array(
            'panel' => array('priority' => 99,'params' => array('plugin' => 'test', 'template' => 'panel', 'avatar' => true))
        )
    ),
    'clear'  => false,
);

return $config;