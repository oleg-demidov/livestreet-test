{**
 * Добавление о себе
 *
 *}
<h1>Обьявления</h1>
{component 'block'
content={component 'button' template='toolbar' groups=[
    [
        'buttons' => [
            [ 'icon' => 'bell-o', 'text' => 'Новые',  'mods' => 'primary',
'url' => {router page='admin/plugin/ydirect/ads/new'} ],
            [ 'icon' => 'check' , 'text' => 'Запущенные', 
'url' => {router page='admin/plugin/ydirect/ads/start'}],
            [ 'icon' => 'stop' , 'text' => 'Остановленные', 
'url' => {router page='admin/plugin/ydirect/ads/stop'}]          
        ]
    ]
]}}
    {component "ydirect:admin-ads.list-new" aUsers=$aUsers}
    
