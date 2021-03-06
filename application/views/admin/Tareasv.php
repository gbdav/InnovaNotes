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
        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Tareas</h1>

        <div class="form-goup" align="center">

            <div class="form-inline">
                <input class="form-control form-control-lg" id="searching" type="text" placeholder="Buscar proyecto..." style="margin:0px auto; display:block;">
            </div>
            <br>
            <!-- data-toggle="modal" data-target="#myModal"
            <button type="button" class="btn btn-success btn-lg">
                <a href="<?php echo base_url("admin/addtareas/") ?><?= encriptar($id) ?>"> Nueva tarea</a>
            </button>-->

            <a href="<?php echo base_url("admin/addtareas/") ?><?= encriptar($id) ?>" class="btn btn-success btn-lg ">
                <span class="icon text-white-50">
                </span>
                <span class="text">Nueva tarea</span>
            </a>
            <br> <br>
            <br>

            <?= $this->session->flashdata('message'); ?>

        </div>


        <div class="row" id="cards">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Proyecto</th>
                        <th scope="col" text="center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="info">
                    <?php
                    $i = 0;
                    if ($t == 0 || $t == null) {
                    ?>
                        <h1>No hay tareas disponibles</h1>
                        <?php
                    } else {
                        foreach ($t as $fila) {
                            $i = $i + 1;

                        ?>

                            <tr>
                                <td scope="row"><?php echo $fila->nombre ?></td>
                                <td><?php echo $fila->des_tareas ?></td>
                                <?php
                                if ($fila->stat_tarea == 0) {
                                    $estado = "warning";
                                    $p = "exclamation";
                                }
                                if ($fila->stat_tarea == 1) {
                                    $estado = "success";
                                    $p = "check";
                                }
                                ?>
                                <td><button type="button" class="btn btn-<?php echo $estado ?> btn-circle"></a><i class="fas fa-<?php echo $p ?>"></i></button></td>
                                <td><?php echo $fila->name ?></td>
                                <td><?php echo $fila->name_project ?></td>
                                <td>
                                    <a href="<?php echo base_url("admin/deltarea/") ?><?= encriptar($fila->id_tarea) ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
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

    <!--Modal crear tareas -->
    <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear tarea</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="pro" method="post" action="<?= base_url('admin/cretareas/'); ?>">
                        <div class="form-group">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe un nombre" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="des_tareas" name="des_tareas" class="form-control form-control-tar" placeholder="Escribe una descripcion" required>
                        </div>
                        <div class="form-group">
                            <LABEL><STRONG>Proyecto:</STRONG></LABEL>
                            <input type="text" id="pro" name="pro" class="form-control form-control-tar" value="<?php echo $id ?>">

                        </div>
                        <?php
                        $querytabla = "SELECT * FROM user WHERE role_id=2";
                        $empleado = $this->db->query($querytabla)->result_array();
                        ?>
                        <DIV class="form-group form-control form-control-tar col col-md-4" action="<?= base_url('admin/get_empleados'); ?>">
                            <LABEL><STRONG>Usuario:</STRONG></LABEL>
                            <SELECT class="form-control" id="id_user" name="id_user">
                                <?php foreach ($empleado as $p) : ?>
                                    <OPTION value="<?= $p['id'] ?>"><?= $p['name'] ?></OPTION>
                                <?php endforeach; ?>
                            </SELECT>

                        </DIV>
                        <div class="modal-footer">
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