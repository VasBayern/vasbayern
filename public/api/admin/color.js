// change color
$(document).on('change', '#color', function (e) {
    var color = $(this).val();
    $(this).closest('.modal-body').find('#bg-color').css({ "background-color": color });
});

/**
 * show
 * @param {*} url 
 * @param {*} data 
 */
function ajaxShowItem(url, data) {
    return shop.common.api.ajaxRequest(url, "GET", data, ajaxShowItem_callback);
}

function ajaxShowItem_callback(response) {
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit .modal-title').html('Sửa màu ' + response.name);
    $('#modal-default-edit #name').val(response.name);
    $('#modal-default-edit #color').val(response.color);
    $('#modal-default-edit .update-item').attr('href', response.link);
    $('#modal-default-edit #bg-color').css({ "background-color": response.color });
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
    $('#modal-default-add #name').val('');
    $('#modal-default-add #color').val('');
    $('#modal-default-add #bg-color').css({
        "background-color": ''
    });
    html = '<tr class="tr-' + response.id + '">';
    html += '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td>' + response.color + '</td>' +
        '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
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
        '<td>' + response.color + '</td>' +
        '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
        '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}
