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
                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:20px;color:#ff3333;font-weight:bold;padding:30px 10px 0px 10px;">
                                {{ $post['name'] }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#666666;padding-left:10px;line-height:30px;">
                               <?php echo $post->intro ?>
                            </td>

                        </tr>
                        <tr>
                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#666666;padding:10px 10px 20px 10px;">
                                Đọc tiếp bài mới nhất tại:
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom:30px;border-bottom:1px solid #ebebeb">
                                <a href="blog/post/{{$post['slug']}}" style="font-family:Arial,Helvetica,sans-serif; color:#fff; padding: 10px 20px; font-size: 15px; margin-left: 230px; background: #FF3334; text-decoration:none;">Xem ngay</a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff;padding-top:20px;">
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

