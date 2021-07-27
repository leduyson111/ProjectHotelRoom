
function actionDelete(e){
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);

    Swal.fire({
        title: 'Bạn có chắc mình muốn xóa không?',
        text: "Đồng ý để xóa hoặc chọn Cancel để không xóa !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa thành công !'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data){
                    if(data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                },
                error: function(){
                    console.log('lỗi rồi')
                }
            });
        }
    })
}

$(function(){
    $(document).on('click', '.action_delete', actionDelete);
})