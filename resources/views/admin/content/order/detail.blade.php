<form action="{{ url('admin/order/update') }}" method="post">
    @method('PUT')

    <div class="row">
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control" value="" id="email" placeholder="Email" readonly>

        </div>  
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" id="name" placeholder="Tên" readonly>
        </div>
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
            </div>
            <input type="text" class="form-control" id="phone" placeholder="SĐT" readonly>
        </div>
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input type="text" class="form-control" readonly id="sub_total" placeholder="Giá tiền">
        </div>
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input type="text" class="form-control" readonly id="promotion" placeholder="Giảm giá">
        </div>
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input type="text" class="form-control" id="total" placeholder="Thanh toán" readonly>
        </div>
        <div class="input-group mb-3 col-lg-6">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            <input type="text" class="form-control" id="address" placeholder="Địa chỉ" readonly>
        </div>
        <div class="input-group mb-3 col-lg-6">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comment"></i></span>
            </div>
            <input type="text" class="form-control" id="note" placeholder="Ghi chú" readonly>
        </div>
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-credit-card"></i></span>
            </div>
            <input type="text" class="form-control" id="payment_method" placeholder="Hình thức thanh toán" readonly>
        </div>

        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-truck"></i></span>
            </div>
            <select class="form-control custom-select" id="shipment" name="shipment">
                <option value="1" data-id="1" id="sm1">Grab</option>
                <option value="2" data-id="2" id="sm2">GHTK</option>
                <option value="3" data-id="3" id="sm3">VNPost</option>
            </select>
        </div>
        <div class="input-group mb-3 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
            </div>
            <select class="form-control custom-select" id="status" name="status">
                <option value="1" data-id="1" id="stt0">Chờ xác nhận</option>
                <option value="2" data-id="2" id="stt1">Đã giao hàng</option>
                <option value="3" data-id="3" id="stt2">Đã nhận hàng</option>
                <option value="0" data-id="0" id="stt3">Hủy đơn hàng</option>
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