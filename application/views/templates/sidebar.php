
        <!-- Main Sidebar Container -->
        <?php $theme = $this->session->userdata('theme_setting');?>
        <aside class="main-sidebar sidebar-<?php echo $theme == 'dark' ? "dark-light" : "light-dark";?> elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?php echo base_url();?>dist/img/HNN_logo_<?php echo $theme == 'dark' ? "dark" : "light";?>.png"
                     alt="HNN Logo"
                     style="opacity: .8; position: absolute; margin-top: 2px"
                     width="60px"
                >
                <span class="brand-text font-weight-light" style="margin-left: 70px;">Sistema</span>
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
                                <p>Inicio</p>
                            </a>
                        </li>
                        <?php
                            $permission = $this->session->userdata('permission');
                            $permission_group = $this->session->userdata('permission_group');
                            $perm = TRUE;
                            $cont = count($permission_group);
                            $projects = FALSE;
                            for ($i = 1; $i < $cont ; $i++):
                                $perm = FALSE;
                                if ($i == 1 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item has-treeview <?php if ($this->session->userdata('view') == 'worker' || $this->session->userdata('view') == 'user' || $this->session->userdata('view') == 'trace') {echo "menu-open";} ?>">
                                        <a href="#" class="nav-link <?php if ($this->session->userdata('view') == 'worker' || $this->session->userdata('view') == 'user' || $this->session->userdata('view') == 'trace') {echo "active";} ?>">
                                            <i class="nav-icon fas fa-cog"></i>
                                            <p>
                                                Administración
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <?php
                                            $is_worker = FALSE;
                                            $is_user = FALSE;
                                            $is_trace = FALSE;
                                            foreach ($permission AS $item):
                                                if (($item['id'] == 1 || $item['id'] == 2 || $item['id'] == 3) && !$is_worker):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/worker'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'worker') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Trabajadores</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_worker = TRUE;
                                                endif;
                                                if (($item['id'] == 4 || $item['id'] == 5 || $item['id'] == 6) && !$is_user):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/user'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'user') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Usuarios</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_user = TRUE;
                                                endif;
                                                if (($item['id'] == 7) && !$is_trace):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/trace'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'trace') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Trazas</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_trace = TRUE;
                                                endif;
                                            endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                if (!$projects){
                                    ?>
                                    <li class="nav-item has-treeview <?php if ($this->session->userdata('view') == 'assigned' || $this->session->userdata('view') == 'project' || $this->session->userdata('view') == 'design' || $this->session->userdata('view') == 'communication' || $this->session->userdata('view') == 'production') echo "menu-open"; ?>">
                                        <a href="#" class="nav-link <?php if ($this->session->userdata('view') == 'assigned' || $this->session->userdata('view') == 'project' || $this->session->userdata('view') == 'design' || $this->session->userdata('view') == 'communication' || $this->session->userdata('view') == 'production') echo "active"; ?>">
                                            <i class="nav-icon fas fa-briefcase"></i>
                                            <p>
                                                Proyectos
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="<?php echo site_url('handle/index/project/assigned'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'assigned') echo "active"; ?>">
                                                    <i class="far fa-minus-square nav-icon"></i>
                                                    <p>Proyectos asignados</p>
                                                </a>
                                            </li>
                                            <?php
                                            $is_project = FALSE;
                                            $is_rewiew_design = FALSE;
                                            $is_rewiew_communication = FALSE;
                                            $is_production = FALSE;
                                            foreach ($permission AS $item):
                                                if (($item['id'] == 8 || $item['id'] == 9 || $item['id'] == 10 || $item['id'] == 11 || $item['id'] == 12 || $item['id'] == 13 || $item['id'] == 14 || $item['id'] == 15) && !$is_project):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/project'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'project') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Todos los proyectos</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_project = TRUE;
                                                endif;
                                                if ($item['id'] == 16 && !$is_rewiew_design):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/project/design'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'design') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Revisar diseño</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_rewiew_design = TRUE;
                                                endif;
                                                if ($item['id'] == 17 && !$is_rewiew_communication):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/project/communication'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'communication') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Revisar comunicación</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_rewiew_communication = TRUE;
                                                endif;
                                                if ($item['id'] == 18 && !$is_production):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/project/production'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'production') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Soportes por producir</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_production = TRUE;
                                                endif;
                                            endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                    $projects = TRUE;
                                }
                                if($i == 3 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>handle/index/workshop" class="nav-link <?php if ($this->session->userdata('view') == 'workshop') echo "active"; ?>">
                                            <i class="nav-icon fas fa-hammer"></i>
                                            <p>Talleres de producción</p>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($i == 4 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>handle/index/client" class="nav-link <?php if ($this->session->userdata('view') == 'client') echo "active"; ?>">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>Clientes</p>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($i == 5 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>handle/index/event" class="nav-link <?php if ($this->session->userdata('view') == 'event') echo "active"; ?>">
                                            <i class="nav-icon fas fa-coffee"></i>
                                            <p>Eventos</p>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($i == 6 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>handle/index/support" class="nav-link <?php if ($this->session->userdata('view') == 'support') echo "active"; ?>">
                                            <i class="nav-icon fas fa-shopping-cart"></i>
                                            <p>Soportes</p>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($i == 7 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>handle/index/contest" class="nav-link <?php if ($this->session->userdata('view') == 'contest') echo "active"; ?>">
                                            <i class="nav-icon fas fa-trophy"></i>
                                            <p>Concursos</p>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($i == 8 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item has-treeview <?php if ($this->session->userdata('view') == 'pay' || $this->session->userdata('view') == 'salary') {echo "menu-open";} ?>">
                                        <a href="#" class="nav-link <?php if ($this->session->userdata('view') == 'pay' || $this->session->userdata('view') == 'salary') {echo "active";} ?>">
                                            <i class="nav-icon fas fa-credit-card"></i>
                                            <p>
                                                Pago a trabajadores
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <?php
                                            $is_salary = FALSE;
                                            $is_pay = FALSE;
                                            foreach ($permission AS $item):
                                                if ($item['id'] == 34 && !$is_salary):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/pay/salary'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'salary') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Pago por salario</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_salary = TRUE;
                                                endif;
                                                if ($item['id'] == 35 && !$is_pay):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="<?php echo site_url('handle/index/pay'); ?>" class="nav-link <?php if ($this->session->userdata('view') == 'pay') echo "active"; ?>">
                                                            <i class="far fa-minus-square nav-icon"></i>
                                                            <p>Pago por proyectos</p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $is_pay = TRUE;
                                                endif;
                                            endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                if($i == 9 && $permission_group[$i] == TRUE){
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>handle/index/assistance" class="nav-link <?php if ($this->session->userdata('view') == 'assistance') echo "active"; ?>">
                                            <i class="nav-icon fas fa-calendar"></i>
                                            <p>Asistencia</p>
                                        </a>
                                    </li>
                                    <?php
                                }
                            endfor;
                            if ($perm) {
                                ?>
                                <li class="nav-item has-treeview <?php if ($this->session->userdata('view') == 'project') echo "menu-open"; ?>">
                                    <a href="#" class="nav-link <?php if ($this->session->userdata('view') == 'project') echo "active "; ?>">
                                        <i class="nav-icon fas fa-briefcase"></i>
                                        <p>
                                            Proyectos
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo site_url('handle/index/project/assigned'); ?>" class="nav-link">
                                                <i class="far fa-minus-square nav-icon"></i>
                                                <p>Proyectos asignados</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>handle/index/contest" class="nav-link <?php if ($this->session->userdata('view') == 'contest') echo "active"; ?>">
                                        <i class="nav-icon fas fa-trophy"></i>
                                        <p>Concursos</p>
                                    </a>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>