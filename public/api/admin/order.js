$(document).on('click', '#chevron', function (e) {
    $('tbody#orderProduct').toggle();
    $(this).toggleClass('fa-chevron-up fa-chevron-down');
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
    let i, j;
    let html = '', statusHtml = '', shipmentHtml = '', footerHtml = '';
    let order = response.order;
    $('.modal').modal('show');

    shipmentHtml += '<div class="input-group-prepend">' +
        '<span class="input-group-text"><i class="fas fa-truck"></i></span></div>' +
        '<select class="form-control custom-select" id="shipment" name="shipment">' +
        '<option value="1" data-id="1" id="sm1">Grab</option>' +
        '<option value="2" data-id="2" id="sm2">GHTK</option>' +
        '<option value="3" data-id="3" id="sm3">VNPost</option>' +
        '</select>';
    $('.shipmentHtml').html(shipmentHtml);
    statusHtml += '<div class="input-group-prepend">' +
        '<span class="input-group-text"><i class="fas fa-shopping-cart"></i></span></div>' +
        '<select class="form-control custom-select" id="status" name="status">' +
        '<option value="1" data-id="1" id="stt1">Chờ xác nhận</option>' +
        '<option value="2" data-id="2" id="stt2">Đã giao hàng</option>' +
        '<option value="3" data-id="3" id="stt3">Đã nhận hàng</option>' +
        '<option value="0" data-id="0" id="stt0">Hủy đơn hàng</option>' +
        '</select>';
    $('.statusHtml').html(statusHtml);
    // footerHtml += ' <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>' +
    //     '<button type="submit" class="btn btn-primary update-item">Cập nhật</button>';
    // $('.footerHtml').html(footerHtml);

    for (i = 0; i < order.length; i++) {
        $('.order_id').html('#' + order[i].order_id);
        $('.updateOrder').attr('data-orderId', order[i].order_id);
        $('#email').val(order[i].email);
        $('#name').val(order[i].name);
        $('#phone').val(order[i].phone);
        $('#address').val(order[i].address);
        $('#sub_total').val(order[i].sub_total);
        $('#promotion').val(order[i].promotion);
        $('#ship_price').val(order[i].ship_price);
        $('#total').val(order[i].total);
        $('#payment_method').val(order[i].payment_method);
        $('#shipment').val(order[i].shipment);
        $('.update-item').val(order[i].url);
        $("#stt" + order[i].status).attr('selected', 'selected');
        if (order[i].status == 2) {
            $('#stt1').attr('disabled', 'disabled');
        } else if (order[i].status == 3 || order[i].status == 0) {
            $('#status').attr('disabled', 'disabled');
            //$('.update-item').attr('disabled', true);
            $('#stt3').html("Thành công");
            $('#stt0').html("Đã hủy");
        }
        if (order[i].status != 1) {
            $('#shipment').attr('disabled', 'disabled');
        }
        for (j = 0; j < order[i].orderDetails.length; j++) {
            html += '<tr>' +
                '<th scope="row">' + (j + 1) + '</th>' +
                '<input type="hidden" name="product_id[]" value="' + order[i].orderDetails[j].product.id + '">' +
                '<input type="hidden" name="size_id[]" value="' + order[i].orderDetails[j].size.id + '">' +
                '<input type="hidden" name="color_id[]" value="' + order[i].orderDetails[j].color.id + '">' +
                '<input type="hidden" name="quantity[]" value="' + order[i].orderDetails[j].quantity + '">' +
                '<input type="hidden" name="email" value="' + order[i].email + '">' +
                '<td><img src="' + order[i].orderDetails[j].product.image + '" style="width:100px"></td>' +
                '<td>' + order[i].orderDetails[j].product.name + '</td>' +
                '<td>' + order[i].orderDetails[j].size.name + '</td>' +
                '<td>' + order[i].orderDetails[j].color.name + '</td>' +
                '<td>' + order[i].orderDetails[j].quantity + '</td>' +
                '<td>' + order[i].orderDetails[j].unit_price + '</td>' +
                '<td>' + order[i].orderDetails[j].total_price + '</td>' +
                '</tr>';
        }
    }
    $('#orderProduct').html(html);
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
    let html = '';
    switch (response.status) {
        case 1:
            html = '<p>Chờ xác nhận</p>';
            break;
        case 2:
            html = '<p style="color: #337AB7">Đã giao hàng</p>';
            break;
        case 3:
            html = '<p style="color: #4CAF50">Thành công</p>';
            break;
        case 0:
            html = '<p style="color: #D9534F">Đã hủy</p>';
            break;
        default:
            break;
    }
    $('.status-' + response.id).html(html)
}