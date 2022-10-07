<?php
     session_start();
	
     require('../php/global.php');	
    // revisar si hay datos en el array post de peticion de borrado
     $idempleado =  "";
     $tipo_accion =  "";
	 $conexion = null;
	

	 if(isset($_POST['periodo']) && !empty($_POST['periodo']) && $_POST['periodo']!='1969-12-01') $_SESSION['periodo'] = $_POST['periodo'];	    
	 if(isset($_SESSION['periodo']) && !empty($_SESSION['periodo']) && $_SESSION['periodo']!='1969-12-01') $fecha = date("Y-m-d",strtotime($_SESSION['periodo']));
	 else $fecha = date("Y-m-d");

     $post = (isset($_POST['idempleado']) && !empty($_POST['idempleado'])) &&
              (isset($_POST['tipo_accion']) && !empty($_POST['tipo_accion']));

     if($post) {
       $idempleado = $_POST['idempleado'];
       $tipo_accion = $_POST['tipo_accion'];
       unset($_POST);

	   if($tipo_accion == "DELETE"){          						 	
	       $conexion = new  mysqli($conexion_servername, $conexion_username, $conexion_password, $conexion_database);    
	       if (mysqli_connect_errno()) {
			   echo "<script>alert('Lo sentimos, por el momento no tenemos servicio de conexión al servidor de bases de datos. Intente Acceder mas tarde')</script>"; 
		   }
	   	   else{		      
               $conexion->query("DELETE FROM empleados WHERE idempleado=".$idempleado); 
			   $conexion->query("DELETE FROM movimientos WHERE idempleado=".$idempleado); 
			   $conexion->query("DELETE FROM bitacora_cortes WHERE idempleado=".$idempleado);
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
        <div id="style_pestania" style="background:#464646;  padding-top: 12px;">Lista de Empleados</div>
        <form method='post' action='lista_movimiento.php' target="_self">
            <button id="style_pestania" style="left:202px; cursor:pointer;" type='submit'>Bitácora Movimientos</button>
        </form>
        <form method='post' action='lista_cortes.php' target="_self">
            <button id="style_pestania" style="left:404px; cursor:pointer;" type='submit'>Corte de Nómina</button>
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
			  $sql = "SELECT a.*,";
			  $sql .= "(SELECT COUNT(b.corte) FROM cortes b WHERE b.corte>='".$fecha_inicio."' AND b.corte<'".$fecha_final."') AS corte,";
			  $sql .= "(SELECT COUNT(b.idmovimiento) FROM movimientos b WHERE a.idempleado=b.idempleado AND ";
			  $sql .= "b.Fecha>='".$fecha_inicio."' AND b.Fecha<'".$fecha_final."') AS registro,";
			  $sql .= "IFNULL((SELECT SUM(cantidad_entrega) FROM movimientos b WHERE a.idempleado=b.idempleado AND ";
			  $sql .= "b.Fecha>='".$fecha_inicio."' AND b.Fecha<'".$fecha_final."'),0) AS entregas ";
			  $sql .=  "FROM empleados a ";
 
			  // configuraciones de filtros de busqueda
			  $filtro = "";
			  $post = (isset($_POST['busqueda']) && !empty($_POST['busqueda']));
              if($post){
				  $filtro = $_POST['busqueda'];
				  unset($_POST);
				  $sql .= " WHERE numero_empleado='".$filtro."' OR Nombre LIKE '%".$filtro."%'";
				  if(strtoupper($filtro) == "CHOFER") $sql .= " OR Rol=0";
				  if(strtoupper($filtro) == "CARGADOR") $sql .= " OR Rol=1";
				  if(strtoupper($filtro) == "AUXILIAR") $sql .= " OR Rol=2";

				  if(strtoupper($filtro) == "INTERNO") $sql .= " OR Tipo=0";
				  if(strtoupper($filtro) == "EXTERNO") $sql .= " OR Tipo=1";
			  }
			  $result = $conexion->query($sql);	

			  // visualizar el numero total de registros de empleados encontrados en la base de datos
			  echo "<script>document.getElementById('num_registros').innerHTML= '|&nbsp;&nbsp;Registros ".$result->num_rows."';</script>";

			  // inicializando tabla de registros
              echo "<div id='impresion_box'><table id='contenedor_lista'>
                      <tr style='background:#FFCCE6;'>
					     <th>ok</th>						 
						 <th> </th>
						 <th> </th>
                         <th>Número</th>
                         <th>Nombre de Empleado</th>
                         <th>Roles</th>
						 <th>Tipo</th>	
						 <th>Entregas</th>			 
                      </tr>";					  
					  while($row = $result->fetch_assoc()) {
						  $rol = "Chofer";
						  if($row['Rol'] == 1) $rol = "Cargador";
						  if($row['Rol'] == 2) $rol = "Auxiliar";

						  $tipo = "Interno";
						  if($row['Tipo'] == 1) $tipo = "Externo";

						  // poner circulo azul si tiene moviemientos registrados y circulo rojo si no tiene movimientos
						  if($row['corte'] != "0"){  
							    if($row['registro'] != "0")  $circulo = "<div id='circulo_blue'><div>";
								else $circulo = "<div id='circulo_red'><div>";	
						  }
						  else{ 								  
								$circulo = "<div id='ajuste_renglon'><form method='post' action='alta_movimiento.php' target='contenedor'>
							                <input type='hidden' name='idempleado' value='".$row['idempleado']."'>
											<input type='hidden' name='tipo_accion' value='LISTA_MOVIMIENTO'>
							                <input style='width:19px' type='image' src='../resource/icono_01.png' alt='Submit'>
						                    </form></div>";							  
						  }	
						  
						  echo "<tr>
						          <td style='width: 40px;'>".$circulo."</td>
								  <td style='width: 40px;'>
								     <div id='ajuste_renglon' onclick='confirmacion_delete_empleado(".$row['idempleado'].",\"".$row['Nombre']."\",\"".$row['numero_empleado']."\")'>
									    <img style='width:19px' src='../resource/icono_04.png'>							       
									 </div>
								  </td>
								  <td style='width: 40px;'>
								     <div id='ajuste_renglon'><form method='post' action='modificar_empleado.php' target='contenedor'>
									    <input type='hidden' name='idempleado' value='".$row['idempleado']."'>
									    <input type='hidden' name='numero' value='".$row['numero_empleado']."'>
									    <input type='hidden' name='nombre' value='".$row['Nombre']."'>
									    <input type='hidden' name='rol' value='".$row['Rol']."'>
									    <input type='hidden' name='tipo' value='".$row['Tipo']."'>
						                <input type='hidden' name='tipo_accion' value='EDIT'>
								   	    <input style='width:19px' type='image' src='../resource/icono_05.png' alt='Submit'>							       
									 </form></div>
							      </td>								  
						          <td style='text-align: center; width: 70px;'><b>".$row['numero_empleado']."</td>
                                  <td>".$row['Nombre']."</td>
								  <td style='text-align: center;'>".$rol."</td>
								  <td style='text-align: center;'>".$tipo."</td>
								  <td style='text-align: center;'><b>".$row['entregas']."</b></td>							  								 
						    </tr>";
							
							// formulario oculto para control de lista de registros	
			                $name_formulario = "eliminar_form_".$row['idempleado'];					
			                echo "<form name='".$name_formulario ."' method='post' action='' target='contenedor'>
			                        <input type='hidden' name='idempleado' value='".$row['idempleado']."'>
						            <input type='hidden' name='tipo_accion' value='DELETE'>	      
			                      </form>";
					  }					 
               echo "</table></div>";			 			 
		  }
    ?>
    <script>
    function confirmacion_delete_empleado(idempledo, empleado, numero) {
        if (confirm('¿Esta seguro de eliminar al empleado ' + numero + " - " + empleado +
                "?\n\nNota: Se eliminaran todos los movimientos y cortes existentes para ese empleado.")) {
            document.forms['eliminar_form_' + idempledo].submit();
        }
    }
    </script>
</body>

</html>