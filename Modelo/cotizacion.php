<?php
include_once('Conexion.php');

class cotizacion{

    var $CON;

    public function getcot(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COT_CODIGO
  FROM cotizacion ORDER BY COT_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "COT_CODIGO"            =>$row["COT_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['COT_CODIGO'];
                    return $cotid;
        }else {
            $cotid = "Error: " . $sql;
            return $cotid;
           }
           $this->CON->desconectar();
          mysqli_close($Con);
            
    }

    public function gettipodetallecotizacion(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_cotizacion";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "EST_TIPDETCOTCOD"            =>$row["EST_TIPDETCOTCOD"],
                                        "EST_TIPDETCOTDESC"            =>$row["EST_TIPDETCOTDESC"]
                                    );
                        $i++;
                
            }  
           }
        //   mysqli_free_result($resultado);
        //   mysqli_close($Con);
           return $data;
    }

    public function getestadocotizacion(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM estado_cotizacion";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "EST_COTCODIGO"            =>$row["EST_COTCODIGO"],
                                        "EST_COTDESCRIPCION"            =>$row["EST_COTDESCRIPCION"]
                                    );
                        $i++;
                
            }  
           }
           return $data;
          mysqli_close($Con);
          $this->CON->desconectar();
    }

    public function codcottit(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COT_CODIGO
  FROM cotizacion ORDER BY COT_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "COT_CODIGO"            =>$row["COT_CODIGO"]
                                    );
                        $i++;
                
            }
                    $cotid=$data[0]['COT_CODIGO']+1;
                    return $cotid;
        }else {
            $cotid=99;
                    return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }   

	public function crecotcant($COT_EMPRESA,$COT_FECHA,$COT_TELEFONO,$COT_CONTACTO,$COT_CONDVENTA,$COT_TOTAL,$COT_OBSERVACION,$COT_CONDICIONES,$EST_TIPDETCOTCOD,$COT_NETO,$COT_IVA,$COT_DIRECCION,$COT_TGIRO,$COT_RUT,$COT_CORREO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO cotizacion (COT_EMPRESA,COT_FECHA,COT_TELEFONO,COT_CONTACTO,COT_CONDVENTA,COT_TOTAL,COT_OBSERVACION,COT_CONDICIONES,EST_PROCODIGO,EST_COTCODIGO,EST_TIPDETCOTCOD,COT_NETO,COT_IVA,COT_DIRECCION,COT_TGIRO,COT_RUT,COT_CORREO) VALUES ('".$COT_EMPRESA."','".$COT_FECHA."','".$COT_TELEFONO."','".$COT_CONTACTO."','".$COT_CONDVENTA."','".$COT_TOTAL."','".$COT_OBSERVACION."','".$COT_CONDICIONES."','3','1','".$EST_TIPDETCOTCOD."','".$COT_NETO."','".$COT_IVA."','".$COT_DIRECCION."','".$COT_TGIRO."','".$COT_RUT."','".$COT_CORREO."');";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) { 
                return true;
            } else {
                echo $sql;
            $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
            return $resultado;
            }
            mysqli_close($Con);
            $this->CON->desconectar();  
    }

    public function credetcot($COT_CODIGO,$DCOT_DESCRIPCION,$DCOT_CBFCOT,$DCOT_VMAN,$DCOT_MANTENCION,$DCOT_VALUNITARIO,$DCOT_VALTOTAL,$DCOT_IVA){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO `detalle_cotizacion`(`DCOT_CODIGO`, `COT_CODIGO`, `EST_DETCOTESTCOD`, `DCOT_DESCRIPCION`, `DCOT_CBFCOT`, `DCOT_VMAN`, `DCOT_MANTENCION`, `DCOT_VALUNITARIO`, `DCOT_VALTOTAL`, `DCOT_IVA`) VALUES ('NULL','".$COT_CODIGO."','1','".$DCOT_DESCRIPCION."','".$DCOT_CBFCOT."','".$DCOT_VMAN."','".$DCOT_MANTENCION."','".$DCOT_VALUNITARIO."','".$DCOT_VALTOTAL."','".$DCOT_IVA."');";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo $sql;
                return true;
            } else {
                echo $sql;
                $respuesta = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
                return $respuesta;
            }
            mysqli_close($Con);
            $this->CON->desconectar();              
}

public function eliminardetallecotizacion($COT_CODIGO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM detalle_cotizacion WHERE COT_CODIGO=".$COT_CODIGO;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                return true;
            } else {
            $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
            return $resultado;
            }
            mysqli_close($Con);
            $this->CON->desconectar();  
    }

public function listarcotizaciones(){
            $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM cotizacion AS a ". 
             "INNER JOIN estado_procesocotizacion as b ON b.EST_PROCODIGO=a.EST_PROCODIGO ". 
             "INNER JOIN estado_cotizacion AS c ON c.EST_COTCODIGO=a.EST_COTCODIGO ". 
             "WHERE a.EST_COTCODIGO=1 ORDER BY COT_FECHA DESC , COT_CODIGO DESC";

             $resultado=mysqli_query($Con, $sql);
             if(mysqli_num_rows($resultado)>0){
                     while($row=mysqli_fetch_array($resultado)){
                        $data[]=array(
                            "COT_CODIGO"             =>$row["COT_CODIGO"],
                            "COT_EMPRESA"            =>$row["COT_EMPRESA"],
                            "COT_RUT"            =>$row["COT_RUT"],
                            "COT_FECHA"              =>$row["COT_FECHA"],
                            "COT_TELEFONO"           =>$row["COT_TELEFONO"],
                            "COT_CONTACTO"           =>$row["COT_CONTACTO"],
                            "COT_CONDVENTA"          =>$row["COT_CONDVENTA"],
                            "COT_TOTAL"              =>$row["COT_TOTAL"],
                            "EST_PRODESCRIPCION"     =>$row["EST_PRODESCRIPCION"],
                            "COT_DIRECCION"          =>$row["COT_DIRECCION"],
                            "EST_COTDESCRIPCION"     =>$row["EST_COTDESCRIPCION"]
                        );
                            
                        }  
                        return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();       
        }else{
            $data = "Nada encontrado";
            return $data;
            mysqli_close($Con);
            $this->CON->desconectar();  
        }
    }

    //Este metodo busca todas las cotizaciones.
    public function getcotizacion($COT_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM cotizacion AS a INNER JOIN tipo_cotizacion AS b ON ".
                     "a.EST_TIPDETCOTCOD=b.EST_TIPDETCOTCOD WHERE a.COT_CODIGO='".$COT_CODIGO."'";
                     $resultado=mysqli_query($Con, $sql);
                if(mysqli_num_rows($resultado)>0){     
                     while($row=mysqli_fetch_array($resultado)){
                     $data[]=array(
                        "COT_CODIGO"             =>$row["COT_CODIGO"],
                        "COT_EMPRESA"            =>$row["COT_EMPRESA"],
                        "COT_FECHA"              =>$row["COT_FECHA"],
                        "COT_TELEFONO"           =>$row["COT_TELEFONO"],
                        "COT_CONTACTO"           =>$row["COT_CONTACTO"],
                        "COT_CONDVENTA"          =>$row["COT_CONDVENTA"],
                        "COT_TOTAL"              =>$row["COT_TOTAL"],
                        "COT_OBSERVACION"        =>$row["COT_OBSERVACION"],
                        "EST_TIPDETCOTCOD"       =>$row["EST_TIPDETCOTCOD"],
                        "EST_TIPDETCOTDESC"      =>$row["EST_TIPDETCOTDESC"],
                        "COT_NETO"               =>$row["COT_NETO"],
                        "COT_IVA"                =>$row["COT_IVA"],
                        "EST_COTCODIGO"          =>$row["EST_COTCODIGO"],
                        "EST_PROCODIGO"          =>$row["EST_PROCODIGO"],
                        "COT_DIRECCION"          =>$row["COT_DIRECCION"],
                        "COT_CONDICIONES"        =>$row["COT_CONDICIONES"],
                        "COT_TGIRO"              =>$row["COT_TGIRO"],
                        "COT_RUT"                 =>$row["COT_RUT"],
                        "COT_CORREO"                =>$row["COT_CORREO"],
                        "COT_CONDICIONES"        =>$row["COT_CONDICIONES"],
                        "error"           =>     ""    
                        );
                    }  
                }else{
                   // echo $sql." <br> ".mysqli_error($Con);
                    $data[0]['error']="error";     
                }    
                return $data;
                mysqli_close($Con);
        }

    public function getdetallecotizacion($COT_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM detalle_cotizacion WHERE COT_CODIGO='".$COT_CODIGO."';";
                     
                     $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){    
                     while($row=mysqli_fetch_array($resultado)){

                    $data[]=array(
                        "DCOT_DESCRIPCION"             =>$row["DCOT_DESCRIPCION"],
                        "DCOT_CBFCOT"         =>$row["DCOT_CBFCOT"],
                        "DCOT_VMAN"    =>$row["DCOT_VMAN"],
                        "DCOT_VALUNITARIO"    =>$row["DCOT_VALUNITARIO"],
                        "DCOT_VALTOTAL"         =>$row["DCOT_VALTOTAL"],
                        "DCOT_MANTENCION"         =>$row["DCOT_MANTENCION"],
                        "DCOT_CODIGO"         =>$row["DCOT_CODIGO"],
                        "EST_DETCOTESTCOD"         =>$row["EST_DETCOTESTCOD"],
                        "DCOT_IVA"    =>$row["DCOT_IVA"]
                        
                    );

                    }
                    return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $data="Nada encontrado";
                    return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }
                
    }

    public function getprocesoscotización(){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM estado_procesocotizacion";
                     
                     $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){    
                     while($row=mysqli_fetch_array($resultado)){

                    $data[]=array(
                        "EST_PROCODIGO"             =>$row["EST_PROCODIGO"],
                        "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"]                     
                    );

                    }
                    return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $data="error";
                    return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }
                
    }

    public function actualizarcotizacion($EST_PROCODIGO,$EST_TIPDETCOTCOD,$EST_COTCODIGO,$COT_EMPRESA, $COT_FECHA,$COT_TELEFONO,$COT_CONTACTO,$COT_CONDVENTA,$COT_NETO,$COT_IVA, $COT_TOTAL, $COT_OBSERVACION,$COT_CONDICIONES,$COT_CODIGO,$COT_DIRECCION,$COT_TGIRO,$COT_RUT,$COT_CORREO){

                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE cotizacion SET "
                        ."EST_PROCODIGO='".$EST_PROCODIGO."', "
                        ."EST_TIPDETCOTCOD='".$EST_TIPDETCOTCOD."', "
                        ."EST_COTCODIGO='".$EST_COTCODIGO."', "
                        ."COT_EMPRESA='".$COT_EMPRESA."', "
                        ."COT_FECHA='".$COT_FECHA."', "
                        ."COT_TELEFONO='".$COT_TELEFONO."', "
                        ."COT_CONTACTO='".$COT_CONTACTO."', "
                        ."COT_CONDVENTA='".$COT_CONDVENTA."', "
                        ."COT_NETO='".$COT_NETO."', "
                        ."COT_IVA='".$COT_IVA."', "
                        ."COT_TOTAL='".$COT_TOTAL."', "
                        ."COT_OBSERVACION='".$COT_OBSERVACION."', "
                        ."COT_DIRECCION='".$COT_DIRECCION."', "
                        ."COT_CONDICIONES='".$COT_CONDICIONES."', "
                        ."COT_TGIRO='".$COT_TGIRO."', "
                        ."COT_RUT='".$COT_RUT."', "
                        ."COT_CORREO='".$COT_CORREO."' "
                        ."WHERE COT_CODIGO='".$COT_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
                    return $resultado;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }   
    }

    public function actualizardetallecotizacion($COT_CODIGO,$EST_DETCOTESTCOD,$DCOT_DESCRIPCION,$DCOT_CBFCOT,$DCOT_VMAN,$DCOT_MANTENCION,$DCOT_VALUNITARIO,$DCOT_VALTOTAL,$DCOT_IVA,$DCOT_CODIGO){

        $this->CON =new Conexion();
         $Con=$this->CON->conectar();
         $sql = "UPDATE detalle_cotizacion SET "
            ."COT_CODIGO='".$COT_CODIGO."', "
            ."EST_DETCOTESTCOD='".$EST_DETCOTESTCOD."', "
            ."DCOT_DESCRIPCION='".$DCOT_DESCRIPCION."', "
            ."DCOT_CBFCOT='".$DCOT_CBFCOT."', "
            ."DCOT_VMAN='".$DCOT_VMAN."', "
            ."DCOT_MANTENCION='".$DCOT_MANTENCION."', "
            ."DCOT_VALUNITARIO='".$DCOT_VALUNITARIO."', "
            ."DCOT_VALTOTAL='".$DCOT_VALTOTAL."', "
            ."DCOT_IVA='".$DCOT_IVA."' "
            ."WHERE DCOT_CODIGO='".$DCOT_CODIGO."';";
         $resultado=mysqli_query($Con, $sql);
    if($resultado){
       // echo $sql;
        return true;
        mysqli_close($Con);
        $this->CON->desconectar();
    }else{
        echo $sql;
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
        return $resultado;
        mysqli_close($Con);
        $this->CON->desconectar();
    }   
}

    public function eliminarcotizacion($COT_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE cotizacion SET "
                        . "EST_COTCODIGO='2' "
                        . "WHERE COT_CODIGO='".$COT_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
                    return $resultado;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }   
    }

   public function filtercotizacion($tipocot,$datobuscar,$estado,$text){
        switch ($tipocot) {
            case '0':
                if($estado==1){
                    if($text == "" || $text == null || !isset($text)){ 
                    // Tipo cotización:0  DaB: !0 Estado: 1 Texto: NO ES Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE a.EST_COTCODIGO=1 ORDER BY a.COT_CODIGO ASC";
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();
                   }else{  // Tipo cotización:0  DaB: !0 Estado: 1 Texto: Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE ($datobuscar LIKE '".$text."%' AND a.EST_COTCODIGO=1) ORDER BY a.COT_CODIGO ASC";
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();

                   } 
                }else{ //Estado 2
                        if($text == "" || $text == null || !isset($text)){ 
                    // Tipo cotización:0  DaB: !0 Estado: 1 Texto: NO ES Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE a.EST_COTCODIGO=2 ORDER BY a.COT_CODIGO ASC";
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();
                   }else{  // Tipo cotización:0  DaB: !0 Estado: 1 Texto: Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE ($datobuscar LIKE '".$text."%' AND a.EST_COTCODIGO=2) ORDER BY a.COT_CODIGO ASC;";
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();

                   } 
                }
                break;
            
            default:
                if($estado==1){
                    if($text == "" || $text == null || !isset($text)){ 
                    // Tipo cotización:Xx  DaB: !0 Estado: 1 Texto: NO ES Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE (a.EST_COTCODIGO=1 AND EST_TIPDETCOTCOD=".$tipocot.") ORDER BY a.COT_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();
                   }else{  // Tipo cotización:Xx  DaB: !0 Estado: 1 Texto: Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE ($datobuscar LIKE '".$text."%' AND a.EST_COTCODIGO=1 AND EST_TIPDETCOTCOD=$tipocot) ORDER BY a.COT_CODIGO ASC;";
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();

                   } 
                }else{ // Estado 2
                         if($text == "" || $text == null || !isset($text)){ 
                    // Tipo cotización:Xx  DaB: !0 Estado: 1 Texto: NO ES Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE (a.EST_COTCODIGO=2 AND EST_TIPDETCOTCOD=".$tipocot.") ORDER BY a.COT_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();
                   }else{  // Tipo cotización:Xx  DaB: !0 Estado: 1 Texto: Null
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE ($datobuscar LIKE '".$text."%' AND a.EST_COTCODIGO=2 AND EST_TIPDETCOTCOD=$tipocot) ORDER BY a.COT_CODIGO ASC;";
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            } 
                            
                        mysqli_close($Con);
                        $this->CON->desconectar();

                   } 
                }
                break;
        }
   }

   public function selectestado($tipocot,$estado){
        if($tipocot==0){ //tipo cotizacion 0
                         $this->CON =new Conexion();  // estado 1
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE (a.EST_COTCODIGO= '".$estado."') ORDER BY a.COT_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            }   
                        mysqli_close($Con);
                        $this->CON->desconectar();
        }else{  // tipo cotizacion !0
                        $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE (a.EST_COTCODIGO= '".$estado."' AND EST_TIPDETCOTCOD= '".$tipocot."') ORDER BY a.COT_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            }   
                        mysqli_close($Con);
                        $this->CON->desconectar();            
        }
   }

   public function selectestadonew($tipocot,$estado,$ANIO,$MES,$LASTDIAMES){
    if($tipocot==0){ //tipo cotizacion 0
                     $this->CON =new Conexion();  // estado 1
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM cotizacion WHERE (EST_COTCODIGO ='1') AND (COT_FECHA>='$ANIO-$MES-01' AND COT_FECHA<='$ANIO-$MES-$LASTDIAMES') ORDER BY COT_FECHA DESC LIMIT 2";                         
                            $resultado=mysqli_query($Con, $sql);
                     if(mysqli_num_rows($resultado)>0){
                             while($row=mysqli_fetch_array($resultado)){

                            $data[]=array(
                                "COT_CODIGO"             =>$row["COT_CODIGO"],
                                "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                "COT_FECHA"         =>$row["COT_FECHA"],
                                "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                "COT_TOTAL"         =>$row["COT_TOTAL"],
                                "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                            );

                            } 
                            return $data;
                        } else{
                            $data = "Error, Dato no encontrado";
                            return $data;         
                        }   
                    mysqli_close($Con);
                    $this->CON->desconectar();
    }else{  // tipo cotizacion !0
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM cotizacion WHERE (EST_COTCODIGO ='1') AND (COT_FECHA>='$ANIO-$MES-01' AND COT_FECHA<='$ANIO-$MES-$LASTDIAMES') ORDER BY COT_FECHA DESC LIMIT 2";                         
                            $resultado=mysqli_query($Con, $sql);
                     if(mysqli_num_rows($resultado)>0){
                             while($row=mysqli_fetch_array($resultado)){

                            $data[]=array(
                                "COT_CODIGO"             =>$row["COT_CODIGO"],
                                "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                "COT_FECHA"         =>$row["COT_FECHA"],
                                "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                "COT_TOTAL"         =>$row["COT_TOTAL"],
                                "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                            );

                            } 
                            return $data;
                        } else{
                            $data = "Error, Dato no encontrado";
                            return $data;         
                        }   
                    mysqli_close($Con);
                    $this->CON->desconectar();            
    }
}

public function filtercotizaciones($datobuscar,$tipocot,$estado,$ANIO,$MES,$LASTDIAMES,$text){

    $letras = array('T','E');
    $sentencia="";

    $changes = array($tipocot,$estado);

    $this->CON =new Conexion();
    $Con=$this->CON->conectar();
    $sql = "SELECT a.COT_CODIGO,a.EST_TIPDETCOTCOD,a.EST_COTCODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION,a.COT_RUT FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE ";

    if(!empty($text)){
      //$sentencia .= 'Txt';
      $sql .= "$datobuscar like '$text%' AND ";
    }

    for ($i=0; $i < count($changes) ; $i++) { 
      if($changes[$i]!=0){
          $sentencia .= $letras[$i];
      }
    }
    // echo "<script>alert(Sentencia: '".$sentencia."')</script>";  
    switch ($sentencia) {
      case 'T':
//        echo "<script>alert('llego aca2')</script>";    
                     $sql .=  "a.EST_TIPDETCOTCOD ='".$tipocot."'AND a.EST_COTCODIGO ='1'";                                       
        break;
      case 'E':
            //        echo "<script>alert('llego aca2')</script>";    
                     $sql .=  "a.EST_COTCODIGO ='".$estado."'";                                       
                    break;  
      case 'TE':
//        echo "<script>alert('llego aca2')</script>";    
                     $sql .=  "a.EST_TIPDETCOTCOD ='".$tipocot."' AND a.EST_COTCODIGO ='".$estado."'";                                       
        break;      
      default:
//        echo "<script>alert('llego aca4')</script>";
               // $data = "error";
                  //          return $data;
                  $sql .=  "a.EST_COTCODIGO ='1'";

        break;
    }

    $sql .= " ORDER BY a.COT_FECHA DESC LIMIT 50";

//      echo "<script>alert('".$sql."')</script>";

    $resultado=mysqli_query($Con, $sql);
                     if(mysqli_num_rows($resultado)>0){
                             while($row=mysqli_fetch_array($resultado)){

                            $data[]=array(
                                 "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "EST_TIPDETCOTCOD"         =>$row["EST_TIPDETCOTCOD"],
                                    "EST_COTCODIGO"         =>$row["EST_COTCODIGO"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "COT_RUT"         =>$row["COT_RUT"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                            );

                            } 
                          // echo $sql;
                            return $data;
                            mysqli_free($sql);
                            mysqli_close($Con);
                        } else{
                         //   echo $sql;
                            $data = "Error, Dato no encontrado";
                            return $data; 
                            mysqli_free($sql);
                            mysqli_close($Con);        
                        }                   
}

   public function selecttipocotizacion($tipocot,$estado){
        if($tipocot==0){ //tipo cotizacion 0
                         $this->CON =new Conexion();  // estado 1
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE (a.EST_COTCODIGO= '".$estado."') ORDER BY a.COT_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            }   
                        mysqli_close($Con);
                        $this->CON->desconectar();
        }else{  // tipo cotizacion !0
                        $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COT_CODIGO,a.COT_EMPRESA,a.COT_FECHA,a.COT_TELEFONO,a.COT_CONTACTO,a.COT_CONDVENTA,a.COT_TOTAL,a.COT_OBSERVACION,a.COT_CONDICIONES,b.EST_COTDESCRIPCION,c.EST_PRODESCRIPCION FROM cotizacion AS a INNER JOIN estado_cotizacion AS b ON b.EST_COTCODIGO=a.EST_COTCODIGO INNER JOIN estado_procesocotizacion AS c ON c.EST_PROCODIGO=a.EST_PROCODIGO WHERE (a.EST_COTCODIGO= '".$estado."' AND EST_TIPDETCOTCOD= '".$tipocot."') ORDER BY a.COT_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COT_CODIGO"             =>$row["COT_CODIGO"],
                                    "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                                    "COT_FECHA"         =>$row["COT_FECHA"],
                                    "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                                    "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                                    "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                                    "COT_TOTAL"         =>$row["COT_TOTAL"],
                                    "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                                    "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                                    "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                                    "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "Error, Dato no encontrado";
                                return $data;         
                            }   
                        mysqli_close($Con);
                        $this->CON->desconectar();            
        }
   }

    public function obtotcot($COT_CODIGO){
            $this->CON =new Conexion();
            $Con=$this->CON->conectar();
            $sql = "SELECT COUNT(*) AS cuenta FROM detalle_cotizacion WHERE COT_CODIGO='".$COT_CODIGO."'";

            $resultado=mysqli_query($Con, $sql);
            if(mysqli_num_rows($resultado)>0){
                    while($row=mysqli_fetch_array($resultado)){

                            $data[]=array(
                                "cuenta"             =>$row["cuenta"]
                            );
                        }  
                        return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();       
        }else{
            $data = "Nada encontrado";
            return $data;
            mysqli_close($Con);
            $this->CON->desconectar();  
        }
    }

    public function obcotcodigo($COT_CODIGO){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM cotizacion AS a INNER JOIN estado_procesocotizacion as b ON b.EST_PROCODIGO=a.EST_PROCODIGO INNER JOIN estado_cotizacion AS c ON c.EST_COTCODIGO=a.EST_COTCODIGO WHERE a.COT_CODIGO='".$COT_CODIGO."');";

        $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                while($row=mysqli_fetch_array($resultado)){

                    $data[]=array(
                        "COT_CODIGO"             =>$row["COT_CODIGO"],
                        "COT_EMPRESA"         =>$row["COT_EMPRESA"],
                        "COT_FECHA"         =>$row["COT_FECHA"],
                        "COT_TELEFONO"    =>$row["COT_TELEFONO"],
                        "COT_CONTACTO"         =>$row["COT_CONTACTO"],
                        "COT_CONDVENTA"         =>$row["COT_CONDVENTA"],
                        "COT_TOTAL"         =>$row["COT_TOTAL"],
                        "COT_OBSERVACION"         =>$row["COT_OBSERVACION"],
                        "COT_CONDICIONES"         =>$row["COT_CONDICIONES"],
                        "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"],
                        "EST_COTDESCRIPCION"         =>$row["EST_COTDESCRIPCION"]
                    );
                }  
                return $data;
                mysqli_close($Con);
                $this->CON->desconectar();       
    }else{
        $data = "Nada encontrado";
        return $data;
        mysqli_close($Con);
        $this->CON->desconectar();  
    }
}
}

