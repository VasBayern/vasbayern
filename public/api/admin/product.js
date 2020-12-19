/**
 * add
 * @param {*} url 
 * @param {*} data 
 */
function ajaxAddItem(url, data) {
    return shop.common.api.ajaxRequest(url, "POST", data, ajaxAddItem_callback);
}

function ajaxAddItem_callback(response) {
    window.location.replace(response.link);
}

/**
 * update
 * @param {*} url 
 * @param {*} data 
 */
function ajaxCallEditFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "PUT", data, ajaxCallEditFunction_callback);
}

function ajaxCallEditFunction_callback(response) {
    window.location.replace(response.link);
}