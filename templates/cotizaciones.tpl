{include file="header.tpl"}

{* COTIZACIONES USUARIO VISITANTE *}
<div class="cuerpoCotizaciones">

    <!-- TABLA -->
    <div class="tabla container">
        <div class="alert alert-dark" role="alert">
            Cotizaciones de {$region}
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Región</th>
                        <th scope="col">País</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Variación</th>
                    </tr>    
                </thead>
                <tbody id="tabla" class="cotizaciones">
	                {foreach from=$acciones item=accion}
                        <tr id='row{$accion['id_accion']}'>
                            <td><a class="text-info" href="detalleAccion/{$accion['id_accion']}">{$accion['accion']}</a></td>
                            <td>{$accion['region']}</td>
                            <td>{$accion['pais']}</td>
                            <td>$ {$accion['precio']}</td>
                            <td class="vari">{$accion['variacion']} %</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    
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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    
</div>
{include file="footer.tpl"}
<script src="js/tablajs.js" crossorigin="anonymous"></script>