{**
 * Список тестов
 *
 *}
 
{extends './test.tpl'}

{block 'test_content'}
    {component 'button' text=$aLang.common.add  url={router page="admin/plugin/test/bilet/add?test={$oTest->getId()}"}}
    
    {component 'test:a-bilet.list' aBilets=$aBilets}
    
{/block}

 