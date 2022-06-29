// form user register
$(document).ready(function () {
    $("#btn-open").click(function () {
        $("#myForm").slideToggle();
    });

    $(".btn__close").click(function () {
        $("#myForm").slideUp();
    });
});

var close = document.getElementById('myForm');
window.onclick = function (event) {
    if (event.target == close) {
        close.style.display = "none";
    }
}


// comments
$(document).ready(function () {
    $(".user-switch-form").click(function () {
        var tab = $(this).data('tab');
        $(".user-tab-body").removeClass("active");
        $("#" + tab).addClass("active");
        // hien thi tat ca cac link
        $(".user-switch-form").removeClass('d-none');
        // an link da click vao
        $(this).addClass("d-none");
    });

    // end tab user login

    $(".tabs-link").click(function() {
        var tab = $(this).data('tab');
        $(".tab-content").removeClass("current");
        $("#" + tab + " .tab-content").addClass("current");
   });

    $(".close-time").click(function(){
        $(".message-account").hide();
    });
});

