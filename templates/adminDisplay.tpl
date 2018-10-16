{include file="header.tpl"}

<div class="cuerpoCotizaciones">

  {include file="tabla.tpl"}
  
  <div class="container">
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
      <strong></strong>{$mensaje}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>

  {include file="opcionesAdmin.tpl"}
  </div>
</div>


{include file="footer.tpl"}
<script src="js/tablajs.js" crossorigin="anonymous"></script>
<script src="js/validateForm.js" crossorigin="anonymous"></script>