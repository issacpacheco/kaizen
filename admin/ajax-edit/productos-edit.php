<?php
include('../class/allClass.php');

$regresar   = filter_input(INPUT_POST, 'regresar',      FILTER_SANITIZE_SPECIAL_CHARS);
$postload   = filter_input(INPUT_POST, 'returnpage',    FILTER_SANITIZE_SPECIAL_CHARS);
$div        = filter_input(INPUT_POST, 'load',          FILTER_SANITIZE_SPECIAL_CHARS);
$id         = filter_input(INPUT_POST, 'id',            FILTER_SANITIZE_NUMBER_INT);

use nsfunciones\funciones;
use nsproductos\productos;

$fn     = new funciones();
$info   = new productos();


$producto       = $info -> obtener_material($id);

?>

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            Agregar Material/Producto/Equipo/Etc...
        </div>
        <div class="panel-body">
            <form id="frmRegistro">
                <input type="hidden" name="idproducto" id="idproducto" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="form-wrapper col-sm-4">
                        <label>Nombre</label>
                        <div class="form-group">
                            <input type="text" class="form-control validar" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $producto['nombre'][0]; ?>">
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Descripcion</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $producto['descripcion'][0]; ?>">
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Costo</label>
                        <div class="form-group">
                            <input type="text" class="form-control esnumero" name="costo" id="costo" placeholder="Costo" value="<?php echo $producto['costo'][0]; ?>">
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Estatus</label>
                        <div class="form-group">
                            <select name="estatus" id="estatus" class="form-control">
                                <option value="2" selected>Selecciona un estatus</option>
                                <option value="1" <?php if($producto['estatus'][0] == 1){ echo "selected"; }?>>Activo</option>
                                <option value="0" <?php if($producto['estatus'][0] == 0){ echo "selected"; }?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div id="cajongaleria" class="left full border-gris h180 mtop20">
                    <div class="thumbnail relative" id="foto_<?php echo $producto["id"][0] ?>" title="<?php echo $producto["foto"][0]; ?>">                        
                        <img src="images/productos/<?php echo $producto["foto"][0]; ?>" class="responsive" />
                        <div class="portaelimina">
                            <i class="borrarimagen fas fa-trash-alt letraroja font18 pointer" onclick="eliminarImagen('<?php echo $producto['id'][0]; ?>', '<?php echo $producto['foto'][0]; ?>','eliminar-foto-material')" title="Eliminar imagen"></i>
                        </div>
                    </div>
                </div>

                <div class="left full mtop20">
                    <input type="file" name="file" id="file" accept="image/x-png,image/gif,image/jpeg">
                    <div class="upload-area fullimportant nomtop" id="uploadfile">
                        <h1>Arrastra y suelta el archivo aqui<br />O<br />Selecciona el archivo</h1>
                    </div>                
                </div>
                <div class="mright textright">
                    <button type="button" class="btnRegresar right btngral" onclick="saveInfo('productos-edit', 'pr-incentivos', this);">
                        <span class="letrablanca font14">Guardar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


function uploadData(formdata) {
        $.ajax({
            url: '../admin/ajax-save/upload-producto',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                addThumbnail(response);
            }
        });
    }

// Added thumbnail
    function addThumbnail(data) {
        var len = $("#cajongaleria div.thumbnail").length;

        var num = Number(len);
        num = num + 1;
        console.log(data);
        var name = data.name;
        var size = convertSize(data.size);
        var src = data.src;
        var id = data.idfoto;
        var page = "eliminar-foto-material";

        // Creating an thumbnail 
        var thumb = '<div class="thumbnail relative" id="foto_' + id + '">\n\
                     <img src="images/productos/' + name + '" class="responsive" />\n\
                      <div class="portaelimina">\n\
                        <span onclick="eliminarImagen(\'' + id + '\', \'' + name + '\')" class="borrarimagen fas fa-trash-alt letraroja font18 pointer tooltip" title="Eliminar imagen"></span>\n\
                        <i class="borrarimagen fas fa-trash-alt letraroja font18 pointer" onclick="eliminarImagen(\'' + id + '\', \'' + name + '\',\'' + page + '\')" title="Eliminar imagen"></i>\n\
                      </div>\n\
                    </div>';

        $("#cajongaleria").append(thumb);

        $("#uploadfile").html("<h1>Arrastra y suelta el archivo aqui<br />O<br />Selecciona el archivo</h1>");
    }

// Bytes conversion
    function convertSize(size) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (size == 0)
            return '0 Byte';
        var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
        return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

// preventing page from redirecting
    $("html").on("drop", function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

// Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#uploadfile h1").text("Suelta la imagen aqui");
    });

// Drag over
    $('.upload-area, html').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#uploadfile h1").text("Suelta la imagen aqui");
    });

    $('html').on("dragleave", function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#uploadfile").html("<h1>Arrastra y suelta el archivo aqui<br />O<br />Selecciona el archivo</h1>");
    });

// Drop
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();

        $("#uploadfile h1").text("Subiendo imagen....");

        var file = e.originalEvent.dataTransfer.files;
        var idproducto = $("#idproducto").val();
        var fd = new FormData();

        fd.append('file', file[0]);
        fd.append('id', idproducto);

        uploadData(fd);
    });

// Open file selector on div click
    $("#uploadfile").click(function () {
        $("#file").click();
    });

// file selected
    $("#file").change(function () {
        $("#uploadfile h1").text("Subiendo imagen....");
        var fd = new FormData();

        var files = $('#file')[0].files[0];
        var idproducto = $("#idproducto").val();

        fd.append('file', files);
        fd.append('id', idproducto);
        uploadData(fd);
    });


</script>