<?php
/*session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}*/
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Tipo_Factura.php');
include_once('../../../Modelo/Facturacion.php');
include_once('../../../Modelo/Tipo_Servicios.php');
$op=$_GET["op"];
$idfact=$_GET["id"];
$nombre=$_GET["nom"];

$fact=new Facturacion();
$tfac=new Tipo_Factura();
$tipsf=new Tipo_Servicios();

$datafact=$fact->BuscarFacturasSimpleDato($idfact);

$datofact=$tfac->listarTipFactura();
$datotip=$tipsf->listarTipServicio();
$datoestf=$tfac->listarEstFactura();

switch($datafact[0]["formpag"]){
      case "CRED": $formpago="CREDITO";
          break;
      case "DEB": $formpago="DEBITO";
          break;
      case "TCIA": $formpago="TRANSFERENCIA";
          break;
      case "EFEC": $formpago="EFECTIVO";
          break;
      case "VVIS": $formpago="VALE VISTA";
          break;
      case "NPAG": $formpago="NOTA DE PAGO";
          break;
      default: $formpago="OTRA FORMA DE PAGO";
          break; 
}
if($datafact[0]["exc"]=="SI"){
    $excento="CON EXCENTO";
}else{
    $excento="SIN EXCENTO";;
}

if($datafact[0]["numorden"]==""){
    $tipor="SIN ORDEN COMPRA";
    $orden="";
}else{
    $tipor="CON ORDEN COMPRA";
    $orden=$datafact[0]["numorden"];
}



?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Vista PDF Facturas - Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css">

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
<script>
$(document).ready(function(){
    
   /* $("#idfact").val("");
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
     */               
                    
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

 function ValidarIdFactura(){
           var datophp= <?php echo $datafact[0]["idfact"]; ?>;    
           var dato=$('#idfact').val();
         if(datophp == dato){
              alert("Mismo ID");
            }else{
               //alert(datophp);
		$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_ValidarIDFact.php",
                        data:"dato="+ dato,
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				if(r >0){
                                    alert("ID NO disponible, Pruebe con otro");
                                     //$("#probtn").attr("disabled", true);
                                    //  $("#devbtn").attr("style='background-color: black'", true);
                                }else{
                                    alert("ID disponible");
                                    //alert(r+"ID disponible");
                                    // $("#probtn").removeAttr("disabled");
                                }
			}
		});
            }
                
 }
 
 function ValidarRut(){
         var datophp= <?php echo $datafact[0]["rsrut"]; ?>;
         var dato=$('#rsrut').val();
         if(datophp == dato){
              //alert("Mismo ID");
            }else{
               //alert(datophp);
		$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_ValidarRut.php",
                        data:"dato="+ dato,
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				if(r == false){
                                    alert("RUT NO VALIDO");
                                     //$("#probtn").attr("disabled", true);
                                    //  $("#devbtn").attr("style='background-color: black'", true);
                                }else{
                                    alert("RUT VALIDO");
                                    //alert(r+"ID disponible");
                                    // $("#probtn").removeAttr("disabled");
                                }
			}
		});
            }
                
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
            
#contenedor1{  
        width:1200px;
	height:1100px;
        background: white;
        margin:0.5em auto;
        padding: 0.5;
        border-radius: 2%
	}
            
#uno{   width:80%;
	align-items: center;
        margin: auto;
        background-color:white;
	}
#dos{
       
        width:80%;
        height: auto;
        align-items: center;
        margin:  auto;
	background-color:white;
	}
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 40px;
}

</style> 
</head>
    <body>
       <div id="contenedor1" >
      <img class="logo" src="../../../img/logo2.png"><br>
         <center> <form action='Ctrl/ctrl_editarFacturas.php' method='post' enctype="multipart/form-data">
          <h1>Edicion Factura <?php echo $datafact[0]["emirec"]; ?> Nº <?php echo $idfact; ?> </h1>
          <input type="hidden" id="factid" name="factid" value="<?php echo $idfact; ?>">
           <input type="hidden" id="op" name="op" value="<?php echo $op; ?>">
           <table style="width:60%;">
               <tr>
                      <td>
                          <select style="border-color: black" id="tipf" name="tipf" class="btn btn-block" style="font-weight:bold; ">
                         <option value="<?php echo  $datafact[0]["codtipf"]; ?>" ><?php echo $datafact[0]["tipfnom"]; ?></option>
                     <?php
                     foreach($datofact as $key => $value ){
                        echo" <option value=".$datofact[$key]['tfcod'].">".$datofact[$key]['tfnom']."</option>";
                     }
                     
                     ?>    
                      </select></td>        
                   <td>
                           <select style="border-color: black" id="exc" name="exc" class="btn btn-block" style="font-weight:bold; ">
                          <option value="OPE" ><?php echo $excento; ?></option>
                          <option value="NO">SIN/Excento</option>
                          <option value="SI">CON/Excento</option>
                      </select></td >
                   <td>
                           <select style="border-color: black" id="ocom" name="ocom" class="btn btn-block" style="font-weight:bold;">
                          <option value="OPO"><?php echo $tipor; ?></option>
                          <option value="NO">SIN/Orden de Compra</option>
                          <option value="SI">CON/Orden de Compra</option>
                      </select></td>
               </tr>
           </table>
          
         <div id="uno"> 
          <center>
               <table>
          <tr>
          <td style='width: 2%'>CODIGO FACTURA:</td>
          <td><input type="text" name="idfact" id="idfact" value="<?php echo $datafact[0]["idfact"]; ?>" maxlength="10" onchange="ValidarIdFactura()"  style="color:blue; font-weight: bold" ></td>
          <td style='width:10%'>N° ORDEN DE COMPRA: </td>
          <td><input type="text" name="ordencomp" id="ordencomp" value="<?php echo $orden; ?>"  style="color:blue; font-weight: bold" ></td>
          </tr>
          
          <tr>
          <td>SERVICIO: </td>
          <td><select id="ser" name="ser"   class="btn btn-block">
                  <option   value="<?php echo $datafact[0]["tipscod"]; ?>"  style=" font-weight: bold"  ><?php echo $datafact[0]["tipsnom"]; ?></option>
                   <?php
                     foreach($datofact as $key => $value ){
                        echo" <option value=".$datotip[$key]['tscod'].">".$datotip[$key]['tsnom']."</option>";
                     }
                     
                     ?>    
              </select>
               </td>
          <td>RUT RAZON SOCIAL: </td>
          <td><input type="text" name="rsrut" id="rsrut" value="<?php echo $datafact[0]["rsrut"]; ?>" onchange="ValidarRut()"  style="font-weight: bold" ></td>
          </tr>
          <tr>
          <td>NOMBRE RAZON SOCIAL: </td>
          <td colspan="3"><input type="text" name="rsnom" id="rsnom" value="<?php echo $datafact[0]["rsnom"]; ?>"  style="font-weight: bold" ></td>
          </tr>
          <tr>
          <td>DIRECCION/LUGAR: </td>
          <td colspan="3"><input type="text" name="rslugar" id="rslugar" value="<?php echo $datafact[0]["rslugar"]; ?>"  style="font-weight: bold" ></td>
         
          </tr>
               </table>
              
              <table>
          <tr>
          <td style='width: 2%'>CONTACTO: </td>
          <td><input type="text" name="con" id="con" value="<?php echo $datafact[0]["con"]; ?>"  style="font-weight: bold"  ></td>
          <td>TELEFONO CONTACTO: </td>
          <td><input type="tel" name="tel" id="tel" value="<?php echo $datafact[0]["fono"]; ?>"  style="font-weight: bold" ></td>
          </tr>
          <tr>
              <td>CORREO: </td>
              <td colspan="3"><input type="email" name="correo" id="correo" value="<?php echo $datafact[0]["correo"]; ?>"  style="font-weight: bold"  ></td>
          </tr>
                      </table>
              <table>
          <tr>
          <td>DESCRIPCIÓN FACTURA: </td>
          </tr>
          <tr>
              <td><textarea  name="descfact" id="descfact" style="width: 100%; height:100px;  font-weight: bold  " > <?php echo $datafact[0]["fdesc"]; ?>  </textarea></td>
          </tr>
              </table>
              <table>
          <tr>
          <td>ESTADO FACTURA: </td>
          <?php 
          switch ($datafact[0]["codestf"]){
              case 0:  echo "<td style='color:orange'><select id='estf' name='estf' class='btn btn-block'><option value='". $datafact[0]["codestf"]."'  style='color:orange; font-weight: bold' >". $datafact[0]["estfact"]."</option>";
                  break;
              case 1:  echo "<td style='color:blue'><select id='estf' name='estf' class='btn btn-block'><option value='". $datafact[0]["codestf"]."'   style='color:blue; font-weight: bold' >". $datafact[0]["estfact"]."</option>";
                  break;
              case 2:  echo "<td style='color:red'><select id='estf' name='estf' class='btn btn-block'><option value='". $datafact[0]["codestf"]."'  style=' style='color:red; font-weight: bold' >". $datafact[0]["estfact"]."</option>";
                  break;
              case 3:  echo "<td ><select id='estf' name='estf' class='btn btn-block'><option value='". $datafact[0]["codestf"]."'   style=' font-weight: bold' >". $datafact[0]["estfact"]."</option>";
                  break;
              case 4:  echo "<td style='color:red'><select id='estf' name='estf' class='btn btn-block'><option value='". $datafact[0]["codestf"]."'   style=' style='color:red; font-weight: bold' >". $datafact[0]["estfact"]."</option>";
                  break;
            
              default:  echo "<td><select id='estf' name='estf' class='btn btn-block'><option value='". $datafact[0]["codestf"]."'   style=' style='color:red; font-weight: bold' >". $datafact[0]["estfact"]."</option>";
                      break;
              
          }
              
                     foreach($datoestf as $key => $value ){
                        echo" <option value=".$datoestf[$key]['estfcod'].">".$datoestf[$key]['estfnom']."</option>";
                     }
                     
              
          
          
          
              echo "</select>"
          . "</td>";
          
          ?>
          
          </tr>
              </table>
              <table>
          <tr>
          <td >FECHA DE INGRESO AL SII: </td>
          <td><input type="date" name="fSII" id="fSII" value="<?php echo  $datafact[0]["fSII"]; ?>"  style="font-weight: bold"    ></td>
          <td>FECHA DE VENCIMIENTO: </td>
          <td><input type="date" name="fvec" id="fvec" value="<?php echo $datafact[0]["fvenc"]; ?>"  style="font-weight: bold" ></td>
         
           <tr>
          <td>FECHA DE PAGO: </td>
          <td><input type="date" name="fpag" id="fpag" value="<?php echo $datafact[0]["fpag"]; ?>"  style="font-weight: bold"  ></td>
          <td>FORMA DE PAGO: </td>
          <td><select id="formpag" name="formpag" class="btn btn-block">
                          <option value="<?php echo $datafact[0]["formpag"]; ?>"  style="font-weight: bold" ><?php echo $formpago; ?></option>
                          <option value="CRED">CREDITO</option>
                          <option value="DEB">DEBITO</option>
                          <option value="EFEC">EFECTIVO</option>
                          <option value="VVIS">VALE VISTA</option>
                          <option value="NPAG">NOTA DE PAGO</option>
              </select></td> 
           </tr>
         
          
              </table>
         
              <table>
          <tr>
          <td>VALOR NETO ($): </td>
          <td><input type="number" name="vneto" id="vneto" value="<?php echo $datafact[0]["vneto"]; ?>"  style="font-weight: bold"  ></td>
          <td>IVA (19%): </td>
          <td><input type="number" name="iva" id="iva" value="<?php echo $datafact[0]["iva"];  ?>"  style="font-weight: bold"  ></td>
          </tr>
          <tr>
              <td colspan="2" >TOTAL ($): </td>
          <td colspan="2"><input type="number" name="vtotal" id="vtotal" value="<?php echo  $datafact[0]["total"];  ?>"  style="color:red; font-size: 18px;font-weight: bold" ></td>
         
          </tr>
                  
              </table>
              <table>
          <tr>
          <td>REGISTRO COBRANZA: </td>
          <td><input type="date" name="rcob" id="rcob" value="<?php echo $datafact[0]["fcobr"]; ?>"  style="font-weight: bold" ></td>
          </tr>        
              </table>
              <table>
          <tr>
          <td>Nombre del Respaldo PDF </td>
          <td><input type="text" id="ArchivoPDF" name="ArchivoPDF" value="<?php echo $nombre;  ?>"  style="font-weight: bold" ></td>
          </tr>  
          <tr>
          <td>Subir Archivo PDF </td>
          <td><input type="file" id="archivo" name="archivo"   style="font-weight: bold" ></td>
          </tr>  
          </table>
              
          </center>
           </div>
              <div id="dos">
          <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
               <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar Facturacion"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='ListarFacturas.php?op=<?php echo $op;?>'" value="No, Volver Listar Clientes"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
       
              </div>
             </form>
      </center>
       </div>
    </body>
</html>
