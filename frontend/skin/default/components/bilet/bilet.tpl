{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 't-bilet'}
{component_define_params params=[ 'oBilet' ]}

<div class="{$component}">
    <div class="{$component}-title">
        {$oBilet->getTitle()}
    </div>
    <div class="{$component}-count">
        {$aLang.plugin.test.panel.bilet.count_ask}:{$oBilet->getCountAsk()}
    </div>
    {component 'button' 
        text=$aLang.plugin.test.panel.bilet.button_start 
        url={router page="test/bilet/{$oBilet->getId()}"}}
</div>
