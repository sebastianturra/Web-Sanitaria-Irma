<?php
include_once('Conexion.php');

class Profesion{
        var $CON;
        public function ListarProfesiones(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM profesion";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"            =>$row["PROF_CODIGO"],
                                        "nom"            =>$row["PROF_NOMBRE"]
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