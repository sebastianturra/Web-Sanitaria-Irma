<?php
include_once('Conexion.php');

class Tipo_Factura {
         var $CON;
    
    public function listarTipFactura(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_factura";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "tfcod"            =>$row["TIPF_CODIGO"],
					"tfnom"            =>$row["TIPF_NOMBRE"]
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
      public function listarEstFactura(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM estado_factura";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "estfcod"            =>$row["ESTF_CODIGO"],
					"estfnom"            =>$row["ESTF_ESTADOFACT"]
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
