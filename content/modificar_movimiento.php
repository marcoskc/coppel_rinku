<?php
     session_start();
    // revisar si hay datos en el array post
     $idempleado = "";
     $post = (isset($_POST['idmovimiento']) && !empty($_POST['idmovimiento']));
     

     if($post) {
       $idmovimiento = $_POST['idmovimiento'];
       $idempleado = $_POST['idempleado'];
       $fecha = $_POST['Fecha'];
       $cantidad_entrega = $_POST['cantidad_entrega'];
       $turno = $_POST['turno'];
       $tipo_accion = $_POST['tipo_accion'];
       unset($_POST);
       
       require('../php/global.php');							 	
	   $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	   if (mysqli_connect_errno()) {
			  echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		}
		else{
            if($tipo_accion ==  "EDIT"){
                $sql = "UPDATE movimientos SET ";
                $sql .= "fecha='".$fecha."',"; 
                $sql .= "cantidad_entrega=".$cantidad_entrega.","; 
                $sql .= "cubre_turno=".$turno." "; 
                $sql .= "WHERE idmovimiento=".$idmovimiento;
                $conexion->query($sql); 
                echo "<script>window.location.replace('lista_movimiento.php'); </script>";  
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
        echo "<script>window.location.replace('lista_movimiento.php'); </script>";   
        die();
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
        <h1>- Modificar Movimiento</h1>
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
            <input type="date" name="Fecha" style="width:130px; height:28px;"
                value="<?php echo $fecha; ?>"></label><br>
            <div id="line_decorativo">___________________________________________________________________</div><br>
            <b>Cantidad Entregas </b>
            <input type="number" name="cantidad_entrega" value="<?php echo $cantidad_entrega; ?>" style="width:100px; height:28px;"></label><br>
            <div id="line_decorativo">___________________________________________________________________</div><br>

            <?php
            if($rol == "2"){
                $turno_radio1 = "checked='true'";
                $turno_radio2 = "";
                $turno_radio3 = "";
                if($turno == 1){ 
                    $turno_radio1 = "";
                    $turno_radio2 = "checked='true'";
                }
                if($turno == 2){ 
                    $turno_radio1 = "";
                    $turno_radio3 = "checked='true'";
                }

              echo "<b>Cubrió Turno:</b><br>
                    <div>
                        &nbsp;
                        <input type='radio' name='turno' value='0' ".$turno_radio1.">
                        <label>No Cubrió</label><br>
                        <input type='radio' name='turno' value='1' ".$turno_radio2.">
                        <label>Turno Chofer</label><br>
                        <input type='radio' name='turno' value='2' ".$turno_radio3.">
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
            <input type='hidden' name='idmovimiento' value="<?php echo $idmovimiento ?>">
            <input type='hidden' name='tipo_accion' value="EDIT">
            <input type="submit" value="Guardar" style="width:100px; height:28px;">
        </form>
        <form method='post' action='lista_movimiento.php' target='contenedor'>         
             <input id='boton_cancelar' type='submit' value='Cancelar'>
        </form>
    </div>
</body>

</html>