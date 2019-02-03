{**
 * Панель тестов
 *
 *}
 
{extends './panel.tpl'}

{block 'panel_content'}
    {component 'test:bilet.list' aBilets=$aBilets}
{/block}
