{**
 * Список тестов
 *
 *}
 
{block 'layout_bilet_title'}
    <h3>Билет "{$oBilet->getTitle()}"
        <span style="float: right;">
            {component 'button' icon="edit" text=$aLang.common.edit url={router page="admin/plugin/test/bilet/edit/{$oBilet->getId()}"}}
            {component 'button' class="js-confirm-remove" 
                icon="trash" text=$aLang.common.remove 
                url="{router page="admin/plugin/test/bilet/remove/{$oBilet->getId()}"}?security_ls_key={$LIVESTREET_SECURITY_KEY}"}
        </span>
    </h3>
{/block}


{block 'bilet_content'}{/block}