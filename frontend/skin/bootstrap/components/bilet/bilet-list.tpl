{**
 * Список билетов
 *}

{$component = 't-bilet-list'}
{component_define_params params=[ 'aBilets' ]}

{if $aBilets}
    <div class="{$component} mt-3 d-flex justify-content-between flex-wrap">
        {foreach $aBilets as $oBilet}
                
            {component 'test:bilet' oBilet=$oBilet }

        {/foreach}
    </div>
{else}
    {component 'blankslate' text='Нет билетов. Вы можете добавить.'}
{/if}