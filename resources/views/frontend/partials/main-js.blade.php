  <!-- Js Plugins -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
  <script src="{{asset('front_ends/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('front_ends/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('front_ends/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('front_ends/js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('front_ends/js/jquery.nice-select.min.js')}}"></script>
  <script src="{{asset('front_ends/js/jquery.zoom.min.js')}}"></script>
  <script src="{{asset('front_ends/js/jquery.dd.min.js')}}"></script>
  <script src="{{asset('front_ends/js/jquery.slicknav.js')}}"></script>
  <script src="{{asset('front_ends/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('front_ends/js/main.js')}}"></script>

  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}

  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#quickForm').validate({
        rules: {
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 8,
            maxlength: 15,
          },
          old_password: {
            required: true,
            minlength: 8,
            maxlength: 15,
          },
          new_password: {
            required: true,
            minlength: 8,
            maxlength: 15,
          },
          password_confirmation: {
            required: true,
            minlength: 8,
            maxlength: 15,
            equalTo: '#new_password'
          },
          phone: {
            required: true,
          },
          city: {
            required: true,
          },
          district: {
            required: true,
          },
          ward: {
            required: true,
          },
          address: {
            required: true,
          },
        },
        messages: {
          name: {
            required: "Vui lòng nhập tên",
          },
          email: {
            required: "Vui lòng nhập email",
            email: "Vui lòng nhập đúng định dạng",
          },
          password: {
            required: "Vui lòng nhập mật khẩu",
            minlength: "Mật khẩu chứa ít nhất 8 kí tự",
            maxlength: "Mật khẩu chứa tối đa 15 kí tự",
          },
          old_password: {
            required: "Vui lòng nhập mật khẩu",
            minlength: "Mật khẩu chứa ít nhất 8 kí tự",
            maxlength: "Mật khẩu chứa tối đa 15 kí tự",
          },
          new_password: {
            required: "Vui lòng nhập mật khẩu mới",
            minlength: "Mật khẩu chứa ít nhất 8 kí tự",
            maxlength: "Mật khẩu chứa tối đa 15 kí tự",
          },
          password_confirmation: {
            required: "Vui lòng nhập mật khẩu",
            minlength: "Mật khẩu chứa ít nhất 8 kí tự",
            maxlength: "Mật khẩu chứa tối đa 15 kí tự",
            equalTo: "Mật khẩu xác thực không trùng khớp",
          },
          phone: {
            required: "Vui lòng nhập SĐT",
          },
          city: {
            required: "Vui lòng nhập Tỉnh / Thành",
          },
          district: {
            required: "Vui lòng nhập Quận / Huyện",
          },
          ward: {
            required: "Vui lòng nhập Xã / Phường",
          },
          address: {
            required: "Vui lòng nhập địa chỉ",
          },

        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>

  <script>
    //search prodcut
    $('#search').on('keyup', function() {
      url = '<?php echo url('searchAuto') ?>';
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        dataType: 'json',
        type: 'POST',
      }).done(function(result) {
        var productName = '';
        $.map(result, function(n) {
          for (var prop in n) {
            productName += n[prop] + ',';
          }
          productName = productName.substring(0, productName.length - 1) + ',';
          productArray = productName.split(',');
        });
        $("#search").autocomplete({
          source: productArray
        });
      });
    })
    // search blog
    $('#search-blog').on('keyup', function() {
      url = '<?php echo url('blogs/searchAuto') ?>';
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        dataType: 'json',
        type: 'POST',
      }).done(function(result) {
        var blogName = '';
        $.map(result, function(n) {
          for (var prop in n) {
            blogName += n[prop] + ',';
          }
          blogName = blogName.substring(0, blogName.length - 1) + ',';
          blogArray = blogName.split(',');
        });
        $("#search").autocomplete({
          source: blogArray
        });
      });
    })
  </script>

  <script type="text/javascript">
    //show hide login register
    $(document).ready(function() {
      $('.register').click(function() {
        $('.show-register').show();
        $('.show-login').hide();
      });
      $('.login').click(function() {
        $('.show-register').hide();
        $('.show-login').show();
      });
    });

    //cart
    $(document).ready(function() {
      // add to cart
      $('#add-to-cart').on('click', function(e) {
        if (!$("input:radio[name='color_id']").is(":checked")) {
          toastr.error('Vui lòng chọn màu sắc');
          breakOut = true;
          return false;
        }
        if (!$("input:radio[name='size_id']").is(":checked")) {
          toastr.error('Vui lòng chọn size');
          breakOut = true;
          return false;
        }
        if ($('#quantity').val() == 0) {
          toastr.error('Vui lòng chọn số lượng');
          breakOut = true;
          return false;
        }
        if (parseInt($('#quantity').val()) > parseInt($('.quantity-stock').attr('data-quantity'))) {
          toastr.error('Vui lòng chọn số lượng nhỏ hơn');
          breakOut = true;
          return false;
        }
        e.preventDefault();
        var add_cart_url = '<?php echo url('cart') ?>';
        var dataPost = $(this).closest('form').serializeArray();
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: add_cart_url,
          dataType: 'json',
          type: 'POST',
          data: dataPost,
          success: function(result) {
            $('#myModal-cart').modal('show');
            $('.countCart').html(result.quantityCart);
            $('.emptyCart').remove();
            $('.select-total').html('<span>Tổng tiền:</span>' +
              '<h5>' + result.total + '</h5>');
            $('.cart-price').html(result.total);

            let i;
            let html = '';
            if ($('.rowCart' + result.id).length > 0) {
              let oldQuantity = parseInt($('.quantityCart' + result.id).attr('data-quantity-' + result.id + ''));
              let newQuantity = parseInt(result.quantity);
              let quantity = newQuantity + oldQuantity;
              $('.quantityCart' + result.id).html(quantity);
              $('.quantityCart' + result.id).attr('data-quantity-' + result.id + '', quantity);
            } else {
              for (i = 0; i < 1000; i++) {
                html += '<tr class="rowCart' + result.id + '">' +
                  '<td class="si-pic">' +
                  '<img src="' + result.image + '" alt="" style="width: 100px; ">' +
                  '</td>' +
                  '<td class="si-text">' +
                  '<div class="product-selected">' +
                  '<p>' + result.price + 'x <span class="quantityCart' + result.id + '" data-quantity-' + result.id + '="' + result.quantity + '">' + result.quantity + '</span></p>' +
                  '<h6>' + result.name + '</h6>' +
                  '<p style="color: #252525;">Size: <span style=" color: #dba239;">' + result.size_name + '</span> - Màu: <span style=" color: #dba239;">' + result.color_name + '</span></p>' +
                  '</div>' +
                  '</td>' +
                  '<td class="si-close" >' +
                  '<i class="ti-close" data-rowId="' + result.id + '"></i>' +
                  '</td>' +
                  '</tr>';
                break;
              }
            }
            $('.cartBody').append(html);
          }
        });
      });

      //remove cart
      $('.ti-close').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var delete_cart_url = '<?php echo url('cart') ?>';
        var id = $(this).attr('data-rowId');
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: delete_cart_url,
          type: 'DELETE',
          dataType: 'json',
          data: {
            id: id
          },
          success: function(result) {
            $('.rowCart' + result.id).fadeOut('slow', function() {
              $('.rowCart' + result.id).remove();
            });
            $('.countCart').html(result.quantityCart);
            $('.select-total').html('<span>Tổng tiền:</span>' +
              '<h5>' + result.total + '</h5>');
            $('.cart-price, .subTotal').html(result.subTotal);
            $('#totalCart').html(result.total);
            if ($('.rowCart').length == 0) {
              $('.select-total').html('<span class="emptyCart">Chưa có sản phẩm</span>');
            }
          }
        })
      })

      //clear cart
      $('.closeAll').on('click', function(e) {
        var clear_cart_url = '<?php echo url('cart/clear') ?>';
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: clear_cart_url,
          type: 'DELETE',
          dataType: 'json',
        }).done(function(result) {
          if (result.msg === 'success') {
            toastr.success('Xoá giỏ hàng thành công');
            $('.contentCart').remove();
            $('.rowCart').remove();
            $('.cart-price').html('0 VNĐ');
            $('.countCart').html(0);
            $('.select-total').html('<span class="emptyCart">Chưa có sản phẩm</span>');
            html = '';
            html += '<div class="col-lg-12 empty-cart" style="text-align: center; margin-bottom: 80px;">' +
              '<img src="" alt="" style="width: 200px;">' +
              '<h6 style="color: #999999; font-size: 16px; margin: 1rem;">Giỏ hàng của bạn đang trống</h6>' +
              '<a href="" class="primary-btn pd-cart" style="border-radius: 0.25rem">Tiếp tục mua sắm</a>' +
              '</div>';
            $('#rowEmptyCart').html(html);
          } else {
            toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
          }
        });
      });

      //add coupon
      $('.coupon-btn').on('click', function(e) {
        e.preventDefault();
        var add_coupon_url = '<?php echo url('cart/coupon') ?>';
        var couponName = $('#code').val();
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: add_coupon_url,
          type: 'post',
          dataType: 'json',
          data: {
            code: couponName
          },
        }).done(function(result) {
          if (result.msg === 'success') {
            toastr.success('Thêm mã giảm giá thành công');
            $('#code').html(result.name);
            $('#couponName').html(result.couponName);
            $('#totalCart').html(result.totalPrice);
            $('#couponValue').html(result.couponValue);
          } else if (result.msg === 'error') {
            toastr.error('Mã giảm giá không đúng');
          } else {
            toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
          }
        });
      });

      //remove coupon
      $('.close-coupon').on('click', function(e) {
        var remove_coupon_url = '<?php echo url('cart/coupon') ?>';
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: remove_coupon_url,
          dataType: 'json',
          type: 'DELETE',
        }).done(function(result) {
          if (result.msg === 'success') {
            toastr.success('Xóa mã giảm giá thành công');
            $('#couponName').empty();
            $('#totalCart').html(result.total);
            $('#couponValue').html('- 0 VNĐ');
          } else {
            toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
          }
        });
      });
    })

    //add wishlist
    $(document).on('click', '#add-wish-list', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: url,
      }).done(function(result) {
        console.log(result);
        if (result['msg'] === 'success') {
          toastr.success('Thêm sản phẩm yêu thích thành công');
          $('.fa-heart-o').removeClass('fa-heart-o').addClass('fa-heart');
          let html = '';
          html += '<tr class="row-wishlist-' + result.id + '">' +
            '<td class="si-pic">' +
            '<a href="' + result.linkProduct + '"><img src="' + result.image + '" alt="" style="width: 100px; "></a>' +
            '</td>' +
            '<td class="si-text">' +
            '<div class="product-selected">';
          if (result.sale > 0) {
            html += '<p>' + result.priceSale + '</p>';
          } else {
            html += '<p>' + result.priceCore + '</p>';
          }
          html += '<h6>' + result.name + '</h6>' +
            '</div>' +
            '</td>' +
            '<td class="si-close">' +
            '<a href="' + result.linkWishlist + '" class="remove-wish-list">x</a>' +
            '</td>' +
            '</tr>';
            $('.select-heart').remove();
            $('.heartBody').append(html);
        } else if (result['msg'] === 'wishlist exist') {
          toastr.error('Sản phẩm đã được thêm từ trước');
        } else if (result['msg'] === 'product not exist') {
          toastr.error('Vui lòng thử lại', 'Không có sản phẩm')
        } else if (result['msg'] === 'user not exist') {
          toastr.warning('Vui lòng đăng nhập')
        } else {
          toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
        }
      })
    })
    //remove wishlist
    $(document).ready(function() {
      $('.remove-wish-list').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete',
          url: url,
        }).done(function(result) {
          if (result['msg'] === 'success') {
            toastr.success('Xóa thành công');
            $('.fa-heart').removeClass('fa-heart').addClass('fa-heart-o');
            $('.row-wishlist-' + result.id).fadeOut('slow', function() {
              $('.row-wishlist-' + result.id).remove();
            });
            $('.countWhislist').html(result.countWishlist);
          } else {
            toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
          }
        })
      })
    })
  </script>