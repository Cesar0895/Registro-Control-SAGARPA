<?php

error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);

    session_start();
/*
    $usuario=$_POST['user'];
    $password=$_POST['pass'];

    $_SESSION['user']=$usuario;
    $_SESSION['pass']=$password;
*/
 $conexion =  new mysqli ('localhost','root','','inventariosagarpa');

    //$conexion =  new mysqli ('localhost','id8480341_root','contra123','id8480341_invensagarpa');
    
    $usuario= mysqli_real_escape_string($conexion, $_POST['user']);
    $email= mysqli_real_escape_string($conexion, $_POST['user']);
    $password=mysqli_real_escape_string($conexion,$_POST['pass']);

    $_SESSION['user']=$usuario;
    $_SESSION['user']=$email;
    $_SESSION['pass']=$password;
    
    $consulta="SELECT * FROM persona WHERE (Usuario='$usuario' or Correo='$email') and Contra='$password'";
    //'or '1'='1
    $resultado = mysqli_query($conexion, $consulta);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

        $RFC=$row['RFC'];
        
 
    $filas=mysqli_num_rows($resultado);

    if($filas>0){
        if ($RFC=='CUAJ800423F77' || $RFC=='BUVG860908DU8') {
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