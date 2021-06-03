(function () {
    $('.create_deep_link',).click(function () {
        let storeSlug = $(this).attr('data-value');
        $.ajax({
            url: deep_link_create_url + storeSlug,
            methods: "get",
            success: function (result) {
                console.log(result.status_code);
                if (result.status_code === 200) {
                    Swal.fire(
                        'Generated!',
                        'Deep link generated successfully .<br><br> Link :  ' + result.short_link + '<br><br><button data-value="' + result.short_link + '" class="btn btn-secondary copy-deeplink">Copy</button>',
                        'success',
                    );
                } else {
                    Swal.fire(
                        'Oops!',
                        'Something went wrong please try again ',
                        'error',
                    );
                }
            }
        });
    })

    $(document).on('click', '.copy-deeplink', function () {
        let deeplink = $(this).attr('data-value')
        const el = document.createElement('textarea');
        el.value = deeplink;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        $(this).text('Coped!!')
        $(this).removeClass('btn-secondary')
        $(this).addClass('btn-success')
    })
})();
