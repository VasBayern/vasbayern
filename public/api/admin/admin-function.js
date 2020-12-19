// toast sweetalert
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

//toast messages
const success = ["Thêm thành công", "Sửa thành công", "Xóa thành công"];
const error = "Đã tồn tại";

// validate rules and messages
const rules = {
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
};
const messages = {
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
}
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
            ajaxCallDeleteFunction(url, data)
        }
    })
})

function ajaxCallDeleteFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "DELETE", data, ajaxCallDeleteFunction_callback);
}

function ajaxCallDeleteFunction_callback(response) {
    $('.tr-' + response.id).remove();
}
/**
 * Validate
 */
$('#quickForm').validate({
    rules: rules,
    messages: messages,
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
        ajaxCallAddFunction(url, data)
    }
});

$('#quickFormEdit').validate({
    rules: rules,
    messages: messages,
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
        ajaxCallEditFunction(url, data);
    }
});