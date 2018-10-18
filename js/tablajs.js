document.addEventListener("DOMContentLoaded", function (event) {
    let tdatas = document.getElementsByClassName("vari");
    console.log(tdatas);
    for (let i = 0; i < tdatas.length; i++) {
        if (parseFloat(tdatas[i].innerHTML) <= 0) {
            tdatas[i].classList.toggle("text-danger");
        }
        if (parseFloat(tdatas[i].innerHTML) > 0) {
            tdatas[i].classList.toggle("text-success");
        }
    }
});
$(document).ready(function () {
    $("#filtrar").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $("#tabla tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});