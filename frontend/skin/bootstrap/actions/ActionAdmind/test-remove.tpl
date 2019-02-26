{**
 * Форма добавления типа теста
 *
 *}
 <h3>Удалить тест "{$oTest->getTitle()}"</h3>
 
 {component 'test:a-test'
    template    = "form-remove"
    oTest   = $oTest}

 