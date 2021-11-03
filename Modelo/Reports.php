<?php
include_once('Conexion.php');

class Reports {
       var $CON;
      
       public function agregarReport($repcod,$razcod,$perut,$tipscod,$estrep,$talcod,$repsup,$repobs,$repfecha,$rephorai,$rephorat,$repcant,$repentr,$repret,$repmant,$repaccion){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             
             $sql = "INSERT INTO reports (REP_CODIGO,RAZ_CODIGO,PER_RUT,TIPS_CODIGO,ESTR_CODIGO,TALR_ID,REP_SUPCLIENTE,REP_OBS,REP_FECHA,REP_HORAINICIO,REP_HORATERMINO,REP_CANTIDAD,REP_ENTREGA,REP_RETIRO,REP_MANTENCION,REP_ACCION) "
                  . " VALUES (".$repcod.",".$razcod.",'".$perut."',".$tipscod.",".$estrep.",".$talcod.",'".$repsup."','".$repobs."','".$repfecha."','".$rephorai."','".$rephorat."',".$repcant.",".$repentr.",".$repret.",".$repmant.",'".$repaccion."')";
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Agregado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }

            mysqli_close($Con);
            $this->CON->desconectar();
       
             return $resultado;
       }
       
       public function eliminarReport($repcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM reports WHERE REP_ID=".$repcod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
       }
       
       
       
       public function editaReport($repid,$repcod,$razcod,$perut,$tipscod,$talcod,$repsup,$repobs,$repfecha,$rephorai,$rephorat,$repcant,$repentr,$repret,$repmant,$repaccion,$estrep){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE reports SET "
                     . "REP_CODIGO=".$repcod.", "
                     . "RAZ_CODIGO=".$razcod.", "
                     . "PER_RUT='".$perut."', "
                     . "TIPS_CODIGO=".$tipscod.", "
                     . "ESTR_CODIGO=".$estrep.", "
                     . "TALR_ID=".$talcod.", "
                     . "REP_SUPCLIENTE='".$repsup."', "
                     . "REP_OBS='".$repobs."', "
                     . "REP_FECHA='".$repfecha."', "
                     . "REP_HORAINICIO='".$rephorai."', "
                     . "REP_HORATERMINO='".$rephorat."', "
                     . "REP_CANTIDAD=".$repcant.", "
                     . "REP_ENTREGA=".$repentr.", "
                     . "REP_RETIRO=".$repret.", "
                     . "REP_MANTENCION=".$repmant.", "
                     . "REP_ACCION='".$repaccion."' "
                     . "WHERE REP_ID=".$repid;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
           
       }
         
       public function contadorReportTal($talcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT count(*) AS cantidad FROM reports WHERE `TALR_ID`=".$talcod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"            =>$row["cantidad"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
       
       
       
       
       public function listarReport(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM reports";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "repid"            =>$row["REP_ID"],
                                        "repcod"            =>$row["REP_CODIGO"],
					"razcod"           =>$row["RAZ_CODIGO"],
                                        "perut"           =>$row["PER_RUT"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "estrep"           =>$row["ESTR_CODIGO"],
                                        "talcod"            =>$row["TALR_ID"],
                                        "repsup"            =>$row["REP_SUPCLIENTE"],
                                        "repfecha"           =>$row["REP_FECHA"],
                                        "rephorai"           =>$row["REP_HORAINICIO"],
                                        "rephorat"            =>$row["REP_HORATERMINO"],
                                        "repcant"            =>$row["REP_CANTIDAD"],
                                        "repmant"            =>$row["REP_MANTENCION"],
                                        "repentg"            =>$row["REP_ENTREGA"],
                                        "repret"            =>$row["REP_RETIRO"],
                                        "repacc"            =>$row["REP_ACCION"],
                                        "repobs"           =>$row["REP_OBS"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
       
    
      public function listarReportFull(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM reports AS rep"
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT ORDER BY REP_FECHA DESC";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //Codigos FK
                                        "repid"           =>$row["REP_ID"],
                                        "repcod"            =>$row["REP_CODIGO"],
					"razcod"           =>$row["RAZ_CODIGO"],
                                        "perut"           =>$row["PER_RUT"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "talcod"            =>$row["TALR_ID"],
                                        "estrep"            =>$row["ESTR_CODIGO"],
                            //Atributos Rep
                                        "repsup"            =>$row["REP_SUPCLIENTE"],
                                        "repfecha"           =>$row["REP_FECHA"],
                                        "rephorai"           =>$row["REP_HORAINICIO"],
                                        "rephorat"            =>$row["REP_HORATERMINO"],
                                        "repcant"            =>$row["REP_CANTIDAD"],
                                        "repmant"            =>$row["REP_MANTENCION"],
                                        "repentg"            =>$row["REP_ENTREGA"],
                                        "repret"            =>$row["REP_RETIRO"],
                                        "repobs"           =>$row["REP_OBS"],
                                        "repacc"           =>$row["REP_ACCION"],
                            //Atributos Raz
                                        "raznom"           =>$row["RAZ_NOMBRE"],
                            //Atributos Per
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                            //Atributos Estado Report
                                        "estrepnom"           =>$row["ESTR_NOMBRE"],
                            //Atributos Tips
                                        "tipsnom"           =>$row["TIPS_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
       public function BusqRepDato($op,$dato){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM reports AS rep"
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN tipo_ruta AS trut "
                    . " ON tr.TRUT_CODIGO = trut.TRUT_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT";
              switch($op){
              case 1 : $sql.=" WHERE rep.REP_CODIGO='".$dato."'";
//            case 1 : $sql.=" WHERE rep.REP_CODIGO LIKE '%".$dato."%'";
              break;
              case 2 : $sql.= " WHERE trut.TRUT_NOMBRE LIKE '".$dato."%'";
              break;
              case 3 : $sql.= " WHERE rep.TALR_ID LIKE '%".$dato."%'";
              break;
              case 4 : $sql.=" WHERE rep.REP_FECHA LIKE '%".$dato."%'";
                      
              break;
              case 5 : $sql.= " WHERE rs.RAZ_NOMBRE LIKE '".$dato."%'";
                            
              break;
              case 6 : $sql.= " WHERE per.PER_NOMBRE LIKE '%".$dato."%' OR per.PER_APELLIDO LIKE '%".$dato."%'";
                              
            //case 6 : $sql.= " WHERE per.PER_NOMBRE LIKE '%".$dato."%' OR per.PER_APELLIDO LIKE '%".$dato."%'";
             break;
              case 7 : $sql.= " WHERE estr.ESTR_NOMBRE LIKE '%".$dato."%' ";
              break;
              case 8 : $sql.= " WHERE rep.REP_CODIGO= '".$dato."' ";
              break;
              default: $sql.= " ";
              break;
              }
              
                    $sql.=" ORDER BY rep.REP_FECHA DESC"
                        ." LIMIT 50;";    
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                           //Codigos FK
                                        "repid"           =>$row["REP_ID"],
                                        "repcod"            =>$row["REP_CODIGO"],
					"razcod"           =>$row["RAZ_CODIGO"],
                                        "perut"           =>$row["PER_RUT"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "talcod"            =>$row["TALR_ID"],
                                        "estrep"            =>$row["ESTR_CODIGO"],
                            //Atributos Rep
                                        "repsup"            =>$row["REP_SUPCLIENTE"],
                                        "repfecha"           =>$row["REP_FECHA"],
                                        "rephorai"           =>$row["REP_HORAINICIO"],
                                        "rephorat"            =>$row["REP_HORATERMINO"],
                                        "repcant"            =>$row["REP_CANTIDAD"],
                                        "repmant"            =>$row["REP_MANTENCION"],
                                        "repentg"            =>$row["REP_ENTREGA"],
                                        "repret"            =>$row["REP_RETIRO"],
                                        "repobs"           =>$row["REP_OBS"],
                                        "repacc"           =>$row["REP_ACCION"],
                            
                            //Atributos Raz
                                        "razrut"           =>$row["RAZ_RUT"],
                                        "raznom"           =>$row["RAZ_NOMBRE"],
                                        "razdire"           =>$row["RAZ_DIRECCION"],
                            //Atributos Per
                                        "perrut"           =>$row["PER_RUT"],
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "talrut"           =>$row["TRUT_CODIGO"],
                            //Atributos Estado Report
                                        "estrepnom"           =>$row["ESTR_NOMBRE"],
                            //Atributos Estado Report
                                        "tipsnom"           =>$row["TRUT_NOMBRE"],
                            //Atributos Tips
                                        "tipsnomtip"           =>$row["TIPS_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
      
      public function BusqRepDatoFull($op,$dato){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM reports AS rep"
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN tipo_ruta AS trut "
                    . " ON tr.TRUT_CODIGO = trut.TRUT_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT";
              switch($op){
              case 1 : $sql.=" WHERE rep.REP_CODIGO='".$dato."'";
//            case 1 : $sql.=" WHERE rep.REP_CODIGO LIKE '%".$dato."%'";
              break;
              case 2 : $sql.= " WHERE trut.TRUT_NOMBRE LIKE '".$dato."%'";
              break;
              case 3 : $sql.= " WHERE rep.TALR_ID LIKE '%".$dato."%'";
              break;
              case 4 : $sql.=" WHERE rep.REP_FECHA LIKE '%".$dato."%'";
                      
              break;
              case 5 : $sql.= " WHERE rs.RAZ_NOMBRE LIKE '".$dato."%'";
                            
              break;
              case 6 : $sql.= " WHERE per.PER_NOMBRE LIKE '%".$dato."%' OR per.PER_APELLIDO LIKE '%".$dato."%'";
                              
            //case 6 : $sql.= " WHERE per.PER_NOMBRE LIKE '%".$dato."%' OR per.PER_APELLIDO LIKE '%".$dato."%'";
             break;
              case 7 : $sql.= " WHERE estr.ESTR_NOMBRE LIKE '%".$dato."%' ";
              break;
              case 8 : $sql.= " WHERE rep.REP_CODIGO= '".$dato."' ";
              break;
              default: $sql.= " ";
              break;
              }
              
                    $sql.=" ORDER BY rep.REP_FECHA DESC";
                            
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                           //Codigos FK
                                        "repid"           =>$row["REP_ID"],
                                        "repcod"            =>$row["REP_CODIGO"],
					"razcod"           =>$row["RAZ_CODIGO"],
                                        "perut"           =>$row["PER_RUT"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "talcod"            =>$row["TALR_ID"],
                                        "estrep"            =>$row["ESTR_CODIGO"],
                            //Atributos Rep
                                        "repsup"            =>$row["REP_SUPCLIENTE"],
                                        "repfecha"           =>$row["REP_FECHA"],
                                        "rephorai"           =>$row["REP_HORAINICIO"],
                                        "rephorat"            =>$row["REP_HORATERMINO"],
                                        "repcant"            =>$row["REP_CANTIDAD"],
                                        "repmant"            =>$row["REP_MANTENCION"],
                                        "repentg"            =>$row["REP_ENTREGA"],
                                        "repret"            =>$row["REP_RETIRO"],
                                        "repobs"           =>$row["REP_OBS"],
                                        "repacc"           =>$row["REP_ACCION"],
                            
                            //Atributos Raz
                                        "razrut"           =>$row["RAZ_RUT"],
                                        "raznom"           =>$row["RAZ_NOMBRE"],
                                        "razdire"           =>$row["RAZ_DIRECCION"],
                            //Atributos Per
                                        "perrut"           =>$row["PER_RUT"],
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "talrut"           =>$row["TRUT_CODIGO"],
                            //Atributos Estado Report
                                        "estrepnom"           =>$row["ESTR_NOMBRE"],
                            //Atributos Estado Report
                                        "tipsnom"           =>$row["TRUT_NOMBRE"],
                            //Atributos Tips
                                        "tipsnomtip"           =>$row["TIPS_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
      }
    
}
