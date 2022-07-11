<?php
include('../class/allClass.php');

$puntos = filter_input(INPUT_POST, 'puntos', FILTER_SANITIZE_NUMBER_INT);

$_SESSION['puntos'] = $puntos;