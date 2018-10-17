{include file="header.tpl"}

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
                    </tr>    
                </thead>
                <tbody id="tabla" class="cotizaciones">
	                {foreach from=$acciones item=accion}
                        <tr id='row{$accion['id_accion']}'>
                            <td>{$accion['accion']}</td>
                            <td>{$accion['pais']}</td>
                            <td>$ {$accion['precio']}</td>
                            <td class="vari">{$accion['variacion']}</td>
                            <td>$ {$accion['volumen']}</td>
                            <td>$ {$accion['maximo']}</td>
                            <td>$ {$accion['minimo']}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    <!-- FILTRO (COLAPSADO) -->
    <div class="filtrar collapse bg-dark" id="filtrar">
        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <input type="text" id="filtrarTicker" class="form-control form-control-sm" placeholder="Buscar">
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</div>
{include file="footer.tpl"}
<script src="js/tablajs.js" crossorigin="anonymous"></script>