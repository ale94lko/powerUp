<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <b>powerUp</b>
    </div>
    <!-- User name -->
    <div class="lockscreen-name"><?php echo $this->input->cookie('user', TRUE);?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?php echo base_url();?>uploads/photos/<?php
            $user_data = $this->session->userdata('user_data');
            if ($user_data['photo']==1) {
                $key = hash("sha256",$user_data['username'].$user_data['id']);
                echo $key.'.png';
            } else {
                $key = hash("sha256","unknown");
                echo $key.'.png';
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
                <input type="password" name="password" class="form-control" placeholder="Password">

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
        Enter your password to retrieve your session
    </div>
    <div class="text-center">
        <a href="<?php echo site_url('login'); ?>">Or sign in as a different user</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; 2020 <strong>powerUp</strong><br>
        All rights reserved
    </div>
</div>
<!-- /.center -->