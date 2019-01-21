$(document).ready(function(){
    Fuels.load();
});

var Fuels  = (function(){

    var deleteFuel = function(){
        $('.delete-js').off('click').on('click', function(e){
            e.preventDefault();
            var element = $(this);
            var title = element.data('title');
            var text = element.data('text');
            var url = element.data('url');
            var url_redirect = element.data('url_redirect');
            var id_fuel = element.data('id_fuel');
            var id_technology = element.data('id_technology');
            var data = {}
            data.id_fuel = id_fuel;
            data.id_technology = id_technology;
            
            swal({
                title: title,
                text: text,
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#5bcb90',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if (result.value) {

                    PeticionAjax.mostrarCargando();
                    var request = PeticionAjax.post(url, data);
                    request.done(function (data){
                        PeticionAjax.ocultarCargando();

                        if(data == 'OK'){
                            swal({
                                title: 'It has been done successfully',
                                type: "success",
                                confirmButtonColor: '#5bcb90',
                                confirmButtonText: 'Ok',
                            }).then(function (result) {
                                window.location.replace(url_redirect);
                            });
                        }else{
                            swal({
                                title: data,
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: '#5bcb90',
                                confirmButtonText: 'OK',
                            });
                        }
                    })
                }
            });
        });
    }
    
    return {
        load: function($context){
            deleteFuel();
        }
    }
})();

