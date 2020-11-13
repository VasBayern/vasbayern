/**
 * add
 */
function ajaxCallAddFunction() {
    $(document).on('click', '.store-item', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data = $(this).closest('form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
        }).done(function (response) {
            window.location.replace(response.link);
            Toast.fire({
                icon: 'success',
                title: 'Thêm thành công'
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: 'Danh mục đã tồn tại'
            })
        })
    })
}

/**
 * update
 */
function ajaxCallEditFunction() {
    $(document).on('click', '.update-item', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data = $(this).closest('form').serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'PUT',
            dataType: 'JSON',
            data: data,
        }).done(function (response) {
            window.location.replace(response.link);
            Toast.fire({
                icon: 'success',
                title: 'Sửa thành công'
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: 'Danh mục, slug đã tồn tại'
            })
        })
    })
}

/**
 * delete
 */
functionRemoveItem();