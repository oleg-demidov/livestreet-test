{**
 * Список тестов
 *
 *}
 
{block 'layout_test_title'}
    <h3>Тест "{$oTest->getTitle()}"
        <span style="float: right;">
            {component 'button' icon="edit" text=$aLang.common.edit url={router page="admin/plugin/test/edit/{$oTest->getId()}"}}
            {component 'button' icon="trash" text=$aLang.common.remove url={router page="admin/plugin/test/remove_test/{$oTest->getId()}"}}
        </span>
    </h3>
{/block}
 
{block 'test_nav'}
    {component 'nav' mods="pills" items = [
            [
                'text' => 'Вопросы',
                'name' => 'asks',
                'url'  => {router page="admin/plugin/test/{$oTest->getCode()}/asks"}
            ],
            [
                'text' => 'Билеты',
                'name' => 'bilets',
                'url'  => {router page="admin/plugin/test/{$oTest->getCode()}/bilets"}
            ],
            [
                'text' => 'Настройки',
                'name' => 'settings',
                'url'  => {router page="admin/plugin/test/{$oTest->getCode()}/settings"}
            ]

        ]
        activeItem=$activeNavItem}
        <hr>
{/block}

{block 'test_content'}{/block}