<!-- TABLA -->
    <div class="tabla container">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col"></th>
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
                            <td><img src="{$accion['rutaImg']}" alt="" width="50" height="35"></td>
                            <td>{$accion['accion']}</td>
                            <td>{$accion['pais']}</td>
                            <td>$ {$accion['precio']}</td>
                            <td class="vari">{$accion['variacion']}</td>
                            <td>$ {$accion['volumen']}</td>
                            <td>$ {$accion['maximo']}</td>
                            <td>$ {$accion['minimo']}</td>
                            <td><div class="btn-group" role="group">
                                    <a href="borrar/{$accion['id_accion']}"><button type="button" class="btn btn-outline-danger btn-sm">Borrar</button></a>
                                    <a href="editar/{$accion['id_accion']}"><button type="button" class="btn btn-outline-warning btn-sm" data-toggle="collapse" data-target="#collapseExample">Editar</button></a>
                                </div>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    <!-- FILTRO -->
    <div class="filtrar collapse bg-dark">
        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <input type="text" id="filtrar" class="form-control form-control-sm" placeholder="Buscar">
                    </div>
                </div>
            </div>
        </form>
    </div>