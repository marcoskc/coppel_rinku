<?php session_start(); ?>
<html>

<head>
    <title>Administracion RINKU</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/lista_trabajadores.css" />
</head>

<body>
    <div id="pestanias">
        <?php
        // sacar el periodo laboral corriendo
        if(isset($_POST['periodo']) && !empty($_POST['periodo'])) $_SESSION['periodo'] = $_POST['periodo'];	    
		if(isset($_SESSION['periodo']) && !empty($_SESSION['periodo']) && $_SESSION['periodo']!='1969-12-01') $fecha = date("Y-m-d",strtotime($_SESSION['periodo']));
        else $fecha = date("Y-m-d");
		unset($_POST);

         // sacar el periodo laboral corriendo
        setlocale(LC_TIME, "spanish");		
        $periodo_actual = strftime("%B de %Y", strtotime($fecha));
		
        $mes =  strftime("%m", strtotime($fecha));
        $year = strftime("%Y", strtotime($fecha));

		$fecha_atras = $year."-".($mes-1)."-01";
        $fecha_inicio = $year."-".$mes."-01";
        $fecha_final = $year."-".($mes+1)."-01";    
		$_SESSION['periodo'] = $fecha_inicio;     

		echo "     <div id='boton_atras'><form method='post' action='' target='contenedor'>
			            <input type='hidden' name='periodo' value='".$fecha_atras."'>
						<input type='submit' value='<' style='width:25px; height:20px;'>
			       </form></div>
		           <div id='text_periodo'><b>Periodo: ".$periodo_actual."</b></div>
				   <div id='boton_adelante'><form method='post' action='' target='contenedor'>
			            <input type='hidden' name='periodo' value='".$fecha_final."'>
						<input type='submit' value='>' style='width:25px; height:20px;'>
			       </form></div>";
	?>
        <form method='post' action='lista_trabajadores.php' target="_self">
            <button id="style_pestania" style="left:0px;  cursor:pointer;" type='submit'>Lista de Empleados</button>
        </form>
        <form method='post' action='lista_movimientos.php' target="_self">
            <button id="style_pestania" style="left:202px; cursor:pointer;" type='submit'>Bitacora Movimientos</button>
        </form>
        <div id="style_pestania" style="background:#464646; left:404px; padding-top: 12px;">Corte de Nómina</div>
        <div id="barra_busqueda">
            <form method='post' action='' target='contenedor'>
                <label id="num_registros">|&nbsp;&nbsp;Registros 0</label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp; Busqueda
                &nbsp;
                <input type="text" name="busqueda"
                    style="position:relative; top:-3px; width:150px; height:24px;"></label>
                <input type='image' style="position:relative; top:3px;" ; src='../resource/icono_03.png' alt='Submit'>
                &nbsp;&nbsp;
            </form>
        </div>
    </div>
    <?php 
	      require('../php/global.php');	
		  $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
		  if (mysqli_connect_errno()) {
			  echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		  }
		  else{			 	 
			  $sql = "SELECT a.*,b.numero_empleado,b.Nombre ";
			  $sql .=  "FROM cortes a LEFT JOIN empleados b ON a.idempleado=b.idempleado ";
			  $sql .=  "WHERE a.corte>='".$fecha_inicio."' AND a.corte<'".$fecha_final."'";			  
			  // configuraciones de filtros de busqueda
			  $filtro = "";
			  $post = (isset($_POST['busqueda']) && !empty($_POST['busqueda']));
              if($post){
				  $filtro = $_POST['busqueda'];
				  unset($_POST);
				  $sql .= " AND b.numero_empleado='".$filtro."' OR b.Nombre LIKE '%".$filtro."%'";
			  }		  
			  $result = $conexion->query($sql);	
			  // visualizar el numero total de registros encontrados en la base de datos
			  echo "<script>document.getElementById('num_registros').innerHTML= '|&nbsp;&nbsp;Registros ".$result->num_rows."';</script>";

			  // inicializando tabla de registros
			  
              echo "<div id='impresion_box'><table id='contenedor_lista'>
                      <tr style='background:#FFCCE6;'>
						 <th>Numero</th>
                         <th>Empleado</th>
                         <th>Expedido</th>
                         <th>Corte</th>
						 <th>Base Hora</th>
						 <th>dia trabajado</th>
						 <th>dia ausente</th>
						 <th>Base</th>
						 <th>Compensacion</th>
						 <th>Bonos</th>
						 <th>Sueldo Bruto</th>
						 <th>ISR</th>
						 <th>Sueldo Neto</th>
						 <th>Vales</th>												 
                      </tr>";					  
					  while($row = $result->fetch_assoc()) {
						   echo " <td style='text-align: center;'><b>".$row['numero_empleado']."</b></td>							  
						          <td><b>".$row['Nombre']."</td>
                                  <td style='text-align: center;'>".$row['expedido']."</td>
								  <td style='text-align: center;'>".$row['corte']."</td>
								  <td style='text-align: center;'>".moneda($row['sueldo_base_hora'])."</td>	
								  <td style='text-align: center;'>".$row['dias_trabajados']."</td>								 						  								 
								  <td style='text-align: center;'>".$row['dias_ausentes']."</td>	
								  <td style='text-align: center;'>".moneda($row['importe_base'])."</td>	
								  <td style='text-align: center;'>".moneda($row['compensacion'])."</td>	
								  <td style='text-align: center;'>".moneda($row['bonos_entregas'])."</td>
								  <td style='text-align: center;'>".moneda($row['sueldo_bruto'])."</td>
								  <td style='text-align: center;'>".moneda($row['ISR'])."</td>
								  <td style='text-align: center;'>".moneda($row['sueldo_neto'])."</td>
								  <td style='text-align: center;'>".moneda($row['vales_despensa'])."</td>
						    </tr>";
					  }					 
               echo "</table></div>";			 			 
		  }
    ?>
    <script>
    function confirmacion_delete_movimiento(idmovimiento, empleado, numero) {
        if (confirm("¿Esta seguro de eliminar al movimiento con Folio " + idmovimiento + " del empleado " + numero +
                " - " + empleado + "?")) {
            document.forms['eliminar_form_' + idmovimiento].submit();
        }
    }
    </script>
</body>

</html>