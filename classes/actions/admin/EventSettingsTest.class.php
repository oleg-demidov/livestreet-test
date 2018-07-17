<?php

class PluginTest_ActionAdmin_EventSettingsTest extends Event
{
    public $oTest;


    public function Init()
    {
        $this->oTest = $this->PluginTest_Test_GetTestByCode($this->sCurrentEvent);        
        if(!$this->oTest){
            return Router::ActionError($this->Lang_Get('plugin.test.admin.bilet.notices.no_test_find'));
        }
    }

    
    public function EventAsks() {
        $this->SetTemplateAction('settings/settings-asks');
                
        $this->Viewer_Assign('oTest', $this->oTest);
//        $this->Viewer_Assign('oAnsRight', $oAnsRight);
//        $this->Viewer_Assign('aBilets', $oTest->getBilets());
        $this->Viewer_Assign('activeNavItem', 'settings');
    }
    
    
}