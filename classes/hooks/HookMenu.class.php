<?php


class PluginTest_HookMenu extends Hook{
    
    public function RegisterHook()
    {
        $this->AddHook('engine_init_complete', 'NavMain');        
    }

    /**
     * Добавляем в главное меню 
     */
    public function NavMain($aParams)
    {
        $aTests = $this->PluginTest_Test_GetTestItemsAll();
        
        $oMenu = $this->Menu_Get('main');
        
        $aItems = [];
        foreach ($aTests as $oTest) {
            
            if(!$oTest->getState()){
                continue;
            }
            
            if(!$oTest->getMenuEnable()){
                continue;
            }
           
            $oMenu->appendChild(Engine::GetEntity("ModuleMenu_EntityItem", [
                'name' => $oTest->getCode(),
                'title' => $oTest->getMenuTitle(),
                'url' => 'test/'.$oTest->getCode().'/bilets'
            ]));
            
        }
        
    }
    
}
