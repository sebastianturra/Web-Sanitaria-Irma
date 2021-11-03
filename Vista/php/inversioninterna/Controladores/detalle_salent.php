<?php
include_once('../../../../Modelo/inversioninterna.php');
$inversioninterna = new InversionInterna();

$id = $_GET['id'];

$getfullbaño = $inversioninterna->getfullbanioSALENT();
$getdispensadorint = $inversioninterna->getdispensadorint();
$detsalent= $inversioninterna-> getdetsalent($id);
$getestado = $inversioninterna->getestadoint();

//echo 'id '.$id;
//echo '<pre>',var_dump($detsalent),'</pre>';

echo "<table style='width: 80%;margin-left 20px;margin-right: auto;'>". 
"<tr>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align: center;'>Item</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align: center;'>Codigo</td>". 
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align: center;'>Disipador</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align: center;'>Lavamano</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align: center;'>Estado</td>".
"<td style='background-color: whitesmoke; color: black; font-weight: bold;text-align: center;'>Color</td>".
"</tr>";
for($i=0;$i<count($detsalent);$i++){
  echo "<input style='padding: 6px 2px' type='hidden' name='ne_dsalent_id[]' id='id_dsalent_id".$i."' value=".$detsalent[$i]['dsalent_id'].">";
   echo "<tr style='border: whitesmoke solid 4px;'>".
   "<td style='border: whitesmoke solid 4px;text-align: center;width:5%'>".($i+1)."</td>".
   "<td style='border: whitesmoke solid 4px; width:20%;'>".
   "<select class='id' name='ne_bodi_id[]' id='id_bodi_id".$i."'>";
         echo "<option value='0'>Seleccione Tipo de banco</option>"; 
          foreach($getfullbaño as $key=>$value){
                if($getfullbaño[$key]['bodi_id'] == $detsalent[$i]['bodi_id']){
                  echo "<option value='".$getfullbaño[$key]['bodi_id']."' SELECTED>".
                  $getfullbaño[$key]['bodi_codigo']."</option>";
                }else{
                  echo "<option value='".$getfullbaño[$key]['bodi_id']."'>".
                  $getfullbaño[$key]['bodi_codigo']."</option>";
                }
          }            
   echo "</select>".
   "</td>".
   "<td style='border: whitesmoke solid 4px;width:10%;'>".
   "<select name='ne_disi_id[]' id='id_disi_id".$i."'>";
         echo "<option value='0'>Seleccione Disipador</option>"; 
          foreach($getdispensadorint as $key=>$value){
                if($getdispensadorint[$key]['dispensadorintid'] == $detsalent[$i]['disi_id']){
                  echo "<option value='".$getdispensadorint[$key]['dispensadorintid']."' SELECTED>".
                  $getdispensadorint[$key]['dispensadorintdesc']."</option>";
                }else{
                  echo "<option value='".$getdispensadorint[$key]['dispensadorintid']."'>".
                  $getdispensadorint[$key]['dispensadorintdesc']."</option>";
                }
          }            
   echo "</select>".
   "</td>".
   "<td style='border: whitesmoke solid 4px;width:10%;'>".
   "<select name='ne_bodi_lavamano[]' id='id_bodi_lavamano".$i."'>";
   echo "<option value='0'>Seleccione Lavamano</option>";
      if($detsalent[$i]['bodi_lavamano']=='SI'){ 
            echo "<option value='SI' SELECTED>SI</option>";
            echo "<option value='NO'>NO</option>";
      }else{
            echo "<option value='0'>Seleccione Lavamano</option>"; 
            echo "<option value='SI'>SI</option>";
            echo "<option value='NO' SELECTED>NO</option>";
      }
      echo "</select>".
      "</td>".
      "<td style='border: whitesmoke solid 4px;width:15%'>".
      "<select name='ne_esti_id[]' id='id_esti_id".$i."'>";
      echo "<option value='0'>Seleccione Lavamano</option>";
         foreach($getestado as $key=>$value){
                if($getestado[$key]['estadointid'] == $detsalent[$i]['esti_id']){
                  echo "<option value='".$getestado[$key]['estadointid']."' SELECTED>".
                  $getestado[$key]['estadointdesc']."</option>";
                }else{
                  echo "<option value='".$getestado[$key]['estadointid']."'>".
                  $getestado[$key]['estadointdesc']."</option>";
                }
          }   
      echo "</select>".  
      "</td>".
   "<td style='border: whitesmoke solid 4px; text-align: center;width:10%'><input style='padding: 6px 2px' type='text' name='ne_bodi_color[]' id='id_bodi_color".$i
   ."' value=".$detsalent[$i]['bodi_color']."></td>".
   "</tr>";
   }
  echo "</table>";  
?> 