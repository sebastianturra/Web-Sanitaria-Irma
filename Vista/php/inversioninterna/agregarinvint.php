<?php
    include_once('../../../Modelo/inversioninterna.php');
    $inversioninterna = new InversionInterna();
    $gettipo = $inversioninterna->gettipoint();
    $getdispensador = $inversioninterna->getdispensadorint();
    $getmodelo = $inversioninterna->getmodeloint();
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
              document.getElementById("menubanios1").style.display = 'none';
              document.getElementById("menubanios2").style.display = 'none';
              document.getElementById("menubanios3").style.display = 'none';
              document.getElementById("menubanios4").style.display = 'none';
        $("#id_tipi_id").change(function(){
        /*  var id_tipi_id = $( "#id_tipi_id option:selected" ).text();
            alert(''id_tipi_id); */
            var id_tipi_id = $("#id_tipi_id").val();
          if(id_tipi_id==1){
            $('#agregarinventorio').prop('disabled', false);
              document.getElementById("menubanios1").style.display = '';
              document.getElementById("menubanios2").style.display = '';
              document.getElementById("menubanios3").style.display = '';
              document.getElementById("menubanios4").style.display = '';
          }else if(id_tipi_id==0){
            $('#agregarinventorio').prop('disabled', true);
              document.getElementById("menubanios1").style.display = 'none';
              document.getElementById("menubanios2").style.display = 'none';
              document.getElementById("menubanios3").style.display = 'none';
              document.getElementById("menubanios4").style.display = 'none';   
          }else{
            $('#agregarinventorio').prop('disabled', false);
              $("#id_bodi_codigo").val('');
              $("#id_modi_id").val(1);
              $("#id_bodi_color").val('');
              $("#id_bodi_lavamano").val('SI');
              $("#id_disi_id").val(1);
              document.getElementById("menubanios1").style.display = '';
              document.getElementById("menubanios2").style.display = 'none';
              document.getElementById("menubanios3").style.display = 'none';
              document.getElementById("menubanios4").style.display = '';     
          }
        });
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
            <h1 style="text-align: center;">Agregar Inventario</h1>
        </div> 
    <div class="tablas">           
        <form method="POST" action="Controladores/funcionesinventariointerno.php" 
        enctype="multipart/form-data"> 
            <input type="hidden" name="funciones" value="crear">      
            <input type="hidden" name="ne_esti_id" id="id_esti_id" value="3"> 
            <input type="hidden" name="ne_bodi_ocupado" id="id_bodi_ocupado" value="habilitado">  
            <table style="margin-left: 7%; margin-right: auto;width: 50%;">
                <tr> 
                    <td>
                    Tipo de Inverción:
                    </td>       
                    <td style="width: 60%;"> 
                        <select name="ne_tipi_id" id="id_tipi_id" class="btn btn-block" required>
                            <option value="0">Seleccione una opción</option>";   
                            <?php
                                foreach($gettipo as $key => $value){
                                    echo "<option value='".$gettipo[$key]['tipointid']."'>".
                                    $gettipo[$key]['tipointdesc']."</option>";
                                }                            
                            ?>
                        </select>      
                    </td> 
                </tr>
            </table>
            <table style="width: 87%; margin: 0 auto;">
                <tr id="menubanios1"> 
                    <td style="width: 10%;">
                        Codigo:
                    </td>       
                    <td style="width: 55%;"> 
                        <input type="text" name="ne_bodi_codigo" id="id_bodi_codigo">
                    </td>
                    <td style="width: 10%;">
                        Fecha:
                    </td>       
                    <td style="width: 10%;"> 
                    <input type="date" name="ne_bodi_fecha" id="id_bodi_fecha" value="<?php echo $fecha ?>"
                     readonly>
                    </td>
                </tr>
                <tr id="menubanios2">     
                    <td>
                     Modelo:
                    </td>         
                    <td><select name="ne_modi_id" id="id_modi_id" class="btn btn-block" required>
                        <option value="0">Seleccione una opción</option>";
                        <?php
                            foreach($getmodelo  as $key => $value){
                                echo "<option value='".$getmodelo [$key]['modelointid']."'>".
                                $getmodelo [$key]['modelointdesc']."</option>";
                            }                            
                        ?>
                        </select>
                    </td>  
                    <td>
                        Color:
                    </td>       
                    <td> 
                        <input type="text" name="ne_bodi_color" id="id_bodi_color">
                    </td>
                </tr>
                <tr id="menubanios3">    
                    <td>
                        Lavamano:
                    </td>          
                    <td> 
                        <select name="ne_bodi_lavamano" id="id_bodi_lavamano" class="btn btn-block" required>
                            <option value="SI" SELECTED>SI</option>";   
                            <option value="NO" >NO</option>";   
                        </select>
                    </td> 
                    <td>
                        Dispensador:
                    </td>
                    <td><select name="ne_disi_id" id="id_disi_id" class="btn btn-block" required> 
                        <option value="0">Seleccione una opción</option>";
                        <?php
                            foreach($getdispensador as $key => $value){
                                echo "<option value='".$getdispensador[$key]['dispensadorintid']."'>".
                                $getdispensador[$key]['dispensadorintdesc']."</option>";
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
                        <textarea name="ne_bodi_obs" id="id_bodi_obs" cols="70" rows="1"></textarea>
                    </td>
                </tr>
            </table> 
            <div class="botones">
                <button type="submit" class="form-submit" id="agregarinventorio">Agregar al Inventario</button>   
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

