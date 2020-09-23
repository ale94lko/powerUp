
        <!-- Main Sidebar Container -->
        <?php //$theme = $this->session->userdata('theme_setting');?>
        <aside class="main-sidebar sidebar-dark-light<?php //echo $theme == 'dark' ? "dark-light" : "light-dark";?> elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?php echo base_url();?>dist/img/favicon.png"
                     alt="Logo"
                     style="opacity: .8; position: absolute; margin-left: 13px"
                     width="30px"
                >
                <span class="brand-text font-weight-light" style="margin-left: 50px;"><strong>powerUp</strong></span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?php echo base_url();?>handle" class="nav-link <?php if ($this->session->userdata('view') == 'home' || $this->session->userdata('view') == 'edit_profile') echo "active"; ?>">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <?php
                            $permission = $this->session->userdata('permission');
                            $permission_group = $this->session->userdata('permission_group');
                            $cont = count($permission_group);
                            $projects = FALSE;
                            for ($i = 1; $i < $cont ; $i++):
                                $perm = FALSE;
                                if ($i == 1 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item has-treeview <?php if ($this->session->userdata('view') == 'user' || $this->session->userdata('view') == 'log') {echo "menu-open";} ?>">
                                        <a href="#" class="nav-link <?php if ($this->session->userdata('view') == 'user' || $this->session->userdata('view') == 'log') {echo "active";} ?>">
                                            <i class="nav-icon fas fa-cog"></i>
                                            <p>
                                                Administration
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <?php
                                            $is_user = FALSE;
                                            $is_log = FALSE;
                                            foreach ($permission AS $item):
                                                if (($item['id'] == 1 || $item['id'] == 2 || $item['id'] == 3) && !$is_user):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/user'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'user') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Users</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_user = TRUE;
                                                endif;
                                                if (($item['id'] == 4) && !$is_log):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/log'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'log') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Logs</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_log = TRUE;
                                                endif;
                                            endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }

                            endfor;
                        ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>