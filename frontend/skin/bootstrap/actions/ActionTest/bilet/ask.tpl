{**
 * Панель тестов
 *
 *}
 
{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    {$items = []}
    
    {for $foo=1 to $iCountAsk}
        {if $oBiletSession}
            {$modsAsk = ''}
            {if $oBiletSession->getAskResult($foo) == 1}
                {$modsAsk = 'success'}
            {/if} 
            {if $oBiletSession->getAskResult($foo) == 0}
                {$modsAsk = 'danger'}
            {/if}
        {/if}
        {$items[] = [
            classes => "ml-1",
            'text' => $foo,
            'name' => "ask{$foo}",
            'mods' =>  $modsAsk,
            'url'  => {router page="test/bilet/{$oBilet->getId()}/ask{$foo}"}
        ]}
    {/for}
    
    {if !$hideNow}
        {$activeItem = "ask{$iNumberAsk}"}
    {/if}
    
    {$layoutNav = [[
        hook       => 'bilet',
        activeItem => $activeItem,
        showSingle => true,
        items       => $items,
        bmods       => "pills",
        classes     => 'js-ask-pagination'
    ]]}
{/block}

{block 'layout_page_title'}
    <h2 class="page-header">
        Билет {$oBilet->getTitle()}
    </h2>
{/block}

{block 'layout_content'}
    
    <form method="POST" 
        action="{router page="test/bilet/{$oBilet->getId()}/ask{$iNumberAsk}"}" 
        class="js-test-ask" 
        data-param-type="bilet"
        data-param-id="{$oBilet->getId()}"
        data-param-i-number-ask="{$iNumberAsk}"
        data-next-ask="{$nextAsk}">
        
        {component 'test:ask' 
            classes = "js-test-ask"
            oAsk    = $oAsk 
            aAnses  = $oAsk->getAnses()
            nextUrl = $sNextUrl
            iAnsId  = $iAnsId
            showHint  = $showHint
            showSubmit = $showSubmit
            urlFinish = $urlFinish        
        }
        
        
    </form>
    
{/block}