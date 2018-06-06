{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'a-ask-form-add'}
{component_define_params params=[ 'oAsk', 'aAnses' ]}

{$aItemsBilets = [[]]}
{if $aBilets}
    {foreach $aBilets as $oBilet}
        {$aItemsBilets[] = [
             'value' => $oBilet->getId(),
             'text' => $oBilet->getTitle()
         ]}
    {/foreach}

{/if}

{* Формируем список категорий для select'а *}
{$items = [[]]}

{foreach $aCategories as $category}
    {$items[] = [ 'value' => $category->getId(), 'text' => $category->getTitle() ]}
{/foreach}

{component 'admin:p-form' isEdit=$oAsk submit=[ name => 'ask_submit' , 'text' => $aLang.common.save] form=[
    [ field => 'text',     name => 'ask[title]', label => 'Название' ],
    [ field => 'textarea',     name => 'ask[text]',  label => 'Вопрос' ],
    [ field => 'textarea',     name => 'ask[hint]', label => 'Подсказка' ],
    [ field => 'set', 'name' => 'anses', 'items' => $aItemsAns , label => 'Ответы', 'isAllowUpdate' => true, classes => 'js-anses'],
    [ field => 'text', name => 'ask[right_ans_value]', label => 'Верный ответ'],
    [ field => 'select', name => 'ask[bilet_id]', label => 'Билет', items => $aItemsBilets ],
    [ field => 'select', name => 'ask[category]', label => 'Категория', items => $items]
]}

<script>
    jQuery(document).ready(function($){
        $('.js-fieldset-item-text').focus(function(){
            $('input[name="ask[right_ans_value]"]').val($(this).val());
        });
    });
</script>