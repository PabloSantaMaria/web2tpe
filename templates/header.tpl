<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{$title}</title>
    <base href="{$baseURL}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        
        {* BARRA NAV *}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            {* LOGO *}
            <a class="navbar-brand" href="home">
                <img src="images/hs.svg" width="80" class="d-inline-block align-center" alt="logo">
                    TABrokers
                <span class="navbar-text font-italic font-weight-light">
                    Tandil Asset Brokers
                </span>
            </a>

            {* NAVEGACIÓN *}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="home"><button type="button" id="home" class="btn btn-outline-info">Home</button><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" id="tablacotiz" class="btn btn-outline-info">Cotizaciones</button>
                        </a>
                        <div class="dropdown-menu btn-outline-info bg-dark " aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item text-info ver" href="cotizaciones/">Todas</a>
                        {foreach from=$regiones item=region}
                            <a class="dropdown-item text-info ver" href="cotizaciones/{$region['region']}">{$region['region']}</a>
                        {/foreach}
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="comentarios"><button type="button" id="comentarios" class="btn btn-outline-info">Comentarios</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="acerca"><button type="button" id="acerca" class="btn btn-outline-info">Acerca de nosotros</button></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" id="usuarios" class="btn btn-outline-warning">Usuario</button>
                        </a>
                        <div class="dropdown-menu btn-outline-info bg-dark" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-info ver" href="login">Login</a>
                            <a class="dropdown-item text-info ver" href="signIn">Sign In</a>
                            <a class="dropdown-item text-info ver" href="admin">Administrador</a>
                            <a class="dropdown-item text-danger ver" href="logout">Log Out</a>
                        </div>
                    </li>
                        
                </ul>
            </div>
            
        </nav>
    </header>