'use strict';
//namespace
var shop = shop || {};
shop.common = shop.common || {};
shop.common.api = shop.common.api || {};

shop.common.api.ajaxRequest = function (
    url, type, data, successCallback, errorCallback
) {
    console.log("ajax start " + url);
    var defer = $.Deferred();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url     : url,
        type    : type,
        cache   : false,
        dataType: "JSON",
        data    : data
    })
    .done(function(response){
        try{
            console.log("ajax callback " + url);
            if(successCallback){
                if(type == "GET") {
                    $('input').removeClass('is-invalid');
                    $('.update-item').attr('href', url);
                } else if (type == "DELETE") {
                    Toast.fire({
                        icon: 'success',
                        title: success[2]
                    })
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: type == "POST" ? success[0] : success[1]
                    });
                    $('.modal').modal('hide');
                }
                successCallback(response);
            }
            defer.resolve();
        }
        catch(e){
            if(errorCallback){errorCallback();}
            else{alert("Có lỗi xảy ra");}
            console.log(e.stack);
            defer.reject();
        }
    })
    .fail(function(){
        Toast.fire({
            icon: 'error',
            title: error
        })
	});
    return defer.promise();
}