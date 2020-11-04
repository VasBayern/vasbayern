const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
})
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
    $('#modal-default-edit .update-tag').attr('href', link);
})
// add
$(document).on('click', '.store-tag', function (e) {
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
            '<a href="' + response.link + '" class="btn btn-danger delete-tag" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
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
            title: 'Thẻ đã tồn tại'
        })
    })
})
// update
$(document).on('click', '.update-tag', function (e) {
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
            '<a href="' + response.link + '" class="btn btn-danger delete-tag" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
            '</td>' ;
        $('.tr-' + response.id).html(html);
        Toast.fire({
            icon: 'success',
            title: 'Sửa thành công'
        })
        $('.modal').modal('hide');
    }).fail(function (response) {
        Toast.fire({
            icon: 'error',
            title: 'Thẻ đã tồn tại'
        })
    })
})
//delete
$(document).on('click', '.delete-tag', function (e) {
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