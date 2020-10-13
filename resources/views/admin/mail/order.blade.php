<base href="{{asset('')}}">
<div marginheight="0" marginwidth="0" style="background:#f0f0f0">
    <div id="wrapper" style="background-color:#f0f0f0">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
            <tbody>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff">
                    <table style="width:580px;border-bottom:1px solid #E7AB3C" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td align="left" valign="middle" style="width:500px;height:60px">
                                <a href="#" style="border:0" target="_blank" width="130" height="35" style="display:block;border:0px">
                                    <img src="https://i.imgur.com/rr41Oea.png" height="30" width="auto" style="display:block;border:0px;float: left;">
                                    <b style="float: left;line-height: 30px;color: #E7AB3C; margin-left: 80px;font-size: 20px;">VASBAYERN SHOP</b>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff">
                    <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px; text-align: center">
                                Thông báo đặt hàng thành công
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                Chào <b>{{ $order -> user-> name }}!</b>
                                <br> Cám ơn bạn đã mua sắm tại Vasbayern Shop.
                                <br> Đơn hàng của bạn đang được shop xử lý và sẽ giao đến bạn trong thời gian sớm nhất.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff">
                    <table style="width:580px;border-top:3px solid #E7AB3C" cellpadding="0" cellspacing="0" border="0">
                        <tbody>

                        <tr>
                            <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:15px 10px 20px 15px;line-height:17px">
                                <b>Đơn hàng của bạn </b>
                                <span style="font-size:12px">({{ $order->created_at }})</span>
                            </td>
                        </tr>

                        <tr>
                            <td align="left" valign="top">
                                <table style="width:100%" cellpadding="0" cellspacing="0" border="1px solid #cccccc;">
                                    <tbody style="border: 1px solid #cccccc;">
                                    <tr>
                                        <td align="left" valign="top" style="width:270px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Sản phẩm</b>
                                        </td>
                                        <td align="left" valign="top" style="width:60px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Số lượng</b>
                                        </td>
                                        <td align="left" valign="top" style="width:80px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Đơn giá</b>
                                        </td>
                                        <td align="left" valign="top" style="width:80px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Thành tiền</b>
                                        </td>
                                    </tr>
                                    @foreach($detail as $order_detail)
                                    <tr>
                                        <td align="left" valign="top" style="width:270px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order_detail->name }}</p>
                                        </td>
                                        <td align="left" valign="top" style="width:60px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:30px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order_detail->quantity }}</p>
                                        </td>
                                        <td align="left" valign="top" style="width:80px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ number_format($order_detail->price)  }} vnđ</p>
                                        </td>
                                        <td align="left" valign="top" style="width:80px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ number_format($order_detail->price* $order_detail->quantity) }} vnđ</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:20px 10px 20px 15px;line-height:17px">
                                <b>Thông tin người nhận </b>
                            </td>
                        </tr>

                        <tr>
                            <td align="left" valign="top">
                                <table style="width:100%" cellpadding="0" cellspacing="0" border="1px solid #cccccc;">
                                    <tbody style="border: 1px solid #cccccc;">
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Họ tên</b>
                                        </td>
                                        <td align="left" valign="top" style="width:60px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>SĐT</b>
                                        </td>
                                        <td align="left" valign="top" style="width:140px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Địa chỉ</b>
                                        </td>
                                        <td align="left" valign="top" style="width:110px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Hình thức thanh toán</b>
                                        </td>
                                        <td align="left" valign="top" style="width:110px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Tổng tiền</b>
                                        </td>
                                        <td align="left" valign="top" style="width:110px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;vertical-align: middle;line-height:20px; text-align: center" border="1px solid #cccccc;">
                                            <b>Ghi chú</b>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order->name}}</p>
                                        </td>
                                        <td align="left" valign="top" style="width:60px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:10px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order->phone }}</p>
                                        </td>
                                        <td align="left" valign="top" style="width:140px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order->address  }}</p>
                                        </td>
                                        <td align="left" valign="top" style="width:110px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:35px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order->payment_method }}</p>
                                        </td>
                                        <td align="left" valign="top" style="width:110px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ number_format($order->total) }} vnđ</p>
                                        </td>
                                        <td align="left" valign="top" style="width:110px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right: 10px;line-height:20px;vertical-align: middle" border="1px solid #cccccc;">
                                            <p>{{ $order->note }}</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" valign="top" style="padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ebebeb">
                                <a href="user/order" style="border:0px" target="_blank">
                                    <img src="https://i.imgur.com/f92hL68.jpg" height="29" width="191" alt="Chi tiết đơn hàng" style="border:0px">
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                    <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td align="center" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                Đây là thư tự động từ hệ thống. Vui lòng không trả lời email này.
                                <br> Nếu có bất kỳ thắc mắc hay cần giúp đỡ, Bạn vui lòng ghé thăm
                                <b style="font-family:Arial,Helvetica,sans-serif;font-size:13px;text-decoration:none;font-weight:bold">Trung tâm trợ giúp</b> của chúng tôi tại địa chỉ:
                                <a href="contact" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold" target="_blank">
                                    help.vasbayernshop.vn
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

