{include file="header.tpl"}

<div class="operaciones bg-dark">
    <div class="row">
        <div class="ingreso col-sm">
            <div class="card text-white bg-secondary">
                <div class="card-header bg-success">
                    Informar ingreso de dinero
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="inputAddress2">Cliente</label>
                            <input type="text" class="form-control" placeholder="Nombre y Apellido">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Número de cuenta</label>
                            <input type="text" class="form-control" placeholder="0000 - 00000000">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Cantidad</label>
                                <input type="text" class="form-control" placeholder="$">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Depositar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="egreso col-sm" >
            <div class="card text-white bg-secondary">
                <div class="card-header bg-danger">
                    Solicitar extracción de dinero
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="inputAddress2">Cliente</label>
                            <input type="text" class="form-control" placeholder="Nombre y Apellido">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Número de cuenta</label>
                            <input type="text" class="form-control" placeholder="0000 - 00000000">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Cantidad</label>
                                <input type="text" class="form-control" placeholder="$">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Transferir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{include file="footer.tpl"}