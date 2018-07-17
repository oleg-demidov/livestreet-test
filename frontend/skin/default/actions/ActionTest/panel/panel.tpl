{**
 * Панель тестов
 *
 *}
 
{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    {$layoutNav = [[
        hook       => 'panel',
        activeItem => $sMenuItemSelect,
        showSingle => true,
        items => [
            [ 'name' => 'bilets', 'url' => "{router page='stream'}personal/", 'text' => $aLang.plugin.test.panel.bilets.text, 'is_enabled' => !! $oUserCurrent ],
            [ 'name' => 'categories',  'url' => "{router page='stream'}all/", 'text' => $aLang.plugin.test.panel.categories.text ]
        ]
    ]]}
{/block}

{block 'layout_page_title'}
    <h2 class="page-header">
        Тестирование
    </h2>
{/block}

{block 'layout_content'}
    {block 'panel_content'}{/block}
{/block}