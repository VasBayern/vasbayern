<form action="{{ url('admin/order/update') }}" method="post">
    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Email
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fas fa-envelope" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="email" value="123">
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="name">
            Tên
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fas fa-user" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="name" />
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="phone">
            SĐT
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fas fa-mobile" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="phone" />
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Tổng tiền
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fas fa-money" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="sub_total" />
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Giảm giá
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fas fa-money" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="promotion" />
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Thanh toán
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="total" />
        </div>
    </div>
    <div class="form-group col-lg-6">
        <label class="control-label" for="email">
            Địa chỉ
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="address" />
        </div>
    </div>
    <div class="form-group col-lg-6">
        <label class="control-label" for="email">
            Ghi chú
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-comments" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="note" />
        </div>
    </div>

    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Hình thức thanh toán
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
            <input class="form-control" type="text" readonly id="payment_method" />
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Đơn vị giao hàng
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-truck" aria-hidden="true"></i></div>
            <select class="form-control" id="shipment" name="shipment">
                <option value="0" data-id="0" id="sm0">Grab</option>
                <option value="1" data-id="1" id="sm1">GHTK</option>
                <option value="2" data-id="2" id="sm2">VNPost</option>
            </select>
        </div>
    </div>
    <div class="form-group col-lg-4">
        <label class="control-label" for="email">
            Trạng thái đơn hàng
        </label>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
            <select class="form-control" id="status" name="status">
                <option value="0" data-id="0" id="stt0">Chờ xác nhận</option>
                <option value="1" data-id="1" id="stt1">Đã giao hàng</option>
                <option value="2" data-id="2" id="stt2">Đã nhận hàng</option>
                <option value="3" data-id="3" id="stt3">Hủy đơn hàng</option>
            </select>
        </div>
    </div>
</form>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Ảnh</th>
            <th scope="col">Sản phẩm</th>
            <th scope="col">Số Lượng</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Thành tiền</th>
            <th scope="col"><i class="fa fa-chevron-down" aria-hidden="true" id="chevron"></i></th>
        </tr>
    </thead>
    <tbody id="orderProduct">


    </tbody>
</table>    