{include file="header.tpl"}

{* VISTA EDITAR ACCIÓN *}
<div class="cuerpoCotizaciones">
    
    <!-- TABLA -->
    <div class="tabla container">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">País</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Var %</th>
                        <th scope="col">Volumen</th>
                        <th scope="col">MAX</th>
                        <th scope="col">MIN</th>
                        <th scope="col">Imágen</th>
                    </tr>    
                </thead>
                <tbody id="tabla" class="cotizaciones">
	                {foreach from=$accion item=valor}
                        <tr class="bg-warning" id='row{$valor['id_accion']}'>
                            <td>{$valor['accion']}</td>
                            <td>{$valor['pais']}</td>
                            <td>$ {$valor['precio']}</td>
                            <td>{$valor['variacion']}</td>
                            <td>$ {$valor['volumen']}</td>
                            <td>$ {$valor['maximo']}</td>
                            <td>$ {$valor['minimo']}</td>
                            <td><img src="{$valor['rutaImg']}" alt="" width="50" height="35"></td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    
    {* FORM EDITAR *}
    <div class="editar bg-dark" id="editar">
        <form method="post" action="actualizar" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="id_accion" name="id_accion" value="{$valor['id_accion']}">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-3">
                        <input type="text" id="editNombre" name="editNombre" class="form-control form-control-sm" value="{$valor['accion']}">
                        <small class="form-text text-muted">Nombre</small>
                    </div>
                    <div class="col-3">
                        <select id="editPais" name="editPais" class="form-control form-control-sm">
                            <option selected>{$valor['pais']}</option>
                            {foreach from=$paises item=pais}
                            <option>{$pais['pais']}</option>
                            {/foreach}
                        </select>
                        <small class="form-text text-muted">País</small>
                    </div>
                   <div class="col">
                        <input type="text" id="editPrecio" name="editPrecio" class="form-control form-control-sm" value="{$valor['precio']}">
                        <small class="form-text text-muted">Precio</small>
                    </div>
                    <div class="col">
                        <input type="text" id="editVariacion" name="editVariacion" class="form-control form-control-sm" value="{$valor['variacion']}">
                        <small class="form-text text-muted">Variación</small>
                    </div>
                    <div class="col">
                        <input type="text" id="editVolumen" name="editVolumen" class="form-control form-control-sm" value="{$valor['volumen']}">
                        <small class="form-text text-muted">Volumen</small>
                    </div>
                    <div class="col">
                        <input type="text" id="editMaximo" name="editMaximo" class="form-control form-control-sm" value="{$valor['maximo']}">
                        <small class="form-text text-muted">Máximo</small>
                    </div>
                    <div class="col">
                        <input type="text" id="editMinimo" name="editMinimo" class="form-control form-control-sm" value="{$valor['minimo']}">
                        <small class="form-text text-muted">Mínimo</small>
                    </div>
                    <div class="col">
                        <input type="file" id="imagen" name="imagen">
                        <small class="form-text text-muted">Imágen</small>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Editar registro</button>
                    </div>
                </div>
            </div>
            
            <a class="btn btn-danger" href="admin" role="button">Salir de la vista de modificación</a>
        </form>
    </div>
</div>

{include file="footer.tpl"}