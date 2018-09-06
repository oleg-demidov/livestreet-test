<?php

class PluginTest_ModuleTest_EntityBilet extends EntityORM
{

    protected $aValidateRules = array(
        array('title', 'string', 'max' => 200, 'min' => 1, 'allowEmpty' => false),
        array('description', 'string', 'max' => 5000, 'min' => 1, 'allowEmpty' => true),
    );
    
    protected $aRelations = array(
        'test' => array( self::RELATION_TYPE_BELONGS_TO, 'PluginTest_ModuleTest_EntityTest', 'test_id' ),
        'asks' => array( self::RELATION_TYPE_HAS_MANY, 'PluginTest_ModuleTest_EntityAsk', 'bilet_id' ),
    );
    
    public function getCountAsks() {
        return $this->PluginTest_Test_GetCountFromAskByFilter(['bilet_id' => $this->getId(), '#cache' => true]);
    }
    
    public function getUrlEdit() {
        return Router::GetPath('admin/plugin/test/bilet/edit/'.$this->getId());
    }
    
    public function getSession() {
        return  Engine::GetEntity(
                    'PluginTest_ModuleTest_EntitySession',
                    [
                        'type' => 'bilet', 
                        'id' => $this->getId(), 
                        'count' => $this->getCountAsks()
                    ]
                );
    }
}