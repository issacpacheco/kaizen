<?php
session_start();
date_default_timezone_set('America/Merida');
setlocale(LC_TIME, 'es_MX.UTF-8');
setlocale(LC_TIME, 'spanish');
setlocale (LC_TIME, "es_ES");
setlocale(LC_MONETARY, 'es_MX');

include_once("bd.php");
include_once("mysql.class.php");
include_once("funciones.class.php");
include_once("crearsesion.class.php");
include_once("productos.class.php");
include_once("PHPExcel.php");