
(function($) {
    "use strict";

    $.widget( "livestreet.testAsk", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Селекторы
            selectors: {
                inner:  ".js-test-ask-inner",
                next:   ".js-next-ask"
            },
            i18n: {
                
            },
            classes:{
                askPagination:"js-ask-pagination",
                input: "form-check-input",
                auto:   "js-auto-ask",
                active: "active"
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
            
            this.option('urls.ans', aRouter.test + 'ajax-' + this.element.data('paramType') + '/' + this.element.data('paramId'));
           
            this._form('ans', this.element, 'onSubmit', {
                onComplete: this.onComplete.bind(this)
            });
            
            this._on( this.elements.next, {click: 'clickNext'});
            
            this.elements.pagination = $('.' + this.option('classes.askPagination'));
            
            this.attachEventInput();
            
        },
        
        attachEventInput:function(){
            this.elements.input = $('.' + this.option('classes.input'));
            this.elements.input.on( 'change', function(){
                this.element.submit(); 
            }.bind(this));
            
        },
        
        updateForm:function(result){
            this.elements.next = $(this.option('selectors.next'));
            this._on( this.elements.next, {click: 'clickNext'});
          
            this.attachEventInput();
            
            this.element.data('nextAsk', result.nextAsk);
            
            if(this.elements.pagination.length){ 
                this.elements.pagination.testAskPagination('setMods', result.aPaginationAsks);
                this.elements.pagination.testAskPagination('setActive', result.iNumberAsk);
                if(result.hideNow){
                    this.elements.pagination.testAskPagination('removeActive');
                }
            }
            
            window.history.pushState( {}, 'Вопрос', aRouter.test 
                    + this.element.data('paramType') + '/' + this.element.data('paramId') 
                    + '/ask' + this._getParam('iNumberAsk') );
        },
        
        clickNext:function(){
            this._setParam('iNumberAsk', this.element.data('nextAsk'));
            
            this._load( 'ans', {}, function(result){
                this.elements.inner.html( result.html );
                
                this.updateForm(result);
            });
            return false;
        },
        
        onSubmit:function(result){
            this.elements.inner.html( result.html );
            this.updateForm(result);
        },
        
        onComplete: function(result){ 
            let response = result.responseJSON;
            if(!response.showSubmit && !response.bStateError){
                ls.utils.formLock( this.element );
            }
        }

        
    });
})(jQuery);