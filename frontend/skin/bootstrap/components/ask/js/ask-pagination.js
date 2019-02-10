(function($) {
    "use strict";

    $.widget( "livestreet.testAskPagination", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Селекторы
            selectors: {
                items:".nav-link"
            },
            i18n: {
                
            },
            classes:{
                active:     "active",
                itemText:   "nav-link"
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
            
        },
        
        removeActive: function(){
            this.elements.items.removeClass(this.option('classes.active'));
        },
        
        setActive:function(numberItem){ 
            if(!this.elements.items.length){
                return null;
            }
            
            this.removeActive();
            
            $(this.elements.items[numberItem-1]).addClass(this.option('classes.active'))
        },
        
        getActive:function(){
            if(!this.elements.items.length){
                return null;
            }
            let activeEl = this.elements.items.find('.'+this.option('classes.active'));
            if(!activeEl.length){
                return false;
            }
            return activeEl;
        },
        
        getActiveNumber:function(){
            let activeEl = this.getActive();
            
            if(!activeEl){
                return false;
            }
            
            return activeEl.find('.'+this.option('classes.itemText')).text();
        },
        
        setModItem:function(numberItem, mod){
            if(!this.elements.items.length){
                return null;
            }
            
            $(this.elements.items[numberItem-1]).addClass( 'bg-' + mod).addClass( 'text-white' );
        },
        
        setMods: function(aData){ 
            let mods = [
                "danger",
                "success"
            ]
            $.each(aData, function(i, val){
                this.setModItem(i, mods[val]);
            }.bind(this))
        }

        
    });
})(jQuery);