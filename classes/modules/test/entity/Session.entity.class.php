<?php

class PluginTest_ModuleTest_EntitySession extends Entity
{
    protected $aValidateRules = array(
        array('ask_result', 'number', 'max' => 10000000, 'min' => 1, 'allowEmpty' => false)        
    );
    
    public function Init() {
        $this->data = $this->Session_Get($this->getType(). $this->getId(). '_results');
        if(!$this->data){
            $this->data = [];
        }
    }
        
    public function setAskResult( $bResult) {
        $this->data[$this->getNowAsk()] = $bResult;
    }
    
    public function getAskResult($nAsk) {
        if(!isset( $this->data[$nAsk] )){
            return 2;
        }
        return $this->data[$nAsk];
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function Save() {
        $this->Session_Set($this->getType(). $this->getId(). '_results', $this->data);
    }
    
    public function Drop() {
        $this->Session_Drop($this->getType(). $this->getId(). '_results');
        $this->data = [];
    }
    
    public function getNextAsk() {
        $iNowAsk = $this->getNowAsk();
        
        for($i=0; $i < $this->getCount(); $i++){
            $iNowAsk++;
            
            if($iNowAsk > $this->getCount()){
                $iNowAsk = 1;
            }
            
            if( !isset($this->data[$iNowAsk]) ){
                break;
            }
            
            if($this->data[$iNowAsk] == 2){
                break;
            }
        }
        
        return $iNowAsk;
    }
    
    public function isFinished() {
        if(count($this->data) < $this->getCount()){
            return false;
        }
        
        if(array_search(2, $this->data) !== false){
            return false;
        }
        
        return true;
    }
    
    public function isLast() {
        if($this->getNowAsk() != $this->getNextAsk()){
            return false;
        }        
        return true;
    }
}