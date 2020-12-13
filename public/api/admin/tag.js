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
            Toast.fire({
                icon: 'success',
                title: success[1]
            })
            $('.modal').modal('hide');
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