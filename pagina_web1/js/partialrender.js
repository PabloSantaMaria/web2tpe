function navCotizaciones(event) {
    event.preventDefault();
    document.querySelector("#useAjax").innerHTML = "<h1>Loading...</h1>";
    fetch("html/tablacotiz.html").then(function(response){
        if (response.ok) {  
            response.text().then(processCotizaciones);
        }
        else
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Failed URL!</h1>";
    })
    .catch(function(response){
        console.log(response);
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Conection Failed!</h1>";
    });
}
function processCotizaciones(t) {
    getTabla();
    let container = document.querySelector("#useAjax");
    container.innerHTML = t;
    document.getElementById("guardarRegistro").addEventListener('click', guardarRegistro);
    document.getElementById("getTabla").addEventListener('click', getTabla);
    document.getElementById("borrarTabla").addEventListener('click', borrarTabla);
    document.getElementById("poblarTabla").addEventListener('click', poblarTabla);
    document.getElementById("guardarNuevo").addEventListener("click", guardarNuevo);

    $(document).ready(function(){
        $("#filtrarTicker").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#tabla tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
}
function navHome() {
    document.querySelector("#useAjax").innerHTML = "<h1>Loading...</h1>";
    fetch("html/home.html").then(function(response){
        if (response.ok) {  
            response.text().then(function(t) {
                let container = document.querySelector("#useAjax");
                container.innerHTML = t;
            });
        }
        else
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Failed URL!</h1>";
    })
    .catch(function(response){
        console.log(response);
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Conection Failed!</h1>";
    });
}
function navOperar(event) {
    event.preventDefault();
    document.querySelector("#useAjax").innerHTML = "<h1>Loading...</h1>";
    fetch("html/operar.html").then(function(response){
        if (response.ok) {  
            response.text().then(function(t) {
                let container = document.querySelector("#useAjax");
                container.innerHTML = t;
            });
        }
        else
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Failed URL!</h1>";
    })
    .catch(function(response){
        console.log(response);
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Conection Failed!</h1>";
    });
}
function navAcerca(event) {
    event.preventDefault();
    document.querySelector("#useAjax").innerHTML = "<h1>Loading...</h1>";
    fetch("html/acerca.html").then(function(response){
        if (response.ok) {  
            response.text().then(function(t) {
                let container = document.querySelector("#useAjax");
                container.innerHTML = t;
            });
        }
        else
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Failed URL!</h1>";
    })
    .catch(function(response){
        console.log(response);
        document.querySelector("#useAjax").innerHTML = "<h1>Error - Conection Failed!</h1>";
    });
}

let home = document.getElementById("home");
home.addEventListener('click', navHome);
let tablacotiz = document.getElementById("tablacotiz");
tablacotiz.addEventListener("click", navCotizaciones);
let operar = document.getElementById("operar");
operar.addEventListener('click', navOperar);
let acerca = document.getElementById("acerca");
acerca.addEventListener("click", navAcerca);
navHome();