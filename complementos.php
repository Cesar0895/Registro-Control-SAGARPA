<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">

    <link rel="stylesheet" href="./css/estilo.css">
    <title>Control de dispositivos</title>

</head>

<body>
   

        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
            <a href="inicio.php" class="logo">
                <img src="./img/logoSagarpa.png" width="180" height="80" class="d-inline-block align-top" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="nav nav-tabs">

                    <li class="nav-item">
                        <a class="nav-link" href="inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Registro</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="registroEquipoComputo.html ">Equipo de computo</a>
                            <a class="dropdown-item" href="registroAuxiliares.html">Auxiliares</a>
                            <a class="dropdown-item" href="#">Telefonia</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="personal.html">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="complementos.php">Registros complementos</a>
                    </li>
                </ul>
            </div>
        </nav>
<br>
<br>
<br>
<br>
<br>

    <div class="container" >
        <div class="card">    
            <form>
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" class="form-control" id="marca" name="Marca" placeholder="Marca" require>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="index.php" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

        <?php

        require 'conexion.php';

        $marca2 = $_GET['Marca'];

        $sqlmarca= "INSERT INTO marca (Marca) VALUES ('".$marca2."')";
        $mysqli->query($sqlmarca);

        ?>

        <div class="card">    
            <form>
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" class="form-control" id="modelo" name="Modelo" placeholder="Modelo" require>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="index.php" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

        <?php

        require 'conexion.php';

        $modelo = $_GET['Modelo'];

        $sqlmodelo= "INSERT INTO modelo (Modelo) VALUES ('".$modelo."')";
        $mysqli->query($sqlmodelo);

        ?>
        
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>
