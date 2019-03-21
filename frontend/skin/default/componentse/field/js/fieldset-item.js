
(function($) {
    "use strict";

    $.widget( "livestreet.testFieldsetItem", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Селекторы
            selectors: {
                buttonRemove:"[data-button-remove]",
                input:"[data-input]",
                radio:"[data-radio]"
            },
            
            val: null
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
            
            this.element.removeClass('ls-hidden');
            
            this.elements.input.attr('name', this.elements.input.data('name'));
            
            this._on(this.elements.buttonRemove, {click:"onClickRemove"});
            
            this._on(this.elements.input, {change:"onChange"});
            
        },
        
        setVal: function(val){
            this.elements.input.val(val);
            this.elements.radio.val(val);
        },
        
        onChange: function(){
            this.elements.radio.val(this.elements.input.val());
        },
        
        onClickRemove: function(){
            this.element.remove()
        }
        
        
    });
})(jQuery);