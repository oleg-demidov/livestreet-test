<?php

class PluginTest_ActionTest_EventPanel extends Event
{
    
    public function Init()
    {
        $this->oTest = $this->PluginTest_Test_GetTestByCode( $this->sCurrentEvent );
        
        if(!$this->oTest){
            return parent::EventNotFound();
        }
        
        $this->sMenuHeadItemSelect = $this->oTest->getCode();
        
        
    }
    
    public function EventIndex() {
        /**
         * Проверяем есть ли такой топик
         */
        if (!($oTopic = $this->Topic_GetTopicById($this->oTest->getTopicId()))) {
            return parent::EventNotFound();
        }
        
        
        
        $this->sMenuSubItemSelect = '';
        
        /**
         * Проверяем права на просмотр топика
         */
        if (!$this->ACL_IsAllowShowTopic($oTopic, $this->oUserCurrent)) {
            return parent::EventNotFound();
        }
        /**
         * Достаём комменты к топику
         */
        if (!Config::Get('module.comment.nested_page_reverse') and Config::Get('module.comment.use_nested') and Config::Get('module.comment.nested_per_page')) {
            $iPageDef = ceil($this->Comment_GetCountCommentsRootByTargetId($oTopic->getId(),
                    'topic') / Config::Get('module.comment.nested_per_page'));
        } else {
            $iPageDef = 1;
        }
        $iPage = getRequest('cmtpage', 0) ? (int)getRequest('cmtpage', 0) : $iPageDef;
        $aReturn = $this->Comment_GetCommentsByTargetId($oTopic->getId(), 'topic', $iPage,
            Config::Get('module.comment.nested_per_page'));
        $iMaxIdComment = $aReturn['iMaxIdComment'];
        $aComments = $aReturn['comments'];
        /**
         * Если используется постраничность для комментариев - формируем ее
         */
        if (Config::Get('module.comment.use_nested') and Config::Get('module.comment.nested_per_page')) {
            $aPaging = $this->Viewer_MakePaging($aReturn['count'], $iPage,
                Config::Get('module.comment.nested_per_page'), Config::Get('pagination.pages.count'), '');
            $this->Viewer_Assign('pagingComments', $aPaging);
        }
        /**
         * Отмечаем дату прочтения топика
         */
        if ($this->oUserCurrent) {
            $oTopicRead = Engine::GetEntity('Topic_TopicRead');
            $oTopicRead->setTopicId($oTopic->getId());
            $oTopicRead->setUserId($this->oUserCurrent->getId());
            $oTopicRead->setCommentCountLast($oTopic->getCountComment());
            $oTopicRead->setCommentIdLast($iMaxIdComment);
            $oTopicRead->setDateRead(date("Y-m-d H:i:s"));
            $this->Topic_SetTopicRead($oTopicRead);
        }
        /**
         * Выставляем SEO данные
         */
        $sTextSeo = strip_tags($oTopic->getText());
        $this->Viewer_SetHtmlDescription(func_text_words($sTextSeo, Config::Get('seo.description_words_count')));
        $this->Viewer_SetHtmlKeywords($oTopic->getTags());
        $this->Viewer_SetHtmlCanonical($oTopic->getUrl());
        /**
         * Open Graph
         */
        $this->Viewer_SetOpenGraphProperty('og:type', 'article');
        $this->Viewer_SetOpenGraphProperty('og:title', $oTopic->getTitle());
        $this->Viewer_SetOpenGraphProperty('og:description', $this->Viewer_GetHtmlDescription());
        $this->Viewer_SetOpenGraphProperty('og:url', $oTopic->getUrl());
        $this->Viewer_SetOpenGraphProperty('article:author', $oTopic->getUser()->getUserWebPath());
        $this->Viewer_SetOpenGraphProperty('article:published_time', date('c', strtotime($oTopic->getDatePublish())));
        if ($sImage = $oTopic->getPreviewImageWebPath(Config::Get('module.topic.default_preview_size'))) {
            $this->Viewer_SetOpenGraphProperty('og:image', $sImage);
        }
        if ($aTags = $oTopic->getTagsArray()) {
            $this->Viewer_SetOpenGraphProperty('article:tag', $aTags);
        }
        /**
         * Вызов хуков
         */
        $this->Hook_Run('topic_show', array("oTopic" => $oTopic));
        /**
         * Загружаем переменные в шаблон
         */
        $this->SetTemplateAction('panel/index');        
        $this->Viewer_Assign('topic', $oTopic);
        $this->Viewer_Assign('comments', $aComments);
        $this->Viewer_Assign('lastCommentId', $iMaxIdComment);
        /**
         * Устанавливаем title страницы
         */
        $this->Viewer_AddHtmlTitle($oTopic->getBlog()->getTitle());
        $this->Viewer_AddHtmlTitle($oTopic->getTitle());
        $this->Viewer_SetHtmlRssAlternate(Router::GetPath('rss') . 'comments/' . $oTopic->getId() . '/',
            $oTopic->getTitle());
    }

    public function EventBilets() {
        
        $aBilets = $this->PluginTest_Test_GetBiletItemsByFilter([
            'test_id' => $this->oTest->getId(),
            '#select' => ['t.*','count(a.id) as count_ask'],
            '#join' => ['LEFT JOIN '.Config::Get('db.table.test_test_ask').' a ON a.bilet_id = t.id'],
            '#group' => ['id'],
            '#index-from' => 'id'
        ]);
        
        if ($this->oUserCurrent){
            $this->PluginTest_Test_AttachResultsToBilets($aBilets, $this->oUserCurrent);
        }
        
        $this->SetTemplateAction('panel/bilets');        
        $this->Viewer_Assign('sMenuItemSelect', 'bilets');
        $this->Viewer_Assign('aBilets', $aBilets);
    }
    
    public function EventCategories() {
        
        $oCategory = $this->PluginTest_Test_GetCategoryByFilter([ 'url' => $this->oTest->getCode() ]);
        
        $aCategories = $oCategory->getDescendants();
        
        $this->SetTemplateAction('panel/categories');        
        $this->Viewer_Assign('sMenuItemSelect', 'categories');
        $this->Viewer_Assign('aCategories', $aCategories);
    }
    
    public function EventHard() {
        
        $this->SetTemplateAction('panel/hard');        
        $this->Viewer_Assign('sMenuItemSelect', 'hard');
        
    }
    
    public function EventShutdown() {
        $this->Viewer_Assign('oTest', $this->oTest);
    }
}