<?php
include_once('Conexion.php');

class Unidad_trabajo{
        var $CON;
        public function ListarUnidadTrabajo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM unidad_trabajo";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["UTRAB_CODIGO"],
                                        "nom"            =>$row["UTRAB_NOMBRE"]
                                	);
                        $i++;
		}
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
        
    }
    
    
}
?>