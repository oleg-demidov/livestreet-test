{**
 * Панель тестов
 *
 *}
 
{extends './panel.tpl'}

{block 'panel_content'}
    {component 'button' text=$aLang.plugin.test.panel.hard.begin url="{router page='test'}{$oTest->getCode()}/hard-test/"}
{/block}
