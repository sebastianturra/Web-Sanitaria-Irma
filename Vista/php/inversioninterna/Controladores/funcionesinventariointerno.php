<?php
include_once('../../../../Modelo/inversioninterna.php');
$inversioninterna = new InversionInterna();

if($_POST["funciones"] == "crear"){
    $TIPI_ID = $_POST['ne_tipi_id'];
    $ESTI_ID = $_POST['ne_esti_id'];
    $MODI_ID = $_POST['ne_modi_id'];    
    $DISI_ID = $_POST['ne_disi_id'];
    $BODI_CODIGO = $_POST['ne_bodi_codigo'];
    $BODI_FECHA = $_POST['ne_bodi_fecha'];
    $BODI_OBS = $_POST['ne_bodi_obs'];
    $BODI_OCUPADO = $_POST['ne_bodi_ocupado'];
    $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'];
    $BODI_COLOR = $_POST['ne_bodi_color'];

    $resultado=$inversioninterna->agregarbodi($TIPI_ID,$ESTI_ID,$MODI_ID,$DISI_ID,$BODI_CODIGO,
    $BODI_FECHA,$BODI_OBS,$BODI_OCUPADO,$BODI_LAVAMANO,$BODI_COLOR);

    if($resultado==true){
        echo "Creado Correctamente.";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../listarinvint.php'>";
    }else{
        echo "Fallo al crear el producto.";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../agregarinvint.php'>";
    }
}else if($_POST["funciones"] == "modificar"){
    $TIPI_ID = $_POST['ne_tipi_id'];
    $ESTI_ID = $_POST['ne_esti_id'];
    $MODI_ID = $_POST['ne_modi_id'];    
    $DISI_ID = $_POST['ne_disi_id'];
    $BODI_CODIGO = $_POST['ne_bodi_codigo'];
    $BODI_FECHA = $_POST['ne_bodi_fecha'];
    $BODI_OBS = $_POST['ne_bodi_obs'];
    $BODI_OCUPADO = $_POST['ne_bodi_ocupado'];
    $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'];
    $BODI_COLOR = $_POST['ne_bodi_color'];
    $banioid=$_POST['ne_bodi_id'];

    if($TIPI_ID!=1){
        $DISI_ID = 1;
        $BODI_LAVAMANO = 'NO';
    }

    $resultado = $inversioninterna->actbanio($TIPI_ID,$MODI_ID,$DISI_ID,$BODI_CODIGO,$BODI_FECHA,
    $BODI_OBS,$BODI_OCUPADO,$BODI_LAVAMANO,$BODI_COLOR,$banioid);

    if($resultado == true){
        echo "Modificado Correctamente el inventario";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../listarinvint.php'>";
    }else{
        echo "Fallo al modificar el inventario";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../modificarinvint.php'>";
    }    
}else if($_POST["funciones"] == "eliminar"){
    $banioid=$_POST['ne_bodi_id'];

    $resultado = $inversioninterna->elibanio($banioid);

    if($resultado == true){
        echo "Modificado Correctamente el inventario";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../listarinvint.php'>";
    }else{
        echo "Fallo al modificar el inventario";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../modificarinvint.php'>";
    }    
//SALIDAS Y ENTRADAS  ----------------------------------------------------------------------------------------------
}else if($_POST["funciones"] == "crearsalida"){ 
//SALENT
    $SALENT_FECHA = $_POST['ne_bodi_fecha'];
    $SALENT_HORA = $_POST['ne_salent_hora'];
    $SALENT_RESPONSABLE = $_POST['ne_salent_responsable'];
    $SALENT_EMPRESA = $_POST['nomras'];
    $SALENT_CANTIDAD = $_POST['ne_salent_cantidad'];
    $SALENT_CORREO = $_POST['ne_salent_correo'];
    $SALENT_TELEFONO = $_POST['ne_salent_telefono'];
    $SALENT_RECEPTOR = $_POST['ne_salent_receptor'];
    $SALENT_TIPO = $_POST['ne_salent_tipo'];
    $SALENT_NUMREP = $_POST['ne_salent_numrep'];
    $SALENT_GUIADESP = $_POST['ne_salent_guiadespacho'];
    $SALENT_OBS = $_POST['ne_bodi_obs'];
// tipo hidden
    $SALENT_SALESTADO = $_POST['ne_salestado']; 
    $SALENT_ESTADO = $_POST['ne_salentestado']; 
    
    $resultado = $inversioninterna->crearsalentint($SALENT_FECHA,$SALENT_HORA,$SALENT_RESPONSABLE,$SALENT_EMPRESA,
    $SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,$SALENT_TIPO,$SALENT_NUMREP,
    $SALENT_GUIADESP,$SALENT_SALESTADO,$SALENT_ESTADO,$SALENT_OBS);

    if($resultado == true){
        echo "<br>Salida Creada Correctamente<br>";
    }else{
        echo "<br>Falló al Crear Salida<br>";
    }

    $lastid = $inversioninterna->getlastsalent();
    $id_salida=$lastid[0]['ultimaid'];
    $SALENT_ID=$lastid[0]['ultimaid'];

    $agregaridsalida = $inversioninterna->agregaridsalida($id_salida,$SALENT_ID);
    if($agregaridsalida == true){
        echo "<br>Union Creada Correctamente<br>";
    }else{
        echo "<br>Falló al Crear Union Salida<br>";
    }

    foreach($_POST['ne_bodi_id'] AS $key=>$value){
        $BODI_ID = $_POST['ne_bodi_id'][$key];
        $SALENT_ID = $lastid[0]['ultimaid'];
        $DSALENT_TIPOSALENT = 'SALIDA';
        $DSALENT_ESTSAL = 'ACTIVA';
        $DSALENT_ESTADO = '1';
        $ESTI_ID = '2';
        $DISI_ID = $_POST['ne_disi_id'][$key];
        $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'][$key];
        $BODI_COLOR = $_POST['ne_bodi_color'][$key];

        $creardetalle = $inversioninterna->creardetsalentint($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,$DSALENT_ESTSAL,
        $DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR);
        if($creardetalle == true){
            echo "<br>Detalle de salida Creada Correctamente<br>";
        }else{
            echo "<br>Falló al Crear Detalle de Salida Creada Correctamente<br>";
        }
        $modificar=$inversioninterna->modificarbodsalent($DISI_ID,$BODI_LAVAMANO,$BODI_COLOR,$BODI_ID);
        if($modificar == true){
            echo "<br>Modificado Inventario Bodega Correctamente<br>";
        }else{
            echo "<br>Falló al Modoficar Inventario Bodega<br>";
        }
    }
                echo "<br><center>...Espere unos segundos...</center><br>"; 
                echo "<meta http-equiv='refresh' content='3; url=../listarsalent.php'>";

}else if($_POST["funciones"] == "crearentrada"){ 

    //SALENT
        $SALENT_ID_SAL = $_POST['id'];
        $SALENT_FECHA = $_POST['ne_bodi_fecha'];
        $SALENT_HORA = $_POST['ne_salent_hora'];
        $SALENT_RESPONSABLE = $_POST['ne_salent_responsable'];
        $SALENT_EMPRESA = $_POST['ne_salent_empresa'];
        $SALENT_CANTIDAD = $_POST['ne_salent_cantidad'];
        $SALENT_CORREO = $_POST['ne_salent_correo'];
        $SALENT_TELEFONO = $_POST['ne_salent_telefono'];
        $SALENT_RECEPTOR = $_POST['ne_salent_receptor'];
        $SALENT_TIPO = $_POST['ne_salent_tipo'];
        $SALENT_NUMREP = $_POST['ne_salent_numrep'];
        $SALENT_GUIADESP = $_POST['ne_salent_guiadespacho'];
        $SALENT_OBS = $_POST['ne_bodi_obs'];
    // tipo hidden
        $SALENT_SALESTADO = $_POST['ne_salestado']; 
        $SALENT_ESTADO = $_POST['ne_salentestado']; 
        
        $resultado = $inversioninterna->crearsalentint($SALENT_FECHA,$SALENT_HORA,$SALENT_RESPONSABLE,$SALENT_EMPRESA,
        $SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,$SALENT_TIPO,$SALENT_NUMREP,
        $SALENT_GUIADESP,$SALENT_SALESTADO,$SALENT_ESTADO,$SALENT_OBS);
    
        if($resultado == true){
            echo "<br>Entrada de Inventario Creada Correctamente<br>";
        }else{
            echo "<br>Falló al Crear Entrada de Inventario<br>";
        }

        $lastid = $inversioninterna->getlastsalent();

        $id_salida=$SALENT_ID_SAL;
        $SALENT_ID=$lastid[0]['ultimaid'];
        $id_entrada=$lastid[0]['ultimaid'];

        $agregaridsalida = $inversioninterna->agregaridsalidaentrada($id_salida,$id_entrada,$SALENT_ID);
        if($agregaridsalida == true){
            echo "<br>Union Creada Correctamente1<br>";
        }else{
            echo "<br>Falló al Crear Union Salida1<br>";
        }
        $agregaridsalida = $inversioninterna->agregaridsalidaentrada($id_salida,$id_entrada,$id_salida);
        if($agregaridsalida == true){
            echo "<br>Union Creada Correctamente2<br>";
        }else{
            echo "<br>Falló al Crear Union Salida2<br>";
        }
    
        foreach($_POST['ne_bodi_id'] AS $key=>$value){
            $BODI_ID = $_POST['ne_bodi_id'][$key]; // 0,1,2
            $DSALENT_ID = $_POST['ne_dsalent_id'][$key];
            $DSALENT_TIPOSALENT = 'ENTRADA';
            $DSALENT_ESTSAL = 'ACTIVA';
            $DSALENT_ESTADO = '1';
            $ESTI_ID = $_POST['ne_esti_id'][$key];
            $DISI_ID = $_POST['ne_disi_id'][$key];
            $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'][$key];
            $BODI_COLOR = $_POST['ne_bodi_color'][$key];
            if($ESTI_ID=='2'){
               $ESTI_ID='3';
                $modentradabod = $inversioninterna->modentradabod($DISI_ID,$ESTI_ID,$BODI_LAVAMANO,$BODI_COLOR,$BODI_ID);
            }else{
                $modentradabod = $inversioninterna->modentradabod($DISI_ID,$ESTI_ID,$BODI_LAVAMANO,$BODI_COLOR,$BODI_ID);
            }
            if($modentradabod==true){
                echo "<br>Inventario Desocupado Correctamente<br>";
            }else{
                echo "<br>Fallo al Desocupar Inventario<br>";
            }  
            $ESTI_ID='3';
            $creardetalle = $inversioninterna->creardetsalentint($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,$DSALENT_ESTSAL,
            $DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR);
            if($creardetalle == true){
                echo "<br>Detalle de Entrada Creado Correctamente<br>";
            }else{
                echo "<br>Falló al Crear Detalle de Entrada<br>";
            }
            $desactivardetsalidaant = $inversioninterna->desactivardetsalidaant($DSALENT_ID);
            if($desactivardetsalidaant==true){
                echo "<br>Modificado Detalle Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Modificar Detalle de Salida<br>";
            }        
        }
            $desactivarsalidaant = $inversioninterna->desactivarsalidaant($SALENT_ID_SAL);
            if($desactivarsalidaant==true){
                echo "<br>Modificado Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Modificar de Inventario<br>";
            }
           
            echo "<br><center>...Espere unos segundos...</center><br>"; 
            echo "<meta http-equiv='refresh' content='3; url=../listarsalent.php'>";

}else if($_POST["funciones"] == "eliminarsalent"){

    $OP = $_POST['op'];
    $salent_entrada = $_POST['ne_salent_entrada'];
    $salent_salida = $_POST['ne_salent_salida'];
    if($OP=='SALIDA'){
        $SALENT_ID_SAL = $_POST['id'];
        // Salida
        //1. cambiar el estado de la salida
               $desactivarsalidaant = $inversioninterna->desactivarsalidaant($SALENT_ID_SAL);
                    if($desactivarsalidaant==true){
                        echo "<br>Modificado Salida Correctamente<br>";
                    }else{
                        echo "<br>Fallo al Modificar de Inventario<br>";
                    }
               
               foreach($_POST['ne_bodi_id'] AS $key=>$value){
                    $DSALENT_ID = $_POST['ne_dsalent_id'][$key];
                    $BODI_ID = $_POST['ne_bodi_id'][$key];
        //2. cambiar el estado de los detalles salida
                    $desactivardetsalidaant = $inversioninterna->desactivardetsalidaant($DSALENT_ID);
                    if($desactivardetsalidaant==true){
                        echo "<br>Modificado Detalle Salida Correctamente<br>";
                    }else{
                        echo "<br>Fallo al Modificar Detalle de Salida<br>";
                    }  
        //3. cambiar el estado del inventario        
                    $habbanio = $inversioninterna->habbanio($BODI_ID);
                    if($habbanio==true){
                        echo "<br>Modificado Inventario Correctamente<br>";
                    }else{
                        echo "<br>Fallo al Modificar Inventario<br>";
                    }
                }                       
                echo "<br><center>...Espere unos segundos...</center><br>"; 
                echo "<meta http-equiv='refresh' content='3; url=../listarsalent.php'>";
        //FIN DE SALIDA
    }else{
        //ENTRADA
        //1. Identificar los datos de la entrada. HECHO
        //2. Identificar los datos detalles de la entrada.
        $detsalent= $inversioninterna->getdetsalent($salent_entrada); 
        //3. Cambiar de estado la entrada.
        $desactivarsalidaant = $inversioninterna->desactivarsalidaant($salent_entrada);
            if($desactivarsalidaant==true){
                echo "<br>Modificado Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Modificar de Inventario<br>";
            }
        //4. Cambiar de estado los detalle de las entradas.
        foreach($detsalent AS $key=>$value){
            $DSALENT_ID = $detsalent[$key]['dsalent_id'];
            $BODI_ID = $_POST['ne_bodi_id'][$key];
            $desactivardetsalidaant = $inversioninterna->desactivardetsalidaant($DSALENT_ID);
            if($desactivardetsalidaant==true){
                echo "<br>Modificado Detalle Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Modificar Detalle de Salida<br>";
            }  
             //10. Modificar estado baño
             $modentradabod = $inversioninterna->desbanio($BODI_ID);
             if($modentradabod==true){
                 echo "<br>Inventario Ocupado Correctamente<br>";
             }else{
                 echo "<br>Fallo al Ocupar Inventario<br>";
             }    
        }
        //5. Obtener la id de la salida correspondiente a la entrada.HECHO
        //6. Obtener los datos de la salida correspondiente.HECHO
        //7. Obtener los datos de los detalles de la salida correspondiente.
        $detsalent= $inversioninterna-> getdetsalent($salent_salida);

        foreach($detsalent AS $key=>$value){
            $DSALENT_ID = $detsalent[$key]['dsalent_id'];
        //9. Cambiar estdo de los detalles de la salida.
            $activardetsalidaant = $inversioninterna->activardetsalidaant($DSALENT_ID);
            if($activardetsalidaant==true){
                echo "<br>Activada Detalle Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Activar Salida<br>";
            }  
        //8. cambiar estado de la salida.
        $activarsalidaant = $inversioninterna->activarsalidaant($salent_salida);
            if($activarsalidaant==true){
                echo "<br>Activada Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Activar Salida<br>";
            }
        }         
//FIN DE ENTRADA   
    echo "<br><center>...Espere unos segundos...</center><br>"; 
    echo "<meta http-equiv='refresh' content='3; url=../listarsalent.php'>";
    }
    

}else if($_POST["funciones"] == "modificarsalent"){

    $OP = $_POST['op'];
    var_dump($OP);
    $salent_detalle_origen = $_POST['id'];
    $salent_entrada = $_POST['ne_salent_entrada'];
    $salent_salida = $_POST['ne_salent_salida'];
    if($OP=='SALIDA'){
        // Salida
       // Datos Originales (METODO)
       //2. Obtener los datos del detalle de la salida.
       $detsalent= $inversioninterna-> getdetsalent($salent_detalle_origen);
       // Datos Mandados
       //3. Obtener los datos de la salida
        $SALENT_FECHA = $_POST['ne_bodi_fecha'];
        $SALENT_HORA = $_POST['ne_salent_hora'];
        $SALENT_RESPONSABLE = $_POST['ne_salent_responsable'];
        $SALENT_EMPRESA = $_POST['nomras'];
        $SALENT_CANTIDAD = $_POST['ne_salent_cantidad'];
        $SALENT_CORREO = $_POST['ne_salent_correo'];
        $SALENT_TELEFONO = $_POST['ne_salent_telefono'];
        $SALENT_RECEPTOR = $_POST['ne_salent_receptor'];
        $SALENT_TIPO = $_POST['ne_salent_tipo'];
        $SALENT_NUMREP = $_POST['ne_salent_numrep'];
        $SALENT_GUIADESP = $_POST['ne_salent_guiadespacho'];
        $SALENT_OBS = $_POST['ne_bodi_obs'];

        //5. actualizar los datos de la salida
        $actualizarsalidaentrada = $inversioninterna->actualizarsalidaentrada($SALENT_FECHA,$SALENT_HORA,
        $SALENT_RESPONSABLE,$SALENT_EMPRESA,$SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,
        $SALENT_TIPO,$SALENT_NUMREP,$SALENT_GUIADESP,$SALENT_OBS,$salent_detalle_origen);
        if($actualizarsalidaentrada==true){
            echo "<br>Actualizado Salida Correctamente<br>";
        }else{
            echo "<br>Fallo Actualizando Salida<br>";
        }  

        foreach($detsalent AS $key=>$value){
            $BODI_ID = $detsalent[$key]['bodi_id'];
            $actualizardetsalent = $inversioninterna->habbanio($BODI_ID);
            if($actualizardetsalent==true){
                echo "<br>Desocupado Detalle Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Desocupar Detalle de Salida<br>";
            } 
        }

        //4. Obtener los datos del detalle de la salida.
        foreach($_POST['ne_bodi_id'] AS $key=>$value){
                $BODI_ID = $_POST['ne_bodi_id'][$key];
                $SALENT_ID = $salent_detalle_origen;
                $DSALENT_TIPOSALENT = 'SALIDA';
                $DSALENT_ESTSAL = 'ACTIVA';
                $DSALENT_ESTADO = '1';
                $ESTI_ID = '2';
                $DISI_ID = $_POST['ne_disi_id'][$key];
                $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'][$key];
                $BODI_COLOR = $_POST['ne_bodi_color'][$key];
                $DSALENT_ID = $_POST['ne_dsalent_id'][$key];
            $actualizardetsalent = $inversioninterna->actualizardetsalent($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,
            $DSALENT_ESTSAL,$DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR,$DSALENT_ID);
            if($actualizardetsalent==true){
                echo "<br>Modificado Detalle Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Modificar Detalle de Salida<br>";
            }
            $desbanio = $inversioninterna->desbanio($BODI_ID);
            if($desbanio==true){
                echo "<br>Ocupado Detalle Salida Correctamente<br>";
            }else{
                echo "<br>Fallo al Ocupar Detalle de Salida<br>";
            } 
        }
        echo "<br><center>...Espere unos segundos...</center><br>"; 
        echo "<meta http-equiv='refresh' content='3; url=../listarsalent.php'>";

//FIN DE SALIDA

    }else{
       // Entrada
       // Datos Originales (METODO)
       //1. Obtener los datos de detalle de la entrada.
       $detsalent= $inversioninterna->getdetsalent($salent_entrada);
       // Datos Mandados
       //2. Obtener los datos de la entrada
        $SALENT_FECHA = $_POST['ne_bodi_fecha'];
        $SALENT_HORA = $_POST['ne_salent_hora'];
        $SALENT_RESPONSABLE = $_POST['ne_salent_responsable'];
        $SALENT_EMPRESA = $_POST['nomras'];
        $SALENT_CANTIDAD = $_POST['ne_salent_cantidad'];
        $SALENT_CORREO = $_POST['ne_salent_correo'];
        $SALENT_TELEFONO = $_POST['ne_salent_telefono'];
        $SALENT_RECEPTOR = $_POST['ne_salent_receptor'];
        $SALENT_TIPO = $_POST['ne_salent_tipo'];
        $SALENT_NUMREP = $_POST['ne_salent_numrep'];
        $SALENT_GUIADESP = $_POST['ne_salent_guiadespacho'];
        $SALENT_OBS = $_POST['ne_bodi_obs'];
        //4. Actualizar los datos de la entrada
        $actualizarsalidaentrada = $inversioninterna->actualizarsalidaentrada($SALENT_FECHA,$SALENT_HORA,
        $SALENT_RESPONSABLE,$SALENT_EMPRESA,$SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,
        $SALENT_TIPO,$SALENT_NUMREP,$SALENT_GUIADESP,$SALENT_OBS,$salent_entrada);
        if($actualizarsalidaentrada==true){
            echo "<br>Actualizada Entrada Correctamente<br>";
        }else{
            echo "<br>Fallo Actualizando Entrada<br>";
        } 

        foreach($detsalent AS $key=>$value){
            $ESTI_ID = $detsalent[$key]['esti_id'];
           // echo $ESTI_ID;
           /*   if($ESTI_ID='3'){
                $desbanio = $inversioninterna->desbanio($detsalent[$key]['bodi_id']);
                if($desbanio==true){
                    echo "<br>Ocupado Detalle Salida Correctamente<br>";
                }else{
                    echo "<br>Fallo al Ocupar Detalle de Salida<br>";
                }
              }   */           
        }

          //3. Obtener los datos de detalle de la entrada
        foreach($_POST['ne_esti_id'] AS $key=>$value){
        if($_POST['ne_esti_id'][$key]=='2'){
            $ESTI_ID='3';  
           //  echo $ESTI_ID;
        }else{
            $ESTI_ID=$_POST['ne_esti_id'][$key];
           // echo $ESTI_ID;
        }   
        $BODI_ID = $_POST['ne_bodi_id'][$key];
        $SALENT_ID = $salent_entrada;
        $DSALENT_TIPOSALENT = 'ENTRADA';
        $DSALENT_ESTSAL = 'ACTIVA';
        $DSALENT_ESTADO = '1';
        $DISI_ID = $_POST['ne_disi_id'][$key];
        $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'][$key];
        $BODI_COLOR = $_POST['ne_bodi_color'][$key];
        $DSALENT_ID = $_POST['ne_dsalent_id'][$key];

        $actualizardetsalent = $inversioninterna->actualizardetsalent($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,
        $DSALENT_ESTSAL,$DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR,$DSALENT_ID);
        if($actualizardetsalent==true){
                echo "<br>Modificado Detalle Salida Correctamente<br>";
        }else{
                echo "<br>Fallo al Modificar Detalle de Salida<br>";
        } 

        $changeestadobanio = $inversioninterna->changeestadobanio($ESTI_ID,$BODI_ID);
        if($changeestadobanio==true){
            echo "<br>Modificado Estado Correctamente<br>";
        }else{
            echo "<br>Fallo al Modificar Estado<br>";
        }
    } 
       //6. Obtener id de la salida. HECHO 
       //7. Obtener los datos de la salida
        $salent= $inversioninterna->getbaniosalidaentrada($salent_salida);
        $detsalentsalida= $inversioninterna->getdetsalent($salent_salida);
        //var_dump($detsalentsalida);
       //8. Actualizar datos de salida.
       $SALENT_FECHA = $salent[0]['salent_fecha'];
       $SALENT_HORA = $salent[0]['salent_hora'];
       $SALENT_RESPONSABLE = $_POST['ne_salent_responsable'];
       $SALENT_EMPRESA = $_POST['ne_salent_empresa'];
       $SALENT_CANTIDAD = $_POST['ne_salent_cantidad'];
       $SALENT_CORREO = $_POST['ne_salent_correo'];
       $SALENT_TELEFONO = $_POST['ne_salent_telefono'];
       $SALENT_RECEPTOR = $_POST['ne_salent_receptor'];
       $SALENT_TIPO = $salent[0]['salent_tipo'];
       $SALENT_NUMREP = $_POST['ne_salent_numrep'];
       $SALENT_GUIADESP = $_POST['ne_salent_guiadespacho'];
       $SALENT_OBS = $_POST['ne_bodi_obs'];
       //4. Actualizar los datos de la entrada
       $actualizarsalidaentrada = $inversioninterna->actualizarsalidaentrada($SALENT_FECHA,$SALENT_HORA,
       $SALENT_RESPONSABLE,$SALENT_EMPRESA,$SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,
       $SALENT_TIPO,$SALENT_NUMREP,$SALENT_GUIADESP,$SALENT_OBS,$salent_salida);
       if($actualizarsalidaentrada==true){
           echo "<br>Actualizado Entrada Correctamente<br>";
       }else{
           echo "<br>Fallo Actualizando Entrada<br>";
       }

       //9. cambiar datos de los detalles salida.    
       foreach($_POST['ne_esti_id'] AS $key=>$value){ 
        $BODI_ID = $_POST['ne_bodi_id'][$key];
        $SALENT_ID = $salent_salida;
        $DSALENT_TIPOSALENT = 'SALIDA';
        $DSALENT_ESTSAL = 'DESACTIVAD';
        $DSALENT_ESTADO = '1';
        $ESTI_ID='3';
        $DISI_ID = $_POST['ne_disi_id'][$key];
        $BODI_LAVAMANO = $_POST['ne_bodi_lavamano'][$key];
        $BODI_COLOR = $_POST['ne_bodi_color'][$key];
        $DSALENT_ID = $detsalentsalida[$key]['dsalent_id'];
        $actualizardetsalent = $inversioninterna->actualizardetsalent($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,
        $DSALENT_ESTSAL,$DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR,$DSALENT_ID);
        if($actualizardetsalent==true){
                echo "<br>Modificado Detalle Salida Correctamente<br>";
            }else{
             echo "<br>Fallo al Modificar Detalle de Salida<br>";
            }
        }
//FIN DE ENTRADA        
  }
  echo "<br><center>...Espere unos segundos...</center><br>"; 
  echo "<meta http-equiv='refresh' content='3; url=../listarsalent.php'>";
}else{
    echo "función no encontrada";
}
?>