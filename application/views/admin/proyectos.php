<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<?php
function encriptar($a)
{
    $string = $a;
    $encrypt_method = 'AES-256-CBC';
    $secret_key = 'riju';
    $secret_iv = 'riju';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}
?>

<body>
    <div class="container-fluid">
        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Proyectos</h1>

        <div class="form-goup" align="center">

            <div class="form-inline">
                <input class="form-control form-control-lg" id="searching" type="text" placeholder="Buscar proyecto..." style="margin:0px auto; display:block;">
            </div>
            <br>

            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Nuevo proyecto</button>
            <br> <br>
            <br>

            <?= $this->session->flashdata('message'); ?>

        </div>


        <div class="row" id="cards">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" align="center">Nombre</th>
                        <th scope="col" align="center">Descripción</th>
                        <th scope="col" align="center">Fecha</th>
                        <th scope="col" align="center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="info">
                    <?php
                    $i = 0;
                    if ($p == 0 || $p == null) {
                    ?>
                        <h1>No hay proyectos disponibles</h1>
                        <?php
                    } else {
                        foreach ($p as $fila) {
                            $i = $i + 1;

                        ?>

                            <tr>
                                <td align="center"><?php echo $fila->name_project ?></td>
                                <td align="center"><?php echo $fila->description ?></td>
                                <td align="center"><?php echo $fila->date_ini ?></td>
                                <td align="center">
                                    <a href="<?= base_url("admin/tareas/") ?><?= encriptar($fila->id) ?>" class="btn btn-facebook btn-circle" data-toggle="tooltip" data-placement="bottom" title="Tareas">
                                        <i class="fas fa-sticky-note"></i>
                                    </a>
                                    <a href="<?= base_url("admin/updatepro/") ?><?= encriptar($fila->id) ?>" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo base_url("admin/delproyecto/") ?><?= encriptar($fila->id) ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <br>
        <br>
        <br>
        <br>
    </div>

    <script>
        $(document).ready(function() {
            $("#searching").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#info tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" align="center">
                        <h4 class="modal-title">Crear Proyecto</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="pro" method="post" action="<?= base_url('admin/creproyecto/'); ?>">
                        <div class="form-group">
                            <label> &nbsp;&nbsp;&nbsp;<i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>Nombre del proyecto</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe un nombre" required>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;&nbsp;&nbsp; <i class="far fa-file-alt">&nbsp;&nbsp;&nbsp;</i>Descripción</label>
                            <input type="text" id="description" name="description" class="form-control form-control-pro" placeholder="Escribe una descripcion" required>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                            <button type="button" data-dismiss="modal" class="btn btn-danger">
                                Cerrar
                            </button>
                            <button type="submit" class="btn btn-success ">
                                Aceptar
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>