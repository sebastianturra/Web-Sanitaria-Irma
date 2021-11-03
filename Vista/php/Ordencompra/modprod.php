<?php
//SE CONECTA LA BASE DE DATOS
$enlace = mysqli_connect("pdb44.awardspace.net", "3217706_db", "K2+pachun", "3217706_db");

if (!$enlace) {
  echo "<div display='none'>
    <script type='text/javascript'>
        console.log('<br>Error: No se pudo conectar a MySQL.<br>');
    </script>
</div>";
}

//ESCRIBE EN LA CONSOLA QUE SE CONECTO CORRECTAMENTE.
echo "<div display='none'>
    <script type='text/javascript'>
        console.log('<br>Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial.<br>');
    </script>
</div>";
$campo=0;
$errores=0;
$NUMERO=168;
for($i=0;$i<237;$i++){
$ingfac = "UPDATE `productos_bodega` SET ";
            $ingfac.="PROB_ID='".$NUMERO."' ";
            $ingfac.="WHERE PROB_CODIGO='".$NUMERO."'";
                //  echo "<br>".$ingfac."<br>";
                      
           $result = $enlace->query($ingfac);
             if (!$result){ echo "<div display='none'>
              <script type='text/javascript'>
                  console.log('<br>Error al insertar registro factura<br>');
              </script>
          </div>".$campo;$errores+=1;} 
    ++$NUMERO;    
}
///////////////////////////////////////////////////////////////////////////////////
      echo "<br><hr> <div class='col-xs-12'>
        <div class='form-group'>
          <strong><center>ARCHIVO MODIFICADO EN TOTAL LOS REGISTROS Y $errores ERRORES</center></strong>
        </div>
      </div> 
      <br> ";  
?>