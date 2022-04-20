<?php
namespace nsproductos;
use conexionbd\mysqlconsultas;

class productos extends mysqlconsultas{
    public function obtener_productos(){
        $qry = "SELECT * FROM productos WHERE estatus = 1";
        $res = $this->consulta($qry);
        return $res;
    }

}


?>