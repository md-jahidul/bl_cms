(function () {

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
        title: 'Deleted!',
        text: 'Your file has been deleted.',
        type: 'success'
    }

    function redirect(redirectUrl)
    {
        window.location.href = redirectUrl;
    }

    $('.delete_btn').click(function (e) {
        e.preventDefault()
        var url = $(this).attr('remove');
        Swal.fire(confirmPopupParams).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    methods: "get",
                    success: function (redirectUrl) {
                        console.log(redirectUrl);
                        Swal.fire(deletePopupParams);
                        setTimeout(redirect, 2000, redirectUrl)
                    },
                    error: function () {
                        window.location.replace(url);
                    }
                })
            }
        })
    });


    function saveNewPositions()
    {
        var positions = [];
        $('.update').each(function () {
            positions.push([
                $(this).attr('data-index'),
                $(this).attr('data-position')
            ]);
        })
        $.ajax({
            type: "POST",
            url: auto_save_url,
            data: {
                update: 1,
                position: positions
            },
            success: function (data) {
                console.log(data)
            },
            error: function () {
                window.location.replace(auto_save_url);
            }
        });
    }

    $("#sortable").sortable({
        update: function (event, ui) {
            console.log(auto_save_url)
            $(this).children().each(function (index) {
                if ($(this).attr('data-position') != (index + 1)) {
                }
                $(this).attr('data-position', (index + 1)).addClass('update')
            });
            saveNewPositions();
        }
    });
})();
