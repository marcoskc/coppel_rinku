<?php
     session_start();
    // revisar si hay datos en el array post
     $numero = "";
     $nombre = "";
     $old_numero = "";
     $old_nombre = "";
     $rol =  "0";
     $tipo =  "0";
     $idempleado =  "";
     $tipo_accion =  "";
     
     // variables de seleccion de radiobox
     $rol_radio1 = "checked='true'";
     $rol_radio2 = "";
     $rol_radio3 = "";

     $tipo_radio1 = "checked='true'";
     $tipo_radio2 = "";

      // reviso si existen variables cargadas
     $post = (isset($_POST['idempleado']) && !empty($_POST['idempleado'])) &&
              (isset($_POST['tipo_accion']) && !empty($_POST['tipo_accion']));

     if($post) {
       $numero = $_POST['numero'];
       $nombre = htmlspecialchars($_POST['nombre']);
       $rol =  $_POST['rol'];
       $tipo =  $_POST['tipo'];
       $idempleado =  $_POST['idempleado'];
       $tipo_accion =  $_POST['tipo_accion'];

       // carga los valores originales para descartarlo como datos repetidos
       if(isset($_POST['old_numero']) && !empty($_POST['old_numero'])) $old_numero=$_POST['old_numero'];
       else $old_numero=$_POST['numero'];

       if(isset($_POST['old_nombre']) && !empty($_POST['old_nombre'])) $old_nombre=$_POST['old_nombre'];
       else $old_nombre=$_POST['nombre'];

       if($rol == 1 || $rol ==2){ 
          $rol_radio1 = "";
          if($rol == 1) $rol_radio2 = "checked='true'";
          else $rol_radio3 = "checked='true'";
       }

       if($tipo == 1){ 
           $tipo_radio1 = "";
           $tipo_radio2 = "checked='true'";
       }

       unset($_POST);
       if($tipo_accion != "EDIT"){
            require('../php/global.php');
	        $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	        if (mysqli_connect_errno()) {
			     echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		    }
		    else{
                 // buscando si ya existe el empleado en la base de datos
                $sql = "SELECT * FROM empleados WHERE numero_empleado='".$numero."'";            
                $result = $conexion->query($sql);
                if($result->num_rows > 0 && $numero!=$old_numero){
                     // ya exite el numero
                     $numero = "";
                }
                else{
                    $sql = "SELECT * FROM empleados WHERE Nombre='".$nombre."'";            
                    $result = $conexion->query($sql);
                    if($result->num_rows > 0 && $nombre!=$old_nombre){
                        // ya existe el nombre de empleado
                        $nombre = "";
                    }
                    else{
                        $sql = "UPDATE empleados SET ";
                        $sql .= "numero_empleado='".$numero."',"; 
                        $sql .= "Nombre='".$nombre."',"; 
                        $sql .= "Rol=".$rol.","; 
                        $sql .= "Tipo=".$tipo." "; 
                        $sql .= "WHERE idempleado=".$idempleado;
                        $conexion->query($sql); 
                        echo "<script>window.location.replace('lista_trabajadores.php'); </script>";   
                        die();
                    }
                }
            }
        }
     }
?>

<html>

<head>
    <title>Administración RINKU</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/alta_empleado.css" />
</head>

<body>
    <div id="panel_alta">
        <h1>- Modificar información del empleado</h1>
        <div id="line_decorativo2" style="background:#9e2662;">.</div><br>
        <form method='post' action='' target='contenedor'>
            <?php
               echo "
                  <b>Numero de empleado </b>
                  <input type='text' name='numero' style='width:100px; height:28px;' value='".$numero."'></label><br>
                  <div id='line_decorativo'>___________________________________________________________________</div><br>
                  <b>Nombre completo del empleado:</b>
                  <br><input type='text' name='nombre' style='width:400px; height:28px;' value='".$nombre."'></label><br>
                  <div id='line_decorativo'>___________________________________________________________________</div><br>
                  <b>Seleccione un rol de empleado:</b><br>
                  <div>&nbsp;
                        <input type='radio' id='chofer' name='rol' value='0' ".$rol_radio1.">
                        <label for='chofer'>Chofer</label><br>
                        <input type='radio' id='cargador' name='rol' value='1' ".$rol_radio2.">
                        <label for='cargador'>Cargador</label><br>
                        <input type='radio' id='auxiliar' name='rol' value='2' ".$rol_radio3.">
                        <label for='auxiliar'>Auxiliar</label><br>
                  </div>
                  <br>
                  <div id='line_decorativo'>___________________________________________________________________</div><br>
                  <b>Seleccione tipo de empleado:</b>
                  <br>
                  <div>&nbsp;
                      <input type='radio' id='interno' name='tipo' value='0' ".$tipo_radio1.">
                      <label for='interno'>Interno</label><br>
                      <input type='radio' id='externo' name='tipo' value='1' ".$tipo_radio2.">
                      <label for='externo'>Externo</label><br>
                  </div>
                  <br>
                  <div id='line_decorativo'>___________________________________________________________________</div>
                  <br>
                  <input type='hidden' name='idempleado' value='".$idempleado."'>
                  <input type='hidden' name='old_numero' value='".$old_numero."'>
                  <input type='hidden' name='old_nombre' value='".$old_nombre."'>
                  <input type='hidden' name='tipo_accion' value='GUARDAR'>	      
                  <input type='submit' value='Guardar' style='width:100px; height:28px;'>";
            ?>
        </form>
        <form method='post' action='lista_trabajadores.php' target='contenedor'>
            <input id='boton_cancelar' type='submit' value='Cancelar'>
        </form>
    </div>
</body>

</html>