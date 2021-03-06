/**
 * add
 * @param {*} url 
 * @param {*} data 
 */
function ajaxAddItem(url, data) {
    return admin.common.api.ajaxRequest(url, "POST", data, ajaxAddItem_callback);
}

function ajaxAddItem_callback(response) {
    window.location.replace(response.link);
}

/**
 * update
 * @param {*} url 
 * @param {*} data 
 */
function ajaxEditItem(url, data) {
    return admin.common.api.ajaxRequest(url, "PUT", data, ajaxEditItem_callback);
}

function ajaxEditItem_callback(response) {
    window.location.replace(response.link);
}