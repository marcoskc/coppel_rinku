<?php
    session_start();
    if(isset($_SESSION['periodo']) && !empty($_SESSION['periodo']) && $_SESSION['periodo']!='1969-12-01') $fecha = date("Y-m-d",strtotime($_SESSION['periodo']));
    else $fecha = date("Y-m-d");

    // sacar el ultimo dial del mes
    $date = new DateTime($fecha." + 1 month");
    $date->modify('last day of this month');
    $fecha = $date->format('Y-m-d');

    // sacar el periodo laboral corriendo
    setlocale(LC_TIME, "spanish");		
    $periodo_actual = strftime("%B de %Y", strtotime($fecha));
      
    // revisar si hay datos en el array post
     $post = (isset($_POST['tipo_accion']) && !empty($_POST['tipo_accion']));

     if($post) {
       $tipo_accion = $_POST['tipo_accion'];
       unset($_POST);
	       
       require('../php/global.php');							 	
	   $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	   if (mysqli_connect_errno()) {
			  echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
	   }
	   else{
           // revisar si ya existe corte en ese periodo
           $sql = "SELECT * FROM cortes WHERE corte='".$fecha."'";            
           $result = $conexion->query($sql);
           if($result->num_rows > 0){
                // ya exite corte realizado
                echo "<script>window.location.replace('lista_cortes.php'); </script>";   
                die();
           }
           else{            
                if($tipo_accion ==  "INSERT"){
                     $sql = "call crear_nomina('".$fecha."');";                             
                     $conexion->query($sql); 
                     echo "<script>window.location.replace('lista_cortes.php'); </script>";   
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
        <h1>- Generar Corte de Nómina</h1>
        <?php
            echo "<b>Periodo de Corte: ".$periodo_actual."</b><br>";
        ?>
        <div id="line_decorativo">___________________________________________________________________</div>
        <form method='post' action='' target='contenedor'>
            <div id="line_decorativo2"></div><br>
            <h3><b>Se realizarán los cálculos de sueldos y compensaciones bajo los siguientes criterios laborales</b></h3>
            <br>
            <ul>
                <li>Sueldo base $30 x 8 horas de jornada laboral = $240 diario</li><br>
                <li>Compensación de $5 x entrega realizada</li><br>
                <li>Bono x hora al día - Chofer $10, Cargador $5, Auxiliar bono correspondiente solo al cubrir turno</li><br>
                <li>Si un trabajador no tiene registro de movimientos del día se tomara como día no trabajado lo cual son descontados de su sueldo base y bonos</li><br>
                <li>Retención de 9% ISR para sueldos menor o igual de $16,000 y el 12% ISR para sueldos mayores de $16,000 al mes</li><br>
                <li>Empleados internos se les otorga 4% de vales de despensa antes de impuestos</li><br>
            </ul>
            <br>
            <div id="line_decorativo">___________________________________________________________________</div><br>
            <input type='hidden' name='tipo_accion' value="INSERT">
            <input type="submit" value="Registrar" style="width:100px; height:28px;">
        </form>
        <form method='post' action='lista_cortes.php' target='contenedor'>
            <input id='boton_cancelar' type='submit' value='Cancelar'>
        </form>
    </div>
</body>

</html>