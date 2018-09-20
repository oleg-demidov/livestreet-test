<?php


class PluginTest_HookMenu extends Hook{
    public function RegisterHook()
    {
        
        $this->AddHook('template_nav_main', 'NavMain', null, 655);
        
        
    }

    /**
     * Добавляем в главное меню 
     */
    public function NavMain($aParams)
    {
        $aTests = $this->PluginTest_Test_GetTestItemsAll();
        
        $aItems = [];
        foreach ($aTests as $oTest) {
            $aItems[] = [
                'text' => $this->Lang_Get('plugin.test.main_menu.tests.text').' '.$oTest->getTitle(),
                'name' => $oTest->getCode(),
                'url'  => Router::GetPath('test/'.$oTest->getCode().'/bilets')
            ];
        }
        
        $aResult = array_merge( $aItems, $aParams['items']);
        return    $aResult;

    }

}
