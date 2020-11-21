
$(document).on('change', '.checkbox', function()  {
    $id="#"+"l_"+this.id;
    if(this.checked){
        $($id).addClass("checked");
    }
});

$("#alert_button").click(function () {
    console.log("yes");
    $("#employee_alert").slideToggle();
});

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_alert");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function find_employee() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_employee");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL_employee");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function Display() {
    var x = document.getElementById("employee_alert");
    if (x.style.display === "none") {
        x.style.display = "block";
        var element = document.getElementById("department_list");
        element.classList.add("clicked");
    } else {
        x.style.display = "none";
        var element = document.getElementById("department_list");
        element.classList.remove("clicked");
    }
  }

$('#emlist').click(function () {
    $("#employee_list").show();
    $("#department_list").hide();
});

$('#back').click(function () {
    $("#employee_list").hide();
    $("#department_list").show();
});

$('.dropdown').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown-menu').slideToggle(300);
});
$('.dropdown').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.dropdown-menu').slideUp(300);
});



$('.dropdown .dropdown-menu li').click(function () {
    $(this).parents('.dropdown').find('span').text($(this).text());
    $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
});
/*End Dropdown Menu*/

$('.dropdown-menu li').click(function () {
var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>',
  msg = '<span class="msg">Hidden input value: ';
$('.msg').html(msg + input + '</span>');
}); 