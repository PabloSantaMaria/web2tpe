{include file="header.tpl"}

<div class="login bg-dark">
  
    <div class="container">
        <div class="col-7">
            <div class="alert alert-secondary" role="alert">
            <h4 class="alert-heading">{$accion['accion']}</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">Región</small>{$accion['region']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">País</small>{$accion['pais']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">Precio</small>$ {$accion['precio']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">Variación</small>{$accion['variacion']} %</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">Volumen</small>$ {$accion['volumen']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">Máximo</small>$ {$accion['maximo']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-info">Mínimo</small>$ {$accion['minimo']}</li>
            </ul>
            </div>
        
    </div>
    </div>
</div>

{include file="footer.tpl"}
<script src="js/validateForm.js" crossorigin="anonymous"></script>