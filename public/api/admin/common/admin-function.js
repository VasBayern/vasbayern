// toast sweetalert
const TOAST = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

//toast messages
const SUCCESS = ["Thêm thành công", "Sửa thành công", "Xóa thành công"];
const ERROR = "Đã tồn tại";

// validate rules and messages
const RULES = {
    name: {
        required: true,
    },
    slug: {
        required: true,
    },
    value: {
        required: true,
    },
    percent_off: {
        required: true,
    },
    code: {
        required: true,
    },
    color: {
        required: true,
    },
    shipment: {
        required: true,
    },
    link: {
        required: true,
    },
    image: {
        required: true,
    },
    sort_no: {
        required: true,
    },
    location_id: {
        required: true
    },
    priceCore: {
        required: true,
    },
    category_id: {
        required: true,
    },
    cat_id: {
        required: true,
    },
    brand_id: {
        required: true,
    },
    location_id: {
        required: true,
    },
    'images[]': {
        required: true,
    },
    size_id: {
        required: true,
    },
    color_id: {
        required: true,
    },
    quantity: {
        required: true,
    },
    'tag[]': {
        required: true,
    },
    email: {
        required: true,
        email: true,
    },
    password: {
        required: true,
        minlength: 8
    },
    password_confirmation: {
        required: true,
        minlength: 8,
        equalTo: '#password'
    },
    terms: {
        required: true
    },
};
const MESSAGES = {
    name: {
        required: "Vui lòng nhập tên",
    },
    slug: {
        required: "Vui lòng nhập slug",
    },
    value: {
        required: "Vui lòng nhập giá tiền",
    },
    code: {
        required: "Vui lòng nhập mã",
    },
    percent_off: {
        required: "Vui lòng nhập % giảm giá",
    },
    color: {
        required: "Vui lòng nhập màu",
    },
    shipment: {
        required: "Vui lòng chọn đơn vị vận chuyển",
    },
    link: {
        required: "Vui lòng nhập đường dẫn",
    },
    image: {
        required: "Vui lòng nhập ảnh",
    },
    sort_no: {
        required: "Vui lòng nhập thứ tự",
    },
    'images[]': {
        required: "Vui lòng nhập ảnh",
    },
    size_id: {
        required: "Vui lòng chọn size",
    },
    color_id: {
        required: "Vui lòng chọn màu sắc",
    },
    quantity: {
        required: "Vui lòng chọn số lượng",
    },
    'tag[]': {
        required: "Vui lòng chọn thẻ",
    },
    priceCore: {
        required: "Vui lòng nhập giá bán",
    },
    category_id: {
        required: "Vui lòng chọn danh mục",
    },
    cat_id: {
        required: "Vui lòng chọn danh mục",
    },
    brand_id: {
        required: "Vui lòng chọn thương hiệu",
    },
    location_id: {
        required: "Vui lòng chọn vị trí",
    },
    email: {
        required: "Vui lòng nhập địa chỉ email",
        email: "Định dạng email không đúng"
    },
    password: {
        required: "Vui lòng nhập mật khẩu",
        minlength: "Mật khẩu chứa ít nhất 8 kí tự"
    },
    password_confirmation: {
        required: "Vui lòng nhập mật khẩu",
        minlength: "Mật khẩu chứa ít nhất 8 kí tự",
        equalTo: "Mật khẩu xác thực không trùng khớp",
    },
    terms: "Vui lòng chấp nhận điều khoản"
}

/**
 * show modal
 */
$(document).on('click', '.edit-modal', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');
    let data = {};
    ajaxShowItem(url, data);
})

/**
 * delete item
 */
$(document).on('click', '.delete-item', function (e) {
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
            var data = {}
            ajaxDeleteItem(url, data)
        }
    })
})

/**
 * delete
 * @param {*} url 
 * @param {*} data 
 */
function ajaxDeleteItem(url, data) {
    return admin.common.api.ajaxRequest(url, "DELETE", data, ajaxDeleteItem_callback);
}

function ajaxDeleteItem_callback(response) {
    $('.tr-' + response.id).remove();
}
/**
 * Validate
 */
$('#quickForm').validate({
    rules: RULES,
    messages: MESSAGES,
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
        var url = $('.store-item').attr('href');
        var data = $('.store-item').closest('form').serializeArray();
        ajaxAddItem(url, data)
    }
});

$('#quickFormEdit').validate({
    rules: RULES,
    messages: MESSAGES,
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
        var url = $('.update-item').attr('href');
        var data = $('.update-item').closest('form').serializeArray();
        ajaxEditItem(url, data);
    }
});
$('#quickFormAuth').validate({
    rules: RULES,
    messages: MESSAGES,
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
        var url = $('.authenticate').attr('href');
        var data = $('.authenticate').closest('form').serializeArray();
        //ajaxAuthenticate(url, data);
    }
});
/**
 * File manager
 */
$('.lfm-btn').filemanager('image', {
    'prefix': '/laravel-filemanager'
});

$(document).on('click', '.plus-image', function (e) {
    e.preventDefault();
    var countLfm = parseInt($('.lfm-btn').length);
    var nextLfm = countLfm + 1;
    var html = '';
    var i;
    for (i = 0; i < 100; i++) {
        if ($('#lfm'.nextLfm).length < 1) {
            html += '<div class="form-group">' +
                '<label for="image">Ảnh</label>' +
                '<span class="input-group-btn">' +
                '<a id="lfm' + nextLfm + '" data-input="thumbnail' + nextLfm + '" data-preview="holder' + nextLfm + '" class="lfm-btn btn">' +
                '<button type="button" class="btn btn-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>' +
                '</a>' +
                '<a class="remove-image">' +
                '<button type="button" class="btn btn-danger"><i class="fas fa-trash-alt" style="margin-right:10px"></i>Xóa</button>' +
                '</a>' +
                '</span>' +
                '<input id="thumbnail' + nextLfm + '" type="text" name="images[]" value="" class="form-control" id="focusedinput">' +
                '<img id="holder' + nextLfm + '" style="max-height:100px;">' +
                '</div>';
            break;
        } else {
            next++;
        }
    }
    var box = $(this).closest('.form-group');
    $(html).insertBefore(box);
    $('.lfm-btn').filemanager('image', {
        'prefix': '/laravel-filemanager'
    });
})
$(document).on('click', '.remove-image', function (e) {
    e.preventDefault();
    $(this).closest('.form-group').remove();
})
/**
 * Summernote
 */
$(function () {
    $('.textarea').summernote({
        height: 150
    });
    $('.textareaDesc').summernote({
        height: 250
    });
    $('.textarea1').summernote({
        height: 100
    });
    $('.textareaDesc1').summernote({
        height: 170
    });
    $('.textareaDescProduct').summernote({
        height: 523
    });
    $('.textareaPost').summernote({
        height: 615
    });
})