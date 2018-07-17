{**
 * Панель тестов
 *
 *}
 
{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    {$items = []}
    
    {for $foo=1 to $iCountAsk}
        {$items[] = [
            'text' => $foo,
            'name' => "ask{$foo}",
            'url'   => {router page="test/bilet/{$oBilet->getId()}/ask{$foo}"}
        ]}
    {/for}
    
    {$layoutNav = [[
        hook       => 'bilet',
        activeItem => "ask{$iNumberAsk}",
        showSingle => true,
        items => $items
    ]]}
{/block}

{block 'layout_page_title'}
    <h2 class="page-header">
        Билет "{$oBilet->getTitle()}"
    </h2>
{/block}

{block 'layout_content'}
    
    {component 'test:ask' oAsk=$oAsk aAnses=$oAsk->getAnses()}
    
{/block}