{**
 * Список билетов
 *}

{$component = 'a-ask-list'}
{component_define_params params=[ 'aAsks' ]}

{if $aAsks}
    <table class="ls-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Ответов</th>
                <th>Билет</th>
                <th>Категория</th>
                <th class="ls-table-cell-actions">Действие</th>
            </tr>
        </thead>
        <tbody>
            {foreach $aAsks as $oAsk}{*$oAsk|print_r*}
                
                <tr data-id="{$oAsk->getId()}">
                    <td>{$oAsk->getId()}</td>
                    <td>
                        <i class="fa fa-file" style="margin-left: {$level * 20}px;"></i>

                        {if $oAsk->getWebUrl()}
                            <a href="{$oAsk->getWebUrl()}" border="0">{$oAsk->getTitle()}</a>
                        {else}
                            {$oAsk->getTitle()}
                        {/if}
                    </td>
                    <td>{$oAsk->getCountAns()}</td>
                    <td>
                        {if $aBilets[$oAsk->getBiletId()]}
                            {$aBilets[$oAsk->getBiletId()]->getTitle()}
                        {else}
                            Не задан
                        {/if}
                    </td>
                    <td>
                        {$oCategory = $oAsk->category->getCategory()}
                        {if $oCategory}
                            {$oCategory->getTitle()}
                        {else}
                            Не задана
                        {/if}
                    </td>
                    <td class="ls-table-cell-actions">
                        <a href="{$oAsk->getUrlEdit()}" class="fa fa-edit" title="{$aLang.plugin.admin.edit}"></a>
                        <a href="{router page="admin/plugin/test/ask/remove/{$oAsk->getId()}"}?security_ls_key={$LIVESTREET_SECURITY_KEY}" class="far fa-trash-alt text-danger js-confirm-remove" title="{$aLang.plugin.admin.delete}"></a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{else}
    {component 'admin:blankslate' text='Нет вопросов. Вы можете добавить.'}
{/if}