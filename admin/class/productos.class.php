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

    public function obtener_canjes(){
        $qry = "SELECT c.*, e.nombre AS equipo FROM canjeo_productos c
                LEFT JOIN canjeo_detalle d ON d.id_canjeo = c.id
                LEFT JOIN equipos e ON c.id_equipo = e.id
                WHERE d.estatus = 1 GROUP BY d.id_canjeo";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_lista_canjes($id){
        $qry = "SELECT d.id, p.nombre AS producto, d.cantidad, d.estatus FROM canjeo_detalle d
                LEFT JOIN productos p ON p.id = d.id_producto
                WHERE d.id_canjeo = $id";
        $res = $this->consulta($qry);
        return $res;
    }

}


?>