{**
 * Добавление о себе
 *
 *}
{component 'button' url="{router page='admin/plugin/ydirect/adgroup/edit'}{$oAdGroup->getId()}" text="Назад"}
<h2>{$oAdGroup->getName()} ->Редактировать обьявление</h2>

{component 'ydirect:admin-ads.edit' oAds=$oAds}