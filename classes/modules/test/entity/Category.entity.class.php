<?php

class PluginTest_ModuleTest_EntityCategory extends ModuleCategory_EntityCategory
{
    
    
    public function getCountAsks() {
        return $this->getCountTargetOfDescendants();
    }
    
        
    public function getSession() {
        return  Engine::GetEntity(
                    'PluginTest_ModuleTest_EntitySession',
                    [
                        'type' => 'category', 
                        'id' => $this->getId(), 
                        'count' => $this->getCountAsks()
                    ]
                );
    }
    
    public function getTest() {
        $oCategoryParent = $this->getParent();
        return $this->PluginTest_Test_GetTestByFilter([
            'code' => $oCategoryParent->getUrl()
        ]);        
    }
}