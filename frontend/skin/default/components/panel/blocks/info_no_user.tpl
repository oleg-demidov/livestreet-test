{**
 * Панель информации
 *}
 
{capture 'content'}
    Выполните вход
{/capture}

{component 'block'
    title={$aLang.plugin.test.block.panel_info.title}
    content={$smarty.capture.content}
}
