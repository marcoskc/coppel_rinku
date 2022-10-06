<?php
    session_start();
    // revisar si hay datos en el array post
     $idempleado = "";

     // reviso si existen variables cargadas
     $post = (isset($_POST['idempleado']) && !empty($_POST['idempleado']));

      // sacar el periodo laboral corriendo
      if(isset($_POST['periodo']) && !empty($_POST['periodo'])) $_SESSION['periodo'] = $_POST['periodo'];	    
      if(isset($_SESSION['periodo']) && !empty($_SESSION['periodo']) && $_SESSION['periodo']!='1969-12-01') $fecha = date("Y-m-d",strtotime($_SESSION['periodo']));
      else $fecha = date("Y-m-d");

     if($post) {
       $idempleado = $_POST['idempleado'];
       $cantidad_entrega = $_POST['entregas'];
       $turno = $_POST['turno'];
       $tipo_accion = $_POST['tipo_accion'];
       
       // sacar el ultimo dia del mes para restringir el calendario de fecha
       $date = new DateTime($fecha." + 1 month");
       $date->modify('last day of this month');
       $fecha_final = $date->format('Y-m-d');
       unset($_POST);
       
       require('../php/global.php');							 	
	   $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	   if (mysqli_connect_errno()) {
			  echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		}
		else{
            if($tipo_accion ==  "INSERT"){
                $sql = "INSERT INTO movimientos VALUES(";
                $sql .= "NULL,"; // idmovimiento
                $sql .= "'".$idempleado."',"; // idempleado
                $sql .= "now(),"; // Expedido
                $sql .= "'".$fecha."',"; // Fecha
                $sql .= $cantidad_entrega.","; // cantidad_entrega
                $sql .= $turno.","; // cubre_turno
                $sql .= "0)"; // corte
                $conexion->query($sql); 
                echo "<script>window.location.replace('lista_movimientos.php'); </script>";   
                die();
            }
            else{
                // sacar la informacion del empleado seleccionado para darle movimientos de entrega
                $result = $conexion->query("SELECT * FROM empleados WHERE idempleado=".$idempleado); 
                $row = $result->fetch_assoc();
                $numero_empleado = $row['numero_empleado'];
                $nombre = $row['Nombre'];
                $rol = $row['Rol'];
                $tipo = $row['Tipo'];
            }
        }
     }
     else{
        echo "<script>window.location.replace('lista_movimientos.php'); </script>";   
        die();
     }
?>

<html>

<head>
    <title>Administracion RINKU</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/alta_empleado.css" />
</head>

<body>
    <div id="panel_alta">
        <h1>- Alta de Nuevo Movimiento</h1>
        <?php
            $rol_str="Chofer";
            if($rol == "1") $rol_str="Cargador";
            if($rol == "2") $rol_str="Auxiliar";

            $tipo_str="Interno";
            if($tipo == "1") $tipo_str="Externo";

            echo "<b>(".$numero_empleado.") ".$nombre."</b><br>
                  <div style='font-size:14px;'>".$rol_str." / ".$tipo_str."</div>";
        ?>
        <div id="line_decorativo">___________________________________________________________________</div>
        <form method='post' action='' target='contenedor'>
            <div id="line_decorativo2"></div><br>
            <b>Fecha de Entregas </b>
            <input type="date" name="periodo" style="width:130px; height:28px;"
                value="<?php echo $fecha; ?>" 
                min="<?php echo $fecha; ?>"
                max="<?php echo $fecha_final; ?>"></label><br>
            <div id="line_decorativo">___________________________________________________________________</div><br>
            <b>Cantidad Entregas </b>
            <input type="number" name="entregas" value="1" style="width:100px; height:28px;"></label><br>
            <div id="line_decorativo">___________________________________________________________________</div><br>

            <?php
            if($rol == "2"){
              echo "
                 <b>Cubrió Turno:</b><br>
                 <div>
                     &nbsp;
                     <input type='radio' name='turno' value='0' checked='true'>
                     <label>No Cubrió</label><br>
                     <input type='radio' name='turno' value='1'>
                     <label>Turno Chofer</label><br>
                     <input type='radio' name='turno' value='2'>
                     <label>Tuno Cargador</label><br>
                 </div>
                 <br>
                 <div id='line_decorativo'>___________________________________________________________________</div><br>
                 <br>";
            }
            else{                
                echo "<input type='hidden' name='turno' value='0'>";            
            }
            ?>
            <input type='hidden' name='idempleado' value="<?php echo $idempleado ?>">
            <input type='hidden' name='tipo_accion' value="INSERT">            
            <input type="submit" value="Registrar" style="width:100px; height:28px;">
        </form>
        <form method='post' action='lista_trabajadores.php' target='contenedor'>         
             <input id='boton_cancelar' type='submit' value='Cancelar'>
        </form>
    </div>
</body>

</html>