{**
 * Форма добавления/редактирования типа теста
 *}
 
{$component = 't-category'}
{component_define_params params=[ 'oCategory', 'classes' ]}

{capture name="content_category"}
    <div class="row ">
        <div class="col-12 col-sm-6  pt-1 text-truncate">
            {$oCategory->getTitle()}
        </div>
        <div class="col-12 d-sm-none">
            <div class="row">
                <div class="col-4  pt-1">
                    {$aLang.plugin.test.panel.categories.colls.count_asks}
                </div>
                <div class="col-4  pt-1 text-success">
                    {$aLang.plugin.test.panel.categories.colls.count_right}
                </div>
                <div class="col-4  pt-1 text-danger">
                    {$aLang.plugin.test.panel.categories.colls.count_wrong}
                </div>
            </div>
        </div>
        <div class="col-4 col-sm-2  pt-1">
            {$oCategory->getCountAsks()}
        </div>
        <div class="col-4 col-sm-1  pt-1 text-success">
            {$oCategory->getRight()}
        </div>
        <div class="col-4 col-sm-1  pt-1 text-danger">
            {$oCategory->getWrong()}
        </div>
        <div class="col-sm-2 d-flex justify-content-sm-end py-2 py-sm-0">
            {component 'bs-button' 
                bmods   = "primary sm"
                text    = $aLang.plugin.test.panel.bilet.button_start 
                url     = {router page="test/category/{$oCategory->getId()}"}}
        </div>
    </div>
    {$precent = round($oCategory->getRight()/$oCategory->getCountAsks()*100)}
    
    {component "bs-progressbar" height=3 value=$precent classes="mt-2" bg="success"}
{/capture}



{component 'bs-card' classes="w-100 {$classes}" content=[
    [   
        type => 'body',
        classes => "py-2",
        content => $smarty.capture.content_category
    ]
]}
