<?php

		require 'conexion.php';

	
	$where = "";

	$sqlmostrar = "SELECT * FROM marca $where";
	$resultadoTabla = $mysqli->query($sqlmostrar);

?>

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
        <div class="row">
				<h2 style="text-align:center">MARCAS</h2>
			</div>
			
			<div class="row">
				<a href="complementos.php" class="btn btn-primary">Nuevo Registro</a>
				
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Nombre: </b><input type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
				</form>
			</div>
			
			<br>
			
			<div class="row table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Marca</th>
							
                            <th></th>
                            <th></th>
						</tr>
					</thead>
					
					<tbody>
						<?php while($row = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>
								<td><?php echo $row['id_Marca']; ?></td>
								<td><?php echo $row['Marca']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>


  
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