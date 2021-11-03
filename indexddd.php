<?php
include_once('Modelo/Conexion.php');
include_once('Modelo/Personal.php');

//Instasicion del las clases de los modelos
$e = new Personal(); 

session_start();

  if (isset($_SESSION['PER_CORREO'])) {
    header("Location: Vista/index.php");
  }

?>
<html lang="en">
<head>
   <!-- Main css -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logopestanaico.ico" />
    <link href="css/Login.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<title>Salitrera Irma Ltda</title>
</head>
<body>

      <form id="formagregarvehiculo" action="">
        <div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                  <center><img src="img/logo2.png" width="100%" height="45%"></center>
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electronico"  >
                    <label for="inputEmail">Correo Electronico</label>
                  </div>
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" >
                    <label for="inputPassword">Contraseña</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Ingresar</button>
                  <div class="text-center">
                    <a class="small" href="#">¿Olvidaste tu Contraseña?</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      </form>  

        <div id="errores">  
        </div>

     <!-- JS -->
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
    $(document).ready(function(){
      $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

       var inputEmail = $("#inputEmail").val(); 
       var inputPassword = $("#inputPassword").val();
       
       console.log("inputEmail:"+inputEmail);
       console.log("inputPassword:"+inputPassword);
      
       $.ajax({
         type: "POST",
         url: "ctrllogin.php",
         data: {funcion:"login", inputEmail:inputEmail, inputPassword:inputPassword },
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