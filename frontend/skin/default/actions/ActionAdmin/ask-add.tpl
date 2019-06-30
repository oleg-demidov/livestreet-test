{**
 * Форма добавления вопроса
 *
 *}

{component 'test:a-ask'
    template    = "form-add"
    oAsk   = $oAsk}

{block "layout_modals" append}
    {component "media:library.modal" oUser=$oUserCurrent}
{/block}