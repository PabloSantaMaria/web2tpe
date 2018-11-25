{* OPCIONES DE ADMIN *}
<div class="accordion text-white" id="accordionExample">
  
  {* VER COTIZACIONES *}
  <div class="card text-white bg-secondary">

    <div class="card-header bg-dark" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link btn-sm text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Ver cotizaciones</button>
      </h5>
    </div>
    
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        
        {* POR REGION *}
        <form class="form-inline" method="post" action="adminControl/verRegion">
          <div class="form-group mb-2">
            <label for="regiones" class="sr-only">Regiones</label>
            <input type="text" readonly class="form-control-plaintext text-white" value="Ver acciones por región">
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <select id="region" name="region" class="form-control-sm">
              {foreach from=$regiones item=region}
                <option>{$region['region']}</option>
              {/foreach}
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">Mostrar</button>
        </form>
        
        {* POR PAIS *}
        <form class="form-inline" method="post" action="adminControl/verPais">
          <div class="form-group mb-2">
            <label for="paises" class="sr-only">Paises</label>
            <input type="text" readonly class="form-control-plaintext text-white" value="Ver acciones por país">
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <select name="pais" class="form-control-sm">
              {foreach from=$paises item=pais}
                <option>{$pais['pais']}</option>
              {/foreach}
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">Mostrar</button>
        </form>
        
        {* VER TODAS *}
        <form class="form-inline" method="post" action="adminControl/verTodas">
          <div class="form-group mb-2">
            <label for="todas" class="sr-only">Todas</label>
            <input type="text" readonly class="form-control-plaintext text-white" value="Ver todas las acciones">
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <button type="submit" class="btn btn-primary btn-sm mb-2">Mostrar</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
  
  {* ADMINISTRAR COTIZACIONES *}
  <div class="card bg-secondary">
    <div class="card-header bg-dark" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link btn-sm collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Administrar cotizaciones
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body w-50 p-3">
        
        {* AGREGAR REGIÓN *}
        <div class="mb-2">
          <label>Agregar nueva región</label>
        </div>
        <form class="form-inline" method="post" action="adminControl/guardarRegion">
          
          <div class="form-group mx-sm-3 mb-2">
            <input class="form-control form-control-sm" type="text" placeholder="" name="nuevaRegion">
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">Guardar</button>
        </form>

        <div class="mb-2">
          <label>Borrar región</label>
        </div>
        <form class="form-inline" method="post" action="borrarRegion">
          <div class="form-group mx-sm-3 mb-2">
            <select name="borrarRegion" class="form-control-sm">
              {foreach from=$regiones item=region}
                <option>{$region['region']}</option>
              {/foreach}
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">Borrar</button>
        </form>

        {* AGREGAR PAÍS *}
        <div class="mb-2">
          <label for="exampleInputEmail1">Agregar nuevo país</label>
        </div>
        <form class="form-inline" method="post" action="adminControl/guardarPais">
          <div class="form-group mx-sm-3 mb-2">
            <input class="form-control form-control-sm" type="text" placeholder="" name="nuevoPais">
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <select name="perteneceRegion" class="form-control-sm">
              <option selected>Pertenece a la región</option>
              {foreach from=$regiones item=region}
                <option>{$region['region']}</option>
              {/foreach}
            </select>
          </div>
          <button type="submit" class="btn btn-primary btn-sm mb-2">Guardar</button>
        </form>
        
        {* GUARDAR ACCIÓN *}
        <div class="bg-secondary">
          <div class="row">
            <div class="col-sm">
              <form class="needs-validation" method="post" action="adminControl/guardarAccion" novalidate>
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="nuevaRegion" class="sr-only">Región Nueva</label>
                    <input type="text" readonly class="form-control-plaintext text-white" value="Agregar nueva acción">
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">País</span>
                    </div>
                    <select name="paisAccion" class="form-control">
                      <option selected>País</option>
                      {foreach from=$paises item=pais}
                      <option>{$pais['pais']}</option>
                      {/foreach}
                    </select>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Acción</span>
                    </div>
                    <input type="text" name="accionAccion" class="form-control form-control-sm" placeholder="Nombre" required>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Precio</span>
                    </div>
                    <input type="text" name="precioAccion" class="form-control form-control-sm" placeholder="$" required>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Variación</span>
                    </div>
                    <input type="text" name="variacionAccion" class="form-control form-control-sm" placeholder="%" required>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Volumen</span>
                    </div>
                    <input type="text" name="volumenAccion" class="form-control form-control-sm" placeholder="$" required>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Máximo</span>
                    </div>
                    <input type="text" name="maximoAccion" class="form-control form-control-sm" placeholder="$" required>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Mínimo</span>
                    </div>
                    <input type="text" name="minimoAccion" class="form-control form-control-sm" placeholder="$" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm mb-2">Guardar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  {* ADMINISTRAR USUARIOS *}
  <div class="card bg-secondary">
    <div class="card-header bg-dark" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link btn-sm collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Administrar usuarios
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">


      

      <div class="row">
        <div class="col">

          {* AGREGAR NUEVO USUARIO *}
          <div class="card bg-dark">
            <div class="card-header">
              Agregar nuevo usuario
            </div>
            <div class="card-body">
              <form method="post" action="adminControl/guardarUsuario" novalidate>
                <div class="form-group">
                  <label for="Email">Email</label>
                  <input type="email" class="form-control" name="nuevoUser" aria-describedby="emailHelp" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="Password">Contraseña</label>
                  <input type="password" class="form-control" name="nuevaPass" placeholder="Password">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" name="comoAdmin">
                  <label class="form-check-label" for="exampleCheck1">Agregar como administrador</label>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Agregar</button>
            </form>
            </div>
          </div>
          
        </div>
        <div class="col">
          <div id="tablaUsuarios">
            {include file="usuariosAdmin.tpl"}
          </div>
          
          
        </div>

      </div>
      </div>
    </div>
  </div>
</div>