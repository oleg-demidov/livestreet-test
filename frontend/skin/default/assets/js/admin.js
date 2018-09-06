jQuery(document).ready(function($){
    let checkRight = function(el){
        $('.js-anses .ls-field').removeClass('right-ans-field');
        $(el).addClass('right-ans-field');
        $('input[name="ask[right_ans_value]"]').val($(el).find('input').val());
    }
    
    $(".js-anses .js-fieldset").lsFieldSet({
        afteradditem:function(e, data){ 
            data.item.find('.ls-field').click(function(){
                checkRight(this)
            });
        }
    });   
    
    $('.js-anses .ls-field').click(function(){
        checkRight(this)
    });
});