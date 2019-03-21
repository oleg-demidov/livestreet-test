{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 'a-bilet-form-add'}
{component_define_params params=[ 'oBilet' ]}


{component 'admin:p-form' isEdit=$oBilet submit=[ name => 'bilet_submit' , 'text' => $aLang.common.save] form=[
    [ field => 'text',     name => 'bilet[title]', label => 'Название' ],
    [ field => 'text',     name => 'bilet[description]',  label => 'Описание' ]
]}
