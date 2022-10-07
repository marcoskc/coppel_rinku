<?php
    session_start();
    // revisar si hay datos en el array post
     $numero = "";
     $nombre = "";
     $rol =  "0";
     $tipo =  "0";

      // reviso si existen variables cargadas
     $post = (isset($_POST['numero']) && !empty($_POST['numero'])) &&
              (isset($_POST['nombre']) && !empty($_POST['nombre']));

     if($post) {
       $numero = $_POST['numero'];
       $nombre = htmlspecialchars($_POST['nombre']);
       $rol =  $_POST['rol'];
       $tipo =  $_POST['tipo'];
       unset($_POST);
       
       require('../php/global.php');							 	
	   $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	   if (mysqli_connect_errno()) {
			  echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		}
		else{
            // buscando si ya existe el empleado en la base de datos
            $sql = "SELECT * FROM empleados WHERE numero_empleado='".$numero."'";            
            $result = $conexion->query($sql);
            if($result->num_rows > 0){
                 // ya exite el numero
                 $numero = "";
            }
            else{
                $sql = "SELECT * FROM empleados WHERE Nombre='".$nombre."'";            
                $result = $conexion->query($sql);
                if($result->num_rows > 0){
                   // ya existe el nombre de empleado
                   $nombre = "";
                }
                else{
                    $sql = "INSERT INTO empleados VALUES(";
                    $sql .= "NULL,"; // idempleado
                    $sql .= "'".$numero."',"; // numero_empleado
                    $sql .= "'".$nombre."',"; // Nombre
                    $sql .= $rol.","; // Rol
                    $sql .= $tipo.")"; // Tipo
                    $conexion->query($sql); 
                    echo "<script>window.location.replace('lista_trabajadores.php'); </script>";   
                    die();
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
        <h1>- Alta de Nuevo Empleado</h1>
        <div id="line_decorativo2" style="background:#9e2662;">.</div><br>
        <form method='post' action='' target='contenedor'>
            <b>Numero de empleado </b>
            <input type="text" name="numero" value="<?php echo $numero; ?>" style="width:100px; height:28px;"></label><br>
            <div id="line_decorativo">___________________________________________________________________</div><br>
            <b>Nombre completo del empleado:</b>
            <br><input type="text" name="nombre" value="<?php echo $nombre; ?>" style="width:400px; height:28px;"></label><br>
            <div id="line_decorativo">___________________________________________________________________</div><br>
            <b>Seleccione un rol de empleado:</b><br>
            <div>&nbsp;
                <input type="radio" name="rol" value="0" checked="true">
                  <label>Chofer</label><br>
                  <input type="radio" name="rol" value="1">
                  <label>Cargador</label><br>
                  <input type="radio" name="rol" value="2">
                  <label>Auxiliar</label><br>
            </div>
            <br>
            <div id="line_decorativo">___________________________________________________________________</div><br>
            <b>Seleccione el tipo de empleado:</b>
            <br>
            <div>&nbsp;
                <input type="radio" name="tipo" value="0" checked="true">
                  <label>Interno</label><br>
                  <input type="radio" name="tipo" value="1">
                  <label>Externo</label><br>
            </div>
            <br>
            <div id="line_decorativo">___________________________________________________________________</div>
            <br>
            <input type="submit" value="Registrar" style="width:100px; height:28px;">
        </form>
        <form method='post' action='lista_trabajadores.php' target='contenedor'>
            <input id='boton_cancelar' type='submit' value='Cancelar'>
        </form>
    </div>
</body>

</html>