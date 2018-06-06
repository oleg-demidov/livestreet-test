<?php

class PluginTest_ActionAdmin_EventAsk extends Event
{

    public function Init()
    {
        
    }

    
    public function EventAddEdit() {
        $this->SetTemplateAction('ask-add');
        
        $aAnses = [];
        if($oAsk = $this->PluginTest_Test_GetAskById($this->GetParam(1))){
            
            $oTest  = $oAsk->getTest();
        }else{
            $oTest  = $this->PluginTest_Test_GetTestById(getRequest('test'));
            $oAsk = Engine::GetEntity('PluginTest_Test_Ask');
        }
        
        if(!$oTest){
            $this->Message_AddErrorSingle($this->Lang_Get('plugin.test.admin.bilet.notices.no_test_find'));
            return false;
            //Router:Action
        }
        
        if(isPost()){
            $oAsk->_setData( getRequest('ask') ); 
            
            $oAsk->setAnsesValues( getRequest('anses') );
            $oAsk->setTestId( $oTest->getId() );            
          
            if($oAsk->_Validate()){
                if($oAsk->Save()){
                    $this->Message_AddNoticeSingle($this->Lang_Get('common.success.save'), '', true);
                    Router::LocationAction('admin/plugin/test/'.$oTest->getCode());
                }else{
                    $this->Message_AddErrorSingle($this->Lang_Get('common.error.system.base'));
                }
            }else{
                foreach($oAsk->_getValidateErrors() as $aError){
                    $this->Message_AddError($aError[0], $this->Lang_Get('common.error.error'));
                }
            }      
        }
        
        $oAnsRight = $oAsk->getAns(['is_right' => 1]);
        
        $_REQUEST['ask'] = $oAsk->_getData();
        if($oAnsRight){
            $_REQUEST['ask']['right_ans_value'] = $oAnsRight->getValue();
        }
        
        
        if(($oCategory = $oAsk->category->getCategory())){
            $_REQUEST['ask']['category'] = $oCategory->getId();
        }
        
        $aAnses = $oAsk->getAnses();
        if(sizeof($aAnses)){
            $_REQUEST['anses'] = [];
            foreach ($aAnses as $oAns) {
                $_REQUEST['anses'][$oAns->getId()] = $oAns->getValue();
            }
        }
        
        $this->Viewer_Assign('oAnsRight', $oAnsRight);
        $this->Viewer_Assign('aBilets', $oTest->getBilets());
        $this->Viewer_Assign('aCategories', $oTest->getCategoriesItems());
    }
    
    
}