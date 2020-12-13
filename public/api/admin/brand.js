// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var slug = $(this).attr('data-slug');
    var link = $(this).attr('data-link');
    var image = $(this).attr('data-image');
    var linkBrand = $(this).attr('data-link');
    var intro = $(this).attr('data-intro');
    var desc = $(this).attr('data-desc');
    var link = $(this).attr('href');
    $('#modal-xl-edit').modal('show');
    $('#modal-xl-edit .modal-title').html('Sửa hãng : ' + name);
    $('#modal-xl-edit #name').val(name);
    $('#modal-xl-edit #slug').val(slug);
    $('#modal-xl-edit #link').val(linkBrand);
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
function ajaxCallAddFunction() {
    $(document).on('click', '.store-item', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data = $(this).closest('form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
        }).done(function (response) {
            $('.modal').modal('hide');
            $('#modal-xl-add #name').val('');
            $('#modal-xl-add #slug').val('');
            $('#modal-xl-add #link').val('');
            $('#modal-xl-add #thumbnail').val('');
            $('#modal-xl-add #holder').attr('src', '');
            $('#modal-xl-add #intro').val('');
            $('#modal-xl-add #desc').val('');
            html = '<tr class="tr-' + response.id + '">'+
                '<th scope="row">' + response.id + '</th>' +
                '<td>' + response.name + '</td>' +
                '<td>' + response.slug + '</td>' +
                '<td><a href="' + response.linkBrand + '" target="_blank">' + response.linkBrand + '</a></td>'+
                '<td><img src="'+ response.image +'" style="margin-top:10px;max-width:240px;"></td>'+
                '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-slug="' + response.slug + '" data-link="' + response.linkBrand + '" data-image="' + response.image + '" data-intro="' + response.intro + '" data-desc="' + response.desc + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                '</td>' +
                '</tr>';
            $('tbody').append(html);
            Toast.fire({
                icon: 'success',
                title: success[0]
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: error
            })
        })
    })
}

/**
 * update
 */
function ajaxCallEditFunction() {
    $(document).on('click', '.update-item', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data = $(this).closest('form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'PUT',
            dataType: 'JSON',
            data: data,
        }).done(function (response) {
            html = '<th scope="row">' + response.id + '</th>' +
                '<td>' + response.name + '</td>' +
                '<td>' + response.slug + '</td>' +
                '<td><a href="' + response.linkBrand + '" target="_blank">' + response.linkBrand + '</a></td>'+
                '<td><img src="'+ response.image +'" style="margin-top:10px;max-width:240px;"></td>'+
                '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-slug="' + response.slug + '" data-link="' + response.linkBrand + '" data-image="' + response.image + '" data-intro="' + response.intro + '" data-desc="' + response.desc + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                '</td>' ;
            $('.tr-' + response.id).html(html);
            $('.modal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: success[1]
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: error
            })
        })
    })
}

/**
 * delete
 */
functionRemoveItem();