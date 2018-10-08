<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{$titulo}</title>
    {* {$base} *}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="html/home.html">
                    <img src="images/hs.svg" width="80" class="d-inline-block align-center" alt="logo">
                    TABrokers
                    <span class="navbar-text font-italic font-weight-light">
                        Tandil Asset Brokers
                    </span>
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" id="home" class="btn btn-outline-info">Home</button>
                        <button type="button" id="tablacotiz" class="btn btn-outline-info">Cotizaciones</button>
                        <button type="button" id="operar" class="btn btn-outline-info">Operar</button>
                        <button type="button" id="acerca" class="btn btn-outline-info">Acerca de nosotros</button>
                    </div>
                </div>
            </nav>
        </header>
        
        <div id="useAjax">
        </div>
        
        <footer>
            <div class="card-footer bg-dark text-info font-weight-light">
                © 2018 Pablo Santa María - Facultad de Ciencias Exactas - UNICEN
            </div>
        </footer>
    </div>
    
    <script src="js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="js/partialrender.js"></script>
    <script src="js/rest.js"></script>
</body>
</html>