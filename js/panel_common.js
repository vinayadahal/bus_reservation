var detached;

$(document).ready(function () {
    var container_height = $("#container").height();
    setFooter(container_height);

    $("#img").change(function () {
        var filesize = this.files[0].size;
        if (filesize >= 2097152) {
            alert('File size should be less than 2 MB.');
            this.value = '';
        } else {
            showImg(this);
        }
    });
});

function change_destination() {
    if (detached) {
        detached.appendTo("#destination");
    }
    var selection = $("#start_point").find(":selected").val();
    detached = $("#destination option[value='" + selection + "']").detach();
}

function showPopup() {
    $("#popup").fadeIn('slow');
    setInterval(function () {
        $("#popup").fadeOut('slow');
    }, 5000);
}

function setFooter(container_height) {
//    console.log(container_height);
    if (container_height < 500) {
        $(".footerWrap").css({position: "fixed", bottom: "0"});
    } else {
        $(".footerWrap").css({position: "relative"});
    }
}

function showImg(img) {
    if (img.files && img.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgLocation').attr('src', e.target.result);
        },
                reader.readAsDataURL(img.files[0]);
    }
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