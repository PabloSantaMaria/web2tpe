{include file="header.tpl"}

<div class="login bg-dark">
  
    <div class="container">
    <div class="row">
        <div class="col-5">
        
            <div class="alert alert-secondary" role="alert">
            <h4 class="alert-heading">{$accion[0]['accion']}</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">Región</small>{$accion[0]['region']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">País</small>{$accion[0]['pais']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">Precio</small>$ {$accion[0]['precio']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">Variación</small>{$accion[0]['variacion']} %</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">Volumen</small>$ {$accion[0]['volumen']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">Máximo</small>$ {$accion[0]['maximo']}</li>
                <li class="list-group-item bg-secondary text-white"><small class="form-text text-warning">Mínimo</small>$ {$accion[0]['minimo']}</li>
            </ul>
            </div>
        </div>
        <div class="col-sm">
            <img src="images/agente-bolsa.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
        
    </div>
</div>

{include file="footer.tpl"}
<script src="js/validateForm.js" crossorigin="anonymous"></script>