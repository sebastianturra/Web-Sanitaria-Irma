<?php
    include_once('../../../Modelo/inversioninterna.php');
    include_once('../../../Modelo/RazonSocial.php');
    

    $inversioninterna = new InversionInterna();
    $rs= new RazonSocial();

    setlocale(LC_ALL,"es_CL");
    $fecha = strftime("%Y-%m-%d");  
    $hora = strftime("%H:%M:%S");  
    
    $id = $_GET['id'];
    $salent= $inversioninterna->getbaniosalidaentrada($id);
    $detsalent= $inversioninterna->getdetsalent($id);
    $datars=$rs->ListarRazonSocial();

  //  echo '<pre>',var_dump($salent),'</pre>';
  //  echo '<pre>',var_dump($detsalent),'</pre>';
 
    $op = $salent[0]["salent_tipo"];
    $codigo = $salent[0]["salent_id"];

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli_1.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
      $(document).ready(function(){

        var id = $("#codigo").val();
        var tipo = $("#id_salent_tipo").val();
        var total = $("#id_salent_cantidad").val();
        var url = "Controladores/detalle_salent.php?id="+id;
        $("#tabla-contenido").load(url);

        if(tipo=="ENTRADA"){
            document.getElementById("cantidad").style.display = 'none';
        }else{
            document.getElementById("cantidad").style.display = '';
            $('#id_salent_cantidad').attr('readonly', true);
        }       

            $(document).on('change', '.id', function(){                   
                var bodi_codigo = $(this).val();
                var id_select= $(this).attr('id');
                var stringLength = id_select.slice(-1);
                //alert(bodi_codigo+'select id: '+stringLength);     
               
                $.ajax({
                    type: "POST",
                    url: "Controladores/busqueda_banio.php",
                    data: {bodi_codigo:bodi_codigo},
                    success: function(data){
                        console.log(data);
                        var lista = eval(data); 
                        console.log(lista.length);
                        for(i = 0; i < lista.length; i++){
                            $('#id_bodi_color'+stringLength).val(lista[i]['bodi_id']).change();
                            $('#id_disi_id'+stringLength).val(lista[i]['disi_id']).change();
                            $('#id_bodi_lavamano'+stringLength).val(lista[i]['bodi_lavamano']).change();
                            $('#id_bodi_color'+stringLength).val(lista[i]['bodi_color']).change();
                            }
                    }
                });
            }); 

      $("#id_salent_empresa").change(function(){
      var empcotcod = $(this).val();
      alert(empcotcod);
      $.ajax({
        type: "POST",
        url: "Ajax/buscadorempresa.php",
        data: {empcotcod:empcotcod},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(lista[0]['error']!='error'){
            for(i = 0; i < lista.length; i++){
              $('#id_salent_telefono').val(lista[i]['fono']);
              $('#id_salent_correo').val(lista[i]['emars']);
              $('#nomras').val(lista[i]['nomrs']);
            }
          }else{
            alert('Empresa no Encontrada');
            $('#id_salent_telefono').val('');
            $('#id_salent_correo').val('');
            $('#nomras').val('');
          }
        }
      }); 
    });
});      
</script>
<style>
    .container{
        border: 1px solid #BBDBB2;
    }
          table{
            table-layout: auto;
            width:80%;
            max-width: 80%;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: 10px;
            }
   td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}
td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}
    td:nth-child(2) {
    background-color:white;
}
    td:nth-child(4) {
    background-color:white;
}
 td { 
                padding: 5px 10px;
                text-align: right;
                border: 1px solid #999;
                font-size: 12px
            }
.logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}
.tablas{
    padding: 50;
    border: 2px solid #E7EDE5;
    margin: 0 auto;
    margin-bottom: 20px; 
    margin-top: 10px;
    width:90%;
    padding: 5px 10px;  
    border-radius: 10px 10px;
    }
.botones{
    text-align: center;
    padding: 5px 0px 20px 0px;
    width: auto;
}   
</style>
</head>
<body>
    <div class="container">
        <div>
            <img class="logo" src="../../../img/logo2.png"> 
            <h1 style="text-align: center;">MODIFICAR <?php echo $op ?> <?php echo $codigo ?></h1>
        </div> 
    <div class="tablas">           
        <form method="POST" action="Controladores/funcionesinventariointerno.php" 
        enctype="multipart/form-data"> 
            <input type="hidden" name="id" id="codigo" value="<?php echo $codigo ?>">
            <input type="hidden" name="op" id="op" value="<?php echo $op ?>"> 
            <input type="hidden" name="ne_salestado" value="<?php echo $salent[0]['salent_salestado'] ?>">
            <input type="hidden" name="ne_salent_entrada" value="<?php echo $salent[0]['salent_entrada'] ?>">
            <input type="hidden" name="ne_salent_salida" value="<?php echo $salent[0]['salent_salida'] ?>"> 
            <input type="hidden" name="ne_salentestado" value="<?php echo $salent[0]['salent_estado'] ?>"> 
            <input type="hidden" name="funciones" value="modificarsalent">      
            <table style="width: 87%; margin: 0 auto;">
                <tr id="menubanios1"> 
                    <td style="width: 10%;">
                        Tipo Ingreso:
                    </td>       
                    <td style="width: 57%;"> 
                        <input type="text" name="ne_salent_tipo" id="id_salent_tipo" value="<?php echo $op ?>" 
                        readonly>
                    </td>
                    <td style="width: 10%;">
                        Fecha:
                    </td>       
                    <td style="width: 10%;"> 
                    <input type="date" name="ne_bodi_fecha" id="id_bodi_fecha" value="<?php echo $salent[0]['salent_fecha'] ?>" >
                    </td>
                </tr>
                <tr id="menubanios2">     
                <td>
                        Empresa:
                    </td>          
                    <td> 
                        <select style="width: 100%"type="text" name="ne_salent_empresa" id="id_salent_empresa">
                        <?php
                            echo "<option value='".$salent[0]['salent_empresa']."' SELECTED>".$salent[0]["salent_empresa"]."</option>";         
                            foreach($datars as $tipoentidad){
                            echo "<option value='".$tipoentidad["cod"]."'>".$tipoentidad["rut"]."-".$tipoentidad["dire"]."-".$tipoentidad["nom"]."</option>";
                            }  
                        ?> 
                        <input type='hidden' name="nomras" id="nomras" value="<?php echo $salent[0]['salent_empresa']?>">        
                   </select> </td>
                    </td>    
                    <td>
                     Hora:
                    </td>         
                    <td><input type="time" name="ne_salent_hora" id="id_salent_hora" value="<?php echo $salent[0]['salent_hora'] ?>" >
                    </td>  
                </tr>
                <tr id="menubanios3">    
                    <td>
                        Responsable:
                    </td>       
                    <td> 
                        <input type="text" name="ne_salent_responsable" id="id_salent_responsable" value="<?php echo $salent[0]['salent_responsable'] ?>" >
                    </td>
                    <td>
                        Telefono:
                    </td>          
                    <td> 
                        <input type="text" name="ne_salent_telefono" id="id_salent_telefono" value="<?php echo $salent[0]['salent_telefono'] ?>" >
                    </td>
                </tr>
                <tr id="menubanios3">    
                    <td>
                        Correo:
                    </td>
                    <td><input type="text" name="ne_salent_correo" id="id_salent_correo" value="<?php echo $salent[0]['salent_correo'] ?>" >
                    </td>
                    <td>
                        Num Report:
                    </td>          
                    <td> 
                    <input type="text" name="ne_salent_numrep" id="id_salent_numrep" value="<?php echo $salent[0]['salent_numrep'] ?>" >
                    </td> 
                </tr>
                <tr id="menubanios3">    
                    <td>
                        Receptor:
                    </td>
                    <td><input type="text" name="ne_salent_receptor" id="ide_salent_receptor" value="<?php echo $salent[0]['salent_receptor'] ?>" >
                    </td>
                    <td>
                        Guia Despacho:
                    </td>
                    <td><input type="text" name="ne_salent_guiadespacho" id="id_salent_guiadespacho" value="<?php echo $salent[0]['salent_guiadesp'] ?>" > 
                    </td>   
                </tr>
            </table>  
            <table id="cantidad" style="width: 20%;margin-left: 70px;margin-right: auto;  margin-top:20px;"> 
                <tr>    
                    <td style="width:7%;">
                        Cantidad:
                    </td>          
                    <td style="width:13%;"> 
                    <input type="text" name="ne_salent_cantidad" id="id_salent_cantidad" value="<?php echo $salent[0]['salent_cantidad'] ?>" >
                    </td> 
                </tr>
            </table>
            <div id="tabla-contenido">
            </div>
            <table id="menubanios4" style="margin-left: 7%; margin-right: auto; width: auto;margin-top:20px;">
                <tr>
                    <td style="width: 100px;">
                        Observación:
                    </td>
                    <td>
                        <textarea name="ne_bodi_obs" id="id_bodi_obs" cols="70" rows="1"><?php echo $salent[0]['salent_obs'] ?></textarea>
                    </td>
                </tr>
            </table> 
            <div class="botones">
                <button type="submit" class="form-submit" >MODIFICAR <?php echo $op ?></button>
                <button type="button" class="form-submit" 
                onclick="window.location.href='listarsalent.php'">Volver al Listado</button>
                <button type="button" class="form-submit" 
                onclick="window.location.href='../../index.php'">Volver al Inicio</button>
            </div>
        </form> 
    <!-- FIN DE TABLAS -->
    </div>           
    <!-- FIN DE CONTAINER -->
    </div> 
</body>    
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html> 

