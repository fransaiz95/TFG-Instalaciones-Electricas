$(document).ready(function(){
    Arcs.load();
});

var Arcs  = (function(){

    var num_lines_typelines = function(){

        var typeline = function(selector){
            if(selector.val() == ''){
                $('#num_lines-js').val('');
                $('#num_lines-js').prop('readonly', true);
            }else{
                $('#num_lines-js').prop('readonly', false);
            }
        }
        
        typeline($('#typeline_id-js'));

        $('#typeline_id-js').on('change', function(){
            typeline($(this));
        });

    };

    return {
        load: function($context){
            num_lines_typelines();
        }
    }
})();

