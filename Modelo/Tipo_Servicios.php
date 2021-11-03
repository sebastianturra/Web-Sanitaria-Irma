<?php
include_once('Conexion.php');

class Tipo_Servicios {
         var $CON;
    
    public function listarTipServicio(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_servicio";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "tscod"            =>$row["TIPS_CODIGO"],
					"tsnom"            =>$row["TIPS_NOMBRE"]
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
      
          public function listarTipRuta(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_ruta";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "tscod"            =>$row["TRUT_CODIGO"],
					"tsnom"            =>$row["TRUT_NOMBRE"]
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
