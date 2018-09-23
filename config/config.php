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
    'list' => [
        'per_page' => 20
    ]
    
];

$config['admin']['assets'] = [
    'js' => [
        'assets/js/admin.js'
    ],
    'css' => [
        'assets/css/admin.css'
    ]
]; 

$config['$root$']['block']['test_panel'] = array(
    'action' => array(
        'test', 'profile'
    ),
    'blocks' => array(
        'right' => array(
            'panel' => array('priority' => 100,'params' => array('plugin' => 'test'))
        )
    ),
    'clear'  => false,
);

return $config;