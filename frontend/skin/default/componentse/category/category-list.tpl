{**
 * Список билетов
 *}

{$component = 't-category-list'}
{component_define_params params=[ 'aCategories' ]}

{if $aCategories}
    <div class="{$component}">
        {foreach $aCategories as $oCategory}
                
            {component 'test:category' oCategory=$oCategory}

        {/foreach}
    </div>
{else}
    {component 'blankslate' text='Нет категорий. Вы можете добавить.'}
{/if}