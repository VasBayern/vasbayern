/**
 * show
 * @param {*} url 
 * @param {*} data 
 */
function ajaxShowItem(url, data) {
    return admin.common.api.ajaxRequest(url, "GET", data, ajaxShowItem_callback);
}

function ajaxShowItem_callback(response) {
    $('#modal-default-edit').modal('show');
    $('#modal-default-edit #size').val(response.size);
    $('#modal-default-edit #color').val(response.color_name);
    $('#modal-default-edit #quantity').val(response.quantity);
    $('#modal-default-edit .update-item-property').attr('href', response.url);
}
/**
 * add
 * @param {*} url 
 * @param {*} data 
 */
$('#quickFormAddProperty').validate({
    rules: {
        quantity: {
            required: true,
        },
        size_id: {
            required: true,
        },
        color_id: {
            required: true,
        }
    },
    messages: {
        quantity: {
            required: 'Vui lòng nhập số lượng'
        },
        size_id: {
            required: 'Vui lòng nhập size'
        },
        color_id: {
            required: 'Vui lòng nhập màu'
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
        var url = $('.store-item-property').attr('href');
        var data = $('.store-item-property').closest('form').serializeArray();
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
                '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                '</td>' +
                '</tr>';
            $('tbody').append(html);
            Toast.fire({
                icon: 'success',
                title: SUCCESS[0]
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: ERROR
            })
        })
    }
});

/**
 * update
 * @param {*} url 
 * @param {*} data 
 */
$('#quickFormEditProperty').validate({
    rules: {
        quantity: {
            required: true,
        }
    },
    messages: {
        quantity: {
            required: 'Vui lòng nhập số lượng'
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
        var url = $('.update-item-property').attr('href');
        var data = $('.update-item-property').closest('form').serializeArray();
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
                '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                '</td>' +
                '</tr>';
            $('.tr-' + response.id).html(html);
            Toast.fire({
                icon: 'success',
                title: SUCCESS[1]
            })
            $('.modal').modal('hide');
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: ERROR
            })
        })
    }
});