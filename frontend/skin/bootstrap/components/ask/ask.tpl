{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'test-ask'}
{component_define_params params=[ 'oAsk', 'aAnses', 'nextUrl', 'iAnsId', 'showHint', 'showSubmit', 'urlFinish', 'attributes', 'mods', 'classes' ]}


<div class="js-{$component}-inner">

    
    {if $image = $oAsk->getImage('500x') }
        <img src="{$image}">
    {else}
        <img src="{$componentAskWebPath}/img/no-image.png">
    {/if}

    {component 'bs-text' classes="h4 mx-3" text=$oAsk->getText()}

    <ul>
        {foreach $aAnses as $oAns}
            <li>
                {$mods = ""}
                {if $iAnsId}
                    {if $oAns->getIsRight()}
                        {$classes = "is-valid"}
                    {else}
                        {if $oAns->getId() == $iAnsId}
                            {$classes = "is-invalid"}
                        {/if}
                    {/if}
                {/if}

                {component 'bs-form.checkbox' 
                    radio   = true
                    name    = 'ans' 
                    checked = ($oAns->getId() == $iAnsId)
                    classes    = $classes 
                    value   = $oAns->getId() 
                    label   = $oAns->getValue()}
            </li>
        {/foreach}
    </ul>

    {$itemsAction = []}

    {if $showSubmit}
        {$itemsAction[] = [
            'buttons' => [
                [ 
                    'icon' => 'check',
                    text    => {$aLang.plugin.test.ask.form.asn_but.text},
                    mods    => 'success',
                    type    => 'submit'
                ]
            ]
        ]}  
    {/if}

    {if $nextUrl}
        {if !$iAnsId}
            {$itemsAction[] = [
                'buttons' => [
                    [ 
                        'icon'  => 'arrow-right',
                        text    => {$aLang.plugin.test.ask.form.skip_but.text},
                        url     =>  $nextUrl,
                        classes =>  'js-next-ask'
                    ]
                ]
            ]}  
        {else}
            {$itemsAction[] = [
                'buttons' => [
                    [ 
                        'icon'  => 'arrow-right',
                        text    => {$aLang.plugin.test.ask.form.next_but.text},
                        url     =>  $nextUrl,
                        mods    => 'primary',
                        classes =>  'js-next-ask'
                    ]
                ]
            ]}  
        {/if}
    {/if}

    {if $showHint}
        {component 'text' text=$oAsk->getHint()}
    {/if}

    {if $urlFinish}
        {$itemsAction[] = [
            'buttons' => [
                [ 
                    'icon' => 'check',
                    text    => {$aLang.plugin.test.ask.form.finish_but.text},
                    mods    => 'success',
                    url    => $urlFinish
                ]
            ]
        ]}
    {/if}

    {component 'actionbar' items=$itemsAction}
    <input type="hidden" name="action" value="submit" />
</div>

