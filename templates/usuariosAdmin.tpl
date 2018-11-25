<div class="tabla container w-100 p-3">
        
    <div class="table-responsive">
        <table class="table table-sm table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">Nombre de usuario</th>
                    <th scope="col">ID</th>
                    <th scope="col"></th>
                </tr>    
            </thead>
            <tbody id="tabla" class="cotizaciones">
                {foreach from=$usuarios item=usuario}
                    <tr id='row{$usuario['id_usuario']}'>
                        <td><a class="text-info">{$usuario['usuario']}</a></td>
                        <td>{$usuario['id_usuario']}</td>
                        <td>
                            {if $usuario['admin'] == 1}
                                administrador
                            {/if}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>

    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Editar usuarios</button>
   
   {* COLLAPSE *}
    <div class="collapse" id="collapseExample">
        <div class="card bg-dark">
            <div class="card-header">
              Editar usuarios
            </div>
            <div class="card-body">
                <form method="post" action="adminControl/editarUsuario" novalidate>
                    <div class="form-group">
                        <select id="usuarioEdit" name="usuarioEdit" class="form-control-sm">
                            {foreach from=$usuarios item=usuario}
                                <option value="{$usuario['id_usuario']}">{$usuario['usuario']}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="submit" name="hacerAdmin" class="btn btn-sm btn-success">Hacer Administrador</button>
                        <button type="submit" name="quitarAdmin" class="btn btn-sm btn-warning">Quitar Administrador</button>
                        <button type="submit" name="borrarUsuario" class="btn btn-sm btn-danger">Borrar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>