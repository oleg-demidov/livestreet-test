<?php
/**
 * 
 * @author Oleg Demidov
 *
 */

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attempt!');
}

class PluginTest extends Plugin
{

    protected $aInherits = array(
//        'module' => array(
//            'ModuleCategory' => 'PluginFixCategory_ModuleCategory',
//        ),
//        'entity'=>[
//            'ModuleCategory_EntityCategory' => '_ModuleCategory_EntityCategory'
//        ],
//        'template' => array(
//            'admin:component.p-category.form' => '_components/p-category/form.tpl'
//        ),
        //'entity' =>array('ModuleCategory_EntityCategory' => '_ModuleCategory_EntityCategory'),
    );

    public function Init()
    {
        $this->Component_Add('test:bilet');
        $this->Component_Add('test:ask');
        $this->Component_Add('test:speedmeter');
        
        $this->Media_AddTargetType('test_img_default');
        
    }

    public function Activate()
    {
        $this->Category_CreateTargetType('test', 'Тесты', array(), true);
        
        $this->Property_CreateTargetType('ask', ["entity" => "ModuleTopic_EntityTopic", "name" => "Вопрос"]);
        
        $aProperties = array(
            array(
                'data'=>array(
                    'type'=>ModuleProperty::PROPERTY_TYPE_IMAGE,
                    'title'=>'Изображение',
                    'code'=>'askimage',
                    'sort'=>100,
                ),
                'validate_rule'=>array(
                    'size_max' => 10000,
                    'width_max' => 7000,
                    'height_max' => 7000
                ),
                'params'=>array(
                    'sizes' => [
                        '1000',
                        '200'                    
                    ],
                    'types' => array(
                        'jpg',
                        'jpeg',
                        'gif',
                        'png'
                    )
                ),
                'additional'=>array()
            )
         );
        
        $this->Property_CreateDefaultTargetPropertyFromPlugin($aProperties, 'ask');
        return true;
    }

    public function Deactivate()
    {
        
        return true;
    }
    
    public function Remove()
    {
        $oAsk = Engine::GetEntity('PluginTest_Test_Ask');
        
        if($oProperty = $this->Property_GetEntityProperty($oAsk, 'askimage')){
            $this->Property_RemoveValueByPropertyId( $oProperty->getId() );
        }
        $this->Property_RemoveTargetType('ask');
        
        $this->Category_RemoveTargetType('test');
        return true;
    }
}