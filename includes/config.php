<?php
error_reporting(0);
$conexion = mysqli_connect("localhost","leafseve_kaizen_user","fabricandomarcas","leafseve_kaizen");
mysqli_query($conexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
date_default_timezone_set('America/Mexico_City');
ini_set('memory_limit', '512M');

session_start();
if (!isset($_SESSION['id_admin']))
{
	header("location:login.php");
}

$hoy = date("Y-m-d");
$anio = substr($hoy,0,4);
$hora = date('H:i:s');
$meses = array("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

$title = 'KAIZEN';
$theme = 'theme-blue.css';

$_SESSION['medium_w'] = 300;
$_SESSION['medium_h'] = 300;
$_SESSION['thumb_w'] = 100;
$_SESSION['thumb_h'] = 100;

$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$pos = strrpos($url, '/');
$pagina = $pos === false ? $url : substr($url, $pos + 1);

function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
	$then = mb_strtolower($then, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

function Limpiar($str)
{
	$bom = pack('H*','EFBBBF');
	//$bom = pack('CCC', 0xEF, 0xBB, 0xBF);
    $str = preg_replace("/^$bom/", '', $str);
	$str = str_replace("&quot;","'",$str);
	return $str;
}

function Fecha($f)
{
    $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
	return substr($f,8,2)." de ". $meses[intval(substr($f,5,2))-1]." de ".substr($f,0,4);
}
function FechaEn($f)
{
    $meses = array("january", "february", "march", "april", "may", "june", "july", "august", "september ", "october", "november", "december");
	return substr($f,8,2)." ". $meses[intval(substr($f,5,2))-1]."  ".substr($f,0,4);
}
function FechaCorta($f)
{
    $meses = array("ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic");
	return substr($f,8,2)." ". $meses[intval(substr($f,5,2))-1];
}
function FechaCortaEn($f)
{
    $meses = array("jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec");
	return substr($f,8,2)."th ". $meses[intval(substr($f,5,2))-1];
}
function Mes($mes)
{
	$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
	return $meses[$mes-1];
}
function MesEn($mes)
{
	$meses = array("january", "february", "march", "april", "may", "june", "july", "august", "september ", "october", "november", "december");
	return $meses[$mes-1];
}

function MesCorto($mes)
{
	$meses = array("ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC");
	return $meses[$mes-1];
}
function MesCortoEn($mes)
{
	$meses = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
	return $meses[$mes-1];
}

function Dia($dia)
{
	$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
	return $dias[$dia];
}
function DiaEn($dia)
{
	$dias = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	return $dias[$dia];
}
function HoraCorta($hora)
{
	return date('h:i a', strtotime($hora));
}
function BorrarCarpeta($dir) 
{
	$Res = false;
	if ( file_exists($dir) )
	{
		$dh = opendir($dir);
		while ($file=readdir($dh)) 
		{
			if ($file!="." && $file!="..") 
			{
				$fullpath = $dir."/".$file;
				if (!is_dir($fullpath)) 
				{
					unlink($fullpath);
				} 
				else 
				{
					BorrarCarpeta($fullpath);
				}
			}
		}
		closedir($dh);
		if (rmdir($dir)) 
		{
			$Res = true;
		} 
	}
	return $Res;
}
function tildes($cadena) 
{
	// Tranformamos todo a minusculas
	$cadena = strtolower($cadena);

	//Rememplazamos caracteres especiales latinos
	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
	$repl = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
	$cadena = str_replace ($find, $repl, $cadena);
	return $cadena;

}

function CrearToken()
{
	$length=40;
    $source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890.#-';
    if($length>0)
	{
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++)
		{
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
 
    }
    return $rstr;
}

function CrearPass($length)
{
    $source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890.#';
    if($length>0)
	{
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++)
		{
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
 
    }
    return $rstr;
}

function esArchivo($nombreArchivo, $extensionesPermitidas ) 
{
	$extension = substr(strrchr($nombreArchivo, '.'), 1);
	foreach ($extensionesPermitidas as $extensiones)
	{
		if(!strcasecmp($extension, $extensiones)) 
		{
			return true;
		}
	}
}

function LeerImagenes($path)
{
	$dir = opendir($path);
	while ($elemento = readdir($dir)) 
	{
		if($elemento == '.' || $elemento == '..') {}
		elseif (esArchivo($elemento,array("jpeg", "jpg","png","gif"))) 
		{						
			$elementos[] = $elemento;
		}
	}
	return $elementos;
	closedir($dir); 
}

function urls_amigables($url) 
{
	// Tranformamos todo a minusculas
	$url = strtolower($url);

	//Rememplazamos caracteres especiales latinos
	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
	$repl = array('a', 'e', 'i', 'o', 'u', 'n');
	$url = str_replace ($find, $repl, $url);

	// Añaadimos los guiones
	$find = array(' ', '&', '\r\n', '\n', '+'); 
	$url = str_replace ($find, '-', $url);

	// Eliminamos y Reemplazamos demás caracteres especiales

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '-', '');
	$url = preg_replace ($find, $repl, $url);
	return $url;

}

?>