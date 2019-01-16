$(document).ready(function(){
    Excels.load();
});

var Excels  = (function(){

    var download_excels = function(){
        $('.btn_excel_rangemeteos-js').off('click').on('click', function(e){
            e.preventDefault();
            var element = $(this);
            var url = element.data('url');
            PeticionAjax.mostrarCargando();

            $.fileDownload( url, {
                successCallback: function(url) {
                    PeticionAjax.ocultarCargando();
                },
                failCallback: function(responseHtml, url) {
                    PeticionAjax.ocultarCargando();
                    alert('ERROR during the file generation.');
                }
            });
            return false; //this is critical to stop the click event which will trigger a normal file download!
        });

        $('.btn_excel_rangerenewables-js').off('click').on('click', function(e){
            e.preventDefault();
            var element = $(this);
            var url = element.data('url');
            var id_technology = element.data('id_technology');
            PeticionAjax.mostrarCargando();

            $.fileDownload( url, {
                data: {id_technology : id_technology},
                successCallback: function(url) {
                    PeticionAjax.ocultarCargando();
                },
                failCallback: function(responseHtml, url) {
                    PeticionAjax.ocultarCargando();
                    alert('ERROR during the file generation.');
                }
            });
            return false; //this is critical to stop the click event which will trigger a normal file download!
        });
    }


    return {
        load: function($context){
            download_excels();
        }
    }
})();

