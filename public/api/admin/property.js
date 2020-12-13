// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var quantity = $(this).attr('data-quantity');
    var size = $(this).attr('data-size');
    var color = $(this).attr('data-color');
    var link = $(this).attr('href');
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit #size').val(size);
    $('#modal-default-edit #color').val(color);
    $('#modal-default-edit #quantity').val(quantity);
    $('#modal-default-edit .update-item-property').attr('href', link);
    $('input').removeClass('is-invalid');
})
/**
 * add
 */
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
        $('#modal-default-add #size_id').val(0);
        $('#modal-default-add #color_id').val(0);
        $('#modal-default-add #quantity').val('');
        html = '<tr class="tr-' + response.id + '">';
        html += '<th scope="row">' + response.id + '</th>' +
            '<td>' + response.size + '</td>' +
            '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
            '<td>' + response.quantity + '</td>' +
            '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-quantity="' + response.quantity + '" data-size="' + response.size + '" data-color="' + response.color_name + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
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
/**
 * update
 */

$(document).on('click', '.update-item-property', function (e) {
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
            '<td>' + response.size + '</td>' +
            '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
            '<td>' + response.quantity + '</td>' +
            '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-quantity="' + response.quantity + '" data-size="' + response.size + '" data-color="' + response.color_name + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
            '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
            '</td>' +
            '</tr>';
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
/**
 * delete
 */
functionRemoveItem();