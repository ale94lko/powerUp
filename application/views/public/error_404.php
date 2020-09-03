<?php $theme = $this->session->userdata('theme_setting');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-<?php echo $theme;?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Página de error 404</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('handle'); ?>" class="text-<?php echo $theme == 'dark' ? "light" : "dark";?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Página de error 404</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Ups! Página no encontrada.</h3>
                <p>
                    Lo sentimos, la página no pudo ser encontrada.<br/>
                    Usted puede <a href="<?php echo site_url('handle'); ?>">ir a inicio</a> o navegar por el menú lateral.<br/>
                    Si cree que esto es un error contacte al administrador del sitio, gracias.
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>