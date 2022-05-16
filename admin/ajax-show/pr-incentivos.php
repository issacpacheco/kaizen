<?php
include("../class/allClass.php");

use nsproductos\productos;
use nsfunciones\funciones;
$info = new productos();
$fn = new funciones();

$productos = $info->obtener_productos();
$cproductos = $fn->cuentarray($productos);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                Productos
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <button id="idtest" onclick="universalLoad(this)" data-postload="0" data-regresar="pr-incentivos" data-valores="" data-form="" data-page="productos-add" data-carpeta="ajax-add" data-load="contenedor" data-id="" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i> Nuevo </button>
                        
                    </div>
                </div>
                <br>


                <div>
                    <table class="table table-striped table-bordered table-hover" id="tabla">
                        <thead>
                            <tr>
                                <th> Nombre </th>
                                <th> Descripcion </th>
                                <th> Costo </th>
                                <th> <i class="fa fa-pencil"></i> </th>
                                <th> <i class="fa fa-trash"></i> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < $cproductos; $i++){ ?>
                                <tr>
                                    <td><?php echo $productos['nombre'][$i]; ?></td>
                                    <td><?php echo $productos['descripcion'][$i]; ?></td>
                                    <td><?php echo $productos['costo'][$i]; ?></td>
                                    <td><button onclick="universalLoad(this)" data-postload="0" data-returnpage="pr-incentivos" data-form="" data-page="productos-edit" data-carpeta="ajax-edit" data-load="contenedor" data-valores="" data-id="<?php echo $productos["id"][$i]; ?>" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i></button></td>
                                    <td><button type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){	
        $('#tabla').DataTable( {
            "language": { url:"//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"},
            "ordering": true,
            "paging": true,
            "searching": true,
            "info": true,
            "fixedHeader": true,
            "autoFill": false,
            "colReorder": false,
            "fixedColumns": false,
            "responsive": true,
        } );
    });	
</script>  