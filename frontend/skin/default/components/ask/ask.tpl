{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'test-ask'}
{component_define_params params=[ 'oAsk', 'aAnses' ]}

{$oAsk->getText()}
{$oValue = $oAsk->property->getProperty('image')->getValueTypeObject()}
{$image = $oValue->getImageWebPath('150x150crop')}

{if $image }
    <img src="{$image}">
{else}
    <img src="{$componentAskWebPath}/img/no-image.png">
{/if}

<ul>
    {foreach $aAnses as $oAns}
        <li>
            {component 'field.radio' name='ans' label=$oAns->getValue()}
        </li>
    {/foreach}
<ul>
