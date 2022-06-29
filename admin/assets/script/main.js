
// hide/show tab user account
$(document).ready(function () {
    $(".nav__right").click(function () {
        // $(".dropdown__menu").toggle();
        $(".dropdown__menu").fadeToggle(300);
    });
});


// hide/show tab sidebar
$(document).ready(function () {
    $(".icon__bars").click(function () {
        // Phương thức toggle() ẩn hiện 1 phần tử
        // $(".sidebar").toggle();

        // Phương thức fadeToggle() làm mờ phần tử khi ẩn/hiện.Giá trị trong hàm(hiệu ứng nhanh chậm)
        $(".sidebar").fadeToggle(300);
    });
});


var dropdown = document.getElementsByClassName("dropdown__btn");
var i;
for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}



var check1 = document.getElementById("btn1");
var check2 = document.getElementById("btn2");
check1.addEventListener("click", function () {
    var checkboxes = document.getElementsByName('ids[]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = true;
    }
});

check2.addEventListener("click", function () {
    var checkboxes = document.getElementsByName('ids[]');
    for (var i = 0; i < checkboxes.length; i++) {
        console.log(checkboxes[i]);
        checkboxes[i].checked = false;
    }
});

