{**
 * Панель информации
 *}
 
{capture 'content'}
    
    
    <div class="d-flex flex-column">
        <div class="row p-2">
            <div class="col-8">{$aLang.plugin.test.block.panel_info.list.total_ask}</div>
            <div class="col-4">{$iCountAskTotal}444</div>
        </div>
        
        <div class="bg-light rounded mt-2 p-2">
            <div><a class="link" href="{router page='test'}{$oTest->getCode()}/bilets/">{$aLang.plugin.test.panel.bilets.text}</a></div>
            <div class="row mt-1 pl-1 {if $iCountAskRightBilet}text-success{else}text-muted{/if}">
                <div class="col-8">{$aLang.plugin.test.block.panel_info.list.right}</div>
                <div class="col-4">{$iCountAskRightBilet}</div>
            </div>
            <div class="row pl-1 {if $iCountAskWrongBilet}text-danger{else}text-muted{/if}">
                <div class="col-8">{$aLang.plugin.test.block.panel_info.list.wrong}</div>
                <div class="col-4">{$iCountAskWrongBilet}</div>
            </div>
            <div class="row pl-1 text-muted">
                <div class="col-8">{$aLang.plugin.test.block.panel_info.list.skip}</div>
                <div class="col-4">{$iCountAskSkipBilet}</div>
            </div>
        </div>
        
        <div class="bg-light rounded mt-2 p-2">
            <div ><a class="link" href="{router page='test'}{$oTest->getCode()}/categories/">{$aLang.plugin.test.panel.categories.text}</a></div>
            <div class="row mt-1 pl-1 {if $iCountAskRightCategory}text-success{else}text-muted{/if}">
                <div class="col-8">{$aLang.plugin.test.block.panel_info.list.right}</div>
                <div class="col-4">{$iCountAskRightCategory}</div>
            </div>
            <div class="row pl-1 {if $iCountAskWrongCategory}text-danger{else}text-muted{/if}">
                <div class="col-8">{$aLang.plugin.test.block.panel_info.list.wrong}</div>
                <div class="col-4">{$iCountAskWrongCategory}</div>
            </div>
            <div class="row pl-1 text-muted">
                <div class="col-8">{$aLang.plugin.test.block.panel_info.list.skip}</div>
                <div class="col-4">{$iCountAskSkipBilet}</div>
            </div>
        </div>
            
        <div class="row p-2">
            <div class="col-8">{$aLang.plugin.test.block.panel_info.list.total_time}</div>
            <div class="col-4">2322</div>
        </div>
    </div>
    
     {insert name='block' block='speedmeter' params=[  'plugin' => 'test', precent=>$iPrecent ]}
{/capture}

{component 'bs-card'
    content = [
        [
            type => "header", 
            content => $aLang.plugin.test.block.panel_info.title
        ],
        [
            type => "body",
            classes => "p-2",
            content => $smarty.capture.content
        ]
    ]
}
