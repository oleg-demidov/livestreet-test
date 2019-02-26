{**
 * Натсройки
 *
 *}

{extends './test.tpl'}

{block 'test_content'}
    
    {$uploadedFiles=[]}
    {foreach $aMedias as $oMedia}
        {$uploadedFiles[] = $oMedia->getFileWebPath('200x200crop')}
    {/foreach}
    
    {component 'admin:p-form'  
        attributes = [enctype=>"multipart/form-data"]
        submit=[ name => 'test_settings_submit' ] 
        form=[
            [ field => 'checkbox',     name => 'state', label => 'Активен' ],
            [ field => 'image',     name => 'image',  label => 'Картинка по умолчанию', uploadedFiles => $uploadedFiles, removeName => 'remove' ]
        ]}
    
{/block}

 