
(function($) {
    "use strict";

    $.widget( "livestreet.testFieldset", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Селекторы
            selectors: {
                buttonAdd: "[data-button-add]",
                template: "[data-template]",
                items:"[data-item]",
                container:"[data-container]",
                inputAdd:"[data-input-add]"
            },
            
            i18n: {
                
            }
        },

        /**
         * Конструктор
         *
         * @constructor
         * @private
         */
        _create: function () {
            var _this = this;

            this._super();
            
            this._on(this.elements.buttonAdd, {click:"onClickAdd"});
            
            this.elements.items.testFieldsetItem();
            
        },
        
        onClickAdd: function(){
            let item = this.elements.template.clone();
            
            item.testFieldsetItem().testFieldsetItem("setVal",this.elements.inputAdd.val() );
            
            this.elements.inputAdd.val('');
            
            this.elements.container.append(item);
        }
        
        
    });
})(jQuery);