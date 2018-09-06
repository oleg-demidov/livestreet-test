{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 't-category'}
{component_define_params params=[ 'oCategory' ]}

<div class="{$component}">
    <div class="{$component}-title">
        {$oCategory->getTitle()}
    </div>
    <div class="{$component}-count">
        {$aLang.plugin.test.panel.bilet.count_ask}:{$oCategory->getCountAsks()}
    </div>
    {component 'button' 
        text=$aLang.plugin.test.panel.bilet.button_start 
        url={router page="test/category/{$oCategory->getId()}"}}
</div>
