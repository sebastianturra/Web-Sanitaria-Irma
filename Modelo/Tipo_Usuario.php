<?php
include_once('Conexion.php');

class Tipo_Usuario{
        var $CON;
    
    public function listarTipUsuario(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_usuario";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["TIP_CODIGO"],
					"nom"            =>$row["TIP_TIPOUSER"]
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


