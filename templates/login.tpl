{include file="header.tpl"}

<div class="operaciones bg-dark">
    <div class="row">
        <div class="ingreso col-sm-5">
            <div class="card text-white bg-secondary">
                <div class="card-header bg-success">
                    Ingrese credenciales de Administrador
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="post" action="verify" novalidate>
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="email" class="form-control" id="user" name="user" placeholder="Email" required>
                            <div class="invalid-feedback">
                                Por favor ingrese un usuario
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Por favor ingrese una contraseña
                            </div>
                         </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{include file="footer.tpl"}
<script src="js/validateForm.js" crossorigin="anonymous"></script>