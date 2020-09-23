<?php $theme = $this->session->userdata('theme_setting');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-<?php echo $theme;?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Administration</li>
                        <li class="breadcrumb-item active">Logs</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card bg-<?php echo $theme;?>">
                    <div class="card-body">
                        <div class="btn-group float-sm-right">
                            <button type="button" class="btn btn-default btn-sm bg-<?php echo $theme;?>"><a href="<?php echo site_url('handle/index/log/export_pdf'); ?>"><i class="fas fa-file-pdf"></i> Export</a></button>
                            <button type="button" class="btn btn-default btn-sm bg-<?php echo $theme;?>"><a href="<?php echo site_url('handle/index/log'); ?>"><i class="fas fa-retweet"></i> Refresh</a></button>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Ip</th>
                                <th>Time</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($log as $item):
                                    ?>
                                    <tr class="table-flag-gray">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $item['username']; ?></td>
                                        <td><?php echo $item['action']; ?></td>
                                        <td><?php echo $item['ip']; ?></td>
                                        <td><?php echo $item['time']; ?></td>
                                        <td><?php echo $item['date']; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-header -->
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<!-- /.content-wrapper -->
