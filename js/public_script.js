var detached;

var selected_seats = new Array();

$(document).ready(function () {
    var container_height = $("#container").height();
    console.log(container_height);
//    setFooter(container_height);
    set_reserved_seats();
    set_selected_seats();
    $("#side_drp_down").click(function () {
        showDropDown("side_drp_list", "side_drp_wrap");
    });

    $("#side_drp_down").blur(function () {
        hideDropDown("side_drp_list", "side_drp_wrap");
    });
});

function set_reserved_seats() {
    if ($("#reserved_seat").length !== 0) {
        var seats = $("#reserved_seat").html().split(',');
        $.each(seats, function (index, value) {
            $('.click_seat').each(function () { // all element with class click_seat within DOM
                if ($(this).html() === value) {
                    $(this).css({"background-color": "#ff0000", "color": "#fff"});
                    $(this).removeClass("click_seat");
                    selected_seats.push(value);
                }
            });
        });
    }
}

function set_selected_seats() {
    if ($("#selected_seat").length !== 0) {
        var seats = $("#selected_seat").html().split(',');
        $.each(seats, function (index, value) {
            $('.click_seat').each(function () { // all element with class click_seat within DOM
                if ($(this).html() === value) {
                    $(this).css({"background-color": "#00ff00", "color": "#fff"});
                    selected_seats.push(value);
                }
            });
        });
    }
}

function setFooter(container_height) {
    if (container_height < 500) {
        $(".footerWrap").css({position: "fixed", bottom: "0"});
    } else {
        $(".footerWrap").css({position: "relative"});
    }
}

jQuery(document).ready(function ($) {
    $(".clickable-row").click(function () {
        var redirect_url = $(this).attr("url");
        window.location = redirect_url;
    });
    $(".click_seat").click(function () {
        highlight_seat($(this));
    });
});

function highlight_seat(id) {
    id.css({"background-color": "#b4d2e0"});
    console.log((jQuery.inArray(id.html(), selected_seats)));
    if ((jQuery.inArray(id.html(), selected_seats)) === -1) {
        selected_seats.push(id.html());
    } else {
        console.log("already exists value. Removing...");
        selected_seats=jQuery.grep(selected_seats, function (value) { // removing any element and updating the array selected seats
            return value !== id.html();
        });
        id.removeAttr('style');
    }
    console.log(selected_seats);
}

function seat_session() {
    var base_url = $("#seat_table").attr("url");
    $.ajax({
        type: "GET",
        data: {selected_seats},
        url: base_url + "set_seat",
        success: function (msg) {
            console.log(msg);
            window.location = base_url + "confirm_seat";
        }
    });
}

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

function countChars() {
    var val = $('#title').val().length;
    if (val > 40) {
        alert('Only 40 characters are allowed in title.');
        $('#title').css({
            'color': '#f00'
        });
        return false;
    } else if ($('#title').val() === '') {
        return false;
    } else {
        $('#title').css({
            'color': '#555'
        });
        return true;
    }

}

function validate(idArray) {
    var count = idArray.length;
    for (var i = 0; i <= count; i++) {
        if (idArray[i] === 'title') {
            countChars();
        }
        if (checkNull(idArray[i])) {
            continue;
        } else {
            alert('Please fill every fields.');
            return false;
        }
    }
    return true;
}

function checkNull(idName) {
    var id = $("#" + idName).val();
    if (id === '') {
        return false;
    } else {
        return true;
    }
}