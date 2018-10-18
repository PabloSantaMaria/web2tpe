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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <a class="navbar-brand" href="home">
                <img src="images/hs.svg" width="80" class="d-inline-block align-center" alt="logo">
                    TABrokers
                <span class="navbar-text font-italic font-weight-light">
                    Tandil Asset Brokers
                </span>
            </a>

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
                        <a class="nav-link" href="acerca"><button type="button" id="acerca" class="btn btn-outline-info">Acerca de nosotros</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin"><button type="button" id="login" class="btn btn-outline-info">Administrador</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login"><button type="button" id="login" class="btn btn-outline-warning">Login</button></a>
                    </li>
                </ul>
            </div>
            
        </nav>
    </header>