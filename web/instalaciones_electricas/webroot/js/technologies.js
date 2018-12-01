$(document).ready(function(){
    Technologies.load();
});

var Technologies  = (function(){

    var checksbox = function(){

        $('#renewable-js').off('click').on('click', function(){
            if($("#no-renewable-js").is(':checked')){
                $('#no-renewable-js').prop('checked', false);
            }
        });

        $('#no-renewable-js').off('click').on('click', function(){
            if($("#renewable-js").is(':checked')){
                $('#renewable-js').prop('checked', false);
            }
        });
    };

    return {
        load: function($context){
            checksbox();
        }
    }
})();

