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
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            <?php echo form_open('login/forgot_password'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
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
                if ($this->session->userdata('message_type')!= NULL){
                    echo "<div class='form-text'>";
                    echo "<div class='alert alert-".$this->session->userdata('message_type')."'>";
                    echo $this->session->userdata('message');
                    echo "</div>";
                    echo "</div>";
                    $array_items = array('message_type', 'message');
                    $this->session->unset_userdata($array_items);
                }
                echo form_close();
            ?>
            <p class="mt-3 mb-1">
                <a href="<?php echo site_url('login'); ?>">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>