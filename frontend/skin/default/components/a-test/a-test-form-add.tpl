{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'a-test-form-add'}
{component_define_params params=[ 'oTest' ]}

dd
{component 'admin:p-form' isEdit=$oTest submit=[ name => 'test_submit' ] form=[
    [ field => 'text',     name => 'test[title]', label => 'Название' ],
    [ field => 'text',     name => 'test[code]',  label => 'Код' ],
    [ field => 'text',     name => 'test[topic_id]',  label => 'Id топика' ]
]}
