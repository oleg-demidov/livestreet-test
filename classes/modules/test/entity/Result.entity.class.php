<?php

class PluginTest_ModuleTest_EntityResult extends EntityORM
{
    protected $aValidateRules = array(
        array('user_id', 'user_id', 'allowEmpty' => false),
        array('ask_id', 'number', 'allowEmpty' => false),
        array('type', 'string', 'max' => 50, 'min' => 1, 'allowEmpty' => false),
        array('ans_id', 'ans_id', 'allowEmpty' => false)
    );
    
    protected $aRelations = array(
        'ask' => array( self::RELATION_TYPE_BELONGS_TO, 'PluginTest_ModuleTest_EntityAsk', 'ask_id' )
    );
    
    public function ValidateUserId($iUserId) {
        if($this->getTmp()){
            return true;
        }
        
        if(!$oUser = $this->User_GetUserCurrent()){
            return $this->Lang_Get('plugin.test.result.validate.no_user');
        }
        
        if($iUserId != $oUser->getId()){
            return $this->Lang_Get('plugin.test.result.validate.no_user_current');
        }
        
        return true;
    }
    
    public function ValidateAskId($iAskId) {
        if(!$oAsk = $this->getAsk()){
            return $this->Lang_Get('plugin.test.ask.error.no_find');
        }
        
        return true;
    }
        
    public function ValidateAnsId($iAnsId) {
        if(!$oAsk = $this->getAsk()){
            return $this->Lang_Get('plugin.test.ask.error.no_find');
        }
        
        if(!$iAnsId){
            return $this->Lang_Get('plugin.test.result.validate.no_ans_id');
        }
        $oAnsRight = $oAsk->getAns(['is_right' => 1]);
        
        $this->setResult( (int)($iAnsId == $oAnsRight->getId()) );
        
        return true;
    }
    
}