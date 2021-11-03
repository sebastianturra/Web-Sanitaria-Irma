<?php
include('../Modelo/Agenda.php');
$codigo=$_GET["cod"];
//echo $codigo;

$age=new Agenda();
$data=$age->BusquedaContactoAgendaCodigo($codigo);
if($data){
echo "<h3 class='card-header'>";
echo "  Nombre Cliente:<br><h3><h4> ".$data[0]["nombre"]." ".$data[0]["ape"];
echo     "</h4>
	<div class='card-body'>
	<p class='card-text'>
        <center><img src='../img/icon/Agregaruser.png' width='100' height='100' ><br></center>";
echo    "N°Codigo:".$data[0]["cod"]."<br>";        
echo    "CORREO:<br>".$data[0]["ema"]."<br>";
echo    "FONO:".$data[0]["fono"]."<br>";
echo    "DIRECCION:<br>".$data[0]["dire"]."<br>";
echo    "</p>
	</div>
	<div class='card-footer'>
	RRSS:   <a href='http://www.facebook.com' target='_blank'><img src='../img/icon/fb.png' width='20px' height='20px'></a>
                <a href='http://www.twitter.com' target='_blank'><img src='../img/icon/twiter.png' width='20px' height='20px'></a>
                <a href='http://www.salitrerairma.cl' target='_blank'><img src='../img/icon/www.png' width='20px' height='20px'></a>
	</div>";
}else{
    echo "error";
}
?>

