{include file="header.tpl"}


<div class="cuerpoComentarios">
  <div class="container">
    {* Titulo *}
    <div class="card w-75 mx-auto bg-dark text-white">
      <h5 class="card-header text-primary" id="user">{$user}</h5>
      <div hidden id="id_usuario" type="hidden" value="{$id_usuario}">{$id_usuario}</div>
      <h5 class="card-header bg-info">Bienvenido a la sección de comentarios</h5>
      <div class="card-body">
        <h6 class="card-title text-center">Elija una cotización para ver los comentarios</h6>

        {* SELECTOR DE COTIZACION *}
        <form class="form" name="getComentarios">
          <input id="isAdmin" type="hidden" value="{$isAdmin}">
          
          <div class="form-group mb-2">
            {* <label for="acciones">Acciones</label> *}
            <input type="text" readonly class="form-control-plaintext text-white text-center" value="">
          </div>

          <div class="form-group mx-sm-3 mb-2">
            <select id="accionesId" name="accionesId" class="form-control-sm">
              {foreach from=$acciones item=accion}
                <option value="{$accion['id_accion']}">{$accion['accion']}</option>
              {/foreach}
            </select>
          </div>

          <div class="input-group mx-sm-3 mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Puntaje</label>
            </div>
            <select class="custom-select col-3 form-control-sm" id="ratingOrder">
                <option value="DESC" selected>Descendente</option>
                <option value="ASC">Ascendente</option>
            </select>
          </div>  

          <div class="form-group mx-sm-3 mb-2">
          <button type="submit" id="getComentarios" class="btn btn-primary btn-sm mb-2">Ver comentarios</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  {* CONTAINER AJAX *}
  <div class="container">
  
    <div id="comentariosContainer">
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Información</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="infoModal">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    
</div>
{include file="footer.tpl"}
<script src="js/tablajs.js" crossorigin="anonymous"></script>
<script src="js/comentarios.js"></script>