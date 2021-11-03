<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Carta de Aviso</title>
        <style type="text/css">
        body{
            max-width: 96%;
        }    
        table{
            width: 100%;
        }
        p{
            text-align: justify;
            font-size: 18px;
            margin:  10px
        }
        #cabecera{
            background:white;
            width: 100%;
            padding:20px;
        }
 
        #cuerpo{
            width: 100%;
                padding:20px;
             background:white;
        }
        #pie{
            width: 100%;
            padding:20px;
            background:white;
        }
       
        </style>
    </head>
<?php 
include_once('../../../../Modelo/Personal.php');
setlocale(LC_ALL,"es_ES");
$fechaActual= ucwords(strftime("%A"))." ".strftime("%d")." de ". ucwords(strftime("%B"))." del ".strftime("%Y");    
$id=$_GET['id'];
$per =new Personal();




switch($id){
case 1 :
            $rut=$_GET['rut'];
            $fingp=$datoper[0]["fingp"];
            $fter=$_GET['fter'];
            $fechaingreso = date("d", strtotime($fingp))." de ".date("m", strtotime($fingp))." del ".date("Y", strtotime($fingp));
            $fechatermino = date("d", strtotime($fter))." de ".date("m", strtotime($fter))." del ".date("Y", strtotime($fter));
            $datoper=$per->BusqPerDato(0, $rut);

?>
    <body>
        <div id="cabecera">
            <img src="../../../../img/icon/logo3.png" width="100px" height="200px">
            <br>
            
           <p style="text-align: right">  <b>Arica,  <?php echo $fechaActual;?></b></p>
            
            <br>
            <h1 style="text-align: center">CARTA AVISO</h1><br>
            <?php
            if($datoper[0]["sexp"]=="F"){
            ?>
            <p> <b>SEÑORA:</b> <?php echo $datoper[0]["nomp"]." ".$datoper[0]["apep"];?>  <br>
            <?php
            }else{
            ?>
            <p> <b>SEÑOR:</b> <?php echo $datoper[0]["nomp"]." ".$datoper[0]["apep"];?>  <br>
            <?php
             }
            ?>
            <b>RUT:</b>  <?php echo $datoper[0]["rutp"];?> <br>
            <b>PRESENTE</b> </p>
        </div>
        <div id="cuerpo">
            
            <p>     Ponemos en su conocimiento, que se ha dispuesto poner término de su contrato de trabajo por las causales de hecho y de derecho que a continuación se exponen: </p>
            
            <br>

            <p><b>CAUSALES DE HECHO:</b> Ud. Fue contratado con fecha <b><?php echo $fechaingreso; ?></b> como <b><?php echo $datoper[0]["carnom"]?></b>, en la <b>Empresa Salitrera IRMA ltda.</b>
    trabajo que se cumple a satisfacción de esta empresa con aviso de 30 días de anticipación.</p>
<br>
<p><b>CAUSAL DE DERECHO:</b> Lo anterior constituye causa justificada de término de contrato, sancionada como tal por el Art. 161 del Código del Trabajo. “Necesidades de la empresa”.</p>
<br>

<p>Por lo tanto, notificamos a Ud. El término de su servicio a partir del día <b><?php echo $fechatermino;?></b>,
    a cuyo término cancelaremos a Ud. Los días trabajados por el periodo correspondiente.</p>

<p>De conformidad a la ley comunico a Ud. El estado de sus aportes previsionales <b>(<?php echo $datoper[0]['prev'];?>)</b> y seguridad social <b>(<?php echo $datoper[0]['salud'];?>)</b> se encuentran al día.</p>

        
        
        </div>
        <div id="pie">
            <p>Sin otro particular,
               saluda atte. A Ud.</p>
            <br>           
            
            <p style="text-align: right">Nombre :</p>
            <p style="text-align: right">R.U.T: </p>  

        
        </div>
    </body>
    <?php
    break;
///////////////////////////////////////////////////////////////////////////////////////////////////    
case 2:
            $rut=$_GET['rut'];
            $fini=$_GET['fini'];
            $fter=$_GET['fter'];
            $mod=$_GET['mod'];
            $fechainicio = date("d", strtotime($fini))." de ".date( "m", strtotime($fini))." del ".date("Y", strtotime($fini));
            $fechatermino = date("d", strtotime($fter))." de ".date("m", strtotime($fter))." del ".date("Y", strtotime($fter));
            $datoper=$per->BusqPerDato(0, $rut);
    ?> 
    
    <body>
        <div id="cabecera">
            <img src="../../../../img/icon/logo3.png" width="100px" height="200px">
            <br>
            
           <p style="text-align: right">  <b>Arica,  <?php echo $fechaActual;?></b></p>
            
            <br>
            
            <h1 style="text-align: center">COMPROBANTE DE FERIADO</h1><br>
          
        </div>
        <div id="cuerpo">
            
            <p>En cumplimiento a las disposiciones legales vigentes se deja constancia que a contar</p>

            <p style="text-align: center"><b>Del <?php echo $fechainicio;?></b>      Hasta <b>  el <?php echo $fechatermino;?></b></p>



            <p>El Sr. (a):<b> <?php echo $datoper[0]['nomp']." ".$datoper[0]['apep'];?></b> &nbsp;&nbsp;&nbsp;&nbsp;  RUT: <b><?php echo $datoper[0]['rutp'];?></b></p><br>
         <?php
         if($mod=="P"){
         ?>             
            <p> Hará  uso de su feriado Anual         TOTAL:  <b>&nbsp;&nbsp;&nbsp;&nbsp;</b> PARCIAL:  <b>X</b> </p>           
         <?php    
         }else{
         ?>   
      <p> Hará  uso de su feriado Anual         TOTAL:  <b>X</b> PARCIAL:  <b>&nbsp;&nbsp;&nbsp;&nbsp;</b> </p>                 
         <?php
            }
         ?>   
      <br>

            <p>ESTE FERIADO CORRESPONDE AL AÑO TRABAJADO ENTRE:</p>

            <p style="text-align:center"><b><?php echo "El 01 de 01 del ".date("Y"); ?> </b> AL <b><?php echo " 31 de 12 del ".date("Y"); ?></b></p>

        </div>
        <div id="pie">
            <table style="width: auto; margin:auto">
                <tr>
                    <td style="text-align:center"><p style="text-align:center">____________________________</p><br>
                        <p style="text-align:center">FIRMA DEL EMPLEADOR</p><br> </td>
                    <td style="text-align:center"><p style="text-align:center">____________________________</p><br>
                        <p style="text-align:center">FIRMA DEL TRABAJOR.</p><br></td>
                </tr>
            </table>
            <br>
<p style="text-align: center">Nota: Uno de lo ejemplares queda en poder del trabajador y otro del empleador..</p>
            <br>           
          
        </div>
    </body>

    <?php 
    break;
/////////////////////////////////////////////////////////////////////////////////////////////////////    
case 3: 
            $rut=$_GET['rut'];
            //$fechainicio = date("d", strtotime($fini))." de ".date( "m", strtotime($fini))." del ".date("Y", strtotime($fini));
            //$fechatermino = date("d", strtotime($fter))." de ".date("m", strtotime($fter))." del ".date("Y", strtotime($fter));
            $datoper=$per->BusqPerDato(0, $rut);
    ?>
    <body>
        <div id="cabecera">
            <img src="../../../../img/icon/logo3.png" width="100px" height="200px">
            <br>
            
           <p style="text-align: right">  <b>Arica,  <?php echo $fechaActual;?></b></p>
            
            <br>
            
            <h1 style="text-align: center">CARTA DE AMONESTACIÓN </h1><br>
          <?php
            if($datoper[0]["sexp"]=="F"){
            ?>
            <p> <b>SEÑORA:</b> <?php echo $datoper[0]["nomp"]." ".$datoper[0]["apep"];?>  <br>
            <?php
            }else{
            ?>
            <p> <b>SEÑOR:</b> <?php echo $datoper[0]["nomp"]." ".$datoper[0]["apep"];?>  <br>
            <?php
             }
            ?>
            <b>RUT:</b>  <?php echo $datoper[0]["rutp"];?> <br>
            <b>PRESENTE</b> </p>
        </div>
        <div id="cuerpo">
            
            <p><b>Salitrera Irma servicios de Higiene Ltda.</b>, se ve en la obligación de  amonestarlo  en forma escrita, 
                Recordándole   a UD. de   sus  obligaciones las cuales están insertas en su contrato de  trabajo que  usted  mantiene  con esta empresa.</p><br>

<p>Es por eso  cualquier   incumplimiento  en relación  a sus labores  y el caso omiso a cualquier instrucción dada por sus  empleadores, 
en relación que cada  trabajador  tendrá que cumplir  sus  obligaciones contractuales especificadas en su contrato, no se está cumpliendo, 
será considerada  una  Falta Grave  a  las obligaciones que le impone el contrato, situación que es de su conocimiento y que además se encuentra
contemplada en el reglamento interno de orden higiene y seguridad de la empresa.</p><br>
 
 
<p>Por la presente carta amonestación se requiere el estricto cumplimiento de las instrucciones dadas por su jefatura, de lo contrario, 
    se adoptarán las medidas pertinentes, inclusive la terminación del contrato de trabajo.</p><br>

        </div>
        <div id="pie">
            <p>Saluda a usted.</p><br>
 
            <p style="text-align: right"><b>Salitrera Irma Ser. De Higiene Ltda.</b> </p>
            <p style="text-align: right"><b>76.089.282-3</b></p><br>

        </div>
    </body>
    <?php
    break;
////////////////////////////////////////////////////////////////////////////////////////////////////////    
case 4:
    ?>
    <body>
        <div id="cabecera">
            <img src="../../../../img/icon/logo3.png" width="100px" height="200px">
            <br>
           
            <h1 style="text-align: center">CONTRATO DE TRABAJO EXTRANJERO </h1><br>
         
        </div>
        <div id="cuerpo">
            
            <p> En Arica,<b> <?php echo $fechaActual;?></b>, entre Don, <b>SALITRERA IRMA SERVICIOS DE HIGIENE LTDA.</b> . RUT,______________
                Rep. Legal Don:________________ Rut:_______________ con domicilio en ARICA, y Don;_______________,
                C.IDENTIDAD/PASPORTE Nº: _____________/_____________Nacionalidad__________, Fecha de Nac. 00/00/0000, 
                con domicilio _________________, Arica, se ha convenido el siguiente contrato de trabajo, 
                para cuyos efectos las partes convienen denominarse EMPLEADOR Y TRABAJADOR.</p><br>

            <p><b>Primero:</b> El trabajador  se compromete a ejecutar el trabajo de :________________ en el establecimiento de :_______________.,
                ubicado en la ciudad de ARICA, __________________., pudiendo ser trasladado a otro domicilio o labores similares dentro
                y fuera de la ciudad sin que ello importe menoscabo para el trabajador.</p><br>

            <p><b>Segundo:</b> La jornada de trabajo será:</p>
            <br>
            <br>
            <br>
                                             
            <p><b>Tercero:</b> El tiempo extraordinario se pagará con el recargo legal
                y se cancelará conjuntamente con el respectivo sueldo.</p><br>
            
            <p><b>Cuarto:</b> El empleador se compromete a remunerar al trabajador con la suma de$______________ (____________), por mes.
                Las remuneraciones se pagaran mensualmente por cada periodo vencido, en dinero Efectivo moneda nacional y del monto de ellas
                el empleador hará las deducciones que establecen las Leyes vigentes.</p> <br>
            
            <p><b>Quinto:</b> El  presente contrato de trabajo  será , de FORMA INDEFINIDA  y  podrá  ponérsele término  para cuando concurran
                para ello causas justificadas que, en conformidad a la ley, puedan producir su caducidad, o sea  permitido dar al trabajador el aviso de desahucio,
                con 30 días de anticipación,  a lo menos.
                Se entienden incorporadas al presente contrato todas las disposiciones legales que se dicten con posterioridad a la fecha de suscripción y que tengan relación con él.
                El trabajador tendrá dos domingos libres al mes.</p> <br>

            <p><b>Sexto:(clausula de Vigencia)</b> La obligación de prestar servicios emanada del presente contrato solo podrá cumplirse una vez que 
                el trabajador haya obtenido la visacion de residencia correspondiente en chile o el permiso especial de trabajo para extranjeros con visa en trámite.</p> <br>

<p><b>Séptimo: (clausula régimen previsional)</b> se deja constancia que el trabajador cotizara en el régimen Previsional Chileno,
    comprometiéndose el empleador a efectuar las retenciones y entregarlas a las instituciones correspondientes.</p> <br>

<p><b>Octavo: (Clausula impuesto a la Renta) </b>  El empleador tiene la obligación de responder al pago de impuestos a la renta correspondiente en relación con la remuneración pagada (solo para sueldos superiores a 13,5 UTM)</p> <br>

<p><b>Noveno:</b> “El empleador se compromete a pagar, al término de la relación laboral (ya sea por término de contrato, despido o renuncia), el pasaje de regreso del trabajador y los miembros de su familia que se estipulen,
    a su país de origen o al que oportunamente acuerden las partes, conforme a lo dispuesto en el inciso 2º, del artículo 37 del D.S. Nº597 de 1984. Al respecto, se tendrá presente que la señalada obligación del empleador existirá hasta que
    el extranjero salga del país u obtenga nueva visacion o permanencia definitiva”.</p> <br>

<p><b>Decimo:</b> Se firma el presente contrato con dos ejemplares del mismo tenor y quedando uno en poder del trabajador.</p> <br>

<p><b>Undécimo:</b> Se deja constancia que Don,_______________. Ingresó al servicio el 00/00/ 2000.-</p> <br>
<p><b>Sistema de Salud:</b> </p>
<p><b>A.F.P.:</b></p>                 

        </div>
        <div id="pie">
           <table style="width: auto; margin:auto">
                <tr>
                    <td style="text-align:center"><p style="text-align:center">___________________</p><br>
                        <p style="text-align:center">FIRMA DEL TRABAJADOR</p><br>
                        <p style="text-align:center">CI:________________</p><br></td>
                    <td style="text-align:center"><p style="text-align:center">___________________</p><br>
                        <p style="text-align:center">FIRMA DEL TRABAJOR.</p><br>
                        <p style="text-align:center">Se entregó copia fiel  </p><br></td>
                     <td style="text-align:center"><p style="text-align:center">__________________</p><br>
                        <p style="text-align:center">FIRMA DEL EMPLEADOR.</p><br>
                        <p style="text-align:center">RUT:________________</p><br><</td>
                </tr>
            </table>

        </div>
    </body>
    <?php
    break;    
case 5:
    ?>
    <body>
        <div id="cabecera">
            <img src="../../../../img/icon/logo3.png" width="100px" height="200px">
            <br>
           
            <h1 style="text-align: center">CONTRATO DE TRABAJO </h1><br>
         
        </div>
        <div id="cuerpo">
            
            <p> En Arica,<b> <?php echo $fechaActual; ?></b>, entre la empresa Razón Social________.
                Rut Nº_________, representada legalmente por Don __________, 
                Cédula de Identidad N° __________, ambos con domicilio en _________,
                comuna de Arica, Chile y:</p><br>

            <p>Don (a):</p>	
            <p>Cédula de identidad:</p>	
            <p>Nacionalidad:</p> 	
            <p>Domiciliado (a) en:</p>	
            <p>Teléfono:</p>	<br>

            <p>Se ha convenido el siguiente <b><u>CONTRATO DE TRABAJO</u></b>, para cuyos efectos 
                las partes convienen denominarse respectivamente, EMPLEADOR y TRABAJADOR, 
                y cuyas cláusulas son las siguientes: </p>

            <p><b>PRIMERO	:</b>	El TRABAJADOR declara que la información relacionada a sus antecedentes personales, 
                plasmada en éste contrato, han sido proporcionados por él,por lo que el EMPLEADOR se libera de toda responsabilidad
                en caso que los antecedentes consignados fuesen erróneos o no correspondiesen a la realidad.</p><br>
            
            <p>Será responsabilidad y obligación del TRABAJADOR informar al EMPLEADOR, cualquier modificación que estos antecedentes
                puedan sufrir durante el tiempo que dure el presente contrato.</p><br>

            <p><b>SEGUNDO	:</b>	El TRABAJADOR se obliga a ejecutar el trabajo de ____________, en todas las instalaciones 
                con las que el EMPLEADOR,______________, mantiene contrato por prestación de servicios de seguridad privada ubicadas
                en la Región de Arica  y Parinacota Chile, sin perjuicio de la facultad del EMPLEADOR de alterar, por causa justificada,
                la naturaleza de los servicios, o el sitio o recinto en que ellos han de prestarse, con la sola limitación de que se trate
                de labores similares y que el nuevo sitio o recinto quede dentro de la misma localidad o ciudad, conforme a lo señalado
                en el artículo Nº 12 del Código del Trabajo.</p><br>
                
	    <p> El detalle de las funciones, deberes y obligaciones, que el TRABAJADOR se obliga a cumplir en el desarrollo de los servicios, 
                se encuentra estipulado y normado enlos documentos "Descriptor de Cargo", "Reglamento Interno", "Manual de Procedimientos Trabajo Seguro" 
                y todo otro documento anexo a los señalados, los que se adjuntan al presente contrato mediante Anexo de Contrato Nº 1 
                "Entrega de Documentación Complementaria al Contrato de Trabajo", como así también las disposiciones verbales emanadas por el Empleador, Supervisor o Jefe Directo,
                las necesidades observadas durante el servicio y todas las obligaciones y prohibiciones inherentes a las funciones que debe desarrollar  todo trabajador .</p><br>
                
                <p>Los reglamentos y manuales correspondientes a las empresas mandantes (clientes)  y que se le entreguen bajo acta, igualmente serán de cumplimiento 
                   obligatorio por parte del TRABAJADOR en el  ejercicio de su servicio. </p><br>
		
                <p>El TRABAJADOR se obliga a desempeñar su cargo y funciones dentro de su lugar y jornada de trabajo asignada.  El TRABAJADORdeclara conocer cabalmente el ámbito de las
                    responsabilidades, cantidad y calidad de trabajo que se espera de su contratación, y que se encuentra capacitado y
                    preparado para realizarlo sin observaciones que lo puedan limitar.</p><br>
		
                <p>El TRABAJADOR declara expresamente que reconoce al EMPLEADOR su facultad de evaluar su desempeño y el cumplimiento de esta obligación y
                    de adoptar decisiones como su reemplazo o traslado a un cargo y función similar en jerarquía, remuneraciones, siempre y 
                    cuando algún semejante se encuentre disponible.</p><br>
                
                <p>Si no existen funciones y cargos similares, el trabajador será asignado a lo más similar que se encuentre disponible, y si no es posible el traslado, 
                    se entenderá que existe motivo plausible para terminar el contrato.</p><br>

                <p><b>TERCERO	:</b>	El TRABAJADOR cumplirá una jornada  de trabajo de 45 horas semanales.</p><br>

		<p>El TRABAJADOR, conforme lo dispuesto por artículo 38 del código del trabajo,podrá desarrollar su jornada incluso en días Domingos y Festivos,  
                    de día o de noche, debiendo el EMPLEADOR otorgarle  a lo menos un día de descanso semanal, debiendo ser dos de estos, en día domingo durante el mes calendario.</p><br>
		
		<p>Cuando en virtud de las necesidades propias del funcionamiento de los procesos que en la instalación se desarrollen, se tuviera que trabajar tiempo extraordinario, 
                    excediendo el máximo semanal pactado, este sobresueldo se cancelará con el recargo legal correspondiente, conjuntamente con el respectivo pago de remuneraciones,
                    previo acuerdo adjunto, formalizado mediante Anexo de Contrato Nº 2, “Pacto de Horas Extras”.</p><br>

                <p><b>CUARTO	:</b> Se pacta un sueldo  por el periodo trabajado equivalente a los $301.000.- considerando trabajados la totalidad de los días requeridos. </p><br>
		
                <p>De la remuneración pactada, elEMPLEADORademás pagara a las instituciones pertinentes los impuestos y cotizaciones previsionales dispuestos por Ley.</p><br>
                
                <p>La Gratificación legal será cancelada de acuerdo a los artículos Nº47 y 48 del Código del Trabajo.</p><br>
	
	        <p>El TRABAJADOR autoriza el pago de su remuneración mensual vía transferencia electrónica en su cuenta Rut, depositando semanalmente como mutuo acuerdo,
                    (artículo Nº 54 del Código del Trabajo).</p><br>

                <p><b>QUINTO	:</b>	El EMPLEADOR se compromete a facilitar en calidad de préstamo al TRABAJADOR los elementos de vestuario y equipos, 
                    necesarios para cumplir sus funciones. </p><br>
		
                <p>La entrega del vestuario y equipo, se formalizará mediante Anexo de Contrato Nº 4, ¨Entrega de Vestuario y Equipo”, el que indica el detalle de cada especie, 
                    la cantidad entregada, su estado y valor.</p><br>
	
                <p><b>SEXTO</b>	:	Se deja constancia que el TRABAJADOR acepta y autoriza al EMPLEADOR para que éste le descuente de su remuneración mensual 
                    el dinero equivalente al tiempo no trabajado debido a atrasos,inasistencias o permisos.</p><br>

                <p>El TRABAJADOR acepta y autoriza al EMPLEADOR, a deducir de sus remuneraciones o finiquito que le corresponda por ley,  el dinero equivalente a las pérdidas, robos, hurtos, 
                    daños y/o costos que se produzcan en la instalación que tiene a su cuidado, por un mal desempeño en sus funciones, no cumplimiento de sus deberes, acciones indebidas, atrasos,
                    inasistencias o no cumplimiento de las disposiciones señaladas en el presente contrato de trabajo, Reglamento Interno, Manual de Procedimientos, 
                    Anexos de Contrato, o cualquier otra norma señalada en documentos de los que se le haya notificado.</p><br> 
		
                <p>El TRABAJADOR acepta y autoriza al EMPLEADOR a deducir de sus remuneraciones o finiquito que le corresponda por ley,  
                    el valor del vestuario o equipo, que una vez finalizada la relación laboral, no entregue o que durante esta, 
                    pierda o le produzca un deterioro tal que no pueda seguir siendo utilizada para el servicio.  </p><br>

                <p><b>SÉPTIMO</b>	: 	Elpresente contrato será a plazo………………..jo con vigencia entre el día 00/00/20…, hasta el 00/00/20…</p><br>

		
                <p>Se podrá además dar término al presente Contrato de Trabajo, por las siguientes causas:</p><br>

                <p>a)	Cualquiera de los casos señalado en el artículo N° 159 del Código del Trabajo. </p>
                <p>b)	Cualquiera de las causales señalada en el artículo N° 160 del Código del Trabajo, previa fundamentación. </p>
                <p>c)	Por necesidad de la empresa, en conformidad a los requisitos establecidos en el artículo N° 161, del Código del Trabajo.</p>
                <p>d)	Por incumplimiento a las disposiciones y acuerdos señalados en el presente contrato, Anexo y Documentos Complementarios.</p>
                <p>e)	Por causa de Fuerza Mayor o Caso Fortuito;guerra, huelgas, conflictos sociales, conmoción pública y/odestrucción de la instalación
                        por;  incendios, terremotos, inundación u otros actos de la naturaleza, y cualquier otro señalado en el artículo 45 del Código Civil, y en general, 
                        todo acto ajeno a la voluntad del EMPLEADOR, que impida o demore la prestación del servicio que dio origen al presente contrato y al cumplimiento de las obligaciones pactadas.</p><br>

        <p>Si ocurrieran tales circunstancias, el EMPLEADORinformará al TRABAJADOR, sin demora, la existencia del hecho y como tal hecho afectará al cumplimiento del Contrato, y duración del mismo,
           procediendo de la misma manera para informar del término de tal hecho y, en ambos casos, acompañando los documentos justificativos correspondientes.</p><br>

        <p><b>OCTAVO	:</b>	El EMPLEADOR, se compromete a capacitar al TRABAJADOR, en todas las materias propias y relacionadas con el servicio. </p><br>

		<p>Esta capacitaciones se realizaron fuera del horario de la jornada de trabajo y serán de costo íntegro para el EMPLEADOR y en ningún caso para el TRABAJADOR, 
                salvo existir un acuerdo previo formalizado entre ambos. </p><br>

		<p>Será de cargo del EMPLEADOR, los costos de movilización y colación. Por su parte el TRABAJADOR compromete su asistencia y participación en las capacitaciones.</p><br> 

		<p>Se establece como obligación de este compromiso, la asistencia del TRABAJADOR y que las capacitaciones sean dictadas por organismos técnicos o profesionales acreditados
                    y/o competentes en la materia, quienes una vez finalizado el proceso, deberán certificar lo realizado mediante un diploma o certificado. </p><br>

		<p>Igualmente, el TRABAJADOR, se obliga a la aplicación de los conocimientos adquiridos en el desarrollo de sus funciones.</p><br> 

		<p>El  TRABAJADOR acepta que la inasistencia injustificada a los cursos programados, como así también la  no aprobación satisfactoria de la capacitación
                    y la no aplicación de los conocimientos adquiridos,  será causal de término del contrato sin derecho a indemnización.</p><br>

                <p><b>NOVENO</b>	:	Es parte y se adjunta al presente contrato el Anexo , ¨Cumplimiento Decreto Supremo Nº 40, Artículo 21º ¨Obligación de Informar Riesgos Laborales”, 
                    documento por medio del cual el EMPLEADOR notifica al TRABAJADOR, respecto los riesgos laborales a los cuales se encuentra expuesto y la forma correcta de realizar su trabajo. </p><br>
                
                <p><b>DÉCIMO</b>	:	El presente contrato y actas anexas complementarias, se firman en tres ejemplares, declarando el trabajador haber recibido uno de ellos 
                    y que este es fiel reflejo de las condiciones acordadas para la relación laboral existente entre las partes.</p><br>
               

        </div>
        <div id="pie">
           <table style="width: auto; margin:auto">
                <tr>
                    <td style="text-align:center"><p style="text-align:center">___________________</p><br>
                        <p style="text-align:center">FIRMA DEL TRABAJADOR</p><br>
                        <p style="text-align:center">Nombre:_____________</p><br>
                        <p style="text-align:center">RUT:________________</p><br></td>
                    
                     <td style="text-align:center"><p style="text-align:center">__________________</p><br>
                        <p style="text-align:center">FIRMA DEL EMPLEADOR.</p><br>
                        <p style="text-align:center">Nombre:_____________</p><br>
                        <p style="text-align:center">RUT:________________</p><br><</td>
                </tr>
            </table>

        </div>
    </body>
    <?php
    break;
    default:
    break;
    }
    ?>
</html>
