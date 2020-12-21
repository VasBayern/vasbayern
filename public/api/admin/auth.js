/**
 * authentication
 * @param {*} url 
 * @param {*} data 
 */
$(document).on('click', '.authenticate', function(e){
    e.preventDefault();
    var url = $('.authenticate').attr('href');
    var data = $('.authenticate').closest('form').serializeArray();
    ajaxAuthenticate(url, data);
})
function ajaxAuthenticate(url, data) {
    return admin.common.api.ajaxRequest(url, "POST", data, ajaxAuthenticate_callback);
}

function ajaxAuthenticate_callback(response) {
    window.location.replace(response.link);
}