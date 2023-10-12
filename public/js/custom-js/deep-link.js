(function () {
    $('.create_deep_link',).click(function () {
        let storeSlug = $(this).attr('data-value');
        let id = $(this).attr('data-id');
        $.ajax({
            url: deep_link_create_url + storeSlug + "&id=" + id,
            methods: "get",
            success: function (result) {
                if (result.status_code === 200) {
                    let deepLinkSection = $('.deep-link-section-' + id);
                    $(deepLinkSection).children("button").remove()

                    let copyButton = '<button class="btn-sm btn-default copy-deeplink cursor-pointer" type="button"\n' +
                        'data-value="' + result.short_link + '" data-toggle="tooltip" data-placement="button"\n' +
                        'title="Copy to Clipboard">Copy</button>';
                    deepLinkSection.append(copyButton)

                    Swal.fire(
                        'Generated!',
                        'Deep link generated successfully .<br><br> Link :  ' + result.short_link + '<br><br><button data-value="' + result.short_link + '" class="btn btn-secondary copy-deeplink">Copy</button>',
                        'success',
                    ).then(function () {
                        location.reload();
                    });
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
        $(this).text('Copied!!')
        $(this).removeClass('btn-secondary')
        $(this).addClass('btn-success')
    })
})();
