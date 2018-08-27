var detached;

$(document).ready(function () {
    var container_height = $("#container").height();
    console.log(container_height);
    setFooter(container_height);
    $("#side_drp_down").click(function () {
        showDropDown("side_drp_list", "side_drp_wrap");
    });

    $("#side_drp_down").blur(function () {
        hideDropDown("side_drp_list", "side_drp_wrap");
    });
});

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
//        var redirect_url = $(this).attr("url");
//        console.log ($(this).html());
        highlight_seat($(this));
    });
});

function highlight_seat(id) {
    id.css({"background-color": "#b4d2e0"});
    $.cookie(id, id, { expires : 10 });
//    $.ajax({
//        url: url,
//        type: "get",
//        cache: false,
//        complete: function () {
//            console.log("completed the request");
////            $('#loading').hide();
//        },
//        success: function (response) {
//            console.log(response);
////            $("#formPanel").fadeIn(600);
////            $("#heading").html(heading);
////            $("#data").html(response);
////            if (heading === 'Publish Image') {
////                $('#formSize').attr('class', 'pagesPopupFrom');
////            }
//        },
//        failure: function (response) {
//            console.log(response);
//        }
//    });
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