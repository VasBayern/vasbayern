$(document).on('click', '#chevron', function (e) {
    $('tbody#orderProduct').toggle();
    $(this).toggleClass('fa-chevron-up fa-chevron-down');
})
$(document).on('click', '.edit-modal', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
    }).done(function (response) {
        $('.modal').modal('show');
        $('#modal-lg .update-item').attr('href', url);
        let i;
        let j;
        let html = '';
        let order = response.order;
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

            $("#stt" + order[i].status).attr('selected', 'selected');
            if (order[i].status == 2) {
                $('#stt1').attr('disabled', 'disabled');
            } else if (order[i].status == 3 || order[i].status == 0) {
                $('#status').attr('disabled', 'disabled');
                $('.update-item').attr('disabled', true);
                $('#stt3').html("Thành công");
                $('#stt0').html("Đã hủy");
            }
            if (order[i].status != 1) {
                $('#shipment').attr('disabled', 'disabled');
            }
            for (j = 0; j < order[i].orderDetails.length; j++) {
                html += '<tr>' +
                    '<th scope="row">' + order[i].orderDetails[j].product.id + '</th>' +
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
    });
})
/**
 * update
 */
function ajaxCallEditFunction(url, data) {
    return shop.common.api.ajaxRequest(url, "PUT", data, ajaxCallEditFunction_callback);
}

function ajaxCallEditFunction_callback(response) {
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