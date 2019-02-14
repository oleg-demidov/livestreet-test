{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 't-bilet'}
{component_define_params params=[ 'oBilet' ]}

{capture name="content_bilet"}
    {$oBilet->getTitle()}
    <div class="{$component}-count">
        {$aLang.plugin.test.panel.bilet.count_ask}:{$oBilet->getCountAsks()}
    </div>
    <div class="{$component}-count">
        {$aLang.plugin.test.panel.bilet.count_right}:{$oBilet->getRight()}
    </div>
    <div class="{$component}-count">
        {$aLang.plugin.test.panel.bilet.count_wrong}:{$oBilet->getWrong()}
    </div>
    {component 'bs-button' 
        bmods   = "sm success"
        text    = $aLang.plugin.test.panel.bilet.button_start 
        url     = {router page="test/bilet/{$oBilet->getId()}"}}
{/capture}

{component 'bs-card' classes="w-20" content=[
    [   
        type => 'body',
        content => $smarty.capture.content_bilet
    ]
]}
