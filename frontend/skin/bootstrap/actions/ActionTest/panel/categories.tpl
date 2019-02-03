{**
 * Панель тестов
 *
 *}
 
{extends './panel.tpl'}

{block 'panel_content'}
    {component 'test:category.list' aCategories=$aCategories}
{/block}
