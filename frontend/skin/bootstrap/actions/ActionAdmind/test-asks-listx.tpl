{**
 * Список тестов
 *
 *}
 
{extends './test.tpl'}

{block 'test_content'}ccc
    {component 'button' text=$aLang.common.add mods="primary" url={router page="admin/plugin/test/ask/add?test={$oTest->getId()}"}}

    {component 'pagination' 
        total=$aPaging.iCountPage 
        current=$aPaging.iCurrentPage 
        url="{$aPaging.sBaseUrl}/page__page__/{$aPaging.sGetParams}" 
        classes='js-pagination-asks'}
    
    {component 'test:a-ask.list' aAsks=$aAsks}
    cc
{/block}cc

 