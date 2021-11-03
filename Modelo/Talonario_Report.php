<?php
include_once('Conexion.php');
class Talonario_Report {
       var $CON;
      
       public function agregarTalonario($talcod,$tipscod,$esttcod,$talmin,$talmax,$talcont){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             
             $sql = "INSERT INTO talonario_report (TALR_ID,TRUT_CODIGO,ESTT_CODIGO, TALR_MIN , TALR_MAX, TALR_CONTADOR) "
                  . " VALUES (".$talcod.",".$tipscod.",".$esttcod.",".$talmin.",".$talmax.",".$talcont.")";
            
             $resultado=mysqli_query($Con, $sql);
                  mysqli_close($Con);
            $this->CON->desconectar();
       
             return $resultado;
       }
       
       public function eliminarTalonario($talcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM talonario_report WHERE TALR_ID=".$talcod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
       }
       
       
       
       public function editarTalonario($talcod,$talmin,$talmax,$talcont,$tipscod,$esttcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE talonario_report SET "
                     . "TALR_MIN=".$talmin.", "
                     . "TALR_MAX=".$talmax.", "
                     . "TALR_CONTADOR=".$talcont.", "
                     . "TRUT_CODIGO=".$tipscod.", "
                     . "ESTT_CODIGO=".$esttcod.", "
                     . "WHERE TALR_ID=".$talcod;
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
       
         public function editarTalContador($talcod,$talcont){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE talonario_report SET "
                     . "TALR_CONTADOR=".$talcont.", "
                     . "WHERE TALR_ID=".$talcod;
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
       
       
       
       
       public function editarContadorTalonario($talcod,$talcont, $talmax){
             $valor=$talcont+1;
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE talonario_report SET ";
                     if($valor==$talmax){
             $sql.= "ESTT_CODIGO=2, ";
                     }else{
             $sql.= "ESTT_CODIGO=1, ";
                     }
             $sql.= "TALR_CONTADOR=".$valor." "
                 . " WHERE TALR_ID=".$talcod;
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
       
       public function listarTalonario(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM talonario_report";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "talcod"            =>$row["TALR_ID"],
					"tipscod"           =>$row["TRUT_CODIGO"],
                                        "esttcod"           =>$row["ESTT_CODIGO"],
					"talmin"            =>$row["TALR_MIN"],
                                        "talmax"            =>$row["TALR_MAX"],
                                        "talcont"           =>$row["TALR_CONTADOR"]
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
      
       public function listarEstadoTalonario(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM estado_talonario";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "esttcod"            =>$row["ESTT_CODIGO"],
					"esttnom"           =>$row["ESTT_NOMBRE"]
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
    
      public function listarTalonarioFull(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM talonario_report AS tr"
                    . " INNER JOIN tipo_ruta AS t "
                    . " ON tr.TRUT_CODIGO = t.TRUT_CODIGO"
                    . " INNER JOIN estado_talonario AS estt "
                    . " ON tr.ESTT_CODIGO = estt.ESTT_CODIGO";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "talcod"            =>$row["TALR_ID"],
					"tipscod"           =>$row["TRUT_CODIGO"],
                                        "esttcod"           =>$row["ESTT_CODIGO"],
					"talmin"            =>$row["TALR_MIN"],
                                        "talmax"            =>$row["TALR_MAX"],
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "tipsnom"           =>$row["TRUT_NOMBRE"],
                                        "esttnom"           =>$row["ESTT_NOMBRE"]
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
    public function listarTalonarioFull2(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM talonario_report AS tr"
                    . " INNER JOIN tipo_ruta AS t "
                    . " ON tr.TRUT_CODIGO = t.TRUT_CODIGO"
                    . " INNER JOIN estado_talonario AS estt "
                    . " ON tr.ESTT_CODIGO = estt.ESTT_CODIGO"
                    . " WHERE tr.ESTT_CODIGO=0 OR tr.ESTT_CODIGO=1";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "talcod"            =>$row["TALR_ID"],
					"tipscod"           =>$row["TRUT_CODIGO"],
                                        "esttcod"           =>$row["ESTT_CODIGO"],
					"talmin"            =>$row["TALR_MIN"],
                                        "talmax"            =>$row["TALR_MAX"],
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "tipsnom"           =>$row["TRUT_NOMBRE"],
                                        "esttnom"           =>$row["ESTT_NOMBRE"]
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
      
        public function BusqTalDato($op, $dato){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM talonario_report AS tr"
                    . " INNER JOIN tipo_ruta AS t "
                    . " ON tr.TRUT_CODIGO = t.TRUT_CODIGO"
                    . " INNER JOIN estado_talonario AS estt "
                    . " ON tr.ESTT_CODIGO = estt.ESTT_CODIGO";
              switch($op){
              case 1 : $sql.=" WHERE tr.TALR_ID LIKE '%".$dato."%'";
              break;
              case 2 : $sql.= " WHERE t.TRUT_NOMBRE LIKE '%".$dato."%'";
              break;
              case 3 : $sql.= " WHERE estt.ESTT_NOMBRE LIKE '%".$dato."%'";
              break;
              case 4 : $sql.= " WHERE tr.TALR_ID=".$dato;
              break;
              default: $sql.= " ";
              break;
              }
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "talcod"            =>$row["TALR_ID"],
					"tipscod"           =>$row["TRUT_CODIGO"],
                                        "esttcod"           =>$row["ESTT_CODIGO"],
					"talmin"            =>$row["TALR_MIN"],
                                        "talmax"            =>$row["TALR_MAX"],
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "tipsnom"           =>$row["TRUT_NOMBRE"],
                                        "esttnom"           =>$row["ESTT_NOMBRE"]
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
      
 
      public function TalContadorBoleta($talcod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT TALR_CONTADOR, TALR_MAX FROM talonario_report"
                   ." WHERE TALR_ID=".$talcod;
              
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "talcont"           =>$row["TALR_CONTADOR"],
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
      
      public function BusqRepTalDatoFull($op,$dato){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM reports AS rep"
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN estado_talonario AS estt "
                    . " ON tr.ESTT_CODIGO = estt.ESTT_CODIGO"
                    . " INNER JOIN tipo_ruta AS trut "
                    . " ON tr.TRUT_CODIGO =trut.TRUT_CODIGO"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT";
              switch($op){
              case 1 : $sql.=" WHERE rep.REP_CODIGO LIKE '%".$dato."%'";
              break;
              case 2 : $sql.= " WHERE t.TIPS_NOMBRE LIKE '%".$dato."%'";
              break;
              case 3 : $sql.= " WHERE rep.TALR_ID LIKE '%".$dato."%'";
              break;
              case 4 : $sql.=" WHERE rep.REP_FECHA LIKE '%".$dato."%'";
              break;
              case 5 : $sql.= " WHERE rs.RAZ_NOMBRE LIKE '%".$dato."%'";
              break;
              case 6 : $sql.= " WHERE per.PER_NOMBRE LIKE '%".$dato."%' OR per.PER_APELLIDO LIKE '%".$dato."%'";
              break;
              case 7 : $sql.= " WHERE estr.ESTR_NOMBRE LIKE '%".$dato."%' ";
              break;
              default: $sql.= " ";
              break;
              }
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
                            //Atributos Raz
                                        "raznom"           =>$row["RAZ_NOMBRE"],
                                        "razdire"           =>$row["RAZ_DIRECCION"],
                            //Atributos Per
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "talrut"           =>$row["TRUT_CODIGO"],
                                        "talest"           =>$row["ESTT_CODIGO"],
                           //Atributos Estado tal
                                        "talnom"           =>$row["ESTT_NOMBRE"],
                           //Atributos tip ruta
                                        "trutnom"           =>$row["TRUT_NOMBRE"],

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
}
