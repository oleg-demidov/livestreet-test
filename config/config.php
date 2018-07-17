<?php
/**
 * Таблица БД
 */
$config['$root$']['db']['table']['test_test_bilet'] = '___db.table.prefix___test_bilet';
$config['$root$']['db']['table']['test_test_ask'] = '___db.table.prefix___test_ask';
$config['$root$']['db']['table']['test_test_ans'] = '___db.table.prefix___test_ans';
/**
 * Роутинг
 */
$config['$root$']['router']['page']['test'] = 'PluginTest_ActionTest';

$config['ask'] = [
    'list' => [
        'per_page' => 20
    ]
    
];

return $config;