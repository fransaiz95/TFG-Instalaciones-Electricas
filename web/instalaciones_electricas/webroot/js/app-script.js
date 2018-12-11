$(document).ready(function(){
    Weblectric.load();
});

var PeticionAjax  = (function(){

    var get = function(url, data){
        return $.ajax({
            type : "GET",
            // encoding: "UTF-8",
            url: url,
            data: data
        });
    };

    var post = function(url, data){
        console.log(data);
        return $.ajax({
            type : "POST",
            // encoding: "UTF-8",
            url: url,
            data: data
        });
    };

    var mostrarCargando = function(){
        loading = "<div class='mask-up-js' style='background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3); height: 100%; position: fixed; top: 0; width: 100%; z-index: 120;'><div style='position: fixed; background: #5c5c5c; top: 50%; left: 50%; margin-top: -70px; margin-left: -65px; padding: 0.5em 1.2em; border-radius: 15px; text-align: center;'><img src='/css/img/loading.gif'><br><span style='color: #fff; font-weight: bold; font-size: 0.9em'>Cargando</span></div></div>";
        $('body').append(loading);
    };

    var ocultarCargando = function(){
        $('.mask-up-js').remove();
    };

    return {
        get: function(url, data){
            return get(url, data);
        },
        post: function(url, data){
            return post(url, data);
        },
        mostrarCargando: function(){
            mostrarCargando();
        },
        ocultarCargando: function(){
            ocultarCargando();
        }
    }
})();


var Weblectric  = (function(){

    var loadSelect2Single = function(){
        $('.js-example-basic-single').select2();
    }

    var loadSelect2Multiple = function(){
        $('.js-example-basic-multiple').select2();
    }

    var deleteFunction = function(){
        $('.delete-js').off('click').on('click', function(e){
            e.preventDefault();
            var element = $(this);
            var title = element.data('title');
            var text = element.data('text');
            var url = element.data('url');
            var url_redirect = element.data('url_redirect');
            var id = element.data('id');
            var data = {}
            data.id = id;
            
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
            loadSelect2Single();
            loadSelect2Multiple();
            deleteFunction();
        }
    }
})();

