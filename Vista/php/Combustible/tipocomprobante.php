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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
          <h1>Detalle combustible cargado</h1>
      </center>
      <hr>
      <form id="formagregarvehiculo" action="">
        <div id="menu">
          <center><table style="width:auto; max-width: 100%;">
              
              <tr>              
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
                  <td s tyle="background-color: white;width: auto"> <select name="datobuscar" id="datobuscar" style="width: 250px; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione Tipo de carga</option>
                              <option value="1">Carga en planta</option>
                             <!-- <option value="2">Carga en externa</option>   -->
                      </select> </td>                          
                  <td style="background-color: white;padding:1 0 0 5;">
                        <input type="submit" name="ircomprobante" id="ircomprobante" class="form-submit"value="Ir" style=" margin-top: 3; margin-bottom: 3;width:99%; padding-top: 10px; padding-bottom: 10px;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver" style=" margin-top: 3; margin-bottom: 3;width:99%; padding-top: 10px; padding-bottom: 10px;">
                  </td> 
              </tr>            
          </table>
          </center>
      </div>
      </form>  
      <div id="errores">  
        </div>
</div>
        
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
    <script>
  $(document).ready(function(){
    $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

       var datobuscar = $("#datobuscar").val();

       console.log("datobuscar:"+datobuscar);
      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlcombustiblefunciones.php",
         data: {funcion:"tipodecomprobante",datobuscar:datobuscar },
         success: function(data){
           
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