<?php

class PluginTest_ActionAdmin_EventTest extends Event
{
    protected $oUserCurrent = null;

    public function Init()
    {
        $this->oUserCurrent = $this->User_GetUserCurrent();
    }

   
    public function EventList()
    {
        $this->SetTemplateAction('test-list');
        
        $aTests = $this->PluginTest_Test_GetTestItemsAll();
        
        $this->Viewer_Assign('aTests', $aTests);  
    }
    
    public function EventAddTest() {
        
        $this->SetTemplateAction('test-add');
        
        $oTest = $this->PluginTest_Test_GetTestById( $this->GetParam(0) );
        
        if(isPost()){ 
            if(!$oTest){
                $oTest = Engine::GetEntity('PluginTest_Test_Test' );
            }
            $oTest->_setData(getRequest('test'));
                       
            if($oTest->_Validate()){ 
                if($oTest->Save()){
                    
                    $this->Message_AddNoticeSingle($this->Lang_Get('plugin.test.admin.test.notices.add_success'),'',true);
                    Router::LocationAction("admin/plugin/test/".$oTest->getCode());
                    
                }else{
                    $this->Message_AddErrorSingle($this->Lang_Get('common.error.system.base'));
                }
            }else{
                foreach($oTest->_getValidateErrors() as $aError){
                    $this->Message_AddError($aError[0], $this->Lang_Get('common.error.error'));
                }
            }  
                      
        }
        
        if($oTest){
            $_REQUEST['test'] = $oTest->_getData();
        }
        $this->Viewer_Assign('oTest', $oTest);  
    }
    
    public function EventRemove() {
        $this->SetTemplateAction('test-remove');
        
        $oTest = $this->PluginTest_Test_GetTestById( $this->GetParam(0) );
        
        if(isPost()){
            $this->Security_ValidateSendForm();
            
            $aAsks = $oTest->getAsks();
            
            foreach ($aAsks as $oAsk) {
                $this->Category_RemoveCategories($oAsk, 'test');
            }

            if(getRequest('remove_category')){
                if ( $oCategory = $this->Category_GetCategoryByUrl($oTest->getCode()) ) {
                    $aCategories = $oCategory->getChildren(); 
                    foreach ($aCategories as $oCategoryChild) {
                        $oCategoryChild->Delete();
                    }
                    $oCategory->Delete();
                }
            }
            
            if(getRequest('remove_asks')){
                foreach($aAsks as $oAsk){
                    $oAsk->Delete();
                }
            }

            if(getRequest('remove_bilets')){
                $aBilets = $oTest->getBilets();
                foreach($aBilets as $oBilet){
                    $oBilet->Delete();
                }
            }

            /**
             * Удаляем
             */
            if ($oTest->Delete()) {
                $this->Message_AddNotice('Удаление прошло успешно', null, true);
            } else {
                $this->Message_AddError('Возникла ошибка при удалении', null, true);
            }

            Router::LocationAction("admin");
        }
        
        $this->Viewer_Assign('oTest', $oTest);  
    }
    
    public function EventAskList() {
        $this->SetTemplateAction('test-asks-list');
        
        $iPage = $this->GetParamEventMatch(1, 2);
        if(!$iPage){
            $iPage = 1;
        }
        
        $oTest = $this->PluginTest_Test_GetTestByCode($this->sCurrentEvent);        
        if(!$oTest){
            return Router::ActionError($this->Lang_Get('plugin.test.admin.bilet.notices.no_test_find'));
        }
                
        $aBilets = $oTest->getBilets(['#index-from' => 'id']);
        
        $aAsks = $oTest->getAsks([
            '#with' => '#category',
            '#page' => [$iPage, Config::Get('plugin.test.ask.list.per_page')]
        ]);
        
        $aPaging = $this->Viewer_MakePaging($aAsks['count'], $iPage, Config::Get('plugin.test.ask.list.per_page'),
            Config::Get('pagination.pages.count'), Router::GetPath('admin/plugin/test/'.$this->sCurrentEvent.'/asks'));
        
        $this->Viewer_Assign('aBilets', $aBilets);
        $this->Viewer_Assign('aAsks', $aAsks['collection']);
        $this->Viewer_Assign('aPaging', $aPaging);
        $this->Viewer_Assign('oTest', $oTest);
        $this->Viewer_Assign('activeNavItem', 'asks');
    }
    
    public function EventBiletList() {
        $this->SetTemplateAction('test-bilets-list');
        
        $oTest = $this->PluginTest_Test_GetTestByCode( $this->sCurrentEvent );
        if(!$oTest){
            return Router::ActionError($this->Lang_Get('plugin.test.admin.bilet.notices.no_test_find'));
        }
        
        
        $this->Viewer_Assign('oTest', $oTest);
        $this->Viewer_Assign('aBilets', $oTest->getBilets());
        $this->Viewer_Assign('activeNavItem', 'bilets');
        
    }
    
//    public function EventSettings() {
//        $this->SetTemplateAction('test-settings');
//                
//        $oTest = $this->PluginTest_Test_GetTestByCode( $this->sCurrentEvent );
//        if(!$oTest){
//            return Router::ActionError($this->Lang_Get('plugin.test.admin.bilet.notices.no_test_find'));
//        }
//        
//        
//        if(isPost()){
//        
//            $oTest->setState(getRequest('state'));
//            
//            if($oTest->Save()){
//                $this->Message_AddNotice('Cохранено успешно');
//            }
//            
//            $aFile = $_FILES['image'];
//            
//            
//            if($aFile or getRequest('remove')){  
//                $this->Media_RemoveTarget('test_img_default', $oTest->getId(), true);
//            }
//            
//            if($aFile){  
//                            
//                if($oMedia = $this->Media_Upload($aFile, 'user', $this->oUserCurrent->getId()) and is_object($oMedia)){
//                    $this->Media_AttachMedia([$oMedia->getId()], 'test_img_default', $oTest->getId());
//                    $this->Message_AddNotice('Картинка сохранена успешно');
//                }
//
//            }
//        }
//        
//        $_REQUEST = [
//            'state' => $oTest->getState()
//        ];      
//        
//        
//        $aMedias = $this->Media_GetMediaByTarget('test_img_default', $oTest->getId());
//        
//               
//        $this->Viewer_Assign('oTest', $oTest);
//        $this->Viewer_Assign('aMedias', $aMedias);
////        $this->Viewer_Assign('aBilets', $oTest->getBilets());
//        $this->Viewer_Assign('activeNavItem', 'settings');
//    }
}