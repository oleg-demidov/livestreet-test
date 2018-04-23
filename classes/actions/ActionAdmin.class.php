<?php


class PluginTest_ActionAdmin extends PluginAdmin_ActionPlugin
{

  

    public function Init()
    {
        $this->SetDefaultEvent('list');
    }

    /**
     * Регистрируем евенты
     *
     */
    protected function RegisterEvent()
    {
        /**
         * Для ajax регистрируем внешний обработчик
         */
        $this->RegisterEventExternal('Test', 'PluginTest_ActionAdmin_EventTest');
        
        $this->AddEventPreg('/^list$/i', 'Test::EventList');
//        $this->AddEventPreg('/^ads/i', '/^remove$/i', 'Ads::EventRemove');
//        $this->RegisterEventExternal('Ads', 'PluginYdirect_ActionAdmin_EventAds');
        
       
    }

}