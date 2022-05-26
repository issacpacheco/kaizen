<?php
namespace nsinfoconsultas;
use conexionbd\mysqlconsultas;

class infoconsultas extends mysqlconsultas{
    public function obtener_mejor_equipo(){
        $qry = "SELECT nombre, puntos FROM equipos ORDER BY puntos DESC LIMIT 1";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_equipo_perteneciente(){
        $qry = "SELECT e.nombre, e.puntos FROM equipos e
                LEFT JOIN usuarios u ON u.id_equipo = e.id
                WHERE e.id = {$_SESSION['id_equipo']}";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_mejor_generdor(){
        $qry = "SELECT nombre, puntos FROM usuarios ORDER BY puntos DESC LIMIT 1";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_mis_puntos(){
        $qry = "SELECT nombre, puntos FROM usuarios WHERE id = {$_SESSION['id_admin']}";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_reporte_ranking($condicion){
        $qry = "SELECT r.id, r.ranking, i.nombre, e.puntos, r.generador FROM ranking r 
                LEFT JOIN ideas i ON i.id = r.id_idea 
                LEFT JOIN equipos e ON e.id = i.id_equipo 
                WHERE {$condicion}
                ORDER BY r.ranking DESC";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_equipos(){
        $qry = "SELECT * FROM equipos";
        $res = $this->consulta($qry);
        return $res;
    }

}


?>