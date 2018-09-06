<?php

class PluginTest_ModuleTest_EntityTest extends EntityORM
{

    protected $aValidateRules = array(
        array('title', 'string', 'min' => 3, 'max'=>100, 'allowEmpty' => false),
        array('code', 'string', 'min' => 3, 'max'=>50, 'allowEmpty' => false),
        array('code', 'code', 'allowEmpty' => false),
    );
    
    protected $aRelations = array(
        'bilets' => array( self::RELATION_TYPE_HAS_MANY, 'PluginTest_ModuleTest_EntityBilet', 'test_id' ),
        'asks' => array( self::RELATION_TYPE_HAS_MANY, 'PluginTest_ModuleTest_EntityAsk', 'test_id' )
    );
    
    protected $aBehaviors = array(
        // Категории
        'category' => array(
            'class'       => 'ModuleCategory_BehaviorEntity',
            'target_type' => 'test',
        ),
    );
    
    public function ValidateCode($mValue) {
        if(!$this->_isNew()){
            return true;
        }
        
        $oTest = $this->PluginTest_Test_GetTestByFilter(['code' => $mValue]);
        if($oTest){
            return $this->Lang_Get('plugin.test.admin.test.validate_errors.code_not_uniq');
        }
        return true; 
    }
    
    public function beforeSave() {
        if( ($bRes = parent::beforeSave()) ){
            if($oCategory = $this->Category_GetCategoryByFilter(['url' => $this->_getOriginalDataOne('code')])){
                $oCategory->setUrl($this->getCode());
                $oCategory->setUrlFull($this->getCode());
                $oCategory->Save();
                
                $this->Category_RebuildCategoryUrlFull($oCategory);
            }
        }
        return $bRes;
    }
    
    public function afterSave() {
        parent::afterSave();
        
        if(!$this->_isNew()){
            return true;
        }
        
        if (!$oType = $this->Category_GetTypeByTargetTypeAndState('test', ModuleCategory::TARGET_STATE_ACTIVE)) {
            return false;
        }
        
        if(!$oCategory = $this->Category_GetCategoryByUrl($this->getCode())){
            $oCategory = Engine::GetEntity('ModuleCategory_EntityCategory');
        }
        $oCategory->setTitle($this->getTitle());
        $oCategory->setTypeId($oType->getId());
        $oCategory->setState(1);
        $oCategory->setDescription('Категория для теста '.$this->getTitle());
        $oCategory->setUrl($this->getCode());
        $oCategory->setUrlFull($this->getCode());
        return $oCategory->Save();
    }
    
    public function getUrlEdit() {
        return Router::GetPath('admin/plugin/test/edit/'.$this->getId());
    }
    
    public function getCountAsks() {
        return $this->PluginTest_Test_GetCountFromAskByFilter(['test_id' => $this->getId()]);
    }
    
    public function getCategoriesItems( $aFilter = [] ) {
        $oCategory = $this->Category_GetCategoryByFilter([
            "url" => $this->getCode()
        ]);
        if(!$oCategory){
            return [];
        }
        return $oCategory->getChildren($aFilter);
    }
    
    /*
     * Получить тест из самых сложных вопросов
     * 
     */
    public function getHard($iLimit = 100) {
        return $this->PluginTest_Test_GetHardByTestId($this->getId(), $iLimit);
    }
    
}