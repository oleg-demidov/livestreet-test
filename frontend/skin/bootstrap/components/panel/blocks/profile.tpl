{**
 * Панель информации
 *}
 
{capture 'content'}
    {if {$avatar}}
        {component 'user.avatar' user=$oUserCurrent}
    {/if}
    <table>
        <tr>
            <td>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            </td>
            <td>
                Билеты
            </td>
            <td>
                &emsp;Категории
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {component 'info-list' list = [
                    [
                        label => {$aLang.plugin.test.block.panel_info.list.total_ask},
                        content => $iCountAskTotal
                    ],
                    [
                        label => {$aLang.plugin.test.block.panel_info.list.right},
                        content => {$iCountAskRightBilet} 
                    ],
                    [
                        label => {$aLang.plugin.test.block.panel_info.list.wrong},
                        content => {$iCountAskWrongBilet}
                    ],
                    [
                        label => {$aLang.plugin.test.block.panel_info.list.skip},
                        content => {$iCountAskSkipBilet}
                    ],
                    [
                        label => {$aLang.plugin.test.block.panel_info.list.total_time},
                        content => 22
                    ]
                ]}
            </td>
            <td>
                {component 'info-list' attributes=[style=>"margin-left:20px;"] list = [
                    [
                        content => '&nbsp;'
                    ],
                    [
                        content =>  {$iCountAskRightCategory}
                    ],
                    [
                        content =>  {$iCountAskWrongCategory}
                    ],
                    [
                        content => {$iCountAskSkipCategory}
                    ],
                    [
                        content => '&nbsp;'
                    ]
                ]}
            </td>
        </tr>
    </table>
     {insert name='block' block='speedmeter' params=[  'plugin' => 'test', precent=>$iPrecent ]}
{/capture}

{component 'block'
    title={$aLang.plugin.test.block.panel_info.title}
    content={$smarty.capture.content}
}
