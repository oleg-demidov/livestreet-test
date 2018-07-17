<?php

class PluginTest_ActionTest extends ActionPlugin
{
    /**
     * Текущий пользователь
     *
     * @var ModuleUser_EntityUser|null
     */
    protected $oUserCurrent = null;
    
    protected $oTest = null;
    
    protected $sMenuHeadItemSelect = null;
    
    /**
     * Инициализация
     *
     * @return string
     */
    public function Init()
    {
        
        $this->oUserCurrent = $this->User_GetUserCurrent();
    }

    /**
     * Регистрация евентов
     */
    protected function RegisterEvent()
    {
        
        $this->RegisterEventExternal('Panel','PluginTest_ActionTest_EventPanel');
        $this->AddEventPreg('/^[a-z_0-9]{1,50}$/i', '/^(bilets)?$/i', 'Panel::EventBilets');
        
        $this->RegisterEventExternal('Bilet','PluginTest_ActionTest_EventBilet');
        $this->AddEventPreg('/^bilet$/i', '/^[0-9]{1,50}$/i', '/^(ask([0-9]{1,50}))?$/i', 'Bilet::EventTest');
    }

    public function EventShutdown() {
        $this->Viewer_Assign('sMenuHeadItemSelect', $this->sMenuHeadItemSelect);
    }

}