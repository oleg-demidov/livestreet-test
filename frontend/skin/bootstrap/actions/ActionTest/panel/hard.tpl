{**
 * Панель тестов
 *
 *}
 
{extends './panel.tpl'}

{block 'panel_content'}
    
    <div class="my-3">
        <p>{$aLang.plugin.test.panel.hard.text}</p>
    </div>
    
    {component 'bs-button' 
        bmods   = "primary"
        text    = $aLang.plugin.test.panel.hard.begin 
        url     = "{router page='test'}{$oTest->getCode()}/hard-test/"}
{/block}
