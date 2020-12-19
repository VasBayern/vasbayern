// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var slug = $(this).attr('data-slug');
    var image = $(this).attr('data-image');
    var linkBanner = $(this).attr('data-link');
    var location_id = $(this).attr('data-location_id');
    var intro = $(this).attr('data-intro');
    var desc = $(this).attr('data-desc');
    var link = $(this).attr('href');
    $('#modal-xl-edit').modal('show');
    $('#modal-xl-edit .modal-title').html('Sửa banner : ' + name);
    $('#modal-xl-edit #name').val(name);
    $('#modal-xl-edit #slug').val(slug);
    $('#modal-xl-edit #link').val(linkBanner);
    $('#modal-xl-edit #location_id').val(location_id);
    $('#modal-xl-edit .image').val(image);
    $('#modal-xl-edit #holder1').attr('src', image);
    $('#modal-xl-edit #intro').html(intro);
    $('#modal-xl-edit #desc').html(desc);
    $('#modal-xl-edit .update-item').attr('href', link);
    $('input').removeClass('is-invalid');
})
/**
 * add
 */
function ajaxCallAddFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "POST", data, ajaxCallAddFunction_callback);
}

function ajaxCallAddFunction_callback(response) {
    $('#modal-xl-add #name').val('');
    $('#modal-xl-add #slug').val('');
    $('#modal-xl-add #link').val('');
    $('#modal-xl-add #location_id').val(0);
    $('#modal-xl-add #thumbnail1').val('');
    $('#modal-xl-add #holder').attr('src', '');
    $('#modal-xl-add #intro').val('');
    $('#modal-xl-add #desc').val('');
    html = '<tr class="tr-' + response.id + '">' +
        '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>' +
        '<td><a href="' + response.linkBanner + '" target="_blank">' + response.linkBanner + '</a></td>' +
        '<td><img src="' + response.image + '" style="margin-top:10px;max-width:240px;"></td>' +
        '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-slug="' + response.slug + '" data-link="' + response.linkBanner + '" data-image="' + response.image + '" data-location_id="' + response.location_id + '" data-intro="' + response.intro + '" data-desc="' + response.desc + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
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
        '<td><a href="' + response.linkBanner + '" target="_blank">' + response.linkBanner + '</a></td>' +
        '<td><img src="' + response.image + '" style="margin-top:10px;max-width:240px;"></td>' +
        '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-slug="' + response.slug + '" data-link="' + response.linkBanner + '" data-location_id="' + response.location_id + '" data-image="' + response.image + '" data-intro="' + response.intro + '" data-desc="' + response.desc + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}