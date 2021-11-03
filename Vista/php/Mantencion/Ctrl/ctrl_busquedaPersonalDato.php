
<?php
include_once('../../../../Modelo/Personal.php');
$op=$_GET["op"];
$dato=$_GET["dato"];

$per=new Personal();

//echo "OPCION: ".$op."  DATO: ".$dato."<br>";

if($op==0){
$data=$per->ListarPersonalFull();

echo "<table style='width: 100%; max-width: 100%;'>
              
              <th >Rut </th>
              <th >Nombre </th>
              <th >Correo </th>
              <th >Telefono</th>
              <th >Celular</th>
              <th >Fecha Ingreso</th>
              <th >Estado Personal</th>
              <th >Opciones</th>";
$i=0;
while($i<count($data)){
    
echo         "<tr>";
echo         "<td>".$data[$i]["rutp"]."</td>";
echo         "<td>".$data[$i]["nomp"]." ".$data[$i]["apep"]."</td>";
echo         "<td>".$data[$i]["mailp"]."</td>";
echo         "<td>".$data[$i]["fonop"]."</td>";
echo         "<td>".$data[$i]["celp"]."</td>";
echo         "<td>".$data[$i]["fingp"]."</td>";
echo         "<td>".$data[$i]["eest"]."</td>";
echo         "<td><a href=VerPersonalDetalle.php?id=".$data[$i]["rutp"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
               . "<a href=Ctrl/ctrl_impresionPersonal.php?id=".$data[$i]["rutp"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>";
echo         "</tr>";
          
$i++;
}

echo"</table>";    
    
    
}else{
    $data=$per->BusqPerDato($op,$dato);

echo "<table style='width: 100%; max-width: 100%;'>
              
              <th >Rut </th>
              <th >Nombre </th>
              <th >Correo </th>
              <th >Telefono</th>
              <th >Celular</th>
              <th >Fecha Ingreso</th>
              <th >Estado Personal</th>
              <th >Opciones</th>";
$i=0;

if(count($data)>0){
while($i<count($data)){
    
echo         "<tr>";
echo         "<td>".$data[$i]["rutp"]."</td>";
echo         "<td>".$data[$i]["nomp"]." ".$data[$i]["apep"]."</td>";
echo         "<td>".$data[$i]["mailp"]."</td>";
echo         "<td>".$data[$i]["fonop"]."</td>";
echo         "<td>".$data[$i]["celp"]."</td>";
echo         "<td>".$data[$i]["fingp"]."</td>";
echo         "<td>".$data[$i]["eest"]."</td>";
echo         "<td><a href=VerPersonalDetalle.php?id=".$data[$i]["rutp"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a> "
        . "<a href=Ctrl/ctrl_impresionPersonal.php?id=".$data[$i]["rutp"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>";
echo         "</tr>";
          
$i++;
}

echo"</table>";    
    
}else{
     echo "<tr>
                  <td colspan='7'> <center>NO SE REGISTRAN DATOS</center></td>
          </tr>
          </table>";
}
    
    
}
?>

