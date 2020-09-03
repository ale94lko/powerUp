<?php $theme = $this->session->userdata('theme_setting');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-<?php echo $theme;?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Administración</li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card bg-<?php echo $theme;?>">
                    <div class="card-body">
                        <div class="btn-group float-sm-right">
                            <?php
                            $permission = $this->session->userdata('permission');
                            foreach ($permission AS $value):
                                if ($value['id'] == 4) {
                                    ?>
                                    <button type="button" class="btn btn-default btn-sm bg-<?php echo $theme;?>"><a href="<?php echo site_url('handle/index/user/add'); ?>"><i class="fas fa-plus-square"></i> Adicionar</a></button>
                                    <?php
                                }
                            endforeach;
                            ?>
                            <button type="button" class="btn btn-default btn-sm bg-<?php echo $theme;?>"><a href="<?php echo site_url('handle/index/user/export_pdf'); ?>"><i class="fas fa-file-pdf"></i> Exportar</a></button>
                            <button type="button" class="btn btn-default btn-sm bg-<?php echo $theme;?>"><a href="<?php echo site_url('handle/index/user'); ?>"><i class="fas fa-retweet"></i> Actualizar</a></button>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Permisos</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($users as $item):
                                    ?>
                                    <tr class="table-flag-gray">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $item['user']; ?></td>
                                        <td><?php echo $item['name_1'] . " " . $item['name_2'] . " " . $item['last_name_1'] . " " . $item['last_name_2']; ?></td>
                                        <td><?php
                                            foreach ($permission_user as $item2):
                                                if ($item2['id'] == $item['id'])
                                                {
                                                    echo $item2['name'].'<br>';
                                                }
                                            endforeach;
                                            ?></td>
                                        <td style="min-width: 135px;">
                                            <?php
                                            $permission = $this->session->userdata('permission');
                                            foreach ($permission AS $value):
                                                if ($value['id'] == 5) {
                                                    ?>
                                                    <a title="Editar" href="<?php echo site_url('handle/index/user/edit/' . $item['id']); ?>" class="btn btn-<?php echo $theme;?>" role="button">
                                                        <i class="fas fa-edit text-<?php echo $theme == 'dark' ? "light" : "dark";?>"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($value['id'] == 6) {
                                                    ?>
                                                    <button type="button" title="Eliminar" class="btn btn-<?php echo $theme;?>" data-toggle="modal" data-target="#del_<?php echo $item['id']; ?>"><i class="fas fa-trash"></i> </button>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </td>
                                        <div class="modal fade" id="del_<?php echo $item['id']; ?>">
                                            <div class="modal-dialog <?php echo $this->session->userdata('theme_setting');?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class="fas fa-trash"></i> Eliminar</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Seguro que deseas eliminar el usuario perteneciente a <?php echo $item['name_1'] . " " . $item['name_2'] . " " . $item['last_name_1'] . " " . $item['last_name_2']; ?>?</p>
                                                    </div>
                                                    <div class="modal-footer float-sm-right">
                                                        <a class="" href="<?php echo site_url('handle/index/user/delete/' . $item['id']); ?>">
                                                            <button type="button" class="btn btn-primary float-sm-right">Eliminar</button>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-header -->
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->
