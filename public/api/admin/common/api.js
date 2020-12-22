'use strict';
//namespace
var admin = admin || {};
admin.common = admin.common || {};
admin.common.api = admin.common.api || {};
admin.common.BASE_URL = admin.common.BASE_URL || BASE_URL;

/**
 * Get Method
 * @param {*} endpoint 
 * @param {*} data 
 */
admin.common.api.get = function (endpoint, data) {
    let defer = $.Deferred();
    let url = admin.common.BASE_URL + '/api/admin/' + endpoint;
    console.log("ajax start " + url);
    $.get(url, data)
        .done(function (response) {
            console.log("ajax callback " + url);
            defer.resolve(response);
        }).fail(function (xhr) {
            try {
                defer.resolve(xhr.responseJson)
            } catch (e) {
                defer.reject(xhr);
            }
        })
    return defer.promise();
}
admin.common.api.ajaxRequest = function (
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
        url: url,
        type: type,
        cache: false,
        dataType: "JSON",
        data: data
    })
        .done(function (response) {
            try {
                console.log("ajax callback " + url);
                if (successCallback) {
                    if (type == "GET") {
                        $('input').removeClass('is-invalid');
                        $('.update-item').attr('href', url);
                    } else if (type == "DELETE") {
                        TOAST.fire({
                            icon: 'success',
                            title: SUCCESS[2]
                        })
                    } else {
                        TOAST.fire({
                            icon: 'success',
                            title: type == "POST" ? SUCCESS[0] : SUCCESS[1]
                        });
                        $('.modal').modal('hide');
                    }
                    successCallback(response);
                }
                defer.resolve();
            }
            catch (e) {
                if (errorCallback) { errorCallback(); }
                else { alert("Có lỗi xảy ra"); }
                console.log(e.stack);
                defer.reject();
            }
        })
        .fail(function () {
            TOAST.fire({
                icon: 'error',
                title: ERROR
            })
        });
    return defer.promise();
}