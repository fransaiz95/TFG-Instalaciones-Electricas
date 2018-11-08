$(document).ready(function(){
    Weblectric.load();
});

var Weblectric  = (function(){

    var loadSelect2Single = function(){
        $('.js-example-basic-single').select2();
    }

    var loadSelect2Multiple = function(){
        $('.js-example-basic-multiple').select2();
    }

    return {
        load: function($context){
            loadSelect2Single();
            loadSelect2Multiple();
        }
    }
})();

