{**
 * Панель тестов
 *
 *}
 
 
{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    
{/block}

{block 'layout_page_title'}
    
{/block}

{block 'layout_content'}

    <div class="d-md-flex justify-content-around flex-wrap ls-sidebar">
            
        {component "bs-card" 
            classes = 'period'
            content=[
                [
                    type => 'header',
                    content => 'Тестовый'
                ],
                [
                    type => 'body',
                    content => '2 дня<br>Бесплатно'
                ],
                [
                    type => 'footer',
                    content => {component "bs-button" url={router page="pdd/get-test-period"} text = 'Получить' bmods="outline-secondary"}
                ]
            ]}
        
        {component "bs-card" 
            classes = "text-success border-success period"
            content=[
                [
                    type => 'header',
                    content => 'Начальный'
                ],
                [
                    type => 'body',
                    content => '10 дней<br>100 руб.'
                ],
                [
                    type => 'footer',
                    content => {component "bs-button" url={router page="pdd/get-period/10"} text = 'Купить' bmods="success"}
                ]
            ]}
            
        {component "bs-card" 
            classes = "text-primary border-primary period"
            content=[
                [
                    type => 'header',
                    content => 'Полный'
                ],
                [
                    type => 'body',
                    content => '30 дней<br>200 руб.'
                ],
                [
                    type => 'footer',
                    content => {component "bs-button" url={router page="pdd/get-period/30"} text='Купить' bmods="primary"}
                ]
            ]}
        
            
    </div>

{/block}
