$(document).ready(function () {
    var container_height = $("#container").height();
//    console.log(container_height);
    setFooter(container_height);
});


function setFooter(container_height) {
    if (container_height < 500) {
        console.log(container_height);
        $(".footerWrap").css({position: "fixed"});
    } else {
        $(".footerWrap").css({position: "relative"});
    }
}