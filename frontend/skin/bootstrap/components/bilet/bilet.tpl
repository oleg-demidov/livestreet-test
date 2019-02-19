{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 't-bilet'}
{component_define_params params=[ 'oBilet' ]}

{capture name="content_bilet"}
    <h5>{$oBilet->getTitle()}</h5>
    
    <div class="no-gutters row">
        <div class="col-9">{$aLang.plugin.test.panel.bilet.count_ask}:</div>
        <div  class="col-3">{$oBilet->getCountAsks()}</div>
    </div>
    <div class=" no-gutters row {if $oBilet->getWrong()}text-danger{else}text-muted{/if}">
        <div class="col-9">{$aLang.plugin.test.panel.bilet.count_wrong}:</div>
        <div  class="col-3">{$oBilet->getWrong()}</div>
    </div>
    <div class=" no-gutters row {if $oBilet->getRight()}text-success{else}text-muted{/if}">
        <div class="col-9">{$aLang.plugin.test.panel.bilet.count_right}:</div>
        <div class="col-3">{$oBilet->getRight()}</div>
    </div>
    
    {$precent = round($oBilet->getRight()/$oBilet->getCountAsks()*100)}
    
    {component "bs-progressbar" value=$precent classes="my-1" height=3 bg="success"}
    
    {component 'bs-button' 
        bmods   = "sm  success"
        classes = "mt-2"
        text    = $aLang.plugin.test.panel.bilet.button_start 
        url     = {router page="test/bilet/{$oBilet->getId()}"}}
{/capture}

{component 'bs-card' classes="bilet"  content=[

    [   
        type => 'body',
        content => $smarty.capture.content_bilet
    ]
]}
