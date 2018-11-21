'use strict'

let templateComentarios;

fetch('js/templates/comentarios.handlebars')
.then(response => response.text())
.then(template => {
    templateComentarios = Handlebars.compile(template);
})

function getComentarios(id_accion) {
    fetch('api/comentarios/' + id_accion)
    .then(response => response.json())
    .then(jsonComentarios => {
        console.log(jsonComentarios);
        mostrarComentarios(jsonComentarios);
    })
}

function mostrarComentarios(jsonComentarios) {
    let context = {
        comentarios: jsonComentarios
    }
    let html = templateComentarios(context);
    document.getElementById('comentariosContainer').innerHTML = html;
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
        getComentarios(jsonComentarioBorrado.id_accion);
        let info = document.getElementById('infoModal');
        info.innerHTML = 'Ha sido borrado el comentario del usuario ' + jsonComentarioBorrado.usuario + ' con el título: ' + jsonComentarioBorrado.titulo + ' del día ' + jsonComentarioBorrado.date;
    })
}

$(document).ready(function () {
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('borrarComentario')) {
            let id_comentario = event.target.value;
            deleteComentario(id_comentario);
        }
    }, false);
    $("form[name='getComentarios']").submit(function (event) {
        event.preventDefault();
        let id_accion = $('#accionesId').val();
        getComentarios(id_accion);
    });
});