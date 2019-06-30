{**
 * Список билетов
 *}

{$component = 'a-bilet-list'}
{component_define_params params=[ 'aBilets' ]}

{if $aBilets}
    <table class="ls-table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Вопросов</th>
                <th class="ls-table-cell-actions">Действие</th>
            </tr>
        </thead>
        <tbody>
            {foreach $aBilets as $oBilet}
                
                <tr data-id="{$oBilet->getId()}">
                    <td>
                        <i class="fa fa-file" style="margin-left: {$level * 20}px;"></i>

                        {if $oBilet->getWebUrl()}
                            <a href="{$oBilet->getWebUrl()}" border="0">{$oBilet->getTitle()}</a>
                        {else}
                            {$oBilet->getTitle()}
                        {/if}
                    </td>
                    <td><a href="{router page="admin/plugin/test/bilet/{$oBilet->getId()}/asks"}" border="0">{$oBilet->getCountAsks()}</a></td>
                    <td class="ls-table-cell-actions">
                        <a href="{$oBilet->getUrlEdit()}" class="fa fa-edit" title="{$aLang.plugin.admin.edit}"></a>
                        <a href="{router page="admin/plugin/test/bilet/remove/{$oBilet->getId()}"}?security_ls_key={$LIVESTREET_SECURITY_KEY}" class="far fa-trash-alt text-danger js-confirm-remove" title="{$aLang.plugin.admin.delete}"></a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{else}
    {component 'admin:blankslate' text='Нет билетов. Вы можете добавить.'}
{/if}