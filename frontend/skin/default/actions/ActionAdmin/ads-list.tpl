{**
 * Добавление о себе
 *
 *}
<h1>Обьявления</h1>
{$new = ''}
{$mod = ''}
{$active = ''}
{if $sStatus == 'new'}
{$new = 'primary'}
{/if}
{if $sStatus == 'moderate'}
{$mod = 'primary'}
{/if}
{if $sStatus == 'active'}
{$active = 'primary'}
{/if}
{component 'block' content={component 'button' template='toolbar' groups=[
    [
        'buttons' => [
            [ 'icon' => 'bell-o', 'text' => 'Новые', 'mods' => {$new},
'url' => {router page='admin/plugin/ydirect/ads/new'} ],
            [ 'icon' => 'check' , 'text' => 'На модерации', 'mods' => {$mod},
'url' => {router page='admin/plugin/ydirect/ads/moderate'}],         
        [ 'icon' => 'check' , 'text' => 'Активные', 'mods' => {$active},
'url' => {router page='admin/plugin/ydirect/ads/active'}]         
        ]
    ]
]}}
    {component "ydirect:admin-ads.list" aAdGroups=$aAdGroups}
    
