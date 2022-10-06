<?php	
   error_reporting(E_ERROR | E_PARSE | E_NOTICE);  // quitar warning
   //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   $conexion_servername = "localhost";	
   $conexion_username = "root";	
   $conexion_password = "root"; 
   $conexion_database = "coppel_rinku";


   function moneda($number)
   {     
      $formato = explode(".", strval($number));
      $entero = $formato[0];
      $decimal = $formato[1];
     
      $str = strval($entero);
      $contador = 0;
      $entero = "";
      for($i=strlen($str)-1; $i>=0 ; $i--){
         if($contador == 3){
            $contador=0;
            $entero = ",".$entero;
         }
         $entero = $str[$i].$entero;
         $contador++;         
      }
      return "$".$entero.".".$decimal;
   }
?>