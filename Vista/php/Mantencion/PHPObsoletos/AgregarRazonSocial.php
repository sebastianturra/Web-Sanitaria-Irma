<head>
    
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>


<h2 class="form-title">Nueva Razon Social</h2></center>
<form method="POST" action="../../../../Controlador/crtl_agregarRazonSocial.php" class="register-form" id="register-form">
                                <div id="msj"> </div>
                                <table class="table-bordered table-hover" style="text-align: right;">
                                    <tr>
                                        <td><p><i class="zmdi zmdi-card" style="font-size: 20px"></i> &nbsp;Rut Razon Social</p></td>
                                        <td><input type="text" name="rutrs" id="rutrs" placeholder="ej:16226980-1" maxlength="11" required=""  /></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-account material-icons-name" style="font-size: 20px"></i> &nbsp;Nombre</p></td>
                                        <td><input type="text" name="namers" id="namers" placeholder="Nombres de la Razon Social" maxlength="100"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-phone" style="font-size: 20px"></i> &nbsp;Fono</p></td>
                                        <td><input type="number" name="fonors" id="fonors" placeholder="Telefono" maxlength="9"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><p><i class="zmdi zmdi-email" style="font-size: 20px"></i> &nbsp;Correo</p></td>
                                        <td><input type="email" name="mailrs" id="mailrs" placeholder="Correo Razon Social" maxlength="100"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Ciudad</p></td>
                                        <td><input type="text" name="ciudadrs" id="ciudadrs" placeholder="Ciudad"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Direccion</p></td>
                                        <td><input type="text" name="dirers" id="dirers" placeholder="Direccion Razon Social"/></td>
                                    </tr>
                                    
                                </table>
                                
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Agregar Razon Social"  />
                                
                            </div>
                    </form>