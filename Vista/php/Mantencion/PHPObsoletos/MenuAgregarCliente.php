<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Cliente</title>

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
        width:100%;
        max-width: 100%;
        
        
    }
    img{
        margin-bottom: 10px;
    }
 
#uno{ border:1px solid white;
	width:49.5%;
	display:inline-block;
	margin:auto;
        
	height:auto;
	background-color:ghostwhite;
	}
#dos{ border:1px solid white;
	width:49.5%;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
	}
#tres{ border:1px solid white;
	width:99.4%;
        margin-top: 5px;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
	}
#cuatro{
        margin-top: 5px;
	width:99.4%;
        margin-bottom: 20px;
	display:inline-block;
	
	}

</style>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<script>
function nuevoCliente(){
        var texto="<iframe src=AgregarCliente.php style='width: 400px; height:850px'></iframe>";
                   
        document.getElementById('contenido-Menu').innerHTML=texto;
}    
function nuevoRazon(){
     var texto="<iframe src=AgregarRazonSocial.php style='width: 400px; height:450px'></iframe>";
                   
        document.getElementById('contenido-Menu').innerHTML=texto;
}   
function nuevoServicio(){
         var texto="<iframe src=AgregarServicio.php style='width: 400px; height:950px'></iframe>";
                   
        document.getElementById('contenido-Menu').innerHTML=texto;
}   

</script>
</head>
<body>
   

    <div class="main"  >

      
        <section class="signup" style="background-color: ghostwhite">
            <div class="container">
                <center><img src="../../../../img/logo2.png"></center>
                <div class="signup-content">
                    <div class="signup-form">
                        <div id="contenido-Menu">
                            <center><h2>IMPORTANTE</h2>
                                <img src="../../../../img/icon/importante.png" width="50%" height="50%"><br>
                            <p> Para agregar un nuevo cliente sigua los siguientes pasos:<br>
                            <ol>
                                <li value="1"> <p>Agregue la Razon Social (si ya tiene la razon social del cliente agregado salte este paso)</p></li>
                                <li value="2"> <p>Agregue al cliente (complete los campos y seleccione una Razon Social</p></li>
                                <li value="3"> <p>Agregue el servicio (una vez agregado el cliente seleccionelo y agregue el servicio) </p></li>
                        
                            </ol>
                            </center>
                       </div>
                    </div>
                    
                    <div class="signup-image">
                        <div class="flex-container-menu">
                            <div name="cli" id="cli" onclick="nuevoRazon()" ><img src="../../../../img/icon/razon.png" width="50%" height="40%"><br>Nueva Razon Social</div>
                            <div name="rs" id="rs" onclick="nuevoCliente()"> <img src="../../../../img/icon/cliente1.png" width="50%" height="40%"><br>Nueva Cliente </div>
                            <div name="ser" id="ser" onclick="nuevoServicio()"><img src="../../../../img/icon/servis.png" width="50%" height="40%"><br>Nuevo Servicio </div>
                            <div name="volver" id="volvrt" onclick="window.location.href='../../index.php'"><img src="../../../../img/icon/volver.png" width="50%" height="40%"><br>Volver </div>
                                
                        </div>
                        </div>
                            
                </div>
                  
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>