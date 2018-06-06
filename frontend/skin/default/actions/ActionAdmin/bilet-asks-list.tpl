{**
 * Список тестов
 *
 *}
 
{extends './bilet.tpl'}

{block 'bilet_content'}
    {component 'button' text=$aLang.common.add mods="primary" url={router page="admin/plugin/test/ask/add?test={$oTest->getId()}"}}
    
    {component 'test:a-ask.list' aAsks=$aAsks}
    
{/block}

 