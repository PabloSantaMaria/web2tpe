document.addEventListener("DOMContentLoaded", function (event) {
    let td = document.getElementsByClassName("vari");
    console.log(td);
    for (let i = 0; i < td.length; i++) {
        if (parseFloat(td[i].innerHTML) <= 0) {
            td[i].classList.toggle("text-danger");
        }
        if (parseFloat(td[i].innerHTML) > 0) {
            td[i].classList.toggle("text-success");
        }
    }
});