<?php
include_once("../../../../Modelo/Cliente.php");
$cli=new Cliente();
$data=$cli->ListarClienteConRazonSocial();

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


<h2 class="form-title">Nuevo Servicio</h2></center>
                            <form method="POST" action="../../../../Controlador/ctrl_agregarServicio.php" class="register-form" id="register-form">
                            
                                <table class="table-bordered table-hover" style="text-align: right;">
                                    <tr>
                                        <td style="width: 200px"><p><i class="zmdi zmdi-card" style="font-size: 20px"></i> &nbsp;Cliente </p></td>
                                        <td><select class="btn btn-block" id="sercli" name="sercli" style=" color: grey" required="">
                                                        <option>Seleccione un Cliente... </option>
                                                        <?php
                                                        $i=0;
                                                        while($i<count($data)){
                                                            echo "<option value=".$data[$i]["cod"]."> ID#".$data[$i]["cod"]." - ".$data[$i]["rut"]." - ".$data[$i]["nom"]." ".$data[$i]["ape"]." [R.S: ".$data[$i]["rutrs"]." - ".$data[$i]["nomrs"]." - ".$data[$i]["dirers"]."] </option>";
                                                            $i++;
                                                        }
                                                        
                                                        ?>
                                            </select> </td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-money" style="font-size: 20px"></i> &nbsp;Valor Arriendo Baño</p></td>
                                        <td><input type="number" name="valorb" id="valorb" placeholder="Valor Arriendo" style="width: 200px" /></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-money" style="font-size: 20px"></i> &nbsp;Cantidad Baños</p></td>
                                        <td><input type="number" name="cantb" id="cantb" placeholder="N° de Baños" style="width: 200px"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Mantencion Semanal</p></td>
                                        <td><input type="number" name="mant" id="mant" placeholder="N° de Mantenciones" style="width: 200px"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><i class="zmdi zmdi-calendar" style="font-size: 20px"></i> &nbsp;Fecha Cierre Factura</p></td>
                                        <td><input type="date" name="fechaf" id="fechaf" placeholder="Fecha..." style="width: 200px; color: grey"/></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><p><i class="zmdi zmdi-money" style="font-size: 20px"></i> &nbsp;Valor Limpa Fosa</p></td>
                                        <td><input type="number" name="valorf" id="valorf" placeholder="Valor Fosa" style="width: 200px"/></td>
                                    </tr>
                                     <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Area</p></td>
                                        <td><input type="text" name="area" id="area" placeholder="Area" style="width: 200px"/></td>
                                    </tr>
                                     <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Otros</p></td>
                                        <td><textarea type="text" name="otro" id="otro" placeholder="Escriba aqui...."  style="width: 200px; height: 200px" maxlength="100"></textarea></td>
                                    </tr>
                                     <tr>
                                        <td><p><i class="zmdi zmdi-file" style="font-size: 20px"></i> &nbsp;Observacion</p></td>
                                        <td><textarea type="text" name="obs" id="obs" placeholder="Escriba aqui...." style="width: 200px; height: 250px" maxlength="500"></textarea></td>
                                    </tr>
                                    
                                </table>
                                
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Agregar Servicio" />
                                
                            </div>
                    </form>