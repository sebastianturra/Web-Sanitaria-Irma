<?php
include_once('Conexion.php');

class EstadoPago {
     public function BusqRazonSocialRut($razrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM razon_social AS r "
                  . " INNER JOIN cliente_servicio AS s "
                  . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
                  . " WHERE (TIP_CODIGO='CLI' OR TIP_CODIGO='CPR') AND RAZ_RUT='".$razrut."'"
                  . " ORDER BY RAZ_DIRECCION ASC";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        //razon social
                                        "cod"           =>$row["RAZ_CODIGO"],
                                        "tipcod"           =>$row["TIP_CODIGO"],
					"rut"           =>$row["RAZ_RUT"],
                                        "nom"           =>$row["RAZ_NOMBRE"],
					"dire"          =>$row["RAZ_DIRECCION"],
					"ema"           =>$row["RAZ_CORREO"],
					"ciu"           =>$row["RAZ_CIUDAD"],
					"fono"          =>$row["RAZ_TELEFONO"],
                                        "cven"          =>$row["RAZ_CONDVENTA"],
                                        "giro"          =>$row["RAZ_GIRO"],
                                        "efact"          =>$row["RAZ_ENTGFACTURA"],
                                        "estpago"          =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
                                        "esp"          =>$row["RAZ_ESPECIAL"],
                                      //servicios
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"]
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
     public function BusqRutRazonSocial($rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT * FROM razon_social "
                    . " WHERE RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                           //Codigos FK
                           		"razcod"           =>$row["RAZ_CODIGO"],
                                        "perut"           =>$row["PER_RUT"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "talcod"            =>$row["TALR_ID"],
                                        "estrep"            =>$row["ESTR_CODIGO"],
                            //Atributos Raz
                                        "raznom"           =>$row["RAZ_NOMBRE"],
                                        "razrut"           =>$row["RAZ_RUT"],
                                        "razdire"           =>$row["RAZ_DIRECCION"]
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
      
      public function ContarReportsfecha($dia,$mes,$year,$tips,$rsrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(REP_FECHA) AS cantidad FROM reports AS rep "
                     . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                   . " WHERE DAY(REP_FECHA)=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rs.RAZ_RUT='".$rsrut."'";
               $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                  "cant"           =>$row["cantidad"]
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
   
    
    public function BusqEstadoPagoGlob($mes,$year,$tips,$rsrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT * FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO "
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO "
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID "
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO "
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT "
                    . " WHERE (MONTH(REP_FECHA)=".$mes.") AND (YEAR(REP_FECHA)=".$year.") AND (rep.TIPS_CODIGO=".$tips.") AND (rs.RAZ_RUT='".$rsrut."') "
                    . " ORDER BY RAZ_DIRECCION, REP_FECHA ASC";
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
                                        "razrut"           =>$row["RAZ_RUT"],
                                        "razdire"           =>$row["RAZ_DIRECCION"],
                            //Atributos Per
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "talrut"           =>$row["TRUT_CODIGO"],
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
    
    public function BusqEstadoPago($mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT * FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                  /*  . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.RAZ_CODIGO=".$rscod;   */
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.RAZ_CODIGO=".$rscod." ORDER BY rep.REP_FECHA ASC";   
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
                                        "razdire"           =>$row["RAZ_DIRECCION"],
                            //Atributos Per
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "talrut"           =>$row["TRUT_CODIGO"],
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
      public function BusqEstadoPagoGlobal($mes,$year,$tips){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT *, rs.TIP_CODIGO AS tcod FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips
                    . " GROUP BY rep.RAZ_CODIGO";
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
                                        "razefact"           =>$row["RAZ_ENTGFACTURA"],
                                        "tipcod"           =>$row["tcod"],
                            //Atributos Per
                                        "pernom"           =>$row["PER_NOMBRE"],
                                        "perape"           =>$row["PER_APELLIDO"],
                            //Atributos Tal
                                        "talcont"           =>$row["TALR_CONTADOR"],
                                        "talrut"           =>$row["TRUT_CODIGO"],
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
      
      public function SumasEstadoPago($dia,$mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)>=".$dia." AND  MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasEstadoPagoM($mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasEstadoPago2($dia, $mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)<=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
       public function SumasEstadoPagoGlob($mes,$year,$tips,$rsrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rs.RAZ_RUT='".$rsrut."'";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasMant($dia,$mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)>=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Mantencion' AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
					);
                        if($data[$i]["suma"]==0){
                            $data[$i]["suma"]=0;
                        }
                        
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
      
      public function SumasEntrega($dia, $mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)>=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Entrega' AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      public function SumasRetiro($dia, $mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)>=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips."  AND rep.REP_ACCION='Retiro' AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasMant2($dia, $mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)<=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Mantencion' AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasEntrega2($dia, $mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)<=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Entrega' AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      public function SumasRetiro2($dia, $mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE DAY(REP_FECHA)<=".$dia." AND MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips."  AND rep.REP_ACCION='Retiro' AND rep.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
     public function SumasMantM($mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Mantencion' AND rs.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasEntregaM($mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Entrega' AND rs.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      public function SumasRetiroM($mes,$year,$tips,$rscod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips."  AND rep.REP_ACCION='Retiro' AND rs.RAZ_CODIGO=".$rscod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      public function SumasMantGlob($mes,$year,$tips,$rsrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Mantencion' AND rs.RAZ_RUT='".$rsrut."'";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      
      public function SumasEntregaGlob($mes,$year,$tips,$rsrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips." AND rep.REP_ACCION='Entrega' AND rs.RAZ_RUT='".$rsrut."'";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
      public function SumasRetiroGlob($mes,$year,$tips,$rsrut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
                $sql="SELECT COUNT(*) AS cantrep, SUM(REP_CANTIDAD) AS sumaman FROM reports AS rep " 
                    . " INNER JOIN tipo_servicio AS t "
                    . " ON rep.TIPS_CODIGO = t.TIPS_CODIGO"
                    . " INNER JOIN estado_report AS estr "
                    . " ON rep.ESTR_CODIGO = estr.ESTR_CODIGO"
                    . " INNER JOIN talonario_report AS tr "
                    . " ON rep.TALR_ID = tr.TALR_ID"
                    . " INNER JOIN razon_social AS rs "
                    . " ON rep.RAZ_CODIGO = rs.RAZ_CODIGO"
                    . " INNER JOIN personal AS per "
                    . " ON rep.PER_RUT = per.PER_RUT"
                    . " WHERE MONTH(REP_FECHA)=".$mes." AND YEAR(REP_FECHA)=".$year." AND rep.TIPS_CODIGO=".$tips."  AND rep.REP_ACCION='Retiro' AND rs.RAZ_RUT='".$rsrut."'";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cantidad"           =>$row["cantrep"],
                                        "suma"               =>$row["sumaman"]
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
        
      public function BusquedaClienteFULLRep($cod){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM razon_social AS r "
             . " INNER JOIN contacto AS c "
             . " ON r.RAZ_CODIGO = c.RAZ_CODIGO"
             . " INNER JOIN tipo_usuario AS tusu "
             . " ON r.TIP_CODIGO = tusu.TIP_CODIGO"
             . " INNER JOIN estado_usuario AS est "
             . " ON c.EST_CODIGO = est.EST_CODIGO"
             . " INNER JOIN sexo AS sx "
             . " ON c.SEX_CODIGO = sx.SEX_CODIGO"
             . " INNER JOIN cliente_servicio AS s "
             . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
             . " INNER JOIN tipo_servicio AS tser "
             . " ON s.TIPS_CODIGO = tser.TIPS_CODIGO"
             . " WHERE r.RAZ_CODIGO=".$cod;
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //Codigos PK->FK
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
                                        "tips"           =>$row["TIPS_CODIGO"],
                            //contacto
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"           =>$row["CON_CARGO"],
                            		"obsc"           =>$row["CON_OBS"],
                            //razon Social
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
	                                "rutrs"           =>$row["RAZ_RUT"],
                                        "nomrs"           =>$row["RAZ_NOMBRE"],
					"dirers"          =>$row["RAZ_DIRECCION"],
					"emars"           =>$row["RAZ_CORREO"],
					"ciurs"           =>$row["RAZ_CIUDAD"],
					"fonors"          =>$row["RAZ_TELEFONO"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                            //Servicios
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                                        "vale"            =>$row["CSER_VALORENTREGA"],
					"valr"           =>$row["CSER_VALORRETIRO"],
                            //sexo
                                        "sexo"            =>$row["SEX_NOMBRE"],
                            //Estado
                                        "estado"          =>$row["EST_ESTADOUSER"],
                            //tipo
                                        "tipusu"          =>$row["TIP_TIPOUSER"],
                            //tipo_servicio
                                        "tipser"          =>$row["TIPS_NOMBRE"]
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
      
        public function ListarClienteFULLRep(){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM razon_social AS r "
             . " INNER JOIN contacto AS c "
             . " ON r.RAZ_CODIGO = c.RAZ_CODIGO"
             . " INNER JOIN tipo_usuario AS tusu "
             . " ON r.TIP_CODIGO = tusu.TIP_CODIGO"
             . " INNER JOIN estado_usuario AS est "
             . " ON c.EST_CODIGO = est.EST_CODIGO"
             . " INNER JOIN sexo AS sx "
             . " ON c.SEX_CODIGO = sx.SEX_CODIGO"
             . " INNER JOIN cliente_servicio AS s "
             . " ON r.RAZ_CODIGO = s.RAZ_CODIGO"
             . " INNER JOIN tipo_servicio AS tser "
             . " ON s.TIPS_CODIGO = tser.TIPS_CODIGO";
       
          $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //Codigos PK->FK
                                        "cod"            =>$row["CON_CODIGO"],
					"estc"           =>$row["EST_CODIGO"],
                                        "tipc"           =>$row["TIP_CODIGO"],
					"razc"           =>$row["RAZ_CODIGO"],
					"sexc"           =>$row["SEX_CODIGO"],
                                        "tips"           =>$row["TIPS_CODIGO"],
                            //contacto
					"nom"            =>$row["CON_NOMBRE"],
                                        "ape"            =>$row["CON_APELLIDO"],
					"fono"           =>$row["CON_TELEFONO"],
                                        "cel"            =>$row["CON_CELULAR"],
                                        "mail"           =>$row["CON_CORREO"],
                                        "cargo"           =>$row["CON_CARGO"],
                            		"obsc"           =>$row["CON_OBS"],
                            //razon Social
                                        "cven"           =>$row["RAZ_CONDVENTA"],
					"giro"           =>$row["RAZ_GIRO"],
					"efact"          =>$row["RAZ_ENTGFACTURA"],
	                                "rutrs"           =>$row["RAZ_RUT"],
                                        "nomrs"           =>$row["RAZ_NOMBRE"],
					"dirers"          =>$row["RAZ_DIRECCION"],
					"emars"           =>$row["RAZ_CORREO"],
					"ciurs"           =>$row["RAZ_CIUDAD"],
					"fonors"          =>$row["RAZ_TELEFONO"],
                                        "esp"             =>$row["RAZ_ESPECIAL"],
                            //Servicios
                                        "serc"            =>$row["CSER_CODIGO"],
                                        "vbanho"          =>$row["CSER_VALORARRIENDOBANHO"],
					"cbanho"          =>$row["CSER_CANTBANHO"],
					"msemana"         =>$row["CSER_MANTSEMANAL"],
					"fact"            =>$row["CSER_FECHACIERREFACTURA"],
					"vlimpf"          =>$row["CSER_VALORLIMPFOSA"],
                                        "area"            =>$row["CSER_AREA"],
					"otro"            =>$row["CSER_OTROS"],
                                        "obs"             =>$row["CSER_OBS"],
                            //sexo
                                        "sexo"            =>$row["SEX_NOMBRE"],
                            //Estado
                                        "estado"          =>$row["EST_ESTADOUSER"],
                            //tipo
                                        "tipusu"          =>$row["TIP_TIPOUSER"],
                            //tipo_servicio
                                        "tipser"          =>$row["TIPS_NOMBRE"]
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
