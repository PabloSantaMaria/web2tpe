{include file="header.tpl"}

{* LOGIN *}
<div class="login bg-dark">
<div class="container">
<h1 class="text-center text-white text-monospace">Login</h1>
</div>    
    <div class="row">
        
            <div class="card text-white bg-secondary loginForm">
                {* HEADER CON MENSAJE *}
                <div class="card-header bg-success">
                    {$mensaje}
                </div>
                {* FORM *}
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
                                <div class="alert alert-danger" role="alert">
                                    Por favor ingrese una contraseña
                                </div>
                            </div>
                         </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        
    </div>
</div>

{include file="footer.tpl"}
<script src="js/validateForm.js" crossorigin="anonymous"></script>