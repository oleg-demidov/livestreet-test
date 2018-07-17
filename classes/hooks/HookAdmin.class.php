<?php


class PluginTest_HookAdmin extends Hook{
    public function RegisterHook()
    {
        /**
         * Хук на отображение админки
         */
        $this->AddHook('init_action_admin', 'InitActionAdmin');
        
        
    }

    /**
     * Добавляем в главное меню админки свой раздел с подпунктами
     */
    public function InitActionAdmin()
    {
        /**
         * Получаем объект главного меню
         */
        $oMenu = $this->PluginAdmin_Ui_GetMenuMain();
        /**
         * Добавляем новый раздел
         */
        $oSection =  Engine::GetEntity('PluginAdmin_Ui_MenuSection');
        
        $oSection->SetCaption($this->Lang_Get('plugin.test.admin.menu.title'))->SetName('test')->SetUrl('plugin/test')->setIcon('question-circle');
        
        $aTests = $this->PluginTest_Test_GetTestItemsAll();
        
        $oSection
                ->AddItem(Engine::GetEntity('PluginAdmin_Ui_MenuItem')
                    ->SetCaption($this->Lang_Get('plugin.test.admin.test.button_add.text'))
                    ->SetUrl('add'));
                
        foreach ($aTests as $oTest) {
            $oSection
                ->AddItem(Engine::GetEntity('PluginAdmin_Ui_MenuItem')->SetCaption($oTest->getTitle())
                    ->SetUrl($oTest->getCode()));
        }
        
        $oSection
                ->AddItem(Engine::GetEntity('PluginAdmin_Ui_MenuItem')
                    ->SetCaption($this->Lang_Get('plugin.test.admin.menu.settings'))
                    ->SetUrl('settings'));
        
        $oMenu->AddSection( $oSection );
    }

}
