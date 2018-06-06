<?php

class PluginTest_ModuleTest_EntityAns extends EntityORM
{

    protected $aValidateRules = array(
        array('value', 'string', 'max' => 1000, 'min' => 1, 'allowEmpty' => false)
    );
    
     protected $aRelations = array(
        'ask' => array( self::RELATION_TYPE_BELONGS_TO, 'PluginTest_ModuleTest_EntityAsk', 'ask_id' )
    );
}