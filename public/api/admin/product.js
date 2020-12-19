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
                title: success[0]
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: error
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
                title: success[1]
            })
        }).fail(function (response) {
            Toast.fire({
                icon: 'error',
                title: error
            })
        })
    })
}
