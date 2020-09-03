<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <b>powerUp</b> System
    </div>
    <!-- User name -->
    <div class="lockscreen-name"><?php echo $this->input->cookie('user', TRUE);?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?php echo base_url();?>uploads/photos/<?php
            if ($user_data['photo']==1) {
                echo $ci.'.png';
            } else {
                echo '00000000000.png';
            }
            ?>" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <?php
        $attributes = array('class' => 'lockscreen-credentials');
        $hidden = array('user' => $this->input->cookie('user', TRUE));
        echo form_open('login/timeout', $attributes, $hidden); ?>
            <div class="input-group">
                <input type="password" name="pass" class="form-control" placeholder="contraseña">

                <div class="input-group-append">
                    <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        <!-- /.lockscreen credentials -->
    </div>
    <?php
    if (validation_errors()!= ""){
        echo "<div class='text-center text-danger'>";
        echo validation_errors();
        echo "</div>";
    }
    if ($this->session->userdata('message_type')!= NULL){
        echo "<div class='text-center text-danger'>";
        echo $this->session->userdata('message');
        echo "</div>";
        $array_items = array('message_type', 'message');
        $this->session->unset_userdata($array_items);
    }
    echo form_close();
    ?>

    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        Ingrese su contraseña para recuperar su sesión
    </div>
    <div class="text-center">
        <a href="<?php echo site_url('login'); ?>">Inicie sesión como un usuario diferente</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; 2020 <strong>HNN</strong><br>
        Todos los derechos reservados
    </div>
</div>
<!-- /.center -->