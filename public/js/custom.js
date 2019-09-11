(function(){
        var confirmPopupParams = {
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            html: jQuery('.delete_btn').html(),
            showCancelButton: true,
            confirmButtonColor: '#f51c31',
            cancelButtonColor: '#1fdd4b',
            confirmButtonText: 'Yes, delete it!'
        };

        var deletePopupParams = {
            title:  'Deleted!',
            text: 'Your file has been deleted.',
            type: 'success'
        }

        function redirect(redirectUrl) {
            window.location.href = redirectUrl;
        }

        $('.delete_btn').click(function () {
            var url = $(this).attr('remove');

            Swal.fire(confirmPopupParams).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: url,
                        methods: "get",
                        success: function (redirectUrl) {
                            Swal.fire(deletePopupParams);
                            setTimeout(redirect, 2000, redirectUrl)
                        }
                    })
                }
            })
        });
})();
