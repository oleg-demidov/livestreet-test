{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'a-test-form-add'}
{component_define_params params=[ 'oTest' ]}


{component 'admin:p-form' 
    isEdit=$oTest 
    action=Router::GetPathWebCurrent() 
    attributes=[enctype => "multipart/form-data"]  
    submit=[ name => 'test_submit' ] 
    form=[
        [ field => 'text',     name => 'test[title]', label => 'Название' ],
        [ field => 'text',     name => 'test[code]',  label => 'Код' ],
        [ field => 'text',     name => 'test[menu_title]',  label => 'Название пункта меню' ],
        [ field => 'checkbox',     name => 'test[menu_enable]',  label => 'Активировать пункт меню' ],
        {component 'media:mfield' oBehavior=$oTest->defimage},
        [ field => 'checkbox',     name => 'test[state]',  label => 'Активировать тест' ]
]}


{block "layout_modals" append}
    {component "media:library.modal" oUser=$oUserCurrent}
{/block}