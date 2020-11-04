const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
})
// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var link = $(this).attr('href');
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit .modal-title').html('Sửa size ' + name);
    $('#modal-default-edit #name').val(name);
    $('#modal-default-edit .update-size').attr('href', link);
})
// add
$(document).on('click', '.store-size', function (e) {
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
        html = '<tr class="tr-' + response.id + '">';
        html += '<th scope="row">' + response.id + '</th>' +
            '<td>' + response.name + '</td>' +
            '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
            '<a href="' + response.link + '" class="btn btn-danger delete-size" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
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
            title: 'Size đã tồn tại'
        })
    })
})
// update
$(document).on('click', '.update-size', function (e) {
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
            '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
            '<a href="' + response.link + '" class="btn btn-danger delete-size" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
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
            title: 'Size đã tồn tại'
        })
    })
})
//delete
$(document).on('click', '.delete-size', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Bạn có muốn xóa?',
        text: "Bạn sẽ không thể hoàn tác hành động này",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Hủy',
        confirmButtonText: 'Xóa'
    }).then((result) => {
        if (result.isConfirmed) {
            var url = $(this).attr('href');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'DELETE',
            }).done(function (response) {
                $('.tr-' + response.id).remove();
                Toast.fire({
                    icon: 'success',
                    title: 'Xóa thành công'
                })
            }).fail(function (response) {
                Toast.fire({
                    icon: 'error',
                    title: 'Không thể xóa'
                })
            })
        }
    })
})