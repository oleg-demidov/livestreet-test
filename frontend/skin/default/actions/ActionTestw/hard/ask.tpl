{**
 * Панель тестов
 *
 *}
 
{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    {$items = []}
    
    {for $foo=1 to $iCountAsk}
        {if $oHardSession}
            {$modsAsk = ''}
            {if $oHardSession->getAskResult($foo) == 1}
                {$modsAsk = 'success'}
            {/if} 
            {if $oHardSession->getAskResult($foo) == 0}
                {$modsAsk = 'danger'}
            {/if}
        {/if}
        {$items[] = [
            'text' => $foo,
            'name' => "ask{$foo}",
            'mods' =>  $modsAsk,
            'url'  => {router page="test/{$oTest->getCode()}/hard-test/ask{$foo}"}
        ]}
    {/for}
    
    {if !$hideNow}
        {$activeItem = "ask{$iNumberAsk}"}
    {/if}
    
    {$layoutNav = [[
        hook       => 'bilet',
        activeItem => $activeItem,
        showSingle => true,
        items => $items,
        classes => 'js-ask-pagination'
    ]]}
{/block}

{block 'layout_page_title'}
    <h2 class="page-header">
        {$aLang.plugin.test.panel.hard.text}
    </h2>
{/block}

{block 'layout_content'}
    
    <form method="POST" 
        action="{router page="test/{$oTest->getCode()}/hard-test/ask{$iNumberAsk}"}" 
        class="js-test-ask" 
        data-param-type="hard"
        data-param-id="{$oTest->getId()}"
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
        
        <input type="hidden" name="action" value="submit" />
    </form>
    
{/block}