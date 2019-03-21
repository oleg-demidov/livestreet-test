{**
 * Список билетов
 *}

{$component = 'a-test-list'}
{component_define_params params=[ 'aTests' ]}

{if $aTests}
    <table class="ls-table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Вопросов</th>
                <th class="ls-table-cell-actions">Действие</th>
            </tr>
        </thead>
        <tbody>
            {foreach $aTests as $oTest}
                
                <tr data-id="{$oTest->getId()}">
                    <td>
                        <i class="fa fa-file" style="margin-left: 20px;"></i>

                        {if $oTest->getWebUrl()}
                            <a href="{$oTest->getWebUrl()}" border="0">{$oTest->getTitle()}</a>
                        {else}
                            {$oTest->getTitle()}
                        {/if}
                    </td>
                    <td><a href="{router page="admin/plugin/test/{$oTest->getCode()}"}" border="0">{$oTest->getCountAsks()}</a></td>
                    <td class="ls-table-cell-actions">
                        <a href="{$oTest->getUrlEdit()}" class="fa fa-edit" title="{$aLang.plugin.admin.edit}"></a>
                        <a href="{router page="admin/plugin/test/remove_test/{$oTest->getId()}"}?security_ls_key={$LIVESTREET_SECURITY_KEY}" class="fa fa-trash-o" title="{$aLang.plugin.admin.delete}"></a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{else}
    {component 'admin:blankslate' text='Нет тестов. Вы можете добавить.'}
{/if}