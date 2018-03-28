<?php
/*
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Maxim Mzhelskiy <rus.engine@gmail.com>
 *
 */

/**
 * Сущность категории
 *
 * @package application.modules.category
 * @since 2.0
 */
class PluginFixCategory_ModuleCategory_EntityCategory extends PluginFixCategory_Inherit_ModuleCategory_EntityCategory
{

    protected $aValidateRules = array(
        array('title', 'string', 'max' => 200, 'min' => 1, 'allowEmpty' => false),
        array('description', 'string', 'max' => 5000, 'min' => 1, 'allowEmpty' => true),
        array('url', 'regexp', 'pattern' => '/^[\w\-_]+$/i', 'allowEmpty' => false),
        array('order', 'number', 'integerOnly' => true),
        array('pid', 'parent_category'),
        array('order', 'order_check'),
        array('icon', 'icon_check'),
    );
    
    public function Init() {
        $this->Hook_Run('fix_init_category_entity', ['entity'=>&$this]);        
    }
    
    
    public function _setRelations($aRelations) {
        $this->aRelations = array_merge($this->aRelations, $aRelations);        
    }
    
    public function beforeSave() {
        if($bResult = parent::beforeSave()){
            $this->Hook_Run('fix_category_before_save', ['entity'=>$this, 'bResult'=> &$bResult]);
        }
        return $bResult;
    }
    
    public function afterSave() {
        parent::afterSave();
        $this->Hook_Run('fix_category_after_save', ['entity'=>$this]);
    }
    
    public function beforeDelete() {
        $this->Hook_Run('fix_category_before_delete', ['entity'=>$this]);
        return parent::beforeDelete();
    }
    
        
    public function setIcon($sValue) {
        $this->setData(array_merge($this->getData(), ['icon' => $sValue] ));
    }
    
    public function _getIcon() {
        $aData = $this->getData();
        return (is_array($aData) and isset( $aData['icon']))?$aData['icon']:null;
    }
    
    public function ValidateIconCheck($sValue, $aParams)
    {
        $this->setIcon($sValue);
        return true;
    }
}