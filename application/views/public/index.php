<?php $theme = $this->session->userdata('theme_setting');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-<?php echo $theme;?>">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inicio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-<?php echo $theme;?>">
                        <span class="info-box-icon bg-<?php echo $theme == 'dark' ? "light" : "dark";?> elevation-1"><i class="fas fa-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Proyectos</span>
                            <span class="info-box-number">
                                <?php echo $projects;?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-<?php echo $theme;?>">
                        <span class="info-box-icon bg-<?php echo $theme == 'dark' ? "light" : "dark";?> elevation-1"><i class="fas fa-piggy-bank"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ganancias</span>
                            <span class="info-box-number">
                                <?php echo $earn;?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-<?php echo $theme;?>">
                        <span class="info-box-icon bg-<?php echo $theme == 'dark' ? "light" : "dark";?> elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Soportes</span>
                            <span class="info-box-number">
                                <?php echo $supports;?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-<?php echo $theme;?>">
                        <span class="info-box-icon bg-<?php echo $theme == 'dark' ? "light" : "dark";?> elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Clientes</span>
                            <span class="info-box-number">
                                <?php echo $clients;?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-<?php echo $theme;?>">
                        <div class="card-header bg-<?php echo $theme == 'dark' ? "light" : "dark";?>">
                            <h3 class="card-title">Líneas de trabajo</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card bg-<?php echo $theme;?>">
                        <div class="card-header bg-<?php echo $theme == 'dark' ? "light" : "dark";?>">
                            <h3 class="card-title">Proyectos</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <?php
            $permission = $this->session->userdata('permission');
            foreach ($permission AS $value):
            if ($value['id'] == 2) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-<?php echo $theme;?>">
                            <div class="card-header bg-<?php echo $theme == 'dark' ? "light" : "dark";?>">
                                <h5 class="card-title">Reporte de uso del sistema</h5>
                                <!--
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">Another action</a>
                                            <a href="#" class="dropdown-item">Something else here</a>
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item">Separated link</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div> -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="position-relative mb-4">
                                            <canvas id="visitors-chart" height="200"></canvas>
                                        </div>
                                        <div class="d-flex flex-row justify-content-end">
                                            <span class="mr-2">
                                                <i class="fas fa-square text-primary"></i> Total de trazas
                                            </span>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Análisis de trazas</strong>
                                        </p>
                                        <?php
                                            $total_trace = $trace_analysis[0]['total'] + $trace_analysis[1]['total'];
                                            $per_1 = ($total_trace > 0) ? round(($trace_analysis[0]['total'] / $total_trace * 100.00), 2) : 0;
                                            $per_2 = ($total_trace > 0) ? round(($trace_analysis[1]['total'] / $total_trace * 100.00), 2) : 0;
                                            $user_active = count($user_analysis);
                                            $user_inactive = $total_user - $user_active;
                                            $per_3 = ($total_user > 0) ? round(($user_active / $total_user * 100.00), 2) : 0;
                                            $per_4 = ($total_user > 0) ? round(($user_inactive / $total_user * 100.00), 2) : 0;
                                        ?>
                                        <div class="progress-group">
                                            <span class="progress-text">Peticiones completadas</span>
                                            <span class="float-right"><b><?php echo $trace_analysis[0]['total']; ?></b>/<?php echo $total_trace; ?></span>
                                            <div class="progress progress-sm">
                                                <div title="<?php echo $per_1; ?>%" class="progress-bar bg-primary" style="width: <?php echo $per_1; ?>%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->

                                        <div class="progress-group">
                                            <span class="progress-text">Accesos denegados</span>
                                            <span class="float-right"><b><?php echo $trace_analysis[1]['total']; ?></b>/<?php echo $total_trace; ?></span>
                                            <div class="progress progress-sm">
                                                <div title="<?php echo $per_2; ?>%" class="progress-bar bg-danger" style="width: <?php echo $per_2; ?>%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text">Usuarios activos</span>
                                            <span class="float-right"><b><?php echo $user_active; ?></b>/<?php echo $total_user; ?></span>
                                            <div class="progress progress-sm">
                                                <div title="<?php echo $per_3; ?>%" class="progress-bar bg-success" style="width: <?php echo $per_3; ?>%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text">Usuarios inactivos</span>
                                            <span class="float-right"><b><?php echo $user_inactive; ?></b>/<?php echo $total_user; ?></span>
                                            <div class="progress progress-sm">
                                                <div title="<?php echo $per_4; ?>%" class="progress-bar bg-warning" style="width: <?php echo $per_4; ?>%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php
            }
            endforeach;
            ?>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
