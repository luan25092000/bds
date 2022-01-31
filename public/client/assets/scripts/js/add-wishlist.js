function addWishlist(id) {
    $.ajax({
        url: '/add-wishlist',
        type: 'GET',
        data: {
            'id': id
        },
        success: function(response) {
            if(response.status == 200) {
                swal({
                    text: "Thêm yêu thích thành công, tự động trở lại sau 3 giây",
                    type: "success",
                    timer: 3000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = window.location.href;
                });
            }
        }
    });
}