{include file="header.tpl"}

<div class="cuerpoCotizaciones">
    <div class="container">

        {* Titulo *}

        <div class="card w-75 mx-auto bg-dark text-white">
        <h5 class="card-header text-primary" id="user">{$user}</h5>
          <h5 class="card-header">Bienvenido a la sección de comentarios</h5>
          <div class="card-body">
            <h6 class="card-title text-center">Elija una cotización para ver</h6>

            {* SELECTOR DE COTIZACION *}
            <form class="form-inline" name="getComentarios">
              <div class="form-group mb-2">
                <label for="acciones" class="sr-only">Acciones</label>
                <input type="text" readonly class="form-control-plaintext text-white text-center" value="">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <select id="accionesId" name="accionesId" class="form-control-sm">
                  {foreach from=$acciones item=accion}
                    <option value="{$accion['id_accion']}">{$accion['accion']}</option>
                  {/foreach}
                </select>
              </div>
              <button type="submit" id="getComentarios" class="btn btn-primary btn-sm mb-2">Ver comentarios</button>
            </form>

          </div>
        </div>
      </div>

        {* CONTAINER AJAX *}
      <div class="container">
        <div id="comentariosContainer"></div>
      <div>

    <!-- FILTRO -->
    <div class="filtro container w-50 p-3">
    <div class="filtrar bg-dark">
        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                    <label for="filtrar"><span class="badge badge-pill badge-warning">Filtrar</span></label>
                        <input type="text" id="filtrar" class="form-control form-control-sm" placeholder="Buscar">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Ingrese un criterio para filtrar la tabla
                        </small>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
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