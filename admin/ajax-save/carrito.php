<?php
// session_start();
error_log(E_ALL);
$mensaje="";

if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'Agregar':
            $id         = $_POST['id_producto'];
            $nombre     = $_POST['nombre'];
            $descrip    = $_POST['descripcion'];
            $costo      = $_POST['costo'];
            $cantidad   = $_POST['cantidad'];
            if(!isset($_SESSION['carrito'])){
                $listaProductos = array(
                    'id'                => $id,
                    'nombre_producto'   => $nombre,
                    'descripcion'       => $descrip,
                    'costo'             => $costo,
                    'cantidad'          => $cantidad
                );
                $_SESSION['carrito'][0] = $listaProductos;
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () {Swal.fire({html: "Listo!",
                    confirmButtonColor: "#FF7300",
                    background: "#211F20",
                    icon: "success"
                  });';
                echo '}, 1000);</script>';
            }else{
                $idproducto=array_column($_SESSION['carrito'],"id");
                if(in_array($id,$idproducto)){
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () {Swal.fire({
                        icon: "error",
                        confirmButtonColor: "#FF7300",
                        background: "#211F20",
                        html: "<p>Ooops... Este producto ya se encuentra en tu carrito!</p>",
                      });';
                    echo '}, 1000);</script>';
                }else{
                    $NumeroProd=count($_SESSION['carrito']);
                    $listaProductos = array(
                        'id'                => $id,
                        'nombre_producto'   => $nombre,
                        'descripcion'       => $descrip,
                        'costo'             => $costo,
                        'cantidad'          => $cantidad
                    );
                    $_SESSION['carrito'][$NumeroProd] = $listaProductos;
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () {Swal.fire({html: "Listo!",
                        confirmButtonColor: "#FF7300",
                        background: "#211F20",
                        icon: "success"
                        });';
                    echo '}, 1000);</script>';
                }
            }
            //$mensaje = print_r($_SESSION, true);
            
        break;
        case 'Eliminar':
            $id = $_POST['id_producto'];
            foreach($_SESSION['carrito'] as $indice=>$listaProductos){
                if($listaProductos['id'] == $id){
                    echo "<script type='text/javascript'>
                    setTimeout(function () {Swal.fire({
                        html: '¿Esta seguro de eliminar ".$listaProductos['nombre']." de su lista?',
                        background: '#211F20',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#FF7300',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Estoy segura(o)'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: 'ajax-save/eliminar-tour-carrito.php',
                                data: 'id=".$id."&estatus=1',
                                success: function (response) {
                                    Swal.fire({
                                        html: 'El tour ".$listaProductos['nombre']." ha sido eliminado de la lista',
                                        background: '#211F20',
                                        icon: 'success',
                                        confirmButtonColor: '#FF7300',
                                        confirmButtonText: 'Ok'
                                    }).then((confirm) => {
                                        if (confirm.isConfirmed){
                                            reload();
                                        }
                                    })
                                },
                                failure: function (response) {
                                    //----some code here-----//
                                },
                                error: function (response) {
                                    //----some code here-----//
                                }
                            });
                        }
                      });}, 1000);
                      function reload(){
                          location.reload();
                      }
                      </script>";
                }
            }
        break;
        // case 'Modificar':
        //     $id = $_POST['id_producto'];
        //     echo $id;
        //     foreach($_SESSION['carrito'] as $indice=>$listaProductos){
        //         if($listaProductos['id'] == $id){
        //             $adultomod = $_POST['cadultosmod'];
        //             $menoresmod = $_POST['cmenoresmod'];
        //             $cinfantesmod = $_POST['cinfantesmod'];
        //             $totalpxsmod = $_POST['totalpxsmod'];
        //             $llaves = array_keys($_SESSION['carrito'][$indice]);
        //             var_dump($llaves);
        //             $_SESSION['carrito'][$indice][$llaves[4]]=$adultomod;
        //             $_SESSION['carrito'][$indice][$llaves[5]]=$menoresmod;
        //             $_SESSION['carrito'][$indice][$llaves[6]]=$cinfantesmod;
        //             $_SESSION['carrito'][$indice][$llaves[7]]=$totalpxsmod;
        //             $_SESSION["carrito"]=array_values($_SESSION["carrito"]);
                    
        //         }
        //     }
        // break;

    }
    
    //echo $mensaje;
}

/*$id = $_POST['id'];
$modificar = $_POST['btnAccion'];
if($modificar == 'Modificar'){
            echo $id;
            foreach($_SESSION['LISTATOURS'] as $indice=>$listaTours){
                if($listaTours['id'] == $id){
                    $adultomod = $_POST['cadultosmod'];
                    $menoresmod = $_POST['cmenoresmod'];
                    $cinfantesmod = $_POST['cinfantesmod'];
                    $totalpxsmod = $_POST['totalpxsmod'];
                    $remplazo = array('Cadultos' => $adultomod, 'Cmenores' => $menoresmod, 'Cinfantes' => $cinfantesmod, 'totalpxs' => $totalpxsmod);
                    var_dump($remplazo);
                    array_replace($_SESSION['LISTATOURS'][$indice],$remplazo);
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function () {Swal.fire({html: "Listo!",
                        confirmButtonColor: "#FF7300",
                        background: "#211F20",
                        icon: "success"
                      });';
                    echo '}, 1000);</script>';
                }
            }
        }*/
//var_dump($_SESSION['LISTATOURS']);
//$hola=implode($_SESSION['LISTATOURS']);
//echo $hola;
//session_destroy();
?>