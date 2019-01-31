$(document).ready(function(){
    Excels.load();
});

var Excels  = (function(){

    var download_excels = function(){
        $('.btn_excel_rangemeteos-js').off('click').on('click', function(e){
            e.preventDefault();

            var element = $(this);
            var year = $('#year-js').val();

            var url_count_results = element.data('url_count_results');
            var data_initial = {}
            data_initial.year = year;

            var request = PeticionAjax.post(url_count_results, data_initial);
            request.done(function (total_registries){

                if(total_registries == 0){
                    var title = 'Would you like to download the template?'
                    var text = 'There are not results to export'
                }else if(total_registries > 0 && total_registries < 10000){
                    var title = 'Would you like to download the data?'
                    var text = 'There are ' + total_registries + ' results to export'
                }else{
                    var title = 'The download process may take several minutes'
                    var text = 'There are ' + total_registries + ' results to export'
                }
    
                swal({
                    title: title,
                    text: text,
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: '#5bcb90',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then(function (result) {
    
                    if(result.value == true){
    
                        var url = element.data('url');
                        var data = {};
                        data.year = year
    
                        PeticionAjax.mostrarCargando();
    
                        $.fileDownload( url, {
                            httpMethod: 'POST',
                            data: data,
                            successCallback: function(url) {
                                PeticionAjax.ocultarCargando();
                            },
                            failCallback: function(responseHtml, url) {
                                PeticionAjax.ocultarCargando();
                                alert('ERROR during the file generation.');
                            }
                        });
                        return false; //this is critical to stop the click event which will trigger a normal file download!
                    }
    
                });
            })

        });

        $('.btn_excel_rangerenewables-js').off('click').on('click', function(e){
            e.preventDefault();

            var element = $(this);

            var year = $('#year-js').val();
            var id_technology = element.data('id_technology');

            var url_count_results = element.data('url_count_results');
            var data_initial = {}
            data_initial.year = year;
            data_initial.id_technology = id_technology;

            var request = PeticionAjax.post(url_count_results, data_initial);
            request.done(function (total_registries){

                if(total_registries == 0){
                    var title = 'Would you like to download the template?'
                    var text = 'There are not results to export'
                }else if(total_registries > 0 && total_registries < 10000){
                    var title = 'Would you like to download the data?'
                    var text = 'There are ' + total_registries + ' results to export'
                }else{
                    var title = 'The download process may take several minutes'
                    var text = 'There are ' + total_registries + ' results to export'
                }

                swal({
                    title: title,
                    text: text,
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: '#5bcb90',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then(function (result) {

                    if(result.value == true){

                        var url = element.data('url');
                        var id_technology = element.data('id_technology');
                        var data = {};
                        data.year = $('#year-js').val();
                        data.id_technology = id_technology;

                        PeticionAjax.mostrarCargando();
            
                        $.fileDownload( url, {
                            httpMethod: 'POST',
                            data: data,
                            successCallback: function(url) {
                                PeticionAjax.ocultarCargando();
                            },
                            failCallback: function(responseHtml, url) {
                                PeticionAjax.ocultarCargando();
                                alert('ERROR during the file generation.');
                            }
                        });
                        return false; //this is critical to stop the click event which will trigger a normal file download!
                    }

                });

            })
        });
    }


    return {
        load: function($context){
            download_excels();
        }
    }
})();

