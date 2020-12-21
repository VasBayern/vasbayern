/**
 * show
 * @param {*} url 
 * @param {*} data 
 */
function ajaxShowItem(url, data) {
    return admin.common.api.ajaxRequest(url, "GET", data, ajaxShowItem_callback);
}

function ajaxShowItem_callback(response) {
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit .modal-title').html('Sửa size ' + response.name);
    $('#modal-default-edit #name').val(response.name);
}
/**
 * add
 * @param {*} url 
 * @param {*} data 
 */
function ajaxAddItem(url, data) {
    return admin.common.api.ajaxRequest(url, "POST", data, ajaxAddItem_callback);
}

function ajaxAddItem_callback(response) {
    $('#modal-default-add #name').val('');
    html = '<tr class="tr-' + response.id + '">';
    html += '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>';
    $('tbody').append(html);
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
    html = '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}