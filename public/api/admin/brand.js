/**
 * show
 * @param {*} url 
 * @param {*} data 
 */
function ajaxShowItem(url, data) {
    return shop.common.api.ajaxRequest(url, "GET", data, ajaxShowItem_callback);
}

function ajaxShowItem_callback(response) {
    $('#modal-xl-edit').modal('show');
    $('#modal-xl-edit .modal-title').html('Sửa hãng : ' + response.name);
    $('#modal-xl-edit #name').val(response.name);
    $('#modal-xl-edit #slug').val(response.slug);
    $('#modal-xl-edit #link').val(response.link);
    $('#modal-xl-edit .image').val(response.image);
    $('#modal-xl-edit #holder1').attr('src', response.image);
    $('#modal-xl-edit #intro').html(response.intro);
    $('#modal-xl-edit #desc').html(response.desc);
}
/**
 * add
 * @param {*} url 
 * @param {*} data 
 */
function ajaxAddItem(url, data) {
    return shop.common.api.ajaxRequest(url, "POST", data, ajaxAddItem_callback);
}

function ajaxAddItem_callback(response) {
    $('#modal-xl-add #name').val('');
    $('#modal-xl-add #slug').val('');
    $('#modal-xl-add #link').val('');
    $('#modal-xl-add #thumbnail').val('');
    $('#modal-xl-add #holder').attr('src', '');
    $('#modal-xl-add #intro').val('');
    $('#modal-xl-add #desc').val('');
    html = '<tr class="tr-' + response.id + '">' +
        '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td>' + response.slug + '</td>' +
        '<td><a href="' + response.link + '" target="_blank">' + response.link + '</a></td>' +
        '<td><img src="' + response.image + '" style="margin-top:10px;max-width:240px;"></td>' +
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
function ajaxCallEditFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "PUT", data, ajaxCallEditFunction_callback);
}

function ajaxCallEditFunction_callback(response) {
    html = '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td>' + response.slug + '</td>' +
        '<td><a href="' + response.link + '" target="_blank">' + response.link + '</a></td>' +
        '<td><img src="' + response.image + '" style="margin-top:10px;max-width:240px;"></td>' +
        '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}