{**
 * Панель тестов
 *
 *}
 
{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    {$layoutNav = [[
        hook       => 'panel',
        activeItem => $sMenuItemSelect,
        bmods       => 'tabs',
        classes    => "mt-2",
        showSingle => true,
        items => [
            [ 'name' => 'bilets', 'url' => "{router page='test'}{$oTest->getCode()}/bilets/", 'text' => $aLang.plugin.test.panel.bilets.text],
            [ 'name' => 'categories',  'url' => "{router page='test'}{$oTest->getCode()}/categories/", 'text' => $aLang.plugin.test.panel.categories.text ],
            [ 'name' => 'hard',  'url' => "{router page='test'}{$oTest->getCode()}/hard/", 'text' => $aLang.plugin.test.panel.hard.text ]
        ]
    ]]}
{/block}

{block 'layout_page_title'}
    <h2 class="page-header">
        Тестирование {$oTest->getTitle()}
    </h2>
{/block}

{block 'layout_content'}
    {block 'panel_content'}{/block}
{/block}