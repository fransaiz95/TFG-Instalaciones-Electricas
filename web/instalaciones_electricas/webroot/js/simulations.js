$(document).ready(function(){
    Simulations.load();
});

var Simulations  = (function(){

    var generate_simulation = function(){
        $('#generate_simulation-js').off('click').on('click', function(e){
            e.preventDefault();

            var element = $(this);
            var url = element.data('url');

            swal({
                title: 'Please insert a name for the simulation',
                text: 'This will be the name of the file when you export it',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonColor: '#5bcb90',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if(result.value != "" && result.value != undefined){
                    
                    PeticionAjax.mostrarCargando();

                    var data = {};
                    data.simulation_name = result.value;
                    
                    var request = PeticionAjax.post(url, data);
                    request.done(function (){

                        PeticionAjax.ocultarCargando();

                        swal({
                            title: 'It has been done successfully',
                            type: "success",
                            confirmButtonColor: '#5bcb90',
                            confirmButtonText: 'Ok',
                        }).then(function (result) {
                            location.reload();
                        });
            
                    })
                }
            });
        });

    }
    
    // var download_simulation = function(){
    //     $('.download_simulation-js').off('click').on('click', function(e){
    //         e.preventDefault();

    //         var element = $(this);
    //         var url = element.data('url');
    //         var title = element.data('title');
    //         var id_simulation = element.data('id');
    //         var data = {};
    //         data.id_simulation = id_simulation;

    //         swal({
    //             title: title,
    //             type: "info",
    //             showCancelButton: true,
    //             confirmButtonColor: '#5bcb90',
    //             confirmButtonText: 'Yes',
    //             cancelButtonText: 'No'
    //         }).then(function (result) {
    //             if(result.value != ""){
                    
    //                 PeticionAjax.mostrarCargando();
    //                 var request = PeticionAjax.post(url, data);
    //                 request.done(function (){
    //                     PeticionAjax.ocultarCargando();
    //                 })

    //             }
    //         });
    //     });

    // }

    return {
        load: function($context){
            generate_simulation();
            // download_simulation();
        }
    }
})();

