<?php
/*session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
} */
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Tipo_Factura.php');
include_once('../../../Modelo/Facturacion.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

$op=$_GET["op"];
$tipf=new Tipo_Factura();
$datotipf=$tipf->listarTipFactura();
$datoestf=$tipf->listarEstFactura();
$fact = new Facturacion();

?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Listar Facturas - Sistema Salitrera Irma Ltda</title>
    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
   $(document).ready(function() {
       
       $("#dos").hide();
                               
                                $(".busqueda").change(function() {
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var estf= $("#estf").val();
                                var fecha = $("#fecha").val();
                                var tipfc = $("#tipf").val();
                                var exc = $("#exc").val();
                                var emirec = $("#emirec").val();

                               // alert("tipo: "+tipo+" txt: "+key+" estf: "+estf+" fecha: "+fecha+" tipfc: "+tipfc+" exc: "+exc+" emirec "+emirec);

                                var url = "Ctrl/ctrl_busquedaFacturaDato.php?op="+tipo+"&dato=" +key+"&estf="+estf+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+exc+"&emirec="+emirec;
                                $("#tabla-contenido").load(url);
                                });
                                
                                /*   
                                $("#tipf").change(function() {
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var fecha = $("#fecha").val();
                                var exc = $("#exc").val();
                                var emirec = $("#emirec").val();
                                var url = "Ctrl/ctrl_busquedaFacturaDato.php?op="+tipo+"&dato=" + txt+"&estf="+estfc+"&tipf="+this.value+"&fecha="+fecha+"&exc="+exc+"&emirec="+emirec;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#fecha").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var exc = $("#exc").val();
                                    var emirec = $("#emirec").val();
                                var url = "Ctrl/ctrl_busquedaFacturaDato.php?op="+tipo+"&dato=" + txt+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+this.value+"&exc="+exc+"&emirec="+emirec;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#exc").change(function() {
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var fecha = $("#fecha").val();
                                var emirec = $("#emirec").val();
                                var url = "Ctrl/ctrl_busquedaFacturaDato.php?op="+tipo+"&dato=" + txt+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+this.value+"&emirec="+emirec;
                                $("#tabla-contenido").load(url);
                                });

                                $("#busqueda").change(function() {
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var fecha = $("#fecha").val();
                                var exc = $("#exc").val();
                                    var emirec = $("#emirec").val();
                                var url = "Ctrl/ctrl_busquedaFacturaDato.php?op=" + this.value  + "&dato=" + txt+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+exc+"&emirec="+emirec;
                                $("#tabla-contenido").load(url);
                                });

                                */
                                
                                $("#datotxt").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var estf= $("#estf").val();
                                var fecha = $("#fecha").val();
                                var tipfc = $("#tipf").val();
                                var exc = $("#exc").val();
                                var emirec = $("#emirec").val();  
                                
                                var url = "Ctrl/ctrl_busquedaFacturaDato.php?op="+tipo+"&dato="+key+
                                "&estf="+estf+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+exc+"&emirec="+emirec;
                                $("#tabla-contenido").load(url);
                                });

                                $("#generarexcel").click(function(){
                                var dato= $("#datotxt").val();
                                var op= $("#busqueda").val();
                                var op= $("#busqueda").val();
                                
                                if(op==0){
                                var op=99;
                                        window.location.href="../../../../lib/PHPExcel-1.8/PagoMensualExcel.php?dato="+dato+"&&op="+op;
                                }else{
                                        window.location.href="../../../../lib/PHPExcel-1.8/PagoMensualExcel.php?dato="+dato+"&&op="+op;
                                }
                            }); 
			});
                         
                        function AbrirMensajeBorrar(id, cod, op){
                            var codfact=cod;
                              var idfact=id;
                              var opcion=op
                            $("#dos").empty();
                            $("#dos").show();
                            $("#dos").append(" <center><p style='color:red; font-weight: bold;font-size: 16px'>¿Estas seguro en Eliminar La Factura Nº "+codfact+" seleccionada?</p>"
                                    +" <b>Los Datos y Archivo Seran Eliminados de la Base de datos y del servidor</b><br>"
                                    +" <input type='button' class='form-submit' onclick=window.location.href='Ctrl/ctrl_borrarFactura.php?id="+idfact+"&op="+opcion+"' style='margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;' value='Si, Eliminar Factura'/> <input type='button' class='form-submit' onclick='CerrarMensajeBorrar()' style='margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;' value='No, Cerrar Mensaje' /> </center><br>");
                        }
                        function CerrarMensajeBorrar(){
                            
                            $("#dos").empty();
                            $("#dos").hide();
                        }
</script>
<style>

table{
    table-layout: auto;
    width:100%;
    max-width: 100%;
        
    }
    td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
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
 
#dos{
        
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:white;
        border-style: solid;
        border-color: red;
        border-width: 1px;
        
    }

    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}
 
</style>
   
</head>
<body>
    <?php
    switch ($op){
        case 1:
            $data = $fact->ListarFacturasFullEmiRec("EMITIDA");
    ?>
  <div class="container">
      <img class="logo" src="../../../img/logo2.png"><br>
      <center>
          <h1>Listado de Facturas Emitidas</h1>
      </center>
      <div id="menu">
          <input type="hidden" id="emirec" name="emirec" value="EMITIDA">
          <center>
          <table style="width: 100%; max-width: 100%;"> 
              <tr>
                  <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 11%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
<!----------------- CAMBIE EL VALOR A 99 ---------------------------------------------->
              <option value="99"> N° FACTURA </option>  
<!----------------- CAMBIE EL VALOR A 99 ---------------------------------------------->
              <option value="2"> N° ORDEN DE COMPRA </option>
              <option value="3"> RUT RAZON SOCIAL </option>
              <option value="4"> RAZON SOCIAL </option>
              </select> </td>
              <td style="width: 11%;  background-color: white;" colspan="2"> <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">ESTADO:</td>
              <td style="width: 11%; background-color: white;"><select name="estf" id="estf" style="width: auto; border-color: black" class="btn btn-block busqueda">
              <option value="99"> Selecciona Una Opcion </option>
              <?php
              foreach($datoestf as $key=>$value){
                  if($datoestf[$key]["estfnom"]=="PENDIENTE"){
                   echo "<option value=".$datoestf[$key]["estfcod"] ." selected>".$datoestf[$key]["estfnom"] ."</option>";
                  }else{
                   echo "<option value=".$datoestf[$key]["estfcod"] .">".$datoestf[$key]["estfnom"] ."</option>";     
                  } 
              }
              ?>
              </select> </td>
              <tr>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">FECHA:</td>
              <td style="width: 11%; background-color: white;"><input type="date" name="fecha" id="fecha" style="width: auto; border-color: black" class="btn btn-block" value="<?php echo $fecha?>">   
              </td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">TIPO FACTURA:</td>
              <td style="width: 11%; background-color: white;"><select name="tipf" id="tipf" style="width: auto; border-color: black" class="btn btn-block busqueda">
              <option value="99"> Selecciona Una Opcion </option>
              <?php
              foreach($datotipf as $key=>$value){
                  echo "<option value=".$datotipf[$key]["tfcod"] .">".$datotipf[$key]["tfnom"] ."</option>";
              }
              ?>
              </select> </td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">EXCENTO:</td>
              <td style="width: 11%; background-color: white;"><select name="exc" id="exc" style="width: auto; border-color: black" class="btn btn-block busqueda">
              <option value="99"> Selecciona Una Opcion </option>
              <option value="OP"> CON/Excento </option>
              <option value="NO"> SIN/Excento </option>
              </select> </td>
          </tr>
          <tr>
          <td style="background-color: white;" colspan="6">
          <input type="button" name="EdEst" id="EdEst" class="form-submit" onclick="window.location.href='CambiaEstadoFact.php?op=1'" value="Cambiar Estado"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          <input type="button" class="form-submit" onclick="window.location.href='CargaLibroExcel.php'" value="Carga libro excel"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/> 
          <input type="button" class="form-submit" onclick="window.location.href='../../../lib/PHPExcel-1.8/Facturas.php'" value="Exportar Facturas"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>   
          <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
         <!-- <input type="button" id="Genexcels" class="form-submit generarexcel" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="-"> -->
          </td>
          </tr>
              
       </table>
          </center>
      </div>
      
         <div id='dos'>
                               
        </div>
      
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
          <table style="width: 100%; max-width: 100%;">
              <tr>
              <td >N° Factura </td>
              <td >N° Orden de Compra </td>
              <td >RUT Razon Social </td>
              <td >Nombre Razon Social </td>
              <td >Fecha Ingreso SII </td>
              <td >Tipo Factura</td>
              <td >Estado</td>
              <td >Valor Total</td>
               <td >IVA</td>
              <td >Opciones</td>
              </tr>
             <?php
              $i = 0;
    while ($i < count($data)) {

        echo "<tr>";
        echo "<td>" . $data[$i]["idfact"] . "</td>";
        if ($data[$i]["numorden"] == NULL) {
            echo "<td> - </td>";
        } else {
            echo "<td>" . $data[$i]["numorden"] . "</td>";
        }
        echo "<td>" . $data[$i]["rsrut"] . "</td>";
        echo "<td>" . $data[$i]["rsnom"] . "</td>";
        echo "<td>" . $data[$i]["fSII"] . "</td>";
        echo "<td>" . $data[$i]["tipfnom"] . "</td>";
       if($data[$i]["codestf"]==0){
         echo "<td style='color:     orange'>" . $data[$i]["estfact"] . "</td>";   
        }
        else if($data[$i]["codestf"]==1){
            echo "<td style='color:     blue'>" . $data[$i]["estfact"] . "</td>";
        }
        else if($data[$i]["codestf"]==2){
            echo "<td style='color:     red'>" . $data[$i]["estfact"] . "</td>";
        }else{
            echo "<td >" . $data[$i]["estfact"] . "</td>";
        }
        echo "<td>$" . number_format($data[$i]["total"], 0, ",", ".") . "</td>";
        if ($data[$i]["exc"] == "NO") {
            echo "<td>$" . number_format($data[$i]["iva"], 0, ",", ".") . "</td>";
        } else {
            echo "<td> - </td>";
        }
        echo "<td>"
        . "<a target=_blank href='VistaArchivoPDF.php?nom=" . $data[$i]["archnom"] . "&id=".$data[$i]["factid"]."&sal=1'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a href='EditarFacturas.php?id=".$data[$i]["factid"]."&nom=" . $data[$i]["archnom"]."&op=1'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
        . "<a href='CambiaEstadoFact.php?id=" . $data[$i]["factid"] . "&op=3'><img src='../../../img/icon/est.png' width='20px' height='20px'></a>"
                . "<a target=_blank href='../Facturas/ArchivosPDF/" . $data[$i]["archnom"]."'><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"   
        . "<a style='cursor:pointer;' onclick='AbrirMensajeBorrar(".$data[$i]["factid"].",".$data[$i]["idfact"].",1)'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>";
        //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
        echo "</tr>";
        $i++;
    }        
             ?>
              
              
              
              
          </table>
          
      </div>
  </div>
     <?php
     break;
        case 2: 
            $data = $fact->ListarFacturasFullEmiRec("RECIBIDA");
            ?>
      <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Facturas Recibidas</h1>
      </center>
      <div id="menu">
          <input type="hidden" id="emirec" name="emirec" value="RECIBIDA">
          <center>
          <table style="width: 100%; max-width: 100%;"> 
              <tr>
                  <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 11%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> N° FACTURA </option>
              <option value="2"> N° ORDEN DE COMPRA </option>
              <option value="3"> RUT RAZON SOCIAL </option>
              <option value="4"> RAZON SOCIAL </option>
              <option value="5"> LUGAR </option>
              <option value="6"> DESCRIPCION </option>
              </select> </td>
              <td style="width: 11%;  background-color: white;" colspan="2"> <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">ESTADO:</td>
              <td style="width: 11%; background-color: white;"><select name="estf" id="estf" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <?php
              foreach($datoestf as $key=>$value){
                  echo "<option value=".$datoestf[$key]["estfcod"] .">".$datoestf[$key]["estfnom"] ."</option>";
              }
              ?>
              </select> </td>
              <tr>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">FECHA:</td>
              <td style="width: 11%; background-color: white;"><input type="date" name="fecha" id="fecha" style="width: auto; border-color: black" class="btn btn-block">               </td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">TIPO FACTURA:</td>
              <td style="width: 11%; background-color: white;"><select name="tipf" id="tipf" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <?php
              foreach($datotipf as $key=>$value){
                  echo "<option value=".$datotipf[$key]["tfcod"] .">".$datotipf[$key]["tfnom"] ."</option>";
              }
              ?>
              </select> </td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">EXCENTO:</td>
              <td style="width: 11%; background-color: white;"><select name="exc" id="exc" style="width: auto; border-color: black" class="btn btn-block">
              <option value=""> Selecciona Una Opcion </option>
              <option value="SI"> CON/Excento </option>
              <option value="NO"> SIN/Excento </option>
              </select> </td>
          </tr>
          <tr>
          <td style="background-color: white;" colspan="6">
          <input type="button" name="EdEst" id="EdEst" class="form-submit" onclick="window.location.href='CambiaEstadoFact.php?op=2'" value="Cambiar Estado"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          </td>
          </tr>
              
       </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
          <table style="width: 100%; max-width: 100%;">
              <tr>
              <td >N° Factura </td>
              <td >N° Orden de Compra </td>
              <td >RUT Razon Social </td>
              <td >Nombre Razon Social </td>
              <td >Fecha Ingreso SII </td>
              <td >Tipo Factura</td>
              <td >Estado</td>
              <td >Valor Total</td>
              <td >IVA</td>
              <td >Opciones</td>
              </tr>
               <?php
              $i = 0;
    while ($i < count($data)) {

        echo "<tr>";
        echo "<td>" . $data[$i]["idfact"] . "</td>";
        if ($data[$i]["numorden"] == NULL) {
            echo "<td> - </td>";
        } else {
            echo "<td>" . $data[$i]["numorden"] . "</td>";
        }
        echo "<td>" . $data[$i]["rsrut"] . "</td>";
        echo "<td>" . $data[$i]["rsnom"] . "</td>";
        echo "<td>" . $data[$i]["fSII"] . "</td>";
        echo "<td>" . $data[$i]["tipfnom"] . "</td>";
        if($data[$i]["codestf"]==0){
         echo "<td style='color:     orange'>" . $data[$i]["estfact"] . "</td>";   
        }
        else if($data[$i]["codestf"]==1){
            echo "<td style='color:     blue'>" . $data[$i]["estfact"] . "</td>";
        }
        else if($data[$i]["codestf"]==2){
            echo "<td style='color:     red'>" . $data[$i]["estfact"] . "</td>";
        }else{
            echo "<td >" . $data[$i]["estfact"] . "</td>";
        }
        echo "<td>$" . number_format($data[$i]["total"], 0, ",", ".") . "</td>";
        if ($data[$i]["exc"] == "NO") {
            echo "<td>$" . number_format($data[$i]["iva"], 0, ",", ".") . "</td>";
        } else {
            echo "<td> - </td>";
        }
        echo "<td>"
       . "<a target=_blank href='VistaArchivoPDF.php?nom=" . $data[$i]["archnom"] . "&id=".$data[$i]["factid"]."&sal=1'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a href='EditarFacturas.php?id=".$data[$i]["factid"]."&nom=" . $data[$i]["archnom"]."&op=2'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
        . "<a href='CambiaEstadoFact.php?id=" . $data[$i]["factid"] . "&op=4'><img src='../../../img/icon/est.png' width='20px' height='20px'></a>"
        . "<a target=_blank href='../Facturas/ArchivosPDF/" . $data[$i]["archnom"]."'><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"        
         . "<a style='cursor:pointer;' onclick='AbrirMensajeBorrar(".$data[$i]["factid"].",".$data[$i]["idfact"].",2)'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>";      
//."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
        echo "</tr>";
        $i++;
    }        
             ?>
              
              
              
              
              
          </table>
          
      </div>
  </div>
            <?php
    
            break;
        default:
            echo "Error";
            break;
              }
    ?>
     <!-- JS -->
</body>
</html>