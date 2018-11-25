'use strict'

let templateComentarios;

fetch('js/templates/comentarios.handlebars')
.then(response => response.text())
.then(template => {
    templateComentarios = Handlebars.compile(template);
})

function getComentarios(id_accion, ratingOrder) {
    // if no tiene comentarios
    console.log(id_accion);
    console.log(ratingOrder);
    fetch('api/comentarios/' + id_accion + '/' + ratingOrder)
    .then(response => response.json())
    .then(jsonComentarios => {
        console.log(jsonComentarios);
        mostrarComentarios(jsonComentarios);
    })
}

function mostrarComentarios(jsonComentarios) {
    let usuario = $('#user').text();
    console.log(usuario);
    let logueado = true;
    let admin = $('#isAdmin').val();
    if (usuario == 'Guest') {
        logueado = false;
    }
    let context = {
        comentarios: jsonComentarios,
        logueado: logueado,
        admin: admin
    }
    let html = templateComentarios(context);
    document.getElementById('comentariosContainer').innerHTML = html;
    // setTimeout(function () {
    //     $("#getComentarios").trigger("submit");
    // }, 2000);
}

function postComentario(id_accion) {
    let usuario = $('#user').text();
    let id_usuario = $('#id_usuario').text();
    console.log(usuario);
    console.log(id_usuario);
    if (usuario == 'Guest') {
        let info = document.getElementById('infoModal');
        info.innerHTML = 'Debe loguearse para postear comentarios';
    }
    else {
        let comentario = {
            'id_accion': id_accion,
            'id_usuario': id_usuario,
            // 'usuario': usuario,
            'titulo': $('#tituloComentario').val(),
            'cuerpo': $('#cuerpoComentario').val(),
            'puntaje': $('#puntajeAccion').val()
        };
        console.log(comentario);
        
        fetch('api/comentario/' + id_accion, {
            method: "POST",
            body: JSON.stringify(comentario)
        })
        .then(response => response.json())
        .then(function(jsonComentarioAgregado) {
            console.log(jsonComentarioAgregado);
            $("#getComentarios").trigger("submit");
            let info = document.getElementById('infoModal');
            info.innerHTML = 'Ha sido agregado el comentario con el título: ' + jsonComentarioAgregado.titulo;
        })
    }
}

function deleteComentario(id_comentario) {
    console.log(id_comentario);
    fetch('api/comentario/' + id_comentario, {
        method: "DELETE"
    })
    .then(response => response.json())
    .then(jsonComentarioBorrado => {
        console.log(jsonComentarioBorrado);
        console.log(jsonComentarioBorrado.id_accion);
        $("#getComentarios").trigger("submit");
        let info = document.getElementById('infoModal');
        info.innerHTML = 'Ha sido borrado el comentario con el título: ' + jsonComentarioBorrado.titulo + ' del día ' + jsonComentarioBorrado.date;
    })
}

$(document).ready(function () {
    $("form[name='getComentarios']").submit(function (event) {
        event.preventDefault();
        let id_accion = $('#accionesId').val();
        let ratingOrder = $('#ratingOrder').val();
        getComentarios(id_accion, ratingOrder);
    });
});
$(document).on("click", '#agregarButton', function (event) {
    let id_accion = event.target.value;
    console.log(id_accion);
    postComentario(id_accion);
});
$(document).on("click", '#borrarComentario', function (event) {
    let id_comentario = event.target.value;
    deleteComentario(id_comentario);
});