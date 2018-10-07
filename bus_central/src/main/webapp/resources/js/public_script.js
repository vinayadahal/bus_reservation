var detached;

var all_seats = new Array();
var selected_seats = new Array();
var old_select_seats = new Array();

$(document).ready(function () {
    var container_height = $("#container").height();
    setFooter(container_height);
    set_reserved_seats();
    set_selected_seats();
    preserve_history();
    change_destination(); // running this to maintain uniqueness in index page.
    $("#side_drp_down").click(function () {
        showDropDown("side_drp_list", "side_drp_wrap");
    });

    $("#side_drp_down").blur(function () {
        hideDropDown("side_drp_list", "side_drp_wrap");
    });

    $("#search_bus").click(function () {
        if (validate(['start_point', 'destination', 'date'])) {
            var input_date = new Date($("#date").val());
            var today = new Date();
            if (input_date.getTime() >= today.getTime()) {
                showBuses($(this).attr("url"));
            } else {
                alert("Date cannot be today or older!");
            }
        }
    });

    $(".click_seat").click(function () {
        highlight_seat($(this));
    });
});

function showBuses(url) {
    console.log(url);
    $.ajax({
        url: url,
        type: "get",
        data: {
            start_point: $("#start_point").val(),
            end_point: $("#end_point").val(),
            date: $("#date").val()
        },
        success: function (response) {
            $("#bus_info").html(response);
            $("#bus_info").css({
                display: 'block'
            });
        },
        error: function (xhr) {
            console.log("Error:");
            console.log(xhr);
        }
    });
}


function set_reserved_seats() {
    if ($("#reserved_seat").length !== 0) {
        var seats = $("#reserved_seat").html().split(',');
        $.each(seats, function (index, value) {
            $('.click_seat').each(function () { // all element with class click_seat within DOM
                if ($(this).html() === value) {
                    $(this).css({"background-color": "#ac0022", "color": "#fff"});
                    $(this).removeClass("click_seat");
                    all_seats.push(value);
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
                    $(this).css({"background-color": "#93a85c", "color": "#fff"});
                    all_seats.push(value);
                }
            });
        });
    }
}

function setFooter(container_height) {
    if (container_height < 550) {
        $(".footerWrap").css({position: "fixed", bottom: "0"});
    } else {
        $(".footerWrap").css({position: "relative"});
    }
}

function preserve_history() {
    $('.click_seat').each(function () { // all element with class click_seat within DOM
        if (typeof $(this).attr("style") !== "undefined") {
            old_select_seats.push($(this).html());
        }
    });
    set_pricing(old_select_seats);
}

function highlight_seat(id) {
    id.css({"background-color": "#dde9b9"});
//    console.log((jQuery.inArray(id.html(), selected_seats)));
    if ((jQuery.inArray(id.html(), all_seats)) === -1) {
        seat_add(id);
        set_pricing(old_select_seats);
    } else {
        seat_remove("all_seats", id);
        var res_seats = $("#reserved_seat").html().split(',');
        if (res_seats.length === all_seats.length) {
            default_vaule();
        } else {
            seat_remove("old_select_seats", id);
            $("#seat_name").html(old_select_seats);
        }
        id.removeAttr('style');
    }
//    console.log(all_seats);
//    console.log(selected_seats);
}

function seat_add(id) {
    all_seats.push(id.html());
    selected_seats.push(id.html());
    old_select_seats.push(id.html());
}

function seat_remove(array_name, id) {
    console.log("removin seat:" + array_name);
    if (array_name === "old_select_seats") {
        old_select_seats = jQuery.grep(old_select_seats, function (value) { // removing any element and updating the array all seats
            return value !== id.html();
        });
    } else {
        all_seats = jQuery.grep(all_seats, function (value) { // removing any element and updating the array all seats
            return value !== id.html();
        });
    }
}

function default_vaule() {
    $("#seat_name").html("N/A");
    $("#selected_seat_count").html("N/A");
    $("#total_price").html("Rs. " + 0 + " /-");
}

function set_pricing(select_seat) {
    $("#seat_name").html(select_seat);
    $("#selected_seat_count").html(select_seat.length);
    var total_price = select_seat.length * $("#price").html();
    $("#total_price").html("Rs. " + total_price + " /-");
}

function seat_session() {
    var base_url = $("#seat_table").attr("url");
    $.ajax({
        type: "GET",
        data: {all: all_seats, selected: selected_seats},
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
        detached.appendTo("#end_point");
    }
    var selection = $("#start_point").find(":selected").val();
    detached = $("#end_point option[value='" + selection + "']").detach();
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