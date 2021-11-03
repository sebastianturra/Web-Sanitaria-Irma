<?php
include_once('../../../../Modelo/inversioninterna.php');
$inversioninterna = new InversionInterna();

$getfullbaño = $inversioninterna->getfullbanio();
$getdispensadorint = $inversioninterna->getdispensadorint();

$total = $_GET['total'];

echo "<table style='width: 80%;margin-left 20px;margin-right: auto;'>". 
"<tr>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align:center'>Item</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;;text-align:center'>Codigo</td>". 
"<td style='background-color: whitesmoke; color: black; font-weight: bold;;text-align:center'>Disipador</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;;text-align:center'>Lavamano</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;;text-align:center'>Color</td>".
"</tr>";
for($i=0;$i<$total;$i++){
   
   echo "<tr style='border: whitesmoke solid 4px;'>".
   "<td style='border: whitesmoke solid 4px;text-align: center;width:10%;'>".($i+1)."</td>".
   "<td style='border: whitesmoke solid 4px;width:20%'>".
   "<select class='id' name='ne_bodi_id[]' id='id_bodi_id".$i."'>";
         echo "<option value='0'>Seleccione Tipo de banco</option>"; 
          foreach($getfullbaño as $key=>$value){
         echo "<option value='".$getfullbaño[$key]['bodi_id']."'>".$getfullbaño[$key]['bodi_codigo']."</option>";
          }            
   echo "</select>".
   "</td>".
   "<td style='border: whitesmoke solid 4px;width:20%'>".
   "<select name='ne_disi_id[]' id='id_disi_id".$i."'>";
         echo "<option value='0'>Seleccione Disipador</option>"; 
          foreach($getdispensadorint as $key=>$value){
         echo "<option value='".$getdispensadorint[$key]['dispensadorintid']."'>".$getdispensadorint[$key]['dispensadorintdesc']."</option>";
          }            
   echo "</select>".
   "</td>".
   "<td style='border: whitesmoke solid 4px;width:20%'>".
   "<select name='ne_bodi_lavamano[]' id='id_bodi_lavamano".$i."'>";
         echo "<option value='0'>Seleccione Lavamano</option>"; 
         echo "<option value='SI'>SI</option>";
         echo "<option value='NO'>NO</option>";
   echo "</select>".
   "</td>".
   "<td style='border: whitesmoke solid 4px; text-align: center;width:20%'><input style='padding: 6px 2px' type='text' name='ne_bodi_color[]' id='id_bodi_color".$i."'></td>".
   "</tr>";
   }
  echo "</table>";  
    
?>
