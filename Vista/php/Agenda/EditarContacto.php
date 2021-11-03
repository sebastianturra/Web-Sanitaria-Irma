<?php
include("../../../../Modelo/Agenda.php");
$codigo=$_GET["codigo"];
$age = new Agenda();
$data=$age ->BusquedaContactoAgendaCodigo($codigo);

if ($data){
    ?>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Editar Contacto - Sistema Salitrera Irma Ltda</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <center> <img src="../../../../img/logo2.png"><br>
                            <h2 class="form-title">Editar Contacto</h2></center>
                            <form method="POST" action="../../../../Controlador/ctrl_editarContacto.php" class="register-form" id="register-form">
                            <div class="form-group">
                                <input type="hidden" id="cod" name="cod" value="<?php echo $data[0]["cod"] ?>">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" value="<?php echo $data[0]["nombre"] ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="Apellidos"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="ape" id="ape" value="<?php echo $data[0]["ape"] ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" value="<?php echo $data[0]["ema"] ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="fono"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="fono" id="fono" value="<?php echo $data[0]["fono"] ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="direccion"><i class="zmdi zmdi-directions-walk"></i></label>
                                <input type="text" name="dire" id="dire" value="<?php echo $data[0]["dire"] ?>"/>
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Agregar" />
                                <input type="button" name="volver" id="volver" class="form-submit" value="Volver" onclick="window.location.href='ListarContacto.php'"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../../../../img/icon/Agenda3.png" width="100%" height="100%" style="padding-bottom: 25%; padding-top: 70%"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
}else{
    echo "error";
}



?>
