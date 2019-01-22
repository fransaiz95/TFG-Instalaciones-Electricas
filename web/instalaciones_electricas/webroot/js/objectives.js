$(document).ready(function(){
    Objectives.load();
});

var Objectives  = (function(){

    var checksbox = function(){

        $('#check-employee-1-js').off('click').on('click', function(){
            if($("#check-employee-1-js").is(':checked')){
                $('.check-employee-1-js').each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $('.check-employee-1-js').each(function(){
                    $(this).prop('checked', false);
                });
            }
        });

        $('#check-employee-2-js').off('click').on('click', function(){
            if($("#check-employee-2-js").is(':checked')){
                $('.check-employee-2-js').each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $('.check-employee-2-js').each(function(){
                    $(this).prop('checked', false);
                });
            }
        });

        $('#check-employee-3-js').off('click').on('click', function(){
            if($("#check-employee-3-js").is(':checked')){
                $('.check-employee-3-js').each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $('.check-employee-3-js').each(function(){
                    $(this).prop('checked', false);
                });
            }
        });

    };

    return {
        load: function($context){
            checksbox();
        }
    }
})();

