{**
 * Список билетов
 *}

{$component = 't-category-list'}
{component_define_params params=[ 'aCategories' ]}

{if $aCategories}
    <div class="{$component} d-none d-sm-block mt-3 mx-3">
        <div class="row">
            <div class="col-sm-5 pt-1">
            </div>
            <div class="col-sm-2  pt-1">
                {$aLang.plugin.test.panel.categories.colls.count_asks}
            </div>
            <div class="col-sm-1  pt-1 text-success">
                {$aLang.plugin.test.panel.categories.colls.count_right}
            </div>
            <div class="col-sm-2  pt-1 text-danger">
                {$aLang.plugin.test.panel.categories.colls.count_wrong}
            </div>
            <div class="col-sm-2">
               
            </div>
        </div>
        
        
    </div>
    {foreach name="category_list" from=$aCategories item="oCategory"}
        
        {component 'test:category' classes="mt-2" oCategory=$oCategory}

    {/foreach}
{else}
    {component 'blankslate' classes="mt-3" text='Нет категорий. Вы можете добавить.'}
    
{/if}