{**
 * Строковый тип
 *}

{extends 'component@admin:field.text'}

{block 'field_options' append}
    {component_define_params params=[ 'parameter', 'key', 'formid', 'items', 'activeItem' ]}


{/block}

{block 'field_input'}
    <div class="{$classes} js-fieldset">
        {*   Шаблон*}
        <div class="ls-hidden ls-mt-10" data-template>
            <textarea class="ls-width-500" data-input data-name="{$name}">{$value|escape}</textarea>
            <label><input type="radio" data-radio name="right_ans_value" class="input-text" value="" > верный</label>
            {component 'admin:button' type='button' icon='trash' attributes=['data-button-remove' => true]}
        </div>
        
        <div data-container>
            {foreach $items as $value}
                <div class="fieldset-item ls-mt-10" data-item>
                    <textarea class="ls-width-500" data-input name="{$name}">{$value|escape}</textarea>
                    <label><input type="radio" {if $activeItem == $value}checked{/if}
                                  data-radio name="right_ans_value" class="input-text" value="{$value}" > верный</label>
                    {component 'admin:button' type='button' icon='trash' attributes=['data-button-remove' => true]}
                </div>
            {/foreach}
        </div>
        
        {* Поле для ввода значений массива *}
        <textarea class="ls-mt-10 ls-width-500" data-input-add></textarea>

        {component 'admin:button' type='button' text={lang 'common.add'} mods='primary' attributes=[ 'data-button-add' => true ]}
    </div>
        
        
    
{/block}
