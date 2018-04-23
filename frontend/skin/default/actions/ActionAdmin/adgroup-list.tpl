{**
 * Добавление о себе
 *
 *}
<h1>Группы обьявлений</h1>

{component 'nav'
    activeItem = {$iActive|default:'def'}
    mods = 'adgroups pills'
    items=[
        [ 'icon' => 'bell-o', 'text' => 'Новые', 'name'=>'def', 'count'=>$countNew,
'url' => {router page='admin/plugin/ydirect/adgroups/0'} ],         
        [ 'icon' => 'plus' , 'text' => 'Создано','name'=>'draft', 'count'=>$countDraft,
'url' => {router page='admin/plugin/ydirect/adgroups/draft'}],         
        [ 'icon' => 'search' , 'text' => 'На модерации', 'name'=>'moderation','count'=>$countModeration,
'url' => {router page='admin/plugin/ydirect/adgroups/moderation'}],         
        [ 'icon' => 'check' , 'text' => 'Активно', 'name'=>'accepted','count'=>$countAccepted,
'url' => {router page='admin/plugin/ydirect/adgroups/accepted'}], 
        [ 'icon' => 'pause' , 'text' => 'Приостановлено', 'name'=>'suspended','count'=>$countSuspended,
'url' => {router page='admin/plugin/ydirect/adgroups/accepted/suspended'}], 
        [ 'icon' => 'ban' , 'text' => 'Отклонено', 'name'=>'rejected','count'=>$countRejected,
'url' => {router page='admin/plugin/ydirect/adgroups/rejected'}]
]}
{component "ydirect:adgroup.list" aAdGroups=$aAdGroups}
