{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'a-test-form-add'}
{component_define_params params=[ 'oTest' ]}


{component 'admin:p-form' isEdit=$oTest submit=[ name => 'test_submit' ] form=[
    [ field => 'text',     name => 'test[title]', label => 'Название' ],
    [ field => 'text',     name => 'test[code]',  label => 'Код' ],
    [ field => 'text',     name => 'test[menu_title]',  label => 'Название пункта меню' ],
    [ field => 'checkbox',     name => 'test[menu_enable]',  label => 'Активировать пункт меню' ],
    [ field => 'image',     name => 'image', label => 'Изображение по умолчанию' , uploadedFiles => $uploadedFiles, removeName => 'remove_image'],
    [ field => 'checkbox',     name => 'test[enable]',  label => 'Активировать тест' ],
]}
