<?php
    include_once('../../../Modelo/inversioninterna.php');
    $inversioninterna = new InversionInterna();
    $gettipo = $inversioninterna->gettipoint();
    $getdispensador = $inversioninterna->getdispensadorint();
    $getmodelo = $inversioninterna->getmodeloint();
    $getestado = $inversioninterna->getestadoint();

    $id=$_GET['banioid'];

//metodos para obtener los datos si esta ocupado el baño
    $banioid = $inversioninterna->getbanio($id);
    $getbaniosalida = $inversioninterna->getbaniosalida($id);
    if($getbaniosalida[0]['error']!="error"){
        $getbaniosalidaentrada = $inversioninterna->getbaniosalidaentrada($getbaniosalida[0]['salent_id']);
    }else{
        $getbaniosalida[0]['error']='error';
        $getbaniosalidaentrada[0]['salent_empresa'] = '';
        $getbaniosalidaentrada[0]['salent_fecha'] = '';
        $getbaniosalidaentrada[0]['salent_hora'] = '';
        $getbaniosalidaentrada[0]['salent_responsable'] = '';
        $getbaniosalidaentrada[0]['salent_numrep'] = '';
        $getbaniosalidaentrada[0]['salent_guiadesp'] = '';
    }

    //echo '<pre>',var_dump($banioid),'</pre>';
   // echo '<pre>',var_dump($getbaniosalida),'</pre>';
  //  echo '<pre>',var_dump($getbaniosalidaentrada),'</pre>';

    setlocale(LC_ALL,"es_ES");
    $fecha = strftime("%Y-%m-%d");    
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
  
              $('#agregarinventorio').prop('disabled', true);
               var ocupado = $("#ocupado").val();

              if(ocupado=='error'){
              document.getElementById("menubanios5").style.display = 'none';
              }else{
              document.getElementById("menubanios5").style.display = '';
              }

        var id_tipi_id = $("#id_tipi_id").val();
        if(id_tipi_id==1){
            document.getElementById("menubanios1").style.display = '';
            document.getElementById("menubanios2").style.display = '';
            document.getElementById("menubanios3").style.display = '';
            document.getElementById("menubanios4").style.display = '';
        }else if(id_tipi_id==2){
            document.getElementById("menubanios1").style.display = '';
            document.getElementById("menubanios2").style.display = '';
            document.getElementById("menubanios3").style.display = 'none';
            document.getElementById("menubanios4").style.display = '';
        }else if(id_tipi_id==3){
            document.getElementById("menubanios1").style.display = '';
            document.getElementById("menubanios2").style.display = '';
            document.getElementById("menubanios3").style.display = '';
            document.getElementById("menubanios4").style.display = '';
        }else{
            document.getElementById("menubanios1").style.display = 'none';
            document.getElementById("menubanios2").style.display = 'none';
            document.getElementById("menubanios3").style.display = 'none';
            document.getElementById("menubanios4").style.display = 'none'; 
            
        }   

        $("#agregarinventorio").hide();
    
    });   
</script>
<style>
    .container{
        border: 1px solid #BBDBB2;
    }
          table{
            table-layout: auto;
            width:100%;
            max-width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
            }
   td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}
td:nth-child(2) {
    background-color:white;
}
    td:nth-child(4) {
    background-color:white;
}
td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}
td:nth-child(6) {
    background-color:white;
}
td:nth-child(5) {
    background-color:whitesmoke;
    font-weight: bold;
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
    width:65%;
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
            <h1 style="text-align: center;"><?php echo $banioid[0]['tipi_desc']." N°".$banioid[0]['bodi_codigo'] ?></h1>
        </div> 
    <div class="tablas">           
        <form method="POST" action="Controladores/funcionesinventariointerno.php" 
        enctype="multipart/form-data"> 
            <input type="hidden" name="funciones" value="crear">
            <input type="hidden" name="ne_tipi_id" id="id_tipi_id" value="<?php echo $banioid[0]['tipi_id']?> ">     
            <input type="hidden" name="ocupado" id="ocupado" value="<?php echo $getbaniosalida[0]['error'] ?>">    
            <input type="hidden" name="ne_esti_id" id="id_esti_id" value="3"> 
            <input type="hidden" name="ne_bodi_ocupado" id="id_bodi_ocupado" value="habilitado">  
            <table style="width: 87%; margin: 0 auto;">
                <tr id="menubanios0"> 
                    <td style="width: 10%;">
                        Tipo:
                    </td>       
                    <td style="width: 55%;"> 
                    <input type="text" name="ne_bodi_codigo" id="id_bodi_codigo" value="<?php echo $banioid[0]['tipi_desc']?>" readonly> 
                    </td>
                    <td style="width: 10%;">
                        Estado:
                    </td>       
                    <td style="width: 10%;"> 
                    <input type="text" name="ne_bodi_fecha" id="id_bodi_fecha" value="<?php echo $banioid[0]['esti_desc']?>" readonly>
                    </td>
                </tr>
                <tr id="menubanios1"> 
                    <td style="width: 10%;">
                        Codigo:
                    </td>       
                    <td style="width: 55%;"> 
                        <input type="text" name="ne_bodi_codigo" id="id_bodi_codigo" value="<?php echo $banioid[0]['bodi_codigo']?>" readonly>
                    </td>
                    <td style="width: 10%;">
                        Fecha:
                    </td>       
                    <td style="width: 10%;"> 
                    <input type="date" name="ne_bodi_fecha" id="id_bodi_fecha" value="<?php echo $banioid[0]['bodi_fecha']?>" readonly>
                    </td>
                </tr>
                <tr id="menubanios2">     
                    <td>
                     Modelo:
                    </td>         
                    <td><select name="ne_modi_id" id="id_modi_id" class="btn btn-block" required>
                        <?php
                                foreach($getmodelo as $key => $value){
                                    if($getmodelo[$key]["modelointid"] == $banioid[0]['modi_id']){
                                        echo "<option value='".$getmodelo[$key]['modelointid']."' selected>".
                                        $getmodelo[$key]['modelointdesc']."</option>";
                                    }else{
                                        echo "<option value='".$getmodelo[$key]['modelointid']."'>".
                                        $getmodelo[$key]['modelointdesc']."</option>";
                                    }     
                                }                            
                            ?>
                        </select>
                    </td>  
                    <td>
                        Color:
                    </td>       
                    <td> 
                        <input type="text" name="ne_bodi_color" id="id_bodi_color" value="<?php echo $banioid[0]['bodi_color']?>" readonly>
                    </td>
                </tr>
                <tr id="menubanios3">    
                    <td>
                        Lavamano:
                    </td>          
                    <td> 
                        <select name="ne_bodi_lavamano" id="id_bodi_lavamano" class="btn btn-block" required>
                            <?php  
                                if($banioid[0]['bodi_lavamano']=='SI'){
                                    echo "<option value='SI' SELECTED>SI</option>";     
                                    echo "<option value='NO' >NO</option>";     
                                }else{
                                    echo "<option value='SI' >SI</option>";     
                                    echo "<option value='NO' SELECTED>NO</option>";
                                }
                            ?>   
                        </select>
                    </td> 
                    <td>
                        Dispensador:
                    </td>
                    <td><select name="ne_disi_id" id="id_disi_id" class="btn btn-block" required> 
                        <?php
                                foreach($getdispensador as $key => $value){
                                    if($getdispensador[$key]["dispensadorintid"] == $banioid[0]['disi_id']){
                                        echo "<option value='".$getdispensador[$key]['dispensadorintid']."' SELECTED>".
                                        $getdispensador[$key]['dispensadorintdesc']."</option>";
                                    }else{
                                        echo "<option value='".$getdispensador[$key]['dispensadorintid']."'>".
                                        $getdispensador[$key]['dispensadorintdesc']."</option>";
                                    }     
                                }                            
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <table id="menubanios4" style="margin-left: 7%; margin-right: auto; width: auto;margin-top:20px;">
                <tr>
                    <td style="width: 100px;">
                        Observación:
                    </td>
                    <td>
                        <textarea name="ne_bodi_obs" id="id_bodi_obs" cols="70" rows="1"><?php echo $banioid[0]['bodi_obs'] ?></textarea>
                    </td>
                </tr>
            </table>                    
            <table id="menubanios5" style="margin-left: 7%; margin-right: auto; width: 87%;margin-top:20px;">
                <tr>
                    <td style="width: 15%;">
                        Empresa:
                    </td>
                    <td>
                        <input style="padding: 0px 0px" type="text" id="salent_empresa" value="<?php echo $getbaniosalidaentrada[0]['salent_empresa']?>" readonly>
                    </td>
                    <td  style="width: 15%;">
                        Fecha:
                    </td>
                    <td>
                        <input style="padding: 0px 0px"type="text" id="salent_empresa" value="<?php echo $getbaniosalidaentrada[0]['salent_fecha']?>" readonly>
                    </td>              
                </tr>
                <tr>
                    <td>
                        Hora:
                    </td>
                    <td>
                        <input style="padding: 0px 0px" type="text" id="salent_empresa" value="<?php echo $getbaniosalidaentrada[0]['salent_hora']?>" readonly>
                    </td>
                    <td style="width: 100px;">
                        Responsable:
                    </td>
                    <td>
                        <input style="padding: 0" type="text" id="salent_empresa" value="<?php echo $getbaniosalidaentrada[0]['salent_responsable']?>" readonly>
                    </td>
                </tr>
                <tr>    
                    <td style="width: 100px;">
                        Nro Report:
                    </td>
                    <td>
                        <input style="padding: 0px 0px" type="text" id="salent_empresa" value="<?php echo $getbaniosalidaentrada[0]['salent_numrep']?>" readonly>
                    </td> 
                    <td style="width: 100px;">
                        Guia Despacho:
                    </td>
                    <td>
                        <input style="padding: 0" type="text" id="salent_empresa" value="<?php echo $getbaniosalidaentrada[0]['salent_guiadesp']?>" readonly>
                    </td>               
                </tr>
            </table>
            <div class="botones">
                <button type="button" class="form-submit" id="imprimirbanio" onclick="window.location.href='imprimirinvint.php?banioid=<?php echo $banioid[0]['bodi_id']?>'">Imprimir</button>
                <button type="button" class="form-submit" id="modificarbanio" onclick="window.location.href='modificarinvint.php?banioid=<?php echo $banioid[0]['bodi_id']?>'">Modificar</button>
                <button type="button" class="form-submit" 
                onclick="window.location.href='listarinvint.php'">Volver al Listado</button>
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

