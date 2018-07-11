var detached;

$(document).ready(function () {
    $("#side_drp_down").click(function () {
        showDropDown("side_drp_list", "side_drp_wrap");
    });

    $("#side_drp_down").blur(function () {
        hideDropDown("side_drp_list", "side_drp_wrap");
    });
});


jQuery(document).ready(function ($) {
    $(".clickable-row").click(function () {
        window.location = $(this).data("href");
    });
});

function showDropDown(list_id, list_wrap) {
    $("#" + list_id).css({"display": "block"});
    $("#" + list_wrap).css({"background-color": "#b4d2e0", "color": "#333"});

}

function hideDropDown(list_id, list_wrap) {
    $("#" + list_id).css({"display": "none"});
    $("#" + list_wrap).css({"background-color": "", "color": ""});
}

function change_destination() {
    if (detached) {
        detached.appendTo("#destination");
    }
    var selection = $("#start_point").find(":selected").val();
    detached = $("#destination option[value='" + selection + "']").detach();
}