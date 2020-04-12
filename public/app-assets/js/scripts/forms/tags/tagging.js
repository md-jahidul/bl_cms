
$(document).ready(function () {
    /*******************************
    *       Simple Options         *
    *******************************/

    // case sensitive
    var t;
    // Edit / Delete tag on delete
    t = $(".edit-on-delete").tagging({
        "edit-on-delete": false,
    });

    t[0].addClass("form-control");

});
