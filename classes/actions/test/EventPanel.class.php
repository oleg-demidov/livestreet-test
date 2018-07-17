<?php

class PluginTest_ActionTest_EventPanel extends Event
{
    
    public function Init()
    {
        $this->oTest = $this->PluginTest_Test_GetTestByCode( $this->sCurrentEvent );
        
        if(!$this->oTest){
            return parent::EventNotFound();
        }
        
        $this->sMenuHeadItemSelect = $this->oTest->getCode();
        $this->oUserCurrent = $this->User_GetUserCurrent();
    }

    public function EventBilets() {
        
        $aBilets = $this->PluginTest_Test_GetBiletItemsByFilter([
            'test_id' => $this->oTest->getId(),
            '#select' => ['t.*','count(a.id) as count_ask'],
            '#join' => ['LEFT JOIN '.Config::Get('db.table.test_test_ask').' a ON a.bilet_id = t.id'],
            '#group' => ['id']
        ]);
        
        $this->SetTemplateAction('panel/bilets');        
        $this->Viewer_Assign('sMenuItemSelect', 'bilets');
        $this->Viewer_Assign('aBilets', $aBilets);
        $this->Viewer_Assign('oTest', $this->oTest);
    }
}