{**
 * Панель тестов
 *
 *}
 
{extends './panel.tpl'}

{block 'panel_content'}
    
    <div class="my-3">
        <p>{lang name='plugin.test.panel.hard.text' count=Config::Get('plugin.test.test.hard.count')}</p>
    </div>
    
    {component 'bs-button' 
        bmods   = "primary"
        text    = $aLang.plugin.test.panel.hard.begin 
        url     = "{router page='test'}{$oTest->getCode()}/hard-test/"}
{/block}
