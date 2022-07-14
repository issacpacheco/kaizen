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

    public function obtener_listado($id){
        $qry = "SELECT * FROM canjeo_detalle WHERE id_canjeo = $id";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_puntos($id){
        $qry = "SELECT e.id, e.puntos FROM equipos e
                LEFT JOIN canjeo_productos c ON c.id_equipo = e.id 
                WHERE c.id = $id";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_detalle($id){
        $qry = "SELECT * FROM canjeo_detalle WHERE id = $id";
        $res = $this->consulta($qry);
        return $res;
    }

    public function puntos_equipo($id){
        $qry = "SELECT e.id, e.puntos FROM equipos e 
                LEFT JOIN canjeo_productos c ON c.id_equipo = e.id 
                LEFT JOIN canjeo_detalle cd ON cd.id_canjeo = c.id 
                WHERE cd.id = $id";
        $res = $this->consulta($qry);
        return $res;
    }

}


?>