<?php
include_once('../../../../Modelo/RazonSocial.php');
include_once('../../../../Modelo/Sexo.php');
      $rs=new RazonSocial();
      $sx=new Sexo();
                                                        $data=$rs->ListarRazonSocial();
                                                        $datasx=$sx->listarSexo();
?>
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
</head>
<center> 
                            <h2 class="form-title">Nuevo Cliente</h2></center>
                            <figure><img src="../../../../img/icon/cliente1.png" width="25%" height="25%" ></figure>
                            <form method="POST" action="../../../../Controlador/ctrl_agregarCliente.php" class="register-form" id="register-form">
                            
                                <table class="table-bordered table-hover" style="text-align: right;">
                                     <tr>
                                        <td><p><i class="zmdi zmdi-card" style="font-size: 20px"></i> &nbsp;Razon Social</p></td>
                                                <td style="background-color:white">
                                                    <select name="codrs" id="codrs" class="btn btn-block" style="width: 148px; color: grey" >
                                                        <option value="0">Seleccione.... </option>
                                                        <?php
                                                  
                                                        $i=0;
                                                        while($i<count($data)){
                                                            echo "<option value=".$data[$i]["cod"]."> id#".$data[$i]["cod"]." - ".$data[$i]["rut"]." - ".$data[$i]["nom"]." - ".$data[$i]["dire"]." </option>";
                                                            $i++;
                                                        }
                                                        ?>
                                                        
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-card" style="font-size: 20px"></i> &nbsp;Rut</p></td>
                                        <td><input type="text" name="rut" id="rut" placeholder="Rut Cliente" maxlength="11"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-account material-icons-name" style="font-size: 20px"></i> &nbsp;Nombres</p></td>
                                        <td><input type="text" name="name" id="name" placeholder="Nombres del Cliente" maxlength="30" /></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-account material-icons-name" style="font-size: 20px"></i> &nbsp;Apellidos</p></td>
                                        <td><input type="text" name="ape" id="ape" placeholder="Apellidos del Cliente" maxlength="30" /></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-phone" style="font-size: 20px"></i> &nbsp;Fono</p></td>
                                        <td><input type="number" name="fono" id="fono" placeholder="Telefono del Cliente" maxlength="9"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-phone" style="font-size: 20px"></i> &nbsp;Celular</p></td>
                                        <td><input type="number" name="cel" id="cel" placeholder="Celular del Cliente" maxlength="9"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-email" style="font-size: 20px"></i> &nbsp;Correo</p></td>
                                        <td><input type="email" name="mail" id="mail" placeholder="Correo Cliente" maxlength="100"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-male-female" style="font-size: 20px"></i> &nbsp;Sexo</p></td>
                                        <td style="background-color:white"><select name="sex" id="sex"  class="btn btn-block" style="width: auto; color: grey">
                                                <?php 
                                                $i=0;
                                                while($i<count($datasx)){
                                                    echo "<option value='".$datasx[$i]["cod"]."'>".$datasx[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                               </select></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-money" style="font-size: 20px"></i> &nbsp;Condicion Venta</p></td>
                                        <td><input type="text" name="venta" id="venta" placeholder="Condicion de venta"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-money" style="font-size: 20px"></i> &nbsp;Giro</p></td>
                                        <td><input type="text" name="giro" id="giro" placeholder="Giro Cliente"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Entrega Factura</p></td>
                                        <td><input type="text" name="factura" id="factura" placeholder="Factura Cliente"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-key" style="font-size: 20px"></i> &nbsp;Password</p></td>
                                        <td><input type="password" name="pass" id="pass" placeholder="Contraseña"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-key" style="font-size: 20px"></i> Password</p></td>
                                        <td><input type="password" name="pass2" id="pass2" placeholder=" Repetir Contraseña"/></td>
                                    </tr>
                                </table>
                                <center><div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Agregar Cliente" />
                              
                                    </div></center>
                  
                        </form>