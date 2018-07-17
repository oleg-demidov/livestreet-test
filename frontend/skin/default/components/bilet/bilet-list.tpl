{**
 * Список билетов
 *}

{$component = 't-bilet-list'}
{component_define_params params=[ 'aBilets' ]}

{if $aBilets}
    <div class="{$component}">
        {foreach $aBilets as $oBilet}
                
            {component 'test:bilet' oBilet=$oBilet}

        {/foreach}
    </div>
{else}
    {component 'blankslate' text='Нет билетов. Вы можете добавить.'}
{/if}