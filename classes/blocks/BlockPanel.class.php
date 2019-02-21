<?php

/**
 * Description of PluginTest_BlockPanel
 *
 * @author oleg
 */
class PluginTest_BlockPanel extends Block {
    
    public function Exec() {
        if(!$oUser = $this->User_GetUserCurrent()){
            return $this->SetTemplate("component@test:panel.block.info_no_user");
        }
        
        if(!$sCode = $this->GetParam('sTestCode')){
            $sCode = Router::GetActionEvent();
        }
        
        if(!$oTest = $this->PluginTest_Test_GetTestByCode($sCode)){
            return false;
        }
        
        $iCountAskTotal = $this->PluginTest_Test_GetCountFromAskByFilter([
            'test_id' => $oTest->getId()
        ]);
        
        $iCountAskRightBilet = $this->PluginTest_Test_GetCountFromResultByFilter([
            'test_id' => $oTest->getId(),
            'user_id' => $oUser->getId(),
            'result'  => 1,
            'type'    => 'bilet'
        ]);
        
        $iCountAskWrongBilet = $this->PluginTest_Test_GetCountFromResultByFilter([
            'test_id' => $oTest->getId(),
            'user_id' => $oUser->getId(),
            'result'  => 0,
            'type'    => 'bilet'
        ]);
        
        $iCountAskRightCategory = $this->PluginTest_Test_GetCountFromResultByFilter([
            'test_id' => $oTest->getId(),
            'user_id' => $oUser->getId(),
            'result'  => 1,
            'type'    => 'category'
        ]);
        
        $iCountAskWrongCategory = $this->PluginTest_Test_GetCountFromResultByFilter([
            'test_id' => $oTest->getId(),
            'user_id' => $oUser->getId(),
            'result'  => 0,
            'type'    => 'category'
        ]);
        
        $iCountAskSkipBilet = $iCountAskTotal - ($iCountAskRightBilet + $iCountAskWrongBilet);
        $iCountAskSkipCategory = $iCountAskTotal - ($iCountAskRightCategory + $iCountAskWrongCategory);
        $iPrecent = round(($iCountAskRightBilet/($iCountAskTotal/100))/2 + ($iCountAskRightCategory/($iCountAskTotal/100))/2);
        
        $this->Viewer_Assign('avatar', $this->GetParam('avatar', true) );
        $this->Viewer_Assign('iPrecent', $iPrecent );
        $this->Viewer_Assign('iCountAskRightBilet', $iCountAskRightBilet );
        $this->Viewer_Assign('iCountAskWrongBilet', $iCountAskWrongBilet );
        $this->Viewer_Assign('iCountAskRightCategory', $iCountAskRightCategory );
        $this->Viewer_Assign('iCountAskWrongCategory', $iCountAskWrongCategory );
        $this->Viewer_Assign('iCountAskSkipBilet', $iCountAskSkipBilet );
        $this->Viewer_Assign('iCountAskSkipCategory', $iCountAskSkipCategory );
        $this->Viewer_Assign('iCountAskTotal', $iCountAskTotal );
        $this->Viewer_Assign('oUserCurrent',$oUser );
        $this->Viewer_Assign('oTest',$oTest );
        return $this->SetTemplate("component@test:panel.block." . $this->GetParam('template', 'profile'));       
    }
}
