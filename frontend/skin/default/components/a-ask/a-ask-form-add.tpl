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

{* Формируем список ответов  *}
{$itemsAns=[]}
{foreach $oAsk->getAnses() as $ans}
    {$itemAns = [ value => $ans->getValue(), name => "anses" ]}
    
    {if $ans->getIsRight()}
        {$itemAns.classes = "right-ans-field"}
    {/if}
    
    {$itemsAns[] = $itemAns}
{/foreach}

{component 'admin:p-form'
    content = {insert name='block' block='propertyUpdate' params=[
        'target'      => $oAsk,
        'entity'      => 'PluginTest_ModuleTest_EntityAsk',
        'target_type' => "ask"
    ]}
    attributes=[enctype => "multipart/form-data"] 
    isEdit=$oAsk 
    submit=[ name => 'ask_submit' , 'text' => $aLang.common.save] 
    form=[
        [ field => 'text',     name => 'ask[title]', label => 'Название' ],
        [ field => 'textarea',     name => 'ask[text]',  label => 'Вопрос' ],
        [ field => 'textarea',     name => 'ask[hint]', label => 'Подсказка' ],
        [ field => 'set', name => 'anses', 'items' => $itemsAns , label => 'Ответы', 'isAllowUpdate' => true, classes => 'js-anses'],
        [ field => 'text', name => 'ask[right_ans_value]', label => 'Верный ответ'],
        [ field => 'text', name => 'ask[order]', label => 'Порядок в билете', 'note' => 'Чем меньше тем выше'],
        [ field => 'select', name => 'ask[bilet_id]', label => 'Билет', items => $aItemsBilets ],
        [ field => 'select', name => 'ask[category]', label => 'Категория', items => $items]
]}

{* Показывает дополнительные поля *}
