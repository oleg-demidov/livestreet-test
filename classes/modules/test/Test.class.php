<?php

class PluginTest_ModuleTest extends ModuleORM
{
    public function Init() {
        parent::Init(); 
    }  
    
    protected $aBehaviors = array(
        // Категории
        'category' => array(
            'class'       => 'ModuleCategory_BehaviorModule',
            'target_type' => 'test',
        ),
    );
}