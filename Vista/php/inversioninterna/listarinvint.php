<?php
include_once('../../../Modelo/inversioninterna.php');
    $inversioninterna = new InversionInterna();
    $gettipo = $inversioninterna->gettipoint();
    $getestado = $inversioninterna->getestadoint();
    $getmodelo = $inversioninterna->getmodeloint();
    $getdispensador = $inversioninterna->getdispensadorint();
    setlocale(LC_ALL,"es_ES");
    $fecha = strftime("%Y-%m-%d");
$dataprod = $inversioninterna->Busquedainvint(0,'',0,0,0,0);
 ?>
<html lang="en">
<head>

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli_1.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
                                $("#datotxt").keyup(function() {
                                    //alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var op = $("#busqueda").val();
                                var tipo = $("#busqueda1").val();
                                var modelo=$("#busqueda2").val();
                                var estado=$("#busqueda3").val();
                                var dispensador=$("#busqueda4").val();
                                //var clas = $("#busqueda4").val();
                                var url = "Controladores/busqueda_dato.php?op=" + op  + "&dato=" +key+ "&tipo=" +tipo
                                + "&modelo=" +modelo+ "&estado=" +estado+ "&dispensador=" +dispensador;
                                $("#tabla-contenido").load(url);
                                });

                                $(".busqueda5").change(function() {
                                   // alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var op = $("#busqueda").val();
                                var tipo = $("#busqueda1").val();
                                var modelo=$("#busqueda2").val();
                                var estado=$("#busqueda3").val();
                                var dispensador=$("#busqueda4").val();
                                //var clas = $("#busqueda4").val();
                                var url = "Controladores/busqueda_dato.php?op=" + op  + "&dato=" +key+ "&tipo=" +tipo
                                + "&modelo=" +modelo+ "&estado=" +estado+ "&dispensador=" +dispensador;
                                $("#tabla-contenido").load(url);
                                });

                                $("#generarexcel").click(function(){
                                        window.location.href="../../../lib/PHPExcel-1.8/BanioGlobal.php";
                                });  
			});
</script>
<style>
    #container{
        margin: 0px 0px 25px 0px;
    }
 table{
        table-layout: auto;
        width:100%;
        max-width: 100%;
        
            }
               td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}
td:nth-child(4) {
    background-color:white;
}
td:nth-child(5) {
    background-color:white;
}
td:nth-child(6) {
    background-color:white;
}


 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 15px;
                font-weight: bold;
                    background-color:white;
            }
  
    th{
        text-align: center;
    }
    .botones{
    text-align: center;
    width: auto;
} 
</style>
   
</head>
<body>
  <div class="container">
         <center><img style="height:70px;" src="../../../img/logo2.png"><br>
          <h1>Listado de Inventario Interno</h1>
      </center>
      
      <div id="menu">
          <center>
          <table> 
          <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 15%; background-color: white;"><select class="busqueda5" name="busqueda" id="busqueda" style="width: auto; border-color: white" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> N°CODIGO </option>  
              <option value="2"> FECHA </option>           
              </select> </td>
          <td  colspan="2" style="width: 11%;  background-color: white;">
          <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
          <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Tipo:</td>
          <td><select class="busqueda5" id="busqueda1" style="width: auto; border-color: white" class="btn btn-block">
                <option value="0">Todas las anteriores</option>";   
                <?php
                    foreach($gettipo as $key => $value){
                        echo "<option value='".$gettipo[$key]['tipointid']."'>".
                        $gettipo[$key]['tipointdesc']."</option>";
                    }                            
                ?>           
                </select> </td>
          </tr>
                 <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Modelo:</td>
                  <td style="width: 15%; background-color: white;"><select class="busqueda5" id="busqueda2" style="width: auto; border-color: white" class="btn btn-block">
                  <option value="0">Todas las anteriores</option>";
                        <?php
                            foreach($getmodelo  as $key => $value){
                                echo "<option value='".$getmodelo [$key]['modelointid']."'>".
                                $getmodelo [$key]['modelointdesc']."</option>";
                            }                            
                        ?>
              </select> </td>
          
          <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Estado:</td>
          <td><select class="busqueda5" id="busqueda3" style="width: auto; border-color: white" c   lass="btn btn-block">
            <option value="0">Todas las anteriores</option>";
            <?php
                foreach($getestado as $key => $value){
                    echo "<option value='".$getestado[$key]['estadointid']."'>".
                    $getestado[$key]['estadointdesc']."</option>";
                }                            
                ?>
              </select> </td>

          <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Dispensador:</td>
          <td><select class="busqueda5" id="busqueda4" style="width: auto; border-color: white" class="btn btn-block">
            <option value="0">Todas las anteriores</option>";
            <?php
                foreach($getdispensador as $key => $value){
                    echo "<option value='".$getdispensador[$key]['dispensadorintid']."'>".
                    $getdispensador[$key]['dispensadorintdesc']."</option>";
                }                            
                ?>  
            </select> </td>    
          <tr> 
          </tr>
       </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido">
          <table style="width: 100%; max-width: 100%;">
              <tr>
              <td >N°</td>
              <td >Codigo</td>
              <td >Tipo</td>
              <td >Estado</td>
              <td >Modelo</td>
              <td >Fecha</td>
              <td >Opciones</td>
              </tr>
              <?php
              foreach($dataprod as $i => $value){
                  echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$dataprod[$i]["bodi_codigo"]."</td>";
                  echo "<td>".$dataprod[$i]["tipi_desc"]."</td>";
                  echo "<td>".$dataprod[$i]["esti_desc"]."</td>";
                  echo "<td>".$dataprod[$i]["modi_desc"]."</td>";
                  echo "<td>".$dataprod[$i]["bodi_fecha"]."</td>";
                    echo "<td>"
        . "<a target=_blank href='verinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a href='modificarinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
        . "<a href='imprimirinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"   
        . "<a href='eliminarinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>";
        //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
        echo "</tr>";
              }
              ?>
              
          </table>
      </div>
      <div class="botones">
                <button type="button" class="form-submit" id="agregarinventario" onclick="window.location.href='agregarinvint.php'">Agregar al Inventario</button>
                <button type="button" class="form-submit" id="generarexcel">Generar Excel</button>   
                <button type="button" class="form-submit" 
                onclick="window.location.href='../../index.php'">Volver al Inicio</button>
      </div>
  </div>
     <!-- JS -->
     <script src="../vendor/jquery/jquery.min.js"></script>
</body>
</html>