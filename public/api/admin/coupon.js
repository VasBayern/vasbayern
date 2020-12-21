$(document).on('click', '.add-modal', function () {
    var type = $('#modal-default-add').find('#type').val();
    changeCouponType(type);
})
$(document).on('change', '#type', function () {
    var type = $(this).val();
    changeCouponType(type);
})

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
    $('#modal-default-edit .modal-title').html('Sửa Mã ' + response.name);
    $('#modal-default-edit #name').val(response.name);
    $('#modal-default-edit #type').val(response.type);
    $('#modal-default-edit #value').val(response.value);
    $('#modal-default-edit #percent_off').val(response.percent_off);
    changeCouponType(type);
}
/**
 * add
 * @param {*} url 
 * @param {*} data 
 */
function ajaxAddItem(url, data) {
    return admin.common.api.ajaxRequest(url, "POST", data, ajaxAddItem_callback);
}

function ajaxAddItem_callback(response) {
    $('#modal-default-add #name').val('');
    $('#modal-default-add #type').val(1);
    $('#modal-default-add #value').val('');
    $('#modal-default-add #percent_off').val('');
    html = '<tr class="tr-' + response.id + '">';
    html += '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>';
    html += (response.type == 1) ? '<td>Giảm %</td>' : '<td>Giảm giá</i></td>';
    html += '<td>' + formatNumber(response.value) + ' VNĐ</td>' +
        '<td>' + response.percent_off + ' %</td>' +
        '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>';
    $('tbody').append(html);
}

/**
 * update
 * @param {*} url 
 * @param {*} data 
 */
function ajaxEditItem(url, data) {
    return admin.common.api.ajaxRequest(url, "PUT", data, ajaxEditItem_callback);
}

function ajaxEditItem_callback(response) {
    html = '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>';
    if (response.type == 1) {
        html += '<td>Giảm %</td>';
    } else if (response.type == 2) {
        html += '<td>Giảm giá</i></td>';
    }
    html += '<td>' + formatNumber(response.value) + ' VNĐ</td>' +
        '<td>' + response.percent_off + ' %</td>' +
        '<td><a href="' + response.url + '"  class="btn btn-primary edit-modal" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.url + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>';
    $('.tr-' + response.id).html(html);
}
/**
 * change type coupon
 * @param {*} type 
 */
function changeCouponType(type) {
    if (type == 1) {
        $('.percent_off').show();
        $('.value').hide();
        $('#value').val('');
    } else if (type == 2) {
        $('.value').show();
        $('.percent_off').hide();
        $('#percent_off').val('');
    };
}

/**
 * format money
 * @param {*} num 
 */
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}