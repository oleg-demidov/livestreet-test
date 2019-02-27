{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'test-ask'}
{component_define_params params=[ 'oAsk', 'aAnses', 'nextUrl', 'iAnsId', 'showHint', 'showSubmit', 'urlFinish', 'attributes', 'mods', 'classes' ]}


<div class="{$component} mt-3 js-{$component}-inner">

    
    {if $image = $oAsk->getImage('500x') }
        <img src="{$image}">
    {else}
        <img src="{$componentAskWebPath}/img/no-image.png">
    {/if}

    {component 'bs-text' classes="h4 mt-3" text=$oAsk->getText()}

    <div class="d-flex flex-column mt-3">
        {foreach $aAnses as $oAns}
            {$classRight = ""}
            {$classWrap = ""}
            {if $iAnsId}
                {if $oAns->getIsRight()}
                    {$classRight = "is-valid"}
                    {$classWrap = "border-success"}
                {else}
                    {if $oAns->getId() == $iAnsId}
                        {$classRight = "is-invalid"}
                        {$classWrap = "border-danger"}
                    {/if}
                {/if}
            {/if}
            <div class="border p-2 mt-1 rounded {$classWrap}">
                {component 'bs-form.checkbox' 
                    radio   = true
                    name    = 'ans' 
                    checked = ($oAns->getId() == $iAnsId)
                    classes = $classRight
                    value   = $oAns->getId() 
                    label   = $oAns->getValue()}
            </div>
        {/foreach}
    </div>

    {$itemsAction = []}

    {if $showSubmit}
        {$itemsAction[] = {component "bs-button"
            icon    = 'check'
            text    = {$aLang.plugin.test.ask.form.asn_but.text}
            bmods   = 'success'
            type    = 'submit'
            classes =  'mr-2'
        }}  
    {/if}

    {if $nextUrl}
        {if !$iAnsId}
            {$itemsAction[] = [
                icon    => 'arrow-right',
                text    => {$aLang.plugin.test.ask.form.skip_but.text},
                url     =>  $nextUrl,
                active  => true,
                classes =>  'js-next-ask'
            ]}  
        {else}
            {$itemsAction[] = [
                icon    => 'arrow-right',
                text    => {$aLang.plugin.test.ask.form.next_but.text},
                url     =>  $nextUrl,
                mods    => 'primary',
                active  => true,
                classes =>  'js-next-ask'
            ]}  
        {/if}
    {/if}

    {if $showHint}
        {component 'bs-card' classes="mt-3 bg-light" content=[ 
            [  type => 'header', content => $aLang.plugin.test.ask.hint],
            [  type => 'body', content => $oAsk->getHint() ]
        ]}
    {/if}

    {if $urlFinish}
        {$itemsAction[] = [
            icon    => 'check',
            text    => {$aLang.plugin.test.ask.form.finish_but.text},
            mods    => 'success',
            url     => $urlFinish,
            active  => true
        ]}
    {/if}

    {component 'bs-nav' bmods="pills" classes="mt-3" items=$itemsAction}
    <input type="hidden" name="action" value="submit" />
</div>

