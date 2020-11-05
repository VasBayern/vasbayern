// toast sweetalert
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})
// delete item
function functionRemoveItem() {
    $(document).on('click', '.delete-item', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Bạn có muốn xóa?',
            text: "Bạn sẽ không thể hoàn tác hành động này",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Xóa'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = $(this).attr('href');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'DELETE',
                }).done(function (response) {
                    $('.tr-' + response.id).remove();
                    Toast.fire({
                        icon: 'success',
                        title: 'Xóa thành công'
                    })
                }).fail(function (response) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Không thể xóa'
                    })
                })
            }
        })
    })
}