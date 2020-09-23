<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <?php 
            if ($pdf == 'worker'){                                
                echo '<title> Listado de trabajadores </title>';
            }
            else if ($pdf == 'user') {
                echo '<title> Listado de usuarios </title>';
            }
            else if ($pdf == 'Log') {
                echo '<title> Listado de trazas </title>';
            }
            else if ($pdf == 'support') {
                echo '<title> Listado de soportes </title>';
            }
            else if ($pdf == 'client') {
                echo '<title> Listado de clientes </title>';
            }
            else if ($pdf == 'project') {
                echo '<title> Proyecto </title>';
            }
        ?>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--base css styles-->
        <style>
            
            table{border-collapse:collapse;border-spacing:0}            
            *,*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
            html{font-size:62.5%;-webkit-tap-highlight-color:rgba(0,0,0,0)}
            body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.428571429;color:#333;background-color:#fff}
            .text-center{text-align:center}
            h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-weight:500;line-height:1.1;color:inherit}
            h1 small,h2 small,h3 small,h4 small,h5 small,h6 small,.h1 small,.h2 small,.h3 small,.h4 small,.h5 small,.h6 small,h1 .small,h2 .small,h3 .small,h4 .small,h5 .small,h6 .small,.h1 .small,.h2 .small,.h3 .small,.h4 .small,.h5 .small,.h6 .small{font-weight:normal;line-height:1;color:#999}
            h1,h2,h3{margin-top:20px;margin-bottom:10px}
            h1 small,h2 small,h3 small,h1 .small,h2 .small,h3 .small{font-size:65%}h4,h5,h6{margin-top:10px;margin-bottom:10px}
            h4 small,h5 small,h6 small,h4 .small,h5 .small,h6 .small{font-size:75%}h1,.h1{font-size:36px}h2,.h2{font-size:30px}
            h3,.h3{font-size:24px}
            h4,.h4{font-size:18px}
            h5,.h5{font-size:14px}
            h6,.h6{font-size:12px}
            .page-header{padding-bottom:9px;margin:40px 0 20px;border-bottom:1px solid #eee}
            .container:before,.container:after{display:table;content:" "}
            .container:after{clear:both}
            .container:before,.container:after{display:table;content:" "}
            .container:after{clear:both}
            .row{margin-right:-15px;margin-left:-15px}
            .row:before,.row:after{display:table;content:" "}
            .row:after{clear:both}
            .row:before,.row:after{display:table;content:" "}
            .row:after{clear:both}
            
            table{max-width:100%;background-color:transparent}
            th{text-align:left}
            .table{width:100%;margin-bottom:20px}
            .table>thead>tr>th,.table>tbody>tr>th,.table>tfoot>tr>th,.table>thead>tr>td,.table>tbody>tr>td,.table>tfoot>tr>td{padding:8px;line-height:1.428571429;vertical-align:top;border-top:1px solid #ddd}
            .table>thead>tr>th{vertical-align:bottom;border-bottom:2px solid #ddd}
            .table>caption+thead>tr:first-child>th,.table>colgroup+thead>tr:first-child>th,.table>thead:first-child>tr:first-child>th,.table>caption+thead>tr:first-child>td,.table>colgroup+thead>tr:first-child>td,.table>thead:first-child>tr:first-child>td{border-top:0}
            .table>tbody+tbody{border-top:2px solid #ddd}
            .table .table{background-color:#fff}
            .table-condensed>thead>tr>th,.table-condensed>tbody>tr>th,.table-condensed>tfoot>tr>th,.table-condensed>thead>tr>td,.table-condensed>tbody>tr>td,.table-condensed>tfoot>tr>td{padding:5px}
            .table-bordered{border:1px solid #ddd}
            .table-bordered>thead>tr>th,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>tbody>tr>td,.table-bordered>tfoot>tr>td{border:1px solid #ddd}
            .table-bordered>thead>tr>th,.table-bordered>thead>tr>td{border-bottom-width:2px}
            .table-striped>tbody>tr:nth-child(odd)>td,.table-striped>tbody>tr:nth-child(odd)>th{background-color:#f9f9f9}
            .table-hover>tbody>tr:hover>td,.table-hover>tbody>tr:hover>th{background-color:#f5f5f5}
            table col[class*="col-"]{display:table-column;float:none}
            table td[class*="col-"],table th[class*="col-"]{display:table-cell;float:none}
            
            html {
                min-height: 100%;
                position: relative;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                text-rendering: optimizelegibility;
            }
            body {
                padding-bottom: 0;
                min-height: 100%;
                font-family: 'Open Sans';
                font-size: 13px;
                color: #393939;
                -webkit-font-smoothing: antialiased;
            }

            ::-moz-selection {background: #3e4349; color: #fff; }
            ::selection      {background: #3e4349; color: #fff; }

            [class*="fa-"], [class^="fa-"] {
                display: inline-block;
                text-align: center;
            }
            #main-container {
                padding: 0;
            }
            .container {
                max-width: 100% !important;
            }

            h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
                font-family: 'Open Sans';
            }
            h1, h2, h3, h4, h5, h6 {
                margin: 5px 0;
            }
            h1 {
                font-size: 32px;
                font-weight: normal;
                margin: 13px 0;
            }
            h2 {
                font-size: 26px;
                font-weight: normal;
                margin: 10px 0;
            }
            h3 {
                font-size: 22px;
                font-weight: normal;
                margin: 8px 0;
            }
            h4 {
                font-size: 18px;
                font-weight: normal;
                margin: 7px 0;
            }
            h5 {
                font-size: 15px;
                font-weight: normal;
            }
            h6 {
                font-size: 13px;
                font-weight: normal;
            }

            .blue         {color: #368ee0;}
            .light-blue   {color: #67c2ef;}
            .green        {color: #393;}
            .light-green  {color: #78cd51;}
            .red          {color: #e51400;}
            .light-red    {color: #fa603d;}
            .orange       {color: #f8a31f;}
            .light-orange {color: #fabb3d;}
            .yellow       {color: #ebe810;}
            .pink         {color: #f359a8;}
            .magenta      {color: #a200ff;}
            .lime         {color: #8cbf26;}
            .gray         {color: #aaa;}

            #main-content {
                padding: 10px 20px 20px;
            }
            .page-title > div {
                margin-bottom: 20px;
            }
            .page-title > div h1 {
                font-size: 30px;
                text-shadow: 0 1px 0 rgba(150,150,150,0.6);
            }
            .page-title > div h1 > i {
                width: 35px;
                text-align: center;
            }
            .page-title > div h4 {
                font-size: 14px;
                margin-top: -5px;
                margin-left: 45px;
                color: #999;
                text-shadow: 0 1px 0 rgba(150,150,150,0.15);
            }

            .box {
                margin-bottom: 20px;
            }

            .box .box-title {
                padding: 10px;
            }

            .box .box-title h3 {
                display: inline-block;
                line-height: 20px;
                margin: 0;
                color: #fff;
                white-space: nowrap;
            }
            .box .box-title h3 > i {
                margin-right: 10px;
            }
            .box .box-title .box-tool {
                display: inline-block;
                float: right;
                line-height: 20px;
                white-space: nowrap;
            }
            .box .box-content {
                padding: 10px;
                background: #fff;
            }
            .box .box-content.no-padding {
                padding: 0;
            }

            .table-bordered,
            .table-bordered thead:first-child tr:first-child > th:first-child,
            .table-bordered tbody:first-child tr:first-child > td:first-child,
            .table-bordered tbody:first-child tr:first-child > th:first-child,
            .table-bordered thead:last-child tr:last-child > th:first-child,
            .table-bordered tbody:last-child tr:last-child > td:first-child,
            .table-bordered tbody:last-child tr:last-child > th:first-child,
            .table-bordered tfoot:last-child tr:last-child > td:first-child,
            .table-bordered tfoot:last-child tr:last-child > th:first-child,
            .table-bordered caption + thead tr:first-child th:first-child,
            .table-bordered caption + tbody tr:first-child td:first-child,
            .table-bordered colgroup + thead tr:first-child th:first-child,
            .table-bordered colgroup + tbody tr:first-child td:first-child {
                border-radius: 0!important;
            }
            .table thead > tr > th {
                border-bottom-width: 1px;
            }
            .table.fill-head thead {
                background: #efefef;
                color: #888;
            }

            .table thead > tr > th > a.sort-asc,
            .table thead > tr > th > a.sort-desc {
                display: block;
                position: relative;
                color: #888;
                padding-right: 15px;
            }
            .table thead > tr > th > a.sort-asc:after {
                content: "";
                position: absolute;
                right: 0;
                top: 0;
                width: 0;
                height: 0;
                border-bottom: 7px solid #ccc;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
            }
            .table thead > tr > th > a.sort-desc:before {
                content: "";
                position: absolute;
                right: 0;
                top: 8px;
                width: 0;
                height: 0;
                border-top: 7px solid #ccc;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
            }
            .table thead > tr > th > a.sort-active.sort-asc:after {
                border-bottom-color: #7a80dd;
            }
            .table thead > tr > th > a.sort-active.sort-desc:before {
                border-top-color: #7a80dd;
            }

            .table-flag-blue    {border-left-color: #00bfdd!important;}
            .table-flag-green   {border-left-color: #8dca35!important;}
            .table-flag-red     {border-left-color: #fa5a35!important;}
            .table-flag-orange  {border-left-color: #ffab00!important;}
            .table-flag-yellow  {border-left-color: #fafd1d!important;}
            .table-flag-lime    {border-left-color: #abfd1d!important;}
            .table-flag-pink    {border-left-color: #fd1dc6!important;}
            .table-flag-magenta {border-left-color: #a61dfd!important;}
            .table-flag-gray    {border-left-color: #ccc!important;}
            .table-flag-black   {border-left-color: #444!important;}

        </style>

    </head>
    <body>

        <!-- BEGIN Container -->
        <div class="container" id="main-container">

            <!-- BEGIN Content -->
            <div id="main-content">
                <!-- BEGIN Page Title -->
                <div class="page-title">
                    <div>
                        <?php 
                            if ($pdf == 'worker'){                                
                                echo '<p class="text-center h1">Listado de trabajadores</p>';
                            }
                            else if ($pdf == 'user') {
                                echo '<p class="text-center h1">Listado de usuarios</p>';
                            }
                            else if ($pdf == 'Log') {
                                echo '<p class="text-center h1">Listado de trazas</p>';
                            }
                            else if ($pdf == 'support') {
                                echo '<p class="text-center h1">Listado de soportes</p>';
                            }
                            else if ($pdf == 'client') {
                                echo '<p class="text-center h1">Listado de clientes</p>';
                            }
                            else if ($pdf == 'project') {
                                echo '<p class="text-center h1">Proyecto</p>';
                            }
                        ?>
                    </div>
                </div>
                <!-- END Page Title -->

                <!-- BEGIN Main Content -->

                <div class="row">
                    <?php
                        if ($pdf == 'project') {
                            $data = $detail_project[0];
                            $cont = count($detail_creative);
                            if ($cont > 0)
                            $creative = $detail_creative[0];
                            ?>
                            <!--<div class="col-md-2">
                                <img class="img-responsive img-thumbnail" src="<?php echo base_url();?>img/demo/profile-picture.jpg" alt="Logo" style="border: none;"/>
                                <br/><br/>
                            </div>-->
                            <div class="col-md-8">
                                <table>
                                    <tr>
                                        <td>
                                            <p><span>Cliente: </span><?php echo $data['client_name'];?></p>
                                        </td>
                                        <td style="min-width: 100px"></td>
                                        <td>
                                            <p><span>Evento: </span><?php echo $data['name'];?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><span>Fecha solicitado: </span><?php echo $data['solicited'];?></p>
                                        </td>
                                        <td style="min-width: 100px"></td>
                                        <td>
                                            <p><span>Fecha a entregar: </span><?php echo $data['delivered'];?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><span>Creativo principal: </span><?php 
                                                if ($cont > 0) {
                                                    echo $creative['name_1'];
                                                } else {
                                                    echo "Sin asignar";
                                                }
                                                ?>
                                            </p>
                                        </td>
                                        <td style="min-width: 100px"></td>
                                        <td>
                                            <p><span>Fecha cobrado: </span><?php 
                                            if ($data['payed'] != "0000-00-00") {
                                                    echo $data['payed'];
                                                } else {
                                                    echo "Sin cobrar";
                                                }?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p><span>Observaciones: </span><?php echo $data['other'];?></p>
                                        </td>
                                    </tr>
                                </table>              
                            </div>
                            <?php
                        }
                    ?>
                    <div class="col-md-6">
                        <div class="box box-pink">
                            <div class="box-content">
                                <table class="table fill-head">
                                    <?php 
                                        if ($pdf == 'worker'){                                
                                            ?>    
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nombre y apellidos</th>
                                                    <th>CI</th>
                                                    <th>Dirección</th>
                                                    <th>Profesión</th>
                                                    <th>Línea</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                
                                                    $i = 1;
                                                    foreach ($worker as $item):
                                                        ?>        
                                                        <tr class="table-flag-gray">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $item['name_1'] . " " . $item['name_2'] . " " . $item['last_name_1'] . " " . $item['last_name_2']; ?></td>
                                                            <td><?php echo $item['ci']; ?></td>
                                                            <td><?php echo $item['address']; ?></td>
                                                            <td><?php echo $item['profession']; ?></td>
                                                            <td><?php echo $item['name']; ?></td>
                                                        </tr>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }
                                        else if ($pdf == 'user') {
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Usuario</th>
                                                    <th>Nombre</th>
                                                    <th>Permisos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                
                                                    $i = 1;
                                                    foreach ($user as $item):
                                                        ?>        
                                                        <tr class="table-flag-gray">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $item['user']; ?></td>
                                                            <td><?php echo $item['name_1'] . " " . $item['name_2'] . " " . $item['last_name_1'] . " " . $item['last_name_2']; ?></td>
                                                            <td>
                                                                <?php                                        
                                                                foreach ($permission_user as $item2):
                                                                    if ($item2['id'] == $item['id'])
                                                                    {
                                                                        echo $item2['name'].'<br>';
                                                                    }
                                                                endforeach;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }
                                        else if ($pdf == 'Log') {
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Acción</th>
                                                    <th>Ip</th>
                                                    <th>Hora</th>
                                                    <th>Fecha</th>
                                                    <th>Usuario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($trace as $item):
                                                    ?>        
                                                    <tr class="<?php
                                                        if ($item['type'] == 0 ) {
                                                            echo "table-flag-gray";
                                                        } else {
                                                            echo "table-flag-red";
                                                        } 
                                                    ?>">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $item['action']; ?></td>
                                                        <td><?php echo $item['ip']; ?></td>
                                                        <td><?php echo $item['time']; ?></td>
                                                        <td><?php echo $item['date']; ?></td>
                                                        <td><?php echo $item['user']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }
                                        else if ($pdf == 'support') {
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nombre</th>
                                                    <th>Costo de producción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($support as $item):
                                                    ?>        
                                                    <tr class="table-flag-gray">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $item['name']; ?></td>
                                                        <td><?php echo $item['cost']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }
                                        else if ($pdf == 'client') {
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nombre</th>
                                                    <th>Dirección</th>
                                                    <th>Teléfonos</th>
                                                    <th>Correo</th>
                                                    <th>Sector</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($client as $item):
                                                    ?>        
                                                    <tr class="table-flag-gray">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $item['name']; ?></td>
                                                        <td><?php echo $item['address']; ?></td>
                                                        <td><?php 
                                                            if ($item['mobile_phone'] != NULL && $item['phone'] != NULL) {
                                                                echo $item['mobile_phone'].' | '.$item['phone'];
                                                            } else {
                                                                echo $item['mobile_phone'].''.$item['phone'];
                                                            }
                                                            ?>
                                                        </td>   
                                                        <td><?php echo $item['e_mail']; ?></td>
                                                        <td><?php echo $item['section_name']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }
                                        else if ($pdf == 'project') {
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Soporte solicitado</th>
                                                    <th>Cantidad</th>
                                                    <th>Estado</th>
                                                    <th>Taller de producción</th>
                                                    <th>Responsable</th>
                                                    <th>Costo</th>
                                                    <th>Fecha pago</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $datestring = '%Y-%m-%d';
                                                $_date = time();
                                                $today = mdate($datestring, $_date);
                                                $count = count($project_support);
                                                if ($count > 0) {
                                                    foreach ($project_support as $item):
                                                        ?>        
                                                        <tr class="<?php
                                                            if ($item['progress_id'] == 1 && $item['design_ini'] > $today) {
                                                                echo "table-flag-gray";
                                                            } else if ($item['progress_id'] == 1 && $item['design_end'] <= $today && $data['delivered'] > $today) {
                                                                echo "table-flag-yellow";
                                                            } else if ($item['progress_id'] == 1 && $item['design_end'] <= $today && $data['delivered'] <= $today) {
                                                                echo "table-flag-red";
                                                            } else if ($item['progress_id'] == 1 && $item['design_end'] > $today && $data['delivered'] > $today) {
                                                                echo "table-flag-green";
                                                            } else if ($item['progress_id'] == 2 && $data['delivered'] > $today) {
                                                                echo "table-flag-green";
                                                            } else if ($item['progress_id'] == 2 && $data['delivered'] <= $today) {
                                                                echo "table-flag-red";
                                                            } else if ($item['progress_id'] == 3 && $data['delivered'] > $today) {
                                                                echo "table-flag-green";
                                                            } else if ($item['progress_id'] == 3 && $data['delivered'] <= $today) {
                                                                echo "table-flag-red";
                                                            } else if ($item['progress_id'] == 4) {
                                                                echo "table-flag-blue";
                                                            } 
                                                        ?>">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $item['name']; ?></td>
                                                            <td><?php echo $item['cant']; ?></td>
                                                            <td><?php echo $item['progress_name']; ?></td>
                                                            <td><?php echo $item['workshop_name']; ?></td>
                                                            <td><?php echo $item['name_1'] . " " . $item['last_name_1'] . " " . $item['last_name_2']; ?></td>
                                                            <td><?php echo $item['amount']; ?></td>
                                                            <td><?php echo $item['payed']; ?></td>
                                                        </tr>                                                                                        
                                                        <?php
                                                        $i++;
                                                    endforeach;
                                                } else {
                                                    ?>
                                                        <tr>
                                                            <td colspan="9"><p class="align-right">No hay soportes asignados a este proyecto</p></td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
                                            </tbody>
                                            <?php
                                        }
                                    ?>                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- END Main Content -->

                <footer>
                    <p class="text-center">Copyright © 2020 HNN. Todos los derechos reservados.</p>
                </footer>

                <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
            </div>
            <!-- END Content -->
        </div>
        <!-- END Container -->

    </body>
</html>
