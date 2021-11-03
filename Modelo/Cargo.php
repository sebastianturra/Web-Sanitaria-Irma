<?php
include_once('Conexion.php');

class Cargo{
        var $CON;
    
    public function listarCargos(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM cargo";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["CAR_CODIGO"],
					"nom"            =>$row["CAR_NOMBRE"]
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
