<?php $theme = $this->session->userdata('theme_setting');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-<?php echo $theme;?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adicionar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Administración</li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('handle/index/user'); ?>" class="text-<?php echo $theme == 'dark' ? "light" : "dark";?>">Usuarios</a></li>
                        <li class="breadcrumb-item active">Adicionar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $attributes = array('role' => 'form', 'id' => 'user');
        $hidden = array('reload' => TRUE);
        echo form_open_multipart('user/add', $attributes, $hidden);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-<?php echo $theme;?>">
                    <div class="card-header bg-<?php echo $theme == 'dark' ? "light" : "dark";?>">
                        <h3 class="card-title">Datos de usuario</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="user" class="col-sm-5 col-form-label">Usuario *</label>
                            <div class="col-sm-7">
                                <input type="text" name="user" value="<?php echo set_value('user'); ?>" class="form-control" minlength="5" maxlength="15">
                            </div>
                            <?php
                            if (validation_errors() != "") {
                                echo "<label class='col-sm-12 col-form-label text-danger'>";
                                echo form_error('user');
                                echo "</label>";
                            }
                            ?>
                        </div>
                        <div class="form-group row">
                            <label for="pass" class="col-sm-5 col-form-label">Contraseña *</label>
                            <div class="col-sm-7">
                                <input type="password" name="pass" value="<?php echo set_value('pass'); ?>" class="form-control">
                            </div>
                            <?php
                            if (validation_errors() != "") {
                                echo "<label class='col-sm-12 col-form-label text-danger'>";
                                echo form_error('pass');
                                echo "</label>";
                            }
                            ?>
                        </div>
                        <div class="form-group row">
                            <label for="re_password" class="col-sm-5 col-form-label">Repetir contraseña *</label>
                            <div class="col-sm-7">
                                <input type="password" name="re_password" value="<?php echo set_value('re_password'); ?>" class="form-control">
                            </div>
                            <?php
                            if (validation_errors() != "") {
                                echo "<label class='col-sm-12 col-form-label text-danger'>";
                                echo form_error('re_password');
                                echo "</label>";
                            }
                            ?>
                        </div>
                        <div class="form-group row">
                            <label for="worker" class="col-sm-5 col-form-label">Trabajador *</label>
                            <div class="col-sm-7">
                                <select name="worker" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark" style="width: 100%;">
                                    <?php
                                    foreach ($worker as $item):
                                        ?>
                                        <option <?php
                                        if (set_value('line') == $item['id']) {
                                            echo "selected='selected'";
                                        }
                                        ?> value="<?php echo $item['id']; ?>"><?php echo $item['name_1'] . " " . $item['last_name_1'] . " " . $item['last_name_2']; ?> </option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-sm-5 col-form-label">Foto </label>
                            <div class="col-sm-7 input-group">
                                <div class="custom-file">
                                    <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                </div>
                            </div>
                            <?php
                            if (validation_errors() != "") {
                                echo "<label class='col-sm-12 col-form-label text-danger'>";
                                echo form_error('photo');
                                echo "</label>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-<?php echo $theme;?>">
                    <div class="card-header bg-<?php echo $theme == 'dark' ? "light" : "dark";?>">
                        <h3 class="card-title">Preferencias</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="permission" class="col-sm-3 col-form-label">Permisos </label>
                            <div class="col-sm-9">
                                <?php
                                foreach ($permission_group as $value):
                                    ?>
                                    <table>
                                        <div id="accordion">
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="permission_group<?php echo $value['id']; ?>" onchange="check_all(<?php echo $value['id']; ?>);">
                                                    <label for="permission_group<?php echo $value['id']; ?>" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="bg-<?php echo $theme;?>" data-toggle="collapse" data-parent="#accordion" href="#a<?php echo $value['id']; ?>">
                                                    <i class="fas fa-angle-right"></i>
                                                    <?php echo $value['name']; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        </div>
                                    </table>

                                    <div id="a<?php echo $value['id']; ?>" class="panel-collapse collapse in">
                                        <div class="card-body">
                                            <?php
                                            foreach ($permissions as $item):
                                                if ($item['permission_group_id'] == $value['id']){
                                                    ?>
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td width="8%">
                                                                <div class="custom-control custom-checkbox check<?php echo $value['id']; ?>"">
                                                                    <input class="custom-control-input" type="checkbox" id="permissions<?php echo $item['id']; ?>"  name="permissions[]" value="<?php echo $item['id']; ?>" onchange="uncheck(<?php echo $value['id']; ?>);">
                                                                    <label for="permissions<?php echo $item['id']; ?>" class="custom-control-label"></label>
                                                                </div>
                                                            </td>
                                                            <td width="92%">
                                                                <span class="float-left"><?php echo $item['name']; ?></span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group float-sm-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="javascript:history.back();" class="btn btn-default">Atrás</a>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
        <?php
        echo form_close();
        ?>
    </section>
</div>
<!-- /.content-wrapper -->
