$(document).on('click', '.add-modal', function () {
    var type = $('#modal-default-add').find('#type').val();
    changeCouponType(type);
})
$(document).on('change', '#type', function () {
    var type = $(this).val();
    changeCouponType(type);
})
// show modal edit
$(document).on('click', '.edit-modal', function (e) {
    var name = $(this).attr('data-name');
    var type = $(this).attr('data-type');
    var value = $(this).attr('data-value');
    var percent_off = $(this).attr('data-percent');
    var link = $(this).attr('href');
    $('#modal-default-edit').modal('show');
    changeCouponType(type);
    $('#modal-default-edit .modal-title').html('Sửa Mã ' + name);
    $('#modal-default-edit #name').val(name);
    $('#modal-default-edit #type').val(type);
    $('#modal-default-edit #value').val(value);
    $('#modal-default-edit #percent_off').val(percent_off);
    $('#modal-default-edit .update-item').attr('href', link);
    $('input').removeClass('is-invalid');
})
/**
 * add
 */
function ajaxCallAddFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "POST", data, ajaxCallAddFunction_callback);
}

function ajaxCallAddFunction_callback(response) {
    $('#modal-default-add #name').val('');
    $('#modal-default-add #type').val(1);
    $('#modal-default-add #value').val('');
    $('#modal-default-add #percent_off').val('');
    html = '<tr class="tr-' + response.id + '">';
    html += '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>';
    if (response.type == 1) {
        html += '<td>Giảm %</td>';
    } else if (response.type == 2) {
        html += '<td>Giảm giá</i></td>';
    }
    html += '<td>' + formatNumber(response.value) + ' VNĐ</td>' +
        '<td>' + response.percent_off + ' %</td>' +
        '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-type="' + response.type + '" data-value="' + response.value + '" data-percent="' + response.percent_off + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>';
    $('tbody').append(html);
}

/**
 * update
 */
function ajaxCallEditFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "PUT", data, ajaxCallEditFunction_callback);
}

function ajaxCallEditFunction_callback(response) {
    html = '<th scope="row">' + response.id + '</th>' +
        '<td>' + response.name + '</td>';
    if (response.type == 1) {
        html += '<td>Giảm %</td>';
    } else if (response.type == 2) {
        html += '<td>Giảm giá</i></td>';
    }
    html += '<td>' + formatNumber(response.value) + ' VNĐ</td>' +
        '<td>' + response.percent_off + ' %</td>' +
        '<td><a href="' + response.link + '"  class="btn btn-primary edit-modal" data-name="' + response.name + '" data-type="' + response.type + '" data-value="' + response.value + '" data-percent="' + response.percent_off + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
        '<a href="' + response.link + '" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
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