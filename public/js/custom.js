$(function () {

    function itemDelete(){

        // alert("Hiii")

        $('.delete_btn').click(function () {
            var id = $(this).attr('data-id');

            console.log(id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('.delete_btn').html(),
                showCancelButton: true,
                confirmButtonColor: '#f51c31',
                cancelButtonColor: '#1fdd4b',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "footer-menu/$parent_id/destroy/"+id,
                        methods: "get",
                        success: function (res) {
                            console.log(res);

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            );
                            setTimeout(redirect, 2000)
                            function redirect() {
                                window.location.href = "$parent_id == 0 ? 'footer-menu' : /footer-menu/$parent_id/child-footer"
                            }
                        }
                    })
                }
            })
        })
    }




})
