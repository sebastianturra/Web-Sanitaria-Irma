<?php

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");
?>
<html lang="en">
<head>
  <!-- Font Icon -->
  <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

  <!-- Main css -->
  <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
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
  <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Editar Cotización - Sistema Salitrera Irma Ltda</title>
  <script  type="text/javascript">
   $(document).ready(function(){
     var cont=0;
     
     $("#add").click(function(){
      if(cont===0){
        cont=1;
      }
      var idCant="cant1"+cont;
      var nuevaFila="<tr>";
      nuevaFila+="<td><input type='number' id='"+idCant+"' name='cant"+cont+"' placeholder='0' required></td>";
      nuevaFila+="<td><input type='text' id='desc2"+cont+"' name='desc"+cont+"' placeholder='Ingrese una Descripcion' required ></td>";
      nuevaFila+="<td><input type='number' id='vunitario3"+cont+"' name='vunitario"+cont+"' placeholder='0' required></td>";            
      nuevaFila+="<td><input type='number' id='vneto4"+cont+"' name='vneto"+cont+"' placeholder='0' required></td>";            
      cont++;
      nuevaFila+="</tr>";
      $("#tabla").append(nuevaFila);
    });
     $("#del").click(function(){
      var trs=$("#tabla tr").length;
      if(trs>1)
      {
        $("#tabla tr:last").remove();
        cont--;
      }
    });
     
     $("#agr").click(function(){

      var totalDatos=$("#tabla tr").length-1;
      var i=0;
      while(i<totalDatos){
        alert($("#cant"+i+"").val());
        i++;
      }
      
    });
     
     $('#calc').click(function(){
       var tds=($("#tabla tr").length)-1;
       var i=0;
       var subtotal=0;
       while(i<tds){

         var cantidad=$("#cant1"+i+"").val();
         var vunitario=$("#vunitario3"+i+"").val();
         var vneto=$("#vneto4"+i+"").val();
         
         if(cantidad==0){
           var resultado=vneto/vunitario;
           subtotal=(parseInt(subtotal)+parseInt(vneto));
           $("#cant1"+i+"").val(resultado);
           
         }else if(vunitario==0){
           var resultado=vneto/cantidad;
           subtotal=parseInt(subtotal)+parseInt(vneto);
           $("#vunitario3"+i+"").val(resultado);
         }else if(vneto==0){
           var resultado = vunitario*cantidad;
           subtotal=parseInt(subtotal)+parseInt(resultado);
           $("#vneto4"+i+"").val(resultado);
         }else{
           var resultado=vunitario*cantidad;
           subtotal=parseInt(subtotal)+parseInt(resultado);
           $("#vneto4"+i+"").val(resultado);
         }
         
         i++;
       }
       
       $("#subtotal").html('$'+subtotal);
     });

     
   });
   
 </script>
 <style>
  table{
    width: auto;
    max-width:100%
  }
  td{
    text-align: center;
    width: auto
  }
  th{
    text-align: center;
    width: auto
  }
  select{
    width: 100%;
  }
  #add{
   width: auto;
   
 }
 #del{
   width: auto;

 }
</style>

</head>
<body>
  <div class="container">
    <center><img src="../../../img/logo2.png"><br>
      <h1>Datos Facturacion</h1>
    </center>
    <center>
      <form action="" method="">
        <table >
          <tr>
            <td><h4>Cliente</h4> </td>
            <td><select id="cliente" name="cliente" class="btn btl-block" required>
              <option value="0">Selecciona un Cliente</option>
            </select></td>
          </tr>
          <tr>
            <td><h4>Fecha:</h4></td>
            <td><h4><input type="date" id="fecha" name="fecha" value="<?php echo $fecha;?>" required></h4></td>
          </tr>
        </table>
        <center><button type="button" id="add" name="add" value="+" class="btn btn-secondary">Agregar Una Nueva Fila</button>&nbsp;<button type="button" id="calc" name="calc" class="btn btn-secondary">Calcular Valores</button>&nbsp;<button type="button" id="del" name="del" value="-" class="btn btn-secondary">Eliminar la ultima Fila</button></center><br>
        <table id="tabla">

          <th style="width:10%">Cantidad</th>
          <th style="width:60%">Descripcion</th>
          <th style="width:15%">Valor Unitario</th>
          <th style="width:15%">Impuesto</th>
          <th style="width:15%">Valor total</th>
          
          
          <tr>
            <td><input type="number" id="cant10" name="cant10" placeholder="0" required></td>
            <td><input type="text" id="desc20" name="desc20" placeholder="Ingrese una Descripcion" required></td>
            <td><input type="number" id="vunitario30" name="vunitario30" placeholder="0" required></td>
            <td><input type="number" id="impuesto" name="impuesto" placeholder="0" required></td>
            <td><input type="number" id="valortotal" name="valortotal" placeholder="0" required></td>
            
          </tr>
          
        </table>
        <table>
          <tr>
            <td colspan="2" style="width:1000px; text-align: right; font-size: 20px; font-weight: bold">Impuesto:</td>
            <td colspan="2" style="width:178px; font-size: 20px; font-weight: bold"> <input type="number" id="impuestocotizacion" name="impuestocotizacion" placeholder="0" required></td>
          </tr>
          <tr>
            <td colspan="2" style="width:1000px; text-align: right; font-size: 20px; font-weight: bold">SUB TOTAL:</td>
            <td colspan="2" style="width:178px; font-size: 20px; font-weight: bold"> <div id="subtotal">$0</div></td>
          </tr>
        </table>
        <table style="width: 100%; max-width: 100%;"> 
    <tr>
        <td style="background-color: white;">
         <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
             <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar Datos"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
             <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='listacotizaciones.php'" value="No, Volver Listar Clientes"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
         </td>
     </tr>
 </table>       
      </form>
    </center>
    <br><br>
  </div>
  <!-- JS -->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../js/main.js"></script>
</body>
</html>