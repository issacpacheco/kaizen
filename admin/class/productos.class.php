<?php
namespace nsproductos;
use conexionbd\mysqlconsultas;

class productos extends mysqlconsultas{
    public function obtener_productos(){
        $qry = "SELECT * FROM productos WHERE estatus = 1";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_material($id){
        $qry = "SELECT  * FROM productos WHERE id = '$id'";
        $res = $this->consulta($qry);
        return $res;
    }

}


?>