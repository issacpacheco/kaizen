
<?php
include("../class/allClass.php");

use nsproductos\productos;
use nsfunciones\funciones;
$info = new productos();
$fn = new funciones();

$canjes = $info->obtener_canjes();
$ccanjes = $fn->cuentarray($canjes);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <?php echo "Centro de canjes";?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <br>
                <div>
                    <table class="table table-striped table-bordered table-hover" id="tabla">
                        <thead>
                            <tr>
                                <th> Equipo </th>
                                <th> Fecha solicitud </th>
                                <th> Folio de canje </th>
                                <th> <i class="fa fa-pencil"></i> </th>
                                <th> <i class="fa fa-trash"></i> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < $ccanjes; $i++){ ?>
                                <tr>
                                    <td><?php echo $canjes['equipo'][$i]; ?></td>
                                    <td><?php echo $canjes['fecha'][$i]; ?></td>
                                    <td><?php echo $canjes['folio'][$i]; ?></td>
                                    <td><button onclick="universalLoad(this)" data-postload="0" data-returnpage="pr-canjes" data-form="" data-page="productos-canjes-edit" data-carpeta="ajax-edit" data-load="contenedor" data-valores="" data-id="<?php echo $canjes["id"][$i]; ?>" type="submit" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i></button></td>
                                    <td><button onclick="cancelarCanje(<?php echo $canjes['id'][$i]; ?>);" type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i> Cancelar</button></td>
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
    
    function cancelarCanje(id){
        var postpagina = "pr-canjes"
        $.ajax({
            type: "post",
            url: "ajax-delete/cancelar-canjes.php",
            data: {id: id},
            success: function(response){
                window.location.href = "pr-canjes.php";
            }
        })
    }
</script>      