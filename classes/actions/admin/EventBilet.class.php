<?php

class PluginTest_ActionAdmin_EventBilet extends Event
{

    public function Init()
    {
        
    }

   
    public function EventList()
    {
    }
    
    public function EventAddEdit() {
        $this->SetTemplateAction('bilet-add');
        
        $oBilet = $this->PluginTest_Test_GetBiletById( $this->GetParam(1) );
        
        if($oBilet){
            $oTest = $oBilet->getTest();
        }else{
            $oTest = $this->PluginTest_Test_GetTestById( getRequest('test') );
        }

        if(!$oTest){    
            $this->Message_AddError($this->Lang_Get('plugin.test.admin.bilet.notices.no_test_find'), $this->Lang_Get('common.error.error'),true);
            Router::LocationAction('admin');
        }
                        
        if(isPost()){
            if(!$oBilet){
                $oBilet = Engine::GetEntity('PluginTest_Test_Bilet');
            }
            $oBilet->_setData( getRequest('bilet'));
            $oBilet->setTestId($oTest->getId());
            
            if($oBilet->_Validate()){
                if($oBilet->Save()){   
                    $this->Message_AddNoticeSingle($this->Lang_Get('plugin.test.admin.bilet.notices.save_success'),'',true);
                    Router::LocationAction("admin/plugin/test/".$oTest->getCode().'/bilets');
                }else{
                    $this->Message_AddErrorSingle($this->Lang_Get('common.error.system.base'));
                }
            }else{
                foreach($oBilet->_getValidateErrors() as $aError){
                    $this->Message_AddError($aError[0], $this->Lang_Get('common.error.error'));
                }
            }    
        }
        
        if($oBilet){
            $_REQUEST['bilet'] = $oBilet->_getData();
        }
    }
    
    public function EventRemove() {
        $this->SetTemplate(false);
        
        if(!$oBilet = $this->PluginTest_Test_GetBiletById( $this->GetParam(1) )){
            $this->Message_AddError($this->Lang_Get('plugin.test.admin.bilet.error.no_bilet'), $this->Lang_Get('common.error.error'), true);
            Router::LocationAction("admin");
        }
        
        if($oTest = $oBilet->getTest()){
            $sTest = $oTest->getCode();
        }
        
        $this->Security_ValidateSendForm();

        foreach ($oBilet->getAsks() as $oAsk){
            $oAsk->setBiketId(null);
            $oAsk->Save();
        }

        /**
         * Удаляем
         */
        if ($oBilet->Delete()) {
            $this->Message_AddNotice('Удаление прошло успешно', null, true);
        } else {
            $this->Message_AddError('Возникла ошибка при удалении', null, true);
        }

        Router::LocationAction("admin/plugin/test/" . $sTest. '/bilets');
    }
    
    public function EventAskList() {
        if(!$oBilet = $this->PluginTest_Test_GetBiletById( $this->GetParam(0) )){
            $this->Message_AddError($this->Lang_Get('plugin.test.admin.bilet.error.no_bilet'), $this->Lang_Get('common.error.error'), true);
            Router::LocationAction("admin");
        }
        
        $oTest = $oBilet->getTest();
        
        $aBilets = $oTest->getBilets(['#index-from' => 'id']);
                
        $this->Viewer_Assign('activeNavItem', 'bilets');
        $this->Viewer_Assign('aBilets', $aBilets);    
        $this->Viewer_Assign('oBilet', $oBilet);
        $this->Viewer_Assign('oTest', $oTest);  
        $this->Viewer_Assign('aAsks', $oBilet->getAsks(['#with' => '#category']));  
        $this->SetTemplateAction('bilet-asks-list');
    }
    
}