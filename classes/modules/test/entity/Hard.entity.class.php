<?php

class PluginTest_ModuleTest_EntityHard extends Entity
{
    
    
    public function getCountAsks() {
        return count($this->getAskIds());
    }
    
        
    public function getSession() {
        return  Engine::GetEntity(
            'PluginTest_ModuleTest_EntitySession',
            [
                'type' => 'hard', 
                'count' => $this->getCountAsks()
            ]
        );
    }
    
    public function getNowAskId($iNumberAsk) {
        $aAskIds = $this->getAskIds();
        return $aAskIds[$iNumberAsk-1];
    }
    
}