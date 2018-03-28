<?php

class PluginFixCategory_ModuleCategory extends PluginFixCategory_Inherit_ModuleCategory
{
    public function GetEntityCategories($oTarget, $sTargetType)
    {
        $aCategories = $oTarget->_getDataOne('_categories');
        if (is_null($aCategories)) {
            $this->AttachCategoriesForTargetItems($oTarget, $sTargetType);
            return is_array($oTarget->_getDataOne('_categories'))?$oTarget->_getDataOne('_categories'):[];
        }
        return is_array($aCategories)?$aCategories:[];
    }
    
    public function SaveCategories($oTarget, $sTargetType, $mCallbackCountTarget = null)
    {   
        $aCategoriesId = $oTarget->_getDataOne('_categories_for_save');
        if (!is_array($aCategoriesId)) {
            return;
        }       
                
        
        $aSpecTargets = $this->Category_GetTargetItemsByFilter([
            'target_id' => $oTarget->_getPrimaryKeyValue(),
            'object_type' => $oTarget->category->getParam('object_type'),
            'target_type' => $sTargetType,
            '#index-from' => 'category_id'
        ]);
        
        
        foreach ($aSpecTargets as $key => $oSpecTarget) {
            if(($keySearch = array_search($key, $aCategoriesId)) === false){
                $oSpecTarget->Delete();
                unset($aSpecTargets[$key]);
            }else{
                unset($aCategoriesId[$keySearch]);
            }
        }
        
        /**
         * Удаляем текущие связи
         */
        //$aCategoryIdChanged = $this->RemoveRelation($oTarget->_getPrimaryKeyValue(), $sTargetType);
        /**
         * Создаем
         */
        $this->CreateRelation($aCategoriesId, $oTarget->_getPrimaryKeyValue(), $sTargetType, $oTarget->category->getParam('object_type') );
        /**
         * Полный список категорий, которые затронули изменения
         */
        /**
         * Подсчитываем количество новое элементов для каждой категории
         */
        $this->UpdateCountTarget($aCategoriesId, $sTargetType, $mCallbackCountTarget, $oTarget->category->getParam('object_type'));

        $oTarget->_setData(array('_categories_for_save' => null));
    }
	
    public function RemoveCategories($oTarget, $sTargetType, $mCallbackCountTarget = null)
    {
        $aCategoryIdChanged = $this->RemoveRelation($oTarget->_getPrimaryKeyValue(), $sTargetType);
        /**
         * Подсчитываем количество новое элементов для каждой категории
         */
        $this->UpdateCountTarget($aCategoryIdChanged, $sTargetType, $mCallbackCountTarget,  $oTarget->category->getParam('object_type'));
    }
    
    public function CreateRelation($aCategoryId, $iTargetId, $iType, $sObjectType=null)
    {
        
        if (!$aCategoryId or (is_array($aCategoryId) and !count($aCategoryId))) {
            return false;
        }
       
        if (!is_array($aCategoryId)) {
            $aCategoryId = array($aCategoryId);
        } 
        if (is_numeric($iType)) {
            $oType = $this->GetTypeById($iType);
        } else {
            $oType = $this->GetTypeByTargetType($iType);
        }
        if (!$oType) {
            return false;
        }
        
        foreach ($aCategoryId as $iCategoryId) {
            if (!$this->GetTargetByCategoryIdAndTargetIdAndTypeId($iCategoryId, $iTargetId, $oType->getId())) {
                $oTarget = Engine::GetEntity('ModuleCategory_EntityTarget');
                $oTarget->setCategoryId($iCategoryId);
                $oTarget->setTargetId($iTargetId);
                $oTarget->setTargetType($oType->getTargetType());
                $oTarget->setObjectType( $sObjectType );
                $oTarget->setTypeId($oType->getId());
                
                $oTarget->Add();
            }
        }
        return true;
    }
    
    public function RewriteFilter($aFilter, $sEntityFull, $sTargetType)
    {
        $oEntitySample = Engine::GetEntity($sEntityFull);

        if (!isset($aFilter['#join'])) {
            $aFilter['#join'] = array();
        }

        if (!isset($aFilter['#select'])) {
            $aFilter['#select'] = array();
        }
        if (!isset($aFilter['#category'])) {
            return $aFilter;
        }

        
        if (array_key_exists('#category', $aFilter)) {
            $aCategoryId = $aFilter['#category'];
            if (!is_array($aCategoryId)) {
                $aCategoryId = array($aCategoryId);
            }
            
            $aCategories = $this->GetCategoryItemsByFilter(['id in' => $aCategoryId]);
            $aCategoryId = [];
            foreach($aCategories as $oCategory){
                $aCategoryId = array_merge($aCategoryId, $this->GetChildsIds($oCategory));
            }      
            
            if($oEntitySample->category){
                $sJoin = "JOIN " . Config::Get('db.table.category_target') . " category ON
                    t.`{$oEntitySample->_getPrimaryKey()}` = category.target_id and
                    category.target_type = '{$sTargetType}' 
                    and category.object_type = '".$oEntitySample->category->getParam('object_type')."'
                    and category.category_id IN ( ?a ) ";
                    //echo $sJoin;
                $aFilter['#join'][$sJoin] = array($aCategoryId);
                /*if (count($aFilter['#select'])) {
                    $aFilter['#select'][] = "distinct t.`{$oEntitySample->_getPrimaryKey()}`";
                } else {
                    $aFilter['#select'][] = "distinct t.`{$oEntitySample->_getPrimaryKey()}`";
                    $aFilter['#select'][] = 't.*';
                }*/
            }
        }
        return $aFilter;
    }
    
    public function GetChildsIds($oCategory) {
        $aCategoryId = [$oCategory->getId()];
        $aCategories = $oCategory->getChildren();
        foreach($aCategories as $oCategory){
            $aCategoryId = array_merge($aCategoryId, $this->GetChildsIds($oCategory));
        }
        return $aCategoryId;
    }
    /**
     * Цепляет для списка объектов категории
     *
     * @param array $aEntityItems
     * @param string $sTargetType
     */
    public function AttachCategoriesForTargetItems($aEntityItems, $sTargetType)
    {
        if (!is_array($aEntityItems)) {
            $aEntityItems = array($aEntityItems);
        }
        $aEntitiesId = array();
        foreach ($aEntityItems as $oEntity) {
            $aEntitiesId[] = $oEntity->getId();
        }
        /**
         * Получаем категории для всех объектов
         */
        $sEntityCategory = $this->_NormalizeEntityRootName('Category');
        $sEntityTarget = $this->_NormalizeEntityRootName('Target');
        $aCategories = $this->GetCategoryItemsByFilter(array(
            '#join'        => array(
                "JOIN " . Config::Get('db.table.category_target') . " ct ON
                        t.id = ct.category_id and
                        ct.target_type = '{$sTargetType}' and
                        ct.object_type = '".$aEntityItems[0]->category->getParam('object_type')."' and
                        ct.target_id IN ( ?a )
                        " => array($aEntitiesId)
            ),
            '#select'      => array(
                't.*',
                'ct.target_id'
            ),
            '#index-group' => 'target_id',
            '#cache'       => array(
                null,
                array(
                    $sEntityCategory . '_save',
                    $sEntityCategory . '_delete',
                    $sEntityTarget . '_save',
                    $sEntityTarget . '_delete'
                )
            )
        ));
        //echo $aEntityItems[0]->getId().';';
        /**
         * Собираем данные
         */
        foreach ($aEntityItems as $oEntity) {
            if (isset($aCategories[$oEntity->_getPrimaryKeyValue()])) {
                $oEntity->_setData(array('_categories' => $aCategories[$oEntity->_getPrimaryKeyValue()]));
            } else {
                //$oEntity->_setData(array('_categories' => array()));
            }
        }
        //print_r($aEntityItems);
    }
    
    public function GetMenuTree($aSpecializations, $aSpecSelected = []) {
        if(!is_array($aSpecSelected)){
            $aSpecSelected = [$aSpecSelected];
        }
        $aRequest = getRequest('specialization', []);
        $aSpecSelected= array_merge($aSpecSelected, $aRequest);
        
        $aItems = [];
        foreach ($aSpecializations as $oSpecialization){
            $aItems[] =  $this->getChildItems($oSpecialization, [], $aSpecSelected);
        }        
    
        return $aItems;
    }
    
    public function getCategoryParents($oCategory, $aParents = []){
        $aParents[] = $oCategory;
        
        if(!$oParent = $oCategory->getParent()){
            return $aParents;
        }
        $this->getCategoryParents($oParent, $aParents);
        
    }
    
    public function getChildItems($oSpecialization, $aParentKeys = [], $aSpecSelected = []){
        
        $aSpecChilds = $oSpecialization->getChildren();
        
        if($oSpecialization->_getTreeParentKeyValue()){
            $aParentKeys[] = $oSpecialization->_getTreeParentKeyValue();
        }
        
        $aItemsMenu = [];
        foreach ($aSpecChilds as $oSpecChild){
            $aItemsMenu[] = $this->getChildItems($oSpecChild, $aParentKeys, $aSpecSelected);
        }
        if(!sizeof($aItemsMenu)){
            $aItem = ['html' => $this->GetMenuCheckbox($oSpecialization, $aParentKeys,
                    in_array($oSpecialization->getId(), $aSpecSelected)) ];
        }else{
            $aItem = [
                'text' => $oSpecialization->getTitle(), 
                'attributes' => ['data-id' => $oSpecialization->getId()], 
                'menu' => [ 'items' => $aItemsMenu] ];
        }
        return $aItem;
    }

    public function GetMenuCheckbox($oSpec, $aParentKeys, $checked) {
        $sSpec = $oSpec->getDescription()?$oSpec->getDescription():$oSpec->getTitle();
        $oViewer = $this->Viewer_GetLocalViewer();
        $oViewer->Assign('label' , $sSpec, true);
        $oViewer->Assign('value' , $oSpec->getId(), true);
        $oViewer->Assign('checked' , $checked, true);
        $oViewer->Assign('classes' , 'fl-specialization-tree-checkbox', true);
        $oViewer->Assign('attributes' , ['data-val' => $sSpec,'data-parent-ids' => implode(',', $aParentKeys)], true);
        return $oViewer->Fetch('component@field.checkbox');
    }
    
    protected function UpdateCountTarget($aCategoryId, $sTargetType, $mCallback = null , $sObjectType = 'user')
    {
        if (!is_array($aCategoryId)) {
            $aCategoryId = array($aCategoryId);
        }
        if (!count($aCategoryId)) {
            return;
        }
        $aCategories = $this->GetCategoryItemsByArrayId($aCategoryId);
        foreach ($aCategories as $oCategory) {
            if ($mCallback) {
                if (is_string($mCallback)) {
                    $mCallback = array($this, $mCallback);
                }
                $iCount = call_user_func_array($mCallback, array($oCategory, $sTargetType));
            } else {
                $iCount = $this->GetCountItemsByFilter(array(
                        'target_type' => $sTargetType, 
                        'category_id' => $oCategory->getId(), 
                        'object_type' => $sObjectType),
                    'ModuleCategory_EntityTarget');
            }
            $oCategory->setCountTarget($iCount);
            $oCategory->Update();
        }
    }
    
}