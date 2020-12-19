// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var link = $(this).attr('href');
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit .modal-title').html('Sửa size ' + name);
    $('#modal-default-edit #name').val(name);
    $('#modal-default-edit .update-item').attr('href', link);
    $('input').removeClass('is-invalid');
})
/**
 * add
 */
function ajaxCallAddFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "POST", data, ajaxCallAddFunction_callback);
}

function ajaxCallAddFunction_callback(response) {
    $('#modal-default-add #name').val('');
    html = '<tr class="tr-' + response.id + '">';
    html += '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>';
    $('tbody').append(html);
}

/**
 * update
 */
function ajaxCallEditFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "PUT", data, ajaxCallEditFunction_callback);
}

function ajaxCallEditFunction_callback(response) {
    html = '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}