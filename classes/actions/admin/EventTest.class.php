<?php

class PluginTest_ActionAdmin_EventTest extends Event
{

    public function Init()
    {
        
    }

   
    public function EventList()
    {
        $this->SetTemplateAction('list');
//        echo'list';
    }
    
    public function GetCountAdGroupByStatus($iActive, $aFilter = []) {
        return $this->PluginYdirect_Ydirect_GetCountItemsByFilter(array_merge([
            'status' => $iActive,
        ],$aFilter) , 'PluginYdirect_ModuleYdirect_EntityAdGroup');
    }
    
    public function EventEdit()
    {
        $this->Component_Add('user');
        $iAdGroupId = $this->GetParam(1);
        if(!$oAdGroup = $this->PluginYdirect_Ydirect_GetAdGroupById($iAdGroupId)){
            $this->Message_AddError('No AdGroup', null, true);
            Router::LocationAction('admin/plugin/ydirect/adgroups');
        }
        if(!$oCampaign = $oAdGroup->getCampaign()){
            $this->Message_AddError('No Campaign', null, true);
            Router::LocationAction('admin/plugin/ydirect/adgroups');
        }
        
        if(isPost()){
            $oAdGroup->setName(getRequest('name'));
            $oAdGroup->setYcampaignId($oCampaign->getYcampaignId());
            
            if(getRequest('active')){
                $oAdGroup->YdSave();
                
                $aKeywords = $oAdGroup->getKeywords([
                    '#index-from' => 'yadgroup_id', 
                    '#where' => ['t.ykeyword_id is null or t.ykeyword_id = ?' => ['']]]);
                $this->PluginYdirect_Ydirect_KeywordsCreate($aKeywords);
                
                $aAdsNew = $oAdGroup->getAds([ 'status' => 'new']);
                $this->PluginYdirect_Ydirect_AdsCreate($aAdsNew);
                
                $aAdsNew = $oAdGroup->getAds(['#index-from' => 'yads_id', 'status in' => ['draft','rejected']]);
                $this->PluginYdirect_Ydirect_AdsModerate($aAdsNew);
                
                $aAdsSuspend = $oAdGroup->getAds(['#index-from' => 'yads_id', 'state in' => ['suspended']]);
                $this->PluginYdirect_Ydirect_AdsResume(array_keys($aAdsSuspend));
                $oAdGroup->setState('on');
                $oAdGroup->Save();
            }else{
                $oAdGroup->Suspend();
            }
        }        
        $this->Viewer_Assign('oAdGroup',$oAdGroup);        
        $this->SetTemplateAction('adgroup-edit');
        
    }
    
}