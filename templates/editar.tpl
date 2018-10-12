{include file="header.tpl"}

<div class="cuerpoCotizaciones">
    <!-- TABLA -->
    <div class="tabla container">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        {* <th scope="col">País</th> *}
                        <th scope="col">Precio</th>
                        <th scope="col">Var %</th>
                        <th scope="col">Volumen</th>
                        <th scope="col">MAX</th>
                        <th scope="col">MIN</th>
                    </tr>    
                </thead>
                <tbody id="tabla" class="cotizaciones">
	                {foreach from=$accion item=valor}
                        <tr class="bg-warning" id='row{$valor['id_accion']}'>
                            <td>{$valor['accion']}</td>
                            {* <td>{$valor['pais']}</td> *}
                            <td>$ {$valor['precio']}</td>
                            <td>{$valor['variacion']}</td>
                            <td>$ {$valor['volumen']}</td>
                            <td>$ {$valor['maximo']}</td>
                            <td>$ {$valor['minimo']}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="editar bg-dark" id="editar">
        <form method="post" action="guardar">
            <input type="hidden" class="form-control" id="id_accion" name="id_accion" value="{$valor['id_accion']}">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-3">
                        <input type="text" id="editNombre" name="editNombre" class="form-control form-control-sm" value="{$valor['accion']}">
                        <small class="form-text text-muted">Nombre</small>
                    </div>
                   {* <div class="col-2">
                        <input type="text" id="editPais" name="editPais" class="form-control form-control-sm" value="{$valor['pais']}">
                        <small class="form-text text-muted">País</small>
                    </div> *}
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
                    {* <select id="editTicker" class="col form-control form-control-sm">
                        <option>AGRO</option>
                        <option>ALUA</option>
                    </select> *}
                </div>
            </div>
            <button type="submit" class="btn btn-success">Editar registro</button>
        </form>
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