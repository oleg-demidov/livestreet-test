<?php

class PluginTest_ModuleTest extends ModuleORM
{
    const RESULT_ANS_RIGHT = 1;
    const RESULT_ANS_WRONG = 0;
    
    public function Init() {
        parent::Init(); 
    }  
    
    protected $aBehaviors = array(
        // Категории
        'category' => array(
            'class'       => 'ModuleCategory_BehaviorModule',
            'target_type' => 'test',
        ),
        'property' => 'ModuleProperty_BehaviorModule'
    );
    
    public function Ans($oAsk, $iAnsId) {
        $oAnsRight = $oAsk->getAns(['is_right' => 1]);
        if(getRequest('ans') == $oAnsRight->getId()){
            return true;
        }
        return false;
    }
    
    public function GetBiletAsk($oBilet, $iNumberAsk) {
        $aFilter = [
            'bilet_id'  => $oBilet->getId(),
            '#order'    => ['order' => 'asc'],
            '#with'     => ['anses'],
            '#limit'    => [($iNumberAsk-1), 1]
        ];
        
        $aAsks = $this->PluginTest_Test_GetAskItemsByFilter($aFilter);
        
        return array_shift($aAsks);
    }
    
    public function GetCategoryAsk($oCategory, $iNumberAsk) {
        $aTargets = $this->Category_GetTargetItemsByFilter([
            'category_id' => $oCategory->getId(),
            '#order'    => ['date_create' => 'asc'],
            '#select'   => ['t.target_id'],
            '#limit'    => [($iNumberAsk-1), 1]
        ]);
        
        if(!$oTarget = array_shift($aTargets)){
            return false;
        }
        
        if(!$oAsk = $this->PluginTest_Test_GetAskByFilter(['id' => $oTarget->getTargetId()])){
            return false;
        }
        
        return $oAsk;
    }
    
    public function GetHardByTestId($iTestId, $iLimit) {
        $oHard = Engine::GetEntity('PluginTest_Test_Hard');
        $oHard->setTestId($iTestId);
        
        $aAsks = $this->GetAskItemsByFilter([
            'test_id' => $iTestId,
            '#index-from' => 'id',
            '#select' => ['t.id'],
        ]);
        $aAskIds = array_keys($aAsks);
        
        $aResults = $this->GetResultItemsByFilter([
            'ask_id in' => $aAskIds,
            'result' => self::RESULT_ANS_WRONG,
            '#order' => ['#count(`result`)'],
            '#group' => ['result', 'ask_id'],
            '#select' => ['t.ask_id'],
            '#limit' => $iLimit,
            '#index-from' => 'ask_id'
        ]);
        $aAskIds = array_keys($aResults);
        
        $oHard->setAskIds($aAskIds);
        
        return $oHard;
    }
    
    public function AttachResultsToBilets($aBilets, $oUser) {
        $aBiletIds = array_keys($aBilets);

        $aResults = $this->PluginTest_Test_GetResultItemsByFilter([
            'user_id'  => $oUser->getId(),
            'bilet_id in' => $aBiletIds,
            '#select' => [
                't.bilet_id',
                't.result'
            ],
            '#index-group' => 'bilet_id'
        ]);

        foreach ($aBilets as $oBilet) {
            if(isset($aResults[$oBilet->getId()])){
                $aResultsBilet = $aResults[$oBilet->getId()];
                foreach ($aResultsBilet as $oResultBilet) {
                    if($oResultBilet->getResult()){
                        $oBilet->setRight($oBilet->getRight() + 1);
                    }else{
                        $oBilet->setWrong($oBilet->getWrong() + 1);
                    }
                }
            }
        }
    }
        
}