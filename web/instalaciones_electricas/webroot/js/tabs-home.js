$(document).ready(function(){
    TabsMenu.load();
});

var TabsMenu  = (function(){

    var changeActive = function(){

        $('#tab-countries-js, #tab-regions-js, #tab-technologies-js, #tab-arcs-js').off('click').on('click', function(e){
            e.preventDefault();

            var element = $(this);
            var cnt_div = element.data('cnt_div');
            console.log(cnt_div);

            $('.tab-home').each(function(){
                if($(this).hasClass('active-tab')){
                    $(this).removeClass('active-tab');
                }
            })

            $('.cnt-tabs').each(function(){
                if(!$(this).hasClass('d-none')){
                    $(this).addClass('d-none');
                }
            })

            element.addClass('active-tab');

            $('#' + cnt_div).removeClass('d-none');
        });
    };

    return {
        load: function($context){
            changeActive();
        }
    }
})();

