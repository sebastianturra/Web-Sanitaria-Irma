<?php
include('../../../../../Modelo/Contacto.php');
$rsrut=$_POST['dato'];
$con=new Contacto();


$datocon=$con->BusqCliDato(9,$rsrut,null);

if($datocon){
$Cadena="";
$Cadena.=$datocon[0]["nomrs"].";"; //0
$Cadena.=$datocon[0]["tipc"].";"; //1
$Cadena.=$datocon[0]["ciurs"].";"; //2
$Cadena.=$datocon[0]["direreal"].";"; //3
$Cadena.=$datocon[0]["dirers"].";"; //4
$Cadena.=$datocon[0]["emars"].";"; //5
$Cadena.=$datocon[0]["fonors"].";"; //6
$Cadena.=$datocon[0]["giro"].";"; //7
$Cadena.=$datocon[0]["estpago"].";"; //8
$Cadena.=$datocon[0]["ordcom"].";"; //9
$Cadena.=$datocon[0]["corpag"].";"; //10
$Cadena.=$datocon[0]["cven"].";"; //11
$Cadena.=$datocon[0]["efact"].";"; //12
$Cadena.=$datocon[0]["fact"]; //13

echo $Cadena;
    
}else{
echo "";
    
}

/*foreach ($datocon as $i => $value) {
    
if ($i<count($datocon)){
 $string.=$datocon[$i]["cod"].";";   
}else{
    $string.=$$datocon[$i];
}
}*/


//echo var_dump($datocon);
?>
