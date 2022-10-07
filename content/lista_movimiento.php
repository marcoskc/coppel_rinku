<?php
     session_start();
     require('../php/global.php');	
    // revisar si hay datos en el array post de peticion de borrado
     $idempleado =  "";
     $tipo_accion =  "";
	 $conexion = null;
	 $filtro = "";

	 if(isset($_POST['busqueda']) && !empty($_POST['busqueda'])) $filtro = $_POST['busqueda'];	 
	 if(isset($_POST['periodo']) && !empty($_POST['periodo'])) $_SESSION['periodo'] = $_POST['periodo'];	    
	 if(isset($_SESSION['periodo']) && !empty($_SESSION['periodo']) && $_SESSION['periodo']!='1969-12-01') $fecha = date("Y-m-d",strtotime($_SESSION['periodo']));
	 else $fecha = date("Y-m-d");

     $post = (isset($_POST['idmovimiento']) && !empty($_POST['idmovimiento'])) &&
              (isset($_POST['tipo_accion']) && !empty($_POST['tipo_accion']));

     if($post) {
       $idmovimiento = $_POST['idmovimiento'];
       $tipo_accion = $_POST['tipo_accion'];
       unset($_POST);

	   if($tipo_accion == "DELETE"){          						 	
	       $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	       if (mysqli_connect_errno()) {
			   echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		   }
	   	   else{		      
			   $conexion->query("DELETE FROM movimientos WHERE idmovimiento=".$idmovimiento); 			   
            }
     	}
     }
	 unset($_POST);
?>

<html>

<head>
    <title>Administración RINKU</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/lista_trabajadores.css" />
</head>

<body>
    <div id="pestanias">
        <?php
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
				  <div id='text_periodo'><b>Período: ".$periodo_actual."</b></div>
				  <div id='boton_adelante'><form method='post' action='' target='contenedor'>
					   <input type='hidden' name='periodo' value='".$fecha_final."'>
					   <input type='submit' value='>' style='width:25px; height:20px;'>
				  </form></div>";
	?>

        <form method='post' action='lista_trabajadores.php' target="_self">
            <button id="style_pestania" style="left:0px;  cursor:pointer;" type='submit'>Lista de Empleados</button>
        </form>
        <div id="style_pestania" style="background:#464646; left:202px; padding-top: 12px;">Bitácora Movimientos</div>
        <form method='post' action='lista_cortes.php' target="_self">
            <button id="style_pestania" style="left:404px;  cursor:pointer;" type='submit'>Corte de Nómina</button>
        </form>
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
	      // realizar conexion con la base de datos si no existe anteriormente
		  if(!isset($conexion))  $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
		  if (mysqli_connect_errno()) {
			  echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		  }
		  else{			 	 
			  $sql = "SELECT a.*,b.numero_empleado,b.Nombre ";
			  $sql .=  "FROM movimientos a LEFT JOIN empleados b ON a.idempleado=b.idempleado ";
			  $sql .=  "WHERE a.Fecha>='".$fecha_inicio."' AND a.Fecha<'".$fecha_final."'";
			  
			  // configuraciones de filtros de busqueda
              if($filtro != ""){
				  $sql .= " AND (b.numero_empleado='".$filtro."' OR b.Nombre LIKE '%".$filtro."%')";
			  }		  
			  $result = $conexion->query($sql);	

			  // visualizar el numero total de registros de movimientos encontrados en la base de datos
			  echo "<script>document.getElementById('num_registros').innerHTML= '|&nbsp;&nbsp;Registros ".$result->num_rows."';</script>";

			  // inicializando tabla de registros
              echo "<div id='impresion_box'><table id='contenedor_lista'>
                      <tr style='background:#FFCCE6;'>					 
						 <th> </th>
						 <th> </th>
						 <th>Folio</th>
                         <th>Empleado</th>
						 <th>Expedido</th>
                         <th>Fecha Entrega</th>                        
						 <th>Entregas</th>	
						 <th>Turno</th>
						 <th>Corte aplicado</th>
                      </tr>";					  
					  while($row = $result->fetch_assoc()) {
						  $turno = "No aplica";
						  if($row['cubre_turno'] == 1) $turno = "Chofer";
						  if($row['cubre_turno'] == 2) $turno = "Cargador";
				
						  echo "<tr>";
						  $corte = "No";
						  if($row['corte'] != 0){ 
							  $corte = "Si";
							  echo"<td style='width: 0px;'></td>
							       <td style='width: 0px;'></td>";
						  }
						  else{
							echo"<td style='width: 40px;'>
							        <abbr title='Eliminar entrega de ".$row['Nombre']." folio ".$row['idmovimiento']."'>
							        <div id='ajuste_renglon' onclick='confirmacion_delete_movimiento(".$row['idmovimiento'].",\"".$row['Nombre']."\",\"".$row['numero_empleado']."\")'>
							            <img style='width:19px' src='../resource/icono_02.png'>							       
						       	    </div>
									</abbr>
						         </td>
						         <td style='width: 40px;'>
								    <abbr title='Modificar entrega de ".$row['Nombre']." folio ".$row['idmovimiento']."'>
							        <div id='ajuste_renglon'><form method='post' action='modificar_movimiento.php' target='contenedor'>
							        <input type='hidden' name='idmovimiento' value='".$row['idmovimiento']."'>
									<input type='hidden' name='idempleado' value='".$row['idempleado']."'>
							        <input type='hidden' name='Fecha' value='".$row['Fecha']."'>
							        <input type='hidden' name='cantidad_entrega' value='".$row['cantidad_entrega']."'>
							        <input type='hidden' name='turno' value='".$row['cubre_turno']."'>
							        <input type='hidden' name='tipo_accion' value=''>	
								    <input style='width:19px' type='image' src='../resource/icono_06.png' alt='Submit'>							       
							        </form></div>
									</abbr>
						         </td>";
						   }			  						       									
						   echo " <td style='text-align: center;'><b>".$row['idmovimiento']."</b></td>							  
						          <td><b>(".$row['numero_empleado'].") ".$row['Nombre']."</td>                                  
								  <td style='text-align: center;'>".$row['Expedido']."</td>
								  <td style='text-align: center;'>".$row['Fecha']."</td>
								  <td style='text-align: center;'><b>".$row['cantidad_entrega']."</b></td>	
								  <td style='text-align: center;'>".$turno."</td>
								  <td style='text-align: center;'>".$corte."</td>								 						  								 
						    </tr>";
							
							// formulario oculto para control de lista de registros	
			                $name_formulario = "eliminar_form_".$row['idmovimiento'];
			                echo "<form name='".$name_formulario ."' method='post' action='' target='contenedor'>
			                        <input type='hidden' name='idmovimiento' value='".$row['idmovimiento']."'>
						            <input type='hidden' name='tipo_accion' value='DELETE'>    
			                      </form>";
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