<?php

class PluginTest_ActionTest_EventBilet extends Event
{
    public function EventTest() {
        $iIdBilet = $this->GetParam(0);
        
        $iNumberAsk = $this->GetParamEventMatch(1, 2);
        if(!$iNumberAsk){
            $iNumberAsk = 1;
        }
        
        if(!$oBilet = $this->PluginTest_Test_GetBiletByFilter(['id' => $iIdBilet])){
            return Router::ActionError($this->Lang_Get('plugin.test.bilet.error.no_find'));
        }
        
        $aFilter = [
            'bilet_id'  => $iIdBilet,
            '#order'    => ['order' => 'asc'],
            '#with'     => ['anses'],
            '#limit'    => [($iNumberAsk-1), 1]
        ];
        
        $aAsks = $this->PluginTest_Test_GetAskItemsByFilter($aFilter);
        
        if(!$oAsk = array_shift($aAsks)){
            return Router::ActionError($this->Lang_Get('plugin.test.ask.error.no_find'));
        }
        
        $this->Viewer_Assign('componentAskWebPath', $this->Component_GetWebPath('test:ask'));
        $this->Viewer_Assign('oAsk', $oAsk);
        $this->Viewer_Assign('iNumberAsk', $iNumberAsk);
        $this->Viewer_Assign('oBilet', $oBilet);
        $this->Viewer_Assign('iCountAsk', $oBilet->getCountAsks());
        $this->SetTemplateAction('bilet/bilet');
    }
    
}