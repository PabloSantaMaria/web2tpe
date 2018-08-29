let url = "http://web-unicen.herokuapp.com/api/groups/";
let grupo = "62";
let coleccion = "cotizaciones";


// LLENA TABLA CON 6 FILAS HARDCODEADAS
function poblarTabla() {
    let data = [
        {"thing": {"ticker": "AGRO", "precio": "15,25", "vari": "3.39", "vol": "8.148.520", "max": "15,6", "min": "13.85", "cierre": "14,75"}},
        {"thing": {"ticker": "ALUA", "precio": "16,3", "vari": "0.31", "vol": "16.777.302", "max": "16,5", "min": "15,2", "cierre": "16,25"}},
        {"thing": {"ticker": "AUSO", "precio": "97", "vari": "-6,46", "vol": "4.342.463", "max": "105", "min": "94", "cierre": "103,7"}},
        {"thing": {"ticker": "FRAN", "precio": "137,5", "vari": "-0,95", "vol": "19.736.247", "max": "139,9", "min": "133", "cierre": "136,2"}},
        {"thing": {"ticker": "SUPV", "precio": "100,5", "vari": "-5,55", "vol": "11.040.835", "max": "109,5", "min": "98,5", "cierre": "106,4"}},
        {"thing": {"ticker": "YPFD", "precio": "503", "vari": "5,13", "vol": "30.201.317", "max": "505", "min": "479,5", "cierre": "478,45"}}
    ];
    for (let fila in data) {
        fetch(url + grupo + "/" + coleccion, {
            "method": "POST",
            "headers": { "Content-Type": "application/json" },
            "body": JSON.stringify(data[fila])
        }).then(function(r){
            if(!r.ok){
                console.log("error");
            }
            return r.json();
        }).then(function(json) {
            console.log(json);
            getTabla();
        })
        .catch(function(e){
            console.log(e);
        }); 
    }
}
// GUARDA LOS DATOS DE LA FORM
function guardarRegistro() {
    let ticker = document.getElementById("ticker").value;
    let precio = document.getElementById("precio").value;
    let vari = document.getElementById("vari").value;
    let vol = document.getElementById("vol").value;
    let max = document.getElementById("max").value;
    let min = document.getElementById("min").value;
    let cierre = document.getElementById("cierre").value;
    
    let data = {
        "thing": {
            "ticker": ticker,
            "precio": precio,
            "vari": vari,
            "vol": vol,
            "max": max,
            "min": min,
            "cierre": cierre
        }
    };
    fetch(url + grupo + "/" + coleccion, {
        "method": "POST",
        "headers": { "Content-Type": "application/json" },
        "body": JSON.stringify(data)
    }).then(function(r){
        if(!r.ok){
            console.log("error");
        }
        return r.json();
    }).then(function(json) {
        console.log(json);
        getTabla();
    })
    .catch(function(e){
        console.log(e);
    });
}
// TRAE TODOS LOS DATOS
function getTabla() {
    fetch(url + grupo + "/" + coleccion, {
        method: "GET",
    }).then(function(r){
        if(!r.ok){
            console.log("error");
        }
        return r.json();
    })
    .then(function(json) {
        let tabla = document.getElementById("tabla");
        tabla.innerHTML = '';
        for (let data of json.cotizaciones) {
            let btns = '<div class="btn-group" role="group"><button type="button" id="'+data._id+'" class="btn btn-outline-danger btn-sm" onClick="borrarRegistro(this.id)">Borrar</button><button type="button" id="'+data._id+'" class="btn btn-outline-warning btn-sm" data-toggle="collapse" data-target="#collapseExample" onClick="editarRegistro(this.id)">Editar</button></div>';
            tabla.innerHTML += "<tr id='row"+data._id+"'>"+
                                "<td>"+data.thing.ticker+"</td>"+
                                "<td>"+data.thing.precio+"</td>"+
                                "<td id='td"+data._id+"'>"+data.thing.vari+"</td>"+
                                "<td>"+data.thing.vol+"</td>"+
                                "<td>"+data.thing.max+"</td>"+
                                "<td>"+data.thing.min+"</td>"+
                                "<td>"+data.thing.cierre+"</td>"+
                                "<td>"+ btns +"</td></tr>";
            let td = document.getElementById("td"+data._id);
            if (parseFloat(data.thing.vari) <= 0) {
                td.classList.toggle("text-danger");
            } 
            if (parseFloat(data.thing.vari) > 0) {
                td.classList.toggle("text-success");
            }
        }
    })
    .catch(function(e){
        console.log(e)
    });
}
// BORRA LA FILA SELECCIONADA
function borrarRegistro(id) {
    fetch(url + grupo + "/" + coleccion + "/" + id, {
        method: "DELETE",
    }).then(function(r){
        if(!r.ok){
            console.log("error");
        }
        return r.json();
    })
    .then(function(json) {
        getTabla();
    })
    .catch(function(e){
        console.log(e);
    });
}
// BORRA TODA LA TABLA
function borrarTabla() {
    fetch(url + grupo + "/" + coleccion, {
        method: "GET",
    }).then(function(r){
        if(!r.ok){
            console.log("error");
        }
        return r.json();
    })
    .then(function(json) {
        for (let data of json.cotizaciones) {
            borrarRegistro(data._id);
        }
    })
    .catch(function(e){
        console.log(e);
    });
}
// TRAE EL ID DE LA FILA A EDITAR Y VACIA LA FORM
function editarRegistro(clicked_id) {
    document.getElementById("registroId").innerHTML = clicked_id;
    let row = document.getElementById("row"+clicked_id);
    row.classList.toggle("text-warning");
    row.classList.toggle("font-italic");
    
    document.getElementById("editTicker").value = "";
    document.getElementById("editPrecio").value = "";
    document.getElementById("editVari").value = "";
    document.getElementById("editMax").value = "";
    document.getElementById("editMin").value = "";
    document.getElementById("editCierre").value = "";
}
// HACE PUT EN EL REGISTRO CON ID ELEGIDO
function guardarNuevo() {
    let ticker = document.getElementById("editTicker").value;
    let precio = document.getElementById("editPrecio").value;
    let vari = document.getElementById("editVari").value;
    let vol = document.getElementById("editVol").value;
    let max = document.getElementById("editMax").value;
    let min = document.getElementById("editMin").value;
    let cierre = document.getElementById("editCierre").value;
    
    let data = {
        "thing": {
            "ticker": ticker,
            "precio": precio,
            "vari": vari,
            "vol": vol,
            "max": max,
            "min": min,
            "cierre": cierre
        }
    };
    let id = document.getElementById("registroId").innerText;
    fetch(url + grupo + "/" + coleccion + "/" + id, {
        "method": "PUT",
        "headers": { "Content-Type": "application/json" },
        "body": JSON.stringify(data)
    }).then(function(r){
        if(!r.ok){
            console.log("error");
        }
        return r.json();
    }).then(function(json) {
        console.log(json);
        getTabla();
    })
    .catch(function(e){
        console.log(e);
    });
}