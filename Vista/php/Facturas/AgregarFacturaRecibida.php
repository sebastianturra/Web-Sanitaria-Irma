<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Tipo_Factura.php');
include_once('../../../Modelo/Tipo_Servicios.php');
setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");
$tfac=new Tipo_Factura();
$tipsf=new Tipo_Servicios();
$datofact=$tfac->listarTipFactura();
$datotip=$tipsf->listarTipServicio();
$datoestf=$tfac->listarEstFactura();
?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Agregar Facturas - Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
          table{
            table-layout: auto;
        width:50%;
        max-width: 100%;
        
            }
   td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}

td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}

td:nth-child(5) {
    background-color:whitesmoke;
    font-weight: bold;
}

    td:nth-child(2) {
    background-color:white;
}
    td:nth-child(4) {
    background-color:white;
}
td:nth-child(6) {
    background-color:white;
}
 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 12px
            }

            .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}

</style>
<script>
$(document).ready(function(){
    
    $("#menu").hide();
    $("#idfact").val("");
            $("#ordencomp").val("");
            $("#rsrut").val("");
            $("#rsnom").val("");
            $("#rslugar").val("");
            $("#desfact").val("");
            $("#fSII").val("");
            $("#vneto").val("");
            $("#iva").val("");
            $("#vtotal").val("");  
            $("#ArchivoPDF").val("");  
            $("#exc").val("");  
            $("#ocom").val("");  
                    
                    
    $("#tipf").change(function(){
        var op=this.value;
        if(op.length>0){
        $("#menu").show();
        }else{
            $("#menu").hide();
            $("#idfact").val("");
            $("#ordencomp").val("");
            $("#rsrut").val("");
            $("#rsnom").val("");
            $("#rslugar").val("");
            $("#desfact").val("");
            $("#fSII").val("");
            $("#vneto").val("");
            $("#iva").val("");
            $("#vtotal").val("");  
            $("#ArchivoPDF").val("");  
            $("#exc").val("");  
            $("#ocom").val("");  
                    
         }     
    
    });
    $("#ocom").change(function(){
        var op=this.value;
        switch(op){
            case "SI":
                $("#ordencomp").removeAttr("disabled");
                break;
            case "NO":
                $("#ordencomp").val("");
                $("#ordencomp").attr("disabled",true);
               
                break;
            default:
                $("#ordencomp").val("");
                $("#ordencomp").attr("disabled",true);
                
                break;
        }
        
       });
       

        $("#vneto").change(function(){
        var vneto= $("#vneto").val();
        var iva;
        var vtotal;
        var op=$("#exc").val();
        if(op=="SI"){
            $("#iva").val(0);
            $("#vtotal").val(vneto);
        }else{
            iva= parseInt(parseInt(vneto) * 0.19);
            $("#iva").val(iva);
            vtotal= parseInt(parseInt(vneto)+parseInt(iva));
            $("#vtotal").val(vtotal);
        }
        
        
       });
       
        $("#exc").change(function(){
          //  alert(this.value);
        var op= this.value;
        var vtotal;
        var iva;
        var vneto= $("#vneto").val();
        
        if(op==="SI"){
            //alert("1");
            $("#iva").val(0);
            
             $("#vtotal").val(vneto);
        }else{
            //alert("2");
            iva= parseInt(parseInt(vneto) * 0.19);
            $("#iva").val(iva);
            vtotal= parseInt(parseInt(vneto)+parseInt(iva));
            $("#vtotal").val(vtotal);     
            
        }
        
       
       });
       
    
  
       
          
});
  

</script>
   
</head>
<body>
          <img class="logo" src="../../../img/logo2.png"><br>
      
  <div class="container">
    <center><h1>Registro Respaldo Facturas Recibidas</h1></center>
       <!--<form method="get" action="Ctrl/ctrl_agregarFactura.php" enctype="multipart/form-data">-->
      <form method="post" action="Ctrl/ctrl_agregarFactura.php" enctype="multipart/form-data">
      <input type="hidden" id="emirec" name="emirec" value="RECIBIDA">
          <center>
          <table>
              <tr>
                  <td>Tipo de Factura</td>
                  <td><select id="tipf" name="tipf" class="btn btn-block">
                          <option value="">Seleccione una Opcion</option>
                     <?php
                     foreach($datofact as $key => $value ){
                        echo" <option value=".$datofact[$key]['tfcod'].">".$datofact[$key]['tfnom']."</option>";
                     }
                     
                     ?>    
                      </select></td>        
              </tr>
              <tr>
                  <td>Orden de compra</td>
                  <td><select id="ocom" name="ocom" class="btn btn-block">
                          <option value="">Seleccione una Opcion</option>
                          <option value="NO">SIN/Orden de Compra</option>
                          <option value="SI">CON/Orden de Compra</option>
                      </select></td>        
              </tr>
              <tr>
                  <td>Excento</td>
                  <td><select id="exc" name="exc" class="btn btn-block">
                          <option value="">Seleccione una Opcion</option>
                          <option value="NO">SIN/Exento</option>
                          <option value="SI">CON/Exento</option>
                      </select></td>        
              </tr>
          </table>
          <div id="menu">
          <table>
          <tr>
          <td>CODIGO FACTURA:</td>
          <td><input type="text" name="idfact" id="idfact" placeholder="Ingrese el Codigo de Factura" maxlength="10"></td>
          </tr>
          <tr>
          <td>N° ORDEN DE COMPRA: </td>
          <td><input type="text" name="ordencomp" id="ordencomp" placeholder="Ingrese el Numero de Orden de Compra" disabled></td>
          </tr>
          <tr>
          <td>RUT RAZON SOCIAL: </td>
          <td><input type="text" name="rsrut" id="rsrut" placeholder='Ejemplo: 16226980-1'></td>
          </tr>
          <tr>
          <td>NOMBRE RAZON SOCIAL: </td>
          <td><input type="text" name="rsnom" id="rsnom" placeholder='Ingrese el Numbre de la razon social'></td>
          </tr>
          <tr>
          <td>DIRECCION/LUGAR: </td>
          <td><input type="text" name="rslugar" id="rslugar" placeholder="Ingrese el Lugar de la Razon Social"></td>
          </tr>
          <tr>
          <td>CONTACTO: </td>
          <td><input type="text" name="con" id="con" placeholder='Nombre Contacto'></td>
          </tr>
          <tr>
          <td>CORREO: </td>
          <td><input type="email" name="correo" id="correo" placeholder='Ingrese Correo Contacto'></td>
          </tr>
          <tr>
          <td>TELEFONO CONTACTO: </td>
          <td><input type="tel" name="tel" id="tel" placeholder="Ingrese Telefono Ej: 5696967121"></td>
          </tr>
          <tr>
          <td>SERVICIO: </td>
            <td><select id="ser" name="ser" class="btn btn-block">
                          <?php
                     foreach($datotip as $key => $value ){
                        echo" <option value=".$datotip[$key]['tscod'].">".$datotip[$key]['tsnom']."</option>";
                     }
                     
                     ?>    
              </select></td>
          </tr>
          <tr>
          <td>DESCRIPCIÓN FACTURA: </td>
          <td><textarea  name="descfact" id="descfact" style="width: 100%; height:100px " placeholder="Ingrese una descripcion del contenido de la Factura"></textarea></td>
          </tr>
          <tr>
          <td>ESTADO FACTURA: </td>
           <td><select id="estf" name="estf" class="btn btn-block">
                          <?php
                     foreach($datoestf as $key => $value ){
                        echo" <option value=".$datoestf[$key]['estfcod'].">".$datoestf[$key]['estfnom']."</option>";
                     }
                     
                     ?>    
              </select></td>
          </tr>
          <tr>
          <td>FECHA DE INGRESO AL SII: </td>
          <td><input type="date" name="fSII" id="fSII" ></td>
          </tr>
          <tr>
          <td>FECHA DE VENCIMIENTO: </td>
          <td><input type="date" name="fvec" id="fvec" ></td>
          </tr>
          <tr>
          <td>FECHA DE PAGO: </td>
          <td><input type="date" name="fpag" id="fpag" ></td>
          </tr>
          <tr>
          <td>FORMA DE PAGO: </td>
          <td><select id="formpag" name="formpag" class="btn btn-block">
                          <option value="">Seleccione una Opcion</option>
                          <option value="CRED">CREDITO</option>
                          <option value="DEB">DEBITO</option>
                          <option value="TCIA">TRANSFERENCIA</option>
                          <option value="EFEC">EFECTIVO</option>
                          <option value="VVIS">VALE VISTA</option>
                          <option value="NPAG">NOTA DE PAGO</option>
                 <!--            -->
                      </select></td>        
          </tr>
          <tr>
          <td>VALOR NETO ($): </td>
          <td><input type="number" name="vneto" id="vneto" placeholder="Ingrese el valor neto"></td>
          </tr>
          <tr>
          <td>IVA (19%): </td>
          <td><input type="number" name="iva" id="iva" placeholder="Debe de ingresar el valor neto" readonly ></td>
          </tr>
          <tr>
          <td>TOTAL ($): </td>
          <td><input type="number" name="vtotal" id="vtotal" placeholder="Debe de ingresar el valor neto"  readonly></td>
          </tr>
           <tr>
          <tr>
          <td>REGISTRO COBRANZA: </td>
          <td><input type="date" name="rcob" id="rcob" ></td>
          </tr>
          <tr>
          <td>SUBIR PDF FACTURA SII </td>
          <td><input type="file" id="ArchivoPDF" name="ArchivoPDF"></td>
          </tr>
      </table>
          </div>
      </center>
      <center>
          
              <input type="submit" class="form-submit" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Agregar Factura" />
              <input type="button" class="form-submit  " onclick="window.location.href='../../index.php'" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Volver">
          </center>


</form>
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>