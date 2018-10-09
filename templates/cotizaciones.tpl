{include file="header.tpl"}

<div class="cuerpoCotizaciones">
    <!-- TABLA -->
    <div class="tabla container">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
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
                            <td>{$accion['nombre']}</td>
                            <td>$ {$accion['precio']}</td>
                            <td>{$accion['variacion']}</td>
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
    
    <!-- EDITAR REGISTRO (COLAPSADO) -->
    <div class="editar collapse bg-dark" id="collapseExample">
        <form>
            <div class="form-group">
                <div class="form-row">
                    <select id="editTicker" class="col form-control form-control-sm">
                        <option>AGRO</option>
                        <option>ALUA</option>
                        <option>APBR</option>
                        <option>AUSO</option>
                        <option>EDN</option>
                        <option>FRAN</option>
                        <option>GGAL</option>
                        <option>HARG</option>
                        <option>LOMA</option>
                        <option>METR</option>
                        <option>SUPV</option>
                        <option>TECO2</option>
                        <option>TS</option>
                        <option>TXAR</option>
                        <option>YPFD</option>
                    </select>
                    <div class="col">
                        <input type="text" id="editPrecio" class="form-control form-control-sm" placeholder="Precio">
                    </div>
                    <div class="col">
                        <input type="text" id="editVari" class="form-control form-control-sm" placeholder="Var %">
                    </div>
                    <div class="col">
                        <input type="text" id="editVol" class="form-control form-control-sm" placeholder="Vol">
                    </div>
                    <div class="col">
                        <input type="text" id="editMax" class="form-control form-control-sm" placeholder="Max">
                    </div>
                    <div class="col">
                        <input type="text" id="editMin" class="form-control form-control-sm" placeholder="Min">
                    </div>
                    <div class="col">
                        <input type="text" id="editCierre" class="form-control form-control-sm" placeholder="Cierre">
                    </div> 
                </div>
            </div>
        </form>
        <button type="button" id="guardarNuevo" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample">Editar registro <span id="registroId" class="badge badge-warning"></span></button>
    </div>
    
    <!-- INPUTS -->
    <div class="inputs bg-secondary">
        <div class="row">
            <div class="col-sm">
                <form>
                    <div class="form-group">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Ticker</span>
                            </div>
                            <select id="ticker" class="form-control form-control-sm">
                                <option>AGRO</option>
                                <option>ALUA</option>
                                <option>APBR</option>
                                <option>AUSO</option>
                                <option>EDN</option>
                                <option>FRAN</option>
                                <option>GGAL</option>
                                <option>HARG</option>
                                <option>LOMA</option>
                                <option>METR</option>
                                <option>SUPV</option>
                                <option>TECO2</option>
                                <option>TS</option>
                                <option>TXAR</option>
                                <option>YPFD</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Precio</span>
                            </div>
                            <input type="text" id="precio" class="form-control form-control-sm" placeholder="$">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Variación</span>
                            </div>
                            <input type="text" id="vari" class="form-control form-control-sm" placeholder="%">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Volumen</span>
                            </div>
                            <input type="text" id="vol" class="form-control form-control-sm" placeholder="$">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Máximo</span>
                            </div>
                            <input type="text" id="max" class="form-control form-control-sm" placeholder="$">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Mínimo</span>
                            </div>
                            <input type="text" id="min" class="form-control form-control-sm" placeholder="$">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Cierre</span>
                            </div>
                            <input type="text" id="cierre" class="form-control form-control-sm" placeholder="$">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm">
                <div class="btn-group-vertical" role="group" aria-label="...">
                    <button type="button" id="getTabla" class="btn btn-primary">Ver cotizaciones</button>
                    <button type="button" id="guardarRegistro" class="btn btn-success">Guardar</button>
                    <button type="button" id="poblarTabla" class="btn btn-warning">Poblar tabla x 6</button>
                    <button type="button" id="borrarTabla" class="btn btn-danger">Borrar todo</button>
                    <button type="button" class="btn btn-light" data-toggle="collapse" data-target="#filtrar">Filtrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

{include file="footer.tpl"}