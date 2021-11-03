<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/bienes.php');

//Instasicion del las clases de los modelos
$e = new Bienes();

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//var_dump($nuevovehiculo);

//Este metodo recibe los estados de los items.
$estados = $e -> getestados();

$lastcodigo = $e ->getlastcodigoitem();

$items = $e ->getitems($_GET["ITEM_CODIGO"]);

$ubicacion = $e ->getubicaciones();

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
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
    table{
        width: 100%
    }
    textarea{
        width: 100%
    }
    #obs{
        height: 300px;
    }

     .select-style2 {
 
 border:1px solid #777;
    width: 300px;
    border-radius: 3px;
    overflow: hidden;
    float:left;

}

.select-style2 select {  
 
font-size:15px;
    width: 100%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
      
}

.select-style2 select:focus {
    outline: none;  
}

.select-style2 select option {
    padding:3px;

}

</style>
   
</head>
<body>

  <div class="container">
        <center><img src="../../../img/logo2.png"><br>
          <h1>Modificar Item</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <table>
          <input type="hidden" name="codigoitem" value="<?php echo $items[0]['ITEM_CODIGO']?>">
          <input type="hidden" name="funcion" value="eliminarbien">  
              <tr>
                  <td style="text-align: right;">Numero:</td>
                  <td style="width: 150px"><input type="text" id="itemdesc" name="numero" value="<?php echo $items[0]['ITEM_NUMIDEN'] ?>" readonly disabled></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Descripción:</td>
                  <td style="width: 150px"><input type="text" id="itemdesc" name="itemdesc" value="<?php echo $items[0]['ITEM_DESC'] ?>"  disabled></td>
              </tr>
              <tr>
                  <td style="text-align: right;vertical-align: middle;">Ubicación:</td>
                  <td><select id="ubicacion" name="ubicacion" class="btn btn-block" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                            <?php
                            foreach($ubicacion as $tipoentidad){
                              if($tipoentidad["UB_CODIGO"] == $items[0]["UB_CODIGO"]){
                                echo "<option value='".$tipoentidad["UB_CODIGO"]."' selected>".$tipoentidad["UB_DESCRIPCION"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["UB_CODIGO"]."'>".$tipoentidad["UB_DESCRIPCION"]."</option>";
                              }
                            }  

                            ?>  
                      </select></td>
              </tr>
              <tr>
                  <td style="text-align: right;vertical-align: middle;">Estado:</td>
                  <td><select id="estado" name="estado" class="btn btn-block" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                            <?php
                            foreach($estados as $tipoentidad){
                              if($tipoentidad["EBR_CODIGO"] == $items[0]["EBR_CODIGO"]){
                                echo "<option value='".$tipoentidad["EBR_CODIGO"]."' selected>".$tipoentidad["EBR_DESC"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EBR_CODIGO"]."'>".$tipoentidad["EBR_DESC"]."</option>";
                              }
                            }  

                            ?>    
                      </select></td>

              </tr>
              <tr>
                  <td style="text-align: right;">Marca:</td>
                  <td style="width: 150px"><input type="text" id="marca" name="marca" value="<?php echo $items[0]['ITEM_MARCA'] ?>" disabled></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Fecha de Ingreso:</td>
                  <td style="width: 150px"><input type="date" id="fechaing" name="fechaing" value="<?php echo $items[0]['ITEM_FECHAING'] ?>" disabled></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Cantidad:</td>
                  <td style="background-color: white;"><input type="number" id="itemcant" name="itemcant" value="<?php echo $items[0]['ITEM_CANT'] ?>" disabled></td>
              </tr>
              <tr>
              <td style="text-align: right;">Observación:</td>
              <td style="background-color: white;"><textarea id="itemobs" name="itemobs" style="width: 400px; height: 180px;max-height: 190px;" placeholder="Ingrese Comentario"><?php echo $items[0]['ITEM_OBS'] ?></textarea></td>
            </tr>
          </table>

          <button type="submit" class="form-submit">Eliminar Item</button>

          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>

          <button type="button" class="form-submit" onclick="window.location.href='listadobienes.php'">Volver al listado</button>

      </form>  
</div>

        <div id="errores">  
        </div>

        </fieldset>
            </fieldset>
      </form>   
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
    <script>
    $(document).ready(function(){
      $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

      console.log(this);
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlbienesfunciones.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
           $("#errores").html(data);
                //$('#codvehiculo').reset();
                //document.getElementById("formagregarvehiculo").reset();
             }
             
         }); 
       });                    
    });
    </script>

</body>
</html>