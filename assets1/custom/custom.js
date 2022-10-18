// $('#row1').click(function () {
//     if ($('#showDiv1').hasClass("hide")) {
//         $('#showDiv1').removeClass("hide");
//         $("#showDiv1").addClass("show");
//     } else {
//         $('#showDiv1').addClass("hide");
//         $("#showDiv1").removeClass("show");
//     }
// });

showDiv1 = true;
$("#showDiv1").hide();
$("#showDiv2").hide();
$("#showDiv3").hide();
$("#showDiv4").hide();
$('#row1').click(function() {
    $("#showDiv2").hide(100);
    $("#showDiv3").hide(100);
    $("#showDiv4").hide(100);
    showDiv2 = false;
    showDiv3 = false;
    showDiv4 = false;
    if (showDiv1) {
        $("#showDiv1").hide(100);
        showDiv1 = false;
    } else {
        $("#showDiv1").show(100);
        showDiv1 = true;
    }
});

showDiv2 = true;
$('#row2').click(function() {
    $("#showDiv1").hide(100);
    $("#showDiv3").hide(100);
    $("#showDiv4").hide(100);
    showDiv1 = false;
    showDiv3 = false;
    showDiv4 = false;
    if (showDiv2) {
        $("#showDiv2").hide(100);
        showDiv2 = false;
    } else {
        $("#showDiv2").show(100);
        showDiv2 = true;
    }
});

showDiv3 = true;
$('#row3').click(function() {
    $("#showDiv1").hide(100);
    $("#showDiv2").hide(100);
    $("#showDiv4").hide(100);
    showDiv1 = false;
    showDiv2 = false;
    showDiv4 = false;
    if (showDiv3) {
        $("#showDiv3").hide(100);
        showDiv3 = false;
    } else {
        $("#showDiv3").show(100);
        showDiv3 = true;
    }
});


showDiv4 = true;
$('#row4').click(function() {
    $("#showDiv1").hide(100);
    $("#showDiv2").hide(100);
    $("#showDiv3").hide(100);
    showDiv1 = false;
    showDiv2 = false;
    showDiv3 = false;
    if (showDiv4) {
        $("#showDiv4").hide(100);
        showDiv4 = false;
    } else {
        $("#showDiv4").show(100);
        showDiv4 = true;
    }
});