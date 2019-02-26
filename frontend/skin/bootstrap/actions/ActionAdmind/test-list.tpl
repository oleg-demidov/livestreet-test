{**
 * Список тестов
 *
 *}
<h3>Список тестов</h3>

{block 'test_content'}
    {component 'button' text=$aLang.common.add  url={router page="admin/plugin/test/add"}}
    
    {component 'test:a-test.list' aTests=$aTests}
    
{/block}

 