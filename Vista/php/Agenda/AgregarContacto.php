<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Agregar Contacto - Sistema Salitrera Irma Ltda</title>

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
                            <h2 class="form-title">Nuevo Contacto</h2></center>
                            <form method="POST" action="../../../../Controlador/ctrl_agregarContacto.php" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Nombres"/>
                            </div>
                            <div class="form-group">
                                <label for="Apellidos"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="ape" id="ape" placeholder="Apellidos"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Correo"/>
                            </div>
                            <div class="form-group">
                                <label for="fono"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="fono" id="fono" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="direccion"><i class="zmdi zmdi-directions-walk"></i></label>
                                <input type="text" name="dire" id="dire" placeholder="Direccion"/>
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Agregar" />
                                <input type="button" name="volver" id="volver" class="form-submit" value="Volver" onclick="window.location.href='../index.php'"/>
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