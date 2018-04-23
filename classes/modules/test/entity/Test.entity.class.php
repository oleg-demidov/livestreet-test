<?php

class PluginTest_ModuleTest_EntityTest extends EntityORM
{

    protected $aValidateRules = array(
        array('title', 'string', 'max' => 200, 'min' => 1, 'allowEmpty' => false),
        array('description', 'string', 'max' => 5000, 'min' => 1, 'allowEmpty' => true),
        array('url', 'regexp', 'pattern' => '/^[\w\-_]+$/i', 'allowEmpty' => false),
        array('order', 'number', 'integerOnly' => true),
        array('pid', 'parent_category'),
        array('order', 'order_check'),
        array('icon', 'icon_check'),
    );
}