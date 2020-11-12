// change color
$(document).on('change', '#color', function (e) {
    var color = $(this).val();
    $(this).closest('.modal-body').find('#bg-color').css({ "background-color": color });
});
// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var color = $(this).attr('data-color');
    var link = $(this).attr('href');
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit .modal-title').html('Sửa màu ' + name);
    $('#modal-default-edit #name').val(name);
    $('#modal-default-edit #color').val(color);
    $('#modal-default-edit .update-item').attr('href', link);
    $('#modal-default-edit #bg-color').css({ "background-color": color });
})

function ajaxCallFunction() {
    // add
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
            $('#modal-default-add #color').val('');
            $('#modal-default-add #bg-color').css({
                "background-color": ''
            });
            html = '<tr class="tr-' + response.id + '">';
            html += '<th scope="row">' + response.id + '</th>' +
                '<td>' + response.name + '</td>' +
                '<td>' + response.color + '</td>' +
                '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
                '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-color="' + response.color + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                '</td>' +
                '</tr>';
            $('tbody').append(html);
            Toast.fire({
                icon: 'success',
                title: 'Thêm thành công'
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: 'Màu đã tồn tại'
            })
        })
    })
    // update
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
                '<td>' + response.color + '</td>' +
                '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
                '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-color="' + response.color + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                '</td>';
            $('.tr-' + response.id).html(html);
            Toast.fire({
                icon: 'success',
                title: 'Sửa thành công'
            })
            $('.modal').modal('hide');
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: 'Màu đã tồn tại'
            })
        })
    })
    //delete
    functionRemoveItem();
}
