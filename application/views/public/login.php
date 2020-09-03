<body class="hold-transition login-page">

<!-- BEGIN Messages -->
<p id="msg" style="display: none"><?php echo $this->session->userdata('message');?></p>
<p id="type" style="display: none"><?php echo $this->session->userdata('message_type');?></p>
<?php
if ($this->session->userdata('message_type') != NULL) {
    $array_items = array('message_type', 'message');
    $this->session->unset_userdata($array_items);
}
?>
<!-- END Messages -->

<div class="login-box">
    <div class="login-logo">
        <span class="oi" data-glyph="fa " title="icon name" aria-hidden="true"></span><b>powerUp</b> System
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login to start your session</p>

            <?php echo form_open('login'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="user" value="<?php echo set_value('user'); ?>" class="form-control" placeholder="User">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="pass" value="<?php echo set_value('pass'); ?>" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
                <?php
                if (validation_errors()!= ""){
                    echo "<div class='form-text'>";
                    echo "<div class='alert alert-danger'>";
                    echo validation_errors();
                    echo "</div>";
                    echo "</div>";
                }
                echo form_close();
            ?>
            <p class="mt-3 mb-1">
                <a href="<?php echo site_url('login/forgot_password'); ?>">I forgot my password</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>