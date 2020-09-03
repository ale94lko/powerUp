<?php $theme = $this->session->userdata('theme_setting');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-<?php echo $theme;?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar perfil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('handle'); ?>" class="text-<?php echo $theme == 'dark' ? "light" : "dark";?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $item_user = $user_edit[0];
        $user_id = $this->session->userdata('id');
        $attributes = array('role' => 'form', 'id' => 'project');
        $hidden = array('user_id' => $user_id, 'reload' => TRUE);
        echo form_open_multipart('handle/edit', $attributes, $hidden);
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-<?php echo $theme;?>">
                    <div class="card-header bg-<?php echo $theme == 'dark' ? "light" : "dark";?>">
                        <h3 class="card-title">Información</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="user" class="col-sm-5 col-form-label">Usuario *</label>
                                <div class="col-sm-7">
                                    <input type="text" name="user" value="<?php echo validation_errors() != "" ? set_value('user') : $item_user['user'];?>" class="form-control" minlength="3" maxlength="50">
                                </div>
                                <?php
                                if (validation_errors() != "") {
                                    echo "<label class='col-sm-12 col-form-label text-danger'>";
                                    echo form_error('name');
                                    echo "</label>";
                                }
                                ?>
                            </div>
                            <div class="form-group row">
                                <label for="color" class="col-sm-5 col-form-label">Tema </label>
                                <div class="col-sm-7">
                                    <select name="color" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark" style="width: 100%;">
                                    <?php
                                        foreach ($color as $item):
                                            ?>
                                            <option <?php
                                            if (set_value('color') == $item['id']) {
                                                echo "selected='selected'";
                                            }
                                            ?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?> </option>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group float-sm-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo site_url('handle'); ?>" class="btn btn-default">Atrás</a>
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
