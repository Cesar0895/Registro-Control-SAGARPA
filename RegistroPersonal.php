<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">


    <title>Control de dispositivos</title>

</head>

<body>

    <nav class="navbar navbar-light" style="background-color: #000000;">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <img src="./img/logoSagarpa.png" width="180" height="80" class="d-inline-block align-top" alt="">
            </li>

            <li class="nav-item">
                <a class="nav-link" href="inicio.html">Inicio</a>
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
                <a class="nav-link" href="#">Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
    </nav>

    <main role="main" class="container">
        <br>
        <br>
        <div class="row">
				<h3 style="text-align:center">NUEVO REGISTRO</h3>
        </div>
        <form class="form-horizontal" method="POST" action="guardar.php" autocomplete="off"> 
            <div class="form-group">      
                <label for="rfc" class="col-sm-2 controllabel">RFC</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="RFC" name="RFC" placeholder="RFC" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="nombre" class="col-sm-2 controllabel">Nombre</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="nombre" name="Nombre" placeholder="Nombre" required>      
                </div>     
            </div>
            
            <div class="form-group">      
                <label for="apePaterno" class="col-sm-2 controllabel">Apellido Paterno</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="apePaterno" name="ApePaterno" placeholder="Apellido Paterno" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="apeMaterno" class="col-sm-2 controllabel">Apellido Materno</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="apeMaterno" name="ApeMaterno" placeholder="Apellido Materno" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="adscripcion" class="col-sm-2 controllabel">Adscripción</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="adscripcion" name="Adscripcion" placeholder="Adscripción" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="area" class="col-sm-2 controllabel">Area</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="area" name="Area" placeholder="Area" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="subarea" class="col-sm-2 controllabel">Subarea</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="subarea" name="Subarea" placeholder="Subarea" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="puestp" class="col-sm-2 controllabel">Puesto</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="puesto" name="Puesto" placeholder="Puesto" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="denominacion" class="col-sm-2 controllabel">Denominación</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="denominacion" name="Denominacion" placeholder="Denominación" required>      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="telefono" class="col-sm-2 controllabel">Telefono</label>      
                <div class="col-sm-10">       
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono">      
                </div>     
            </div>   

            <div class="form-group">      
                <label for="extencion" class="col-sm-2 controllabel">Extención</label>      
                <div class="col-sm-10">       
                    <input type="tel" class="form-control" id="esxtencion" name="extencion" placeholder="Extencion">      
                </div>     
            </div> 

            <div class="form-group">      
                <label for="Domicilo" class="col-sm-2 controllabel">Domicilio</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio">      
                </div>     
            </div>

            <div class="form-group">      
                <label for="correo" class="col-sm-2 controllabel">Correo</label>      
                <div class="col-sm-10">       
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">      
                </div>     
            </div>

            <div class="form-group">      
                <label for="GFC" class="col-sm-2 controllabel">GFC</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="GFC" name="GFC" placeholder="GFC">      
                </div>     
            </div>

            <div class="form-group">      
                <label for="accesoCorreo" class="col-sm-2 controllabel">Acceso del correo</label>      
                <div class="col-sm-10">       
                    <input type="text" class="form-control" id="accesoCorreo" name="accesoCorreo" placeholder="Acceso del correo">      
                </div>     
            </div>

            <div class="form-group">      
                <label for="estatus" class="col-sm-2 controllabel">Status</label>      
                <div class="col-sm-10">       
                    <select class="form-control" id="estatus" name="estatus">        
                        <option value="ACTIVO">ACTIVO</option>        
                        <option value="BAJA">BAJA</option>        
                        <option value="OTRO">OTRO</option>       
                    </select>      
                </div>     
            </div>


            <div class="form-group">      
                <div class="col-sm-offset-2 col-sm-10">       
                    <a href="index.php" class="btn btndefault">Regresar</a>       
                    <button type="submit" class="btn btnprimary">Guardar</button>      
                </div>     
            </div> 

        </form>

        

    </main>
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