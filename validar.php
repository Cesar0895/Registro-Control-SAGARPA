<?php

    session_start();
/*
    $usuario=$_POST['user'];
    $password=$_POST['pass'];

    $_SESSION['user']=$usuario;
    $_SESSION['pass']=$password;
*/
    $conexion =  new mysqli ('localhost','root','','inventariosagarpa');
    
    $usuario= mysqli_real_escape_string($conexion, $_POST['user']);
    $password=mysqli_real_escape_string($conexion,$_POST['pass']);

    $_SESSION['user']=$usuario;
    $_SESSION['pass']=$password;
    
    $consulta="SELECT * FROM persona WHERE Usuario='$usuario' and Contra='$password'";
    //'or '1'='1
    $resultado = mysqli_query($conexion, $consulta);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

        $puesto=$row['Puesto'];
        
 
    $filas=mysqli_num_rows($resultado);

    if($filas>0){
        if ($puesto=='encargado') {
            header('location:inicio.php');
        } else {
            header('location:Resguardante/inicioRes.php');
        }
                
    }
    else {
       
        header('location:index.php');
       
    }


    mysqli_free_result($resultado);
    mysqli_close($conexion);
   
?>