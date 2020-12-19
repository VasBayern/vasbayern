// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var slug = $(this).attr('data-slug');
    var type = $(this).attr('data-type');
    var link = $(this).attr('href');
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit .modal-title').html('Sửa thẻ ' + name);
    $('#modal-default-edit #name').val(name);
    $('#modal-default-edit #slug').val(slug);
    $('#modal-default-edit #type').val(type);
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
    $('#modal-default-add #slug').val('');
    $('#modal-default-add #type').val(1);
    html = '<tr class="tr-' + response.id + '">';
    html += '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td>' + response.slug + '</td>';
    if (response.type == 1) {
        html += '<td><i class="fas fa-tshirt"></i></td>';
    } else if (response.type == 2) {
        html += '<td><i class="far fa-newspaper"></i></td>';
    }
    html += '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-slug="' + response.slug + '" data-type="' + response.type + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
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
        '<td>' + response.slug + '</td>';
    if (response.type == 1) {
        html += '<td><i class="fas fa-tshirt"></i></td>';
    } else if (response.type == 2) {
        html += '<td><i class="far fa-newspaper"></i></td>';
    }
    html += '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-slug="' + response.slug + '" data-type="' + response.type + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}
