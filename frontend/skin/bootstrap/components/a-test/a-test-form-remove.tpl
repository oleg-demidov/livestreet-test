{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'a-test-form-remove'}
{component_define_params params=[ 'oTest' ]}


{component 'admin:p-form' classes=$component isEdit=$oTest 
    submit= [ name => 'test_remove_submit',  'text' => 'Удалить'] 
    form=[
        [ field => 'checkbox',     name => 'remove_asks', label => 'Удалить вопросы' ],
        [ field => 'checkbox',     name => 'remove_bilets',  label => 'Удалить билеты' ],
        [ field => 'checkbox',     name => 'remove_category',  label => 'Удалить категории' ]
    ]}
