    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>plugins/jquery/jquery.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?php echo base_url();?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url();?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url();?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url();?>plugins/chart.js/Chart.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>plugins/jquery-validation/additional-methods.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?php echo base_url();?>plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo base_url();?>plugins/datatables-responsive/js/dataTables.responsive.js"></script>
    <script src="<?php echo base_url();?>plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url();?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url();?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url();?>plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>dist/js/adminlte.js"></script>
    <!-- Ion Slider -->
    <script src="<?php echo base_url();?>plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap slider -->
    <script src="<?php echo base_url();?>plugins/bootstrap-slider/bootstrap-slider.min.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo base_url();?>dist/js/demo.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="<?php echo base_url();?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url();?>plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url();?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?php echo base_url();?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url();?>plugins/chart.js/Chart.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="<?php echo base_url();?>plugins/bootstrap-switch/js/bootstrap-switch.js"></script>

    <!-- PAGE SCRIPTS -->
    <script defer src="<?php echo base_url();?>plugins/fontawesome-free-web/js/all.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            <?php if ($this->session->userdata('view') == 'home') { ?>

                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                };
                var mode      = 'index';
                var intersect = true;
                var $visitorsChart = $('#visitors-chart');
                var visitorsChart  = new Chart($visitorsChart, {
                    data   : {
                        labels  : ['<?php echo $l_month_6; ?>', '<?php echo $l_month_5; ?>', '<?php echo $l_month_4; ?>', '<?php echo $l_month_3; ?>', '<?php echo $l_month_2; ?>', '<?php echo $l_month_1; ?>'],
                        datasets: [{
                            type                : 'line',
                            data                : [ <?php echo $trace_6_t; ?>, <?php echo $trace_5_t; ?>, <?php echo $trace_4_t; ?>, <?php echo $trace_3_t; ?>, <?php echo $trace_2_t; ?>, <?php echo $trace_1_t; ?>],
                            backgroundColor     : 'tansparent',
                            borderColor         : '#007bff',
                            pointBorderColor    : '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill                : false,
                            pointHoverBackgroundColor: '#ced4da',
                            pointHoverBorderColor    : '#ced4da'
                            }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips           : {
                            mode     : mode,
                            intersect: intersect
                        },
                        hover              : {
                            mode     : mode,
                            intersect: intersect
                        },
                        legend             : {
                            display: false
                        },
                        scales             : {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display      : true,
                                    lineWidth    : '4px',
                                    color        : 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks    : $.extend({
                                    beginAtZero : true,
                                    suggestedMax: 200
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display  : true,
                                gridLines: {
                                    display: false
                                },
                                ticks    : ticksStyle
                            }]
                        }
                    }
                });


                var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
                var donutData        = {
                    labels: [
                        <?php
                        foreach ($line as $item):
                            echo "'".$item['name']."',";
                        endforeach;
                        ?>
                    ],
                    datasets: [
                        {
                            data: [
                                <?php
                                    $i=0;
                                    foreach ($line as $item):
                                        if ($i == 0)
                                            echo $item['total'];
                                        else
                                            echo ",".$item['total'];
                                        $i++;
                                    endforeach;
                                ?>
                            ],
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                };
                var donutOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                };
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var donutChart = new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                });
                <?php
                    $datestring = '%Y';
                    $_date = time();
                    $year_1 = mdate($datestring, $_date);
                    $year_2 = $year_1 - 1;
                    $year_3 = $year_1 - 2;
                ?>
                var areaChartData = {
                    labels  : ['<?php echo $l_month_6; ?>', '<?php echo $l_month_5; ?>', '<?php echo $l_month_4; ?>', '<?php echo $l_month_3; ?>', '<?php echo $l_month_2; ?>', '<?php echo $l_month_1; ?>'],
                    datasets: [
                        {
                            label               : '<?php echo $year_2; ?>',
                            backgroundColor     : 'rgba(56,209,80,1)',
                            borderColor         : 'rgba(56,209,80,1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(56,209,80,1)',
                            pointStrokeColor    : '#38d150',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(56,209,80,1)',
                            data                : [<?php echo $date_6_a; ?>, <?php echo $date_5_a; ?>, <?php echo $date_4_a; ?>, <?php echo $date_3_a; ?>, <?php echo $date_2_a; ?>, <?php echo $date_1_a; ?>]
                        },
                        {
                            label               : '<?php echo $year_3; ?>',
                            backgroundColor     : 'rgba(210, 90, 10, 1)',
                            borderColor         : 'rgba(210, 90, 10, 1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(210, 90, 10, 1)',
                            pointStrokeColor    : '#d25a0a',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(210, 90, 10, 1)',
                            data                : [<?php echo $date_6_c; ?>, <?php echo $date_5_c; ?>, <?php echo $date_4_c; ?>, <?php echo $date_3_c; ?>, <?php echo $date_2_c; ?>, <?php echo $date_1_c; ?>]
                        },
                        {
                            label               : '<?php echo $year_1; ?>',
                            backgroundColor     : 'rgba(60,141,188,0.9)',
                            borderColor         : 'rgba(60,141,188,0.8)',
                            pointRadius          : false,
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : [ <?php echo $date_6_i; ?>, <?php echo $date_5_i; ?>, <?php echo $date_4_i; ?>, <?php echo $date_3_i; ?>, <?php echo $date_2_i; ?>, <?php echo $date_1_i; ?>]
                        },
                    ]
                };

                var barChartCanvas = $('#barChart').get(0).getContext('2d');
                var barChartData = jQuery.extend(true, {}, areaChartData);
                var temp0 = areaChartData.datasets[0];
                var temp1 = areaChartData.datasets[1];
                barChartData.datasets[0] = temp1;
                barChartData.datasets[1] = temp0;

                var barChartOptions = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                };

                var barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                });

            <?php }?>

            bsCustomFileInput.init();

            $('#points').ionRangeSlider({
                min     : 0,
                max     : 10,
                from    : 0,
                type    : 'single',
                step    : 1,
                postfix : 'pts',
                prettify: false,
                hasGrid : true
            });
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
                $(this).bootstrapSwitch('onText', 'SI');
                $(this).bootstrapSwitch('offText', 'NO');
            });
            $('#worker').validate({
                rules: {
                    name_1: {
                        required: true,
                        minlength: 3,
                        maxlength: 15,
                        alpha: true
                    },
                    name_2: {
                        maxlength: 15,
                        alpha: true
                    },
                    last_name_1: {
                        required: true,
                        minlength: 3,
                        maxlength: 15,
                        alpha: true
                    },
                    last_name_2: {
                        required: true,
                        minlength: 3,
                        maxlength: 15,
                        alpha: true
                    },
                    ci: {
                        required: true,
                        exactlength: 11,
                        number: true,
                    },
                    address: {
                        required: true,
                        minlength: 10,
                        maxlength: 100
                    },
                    mobile_phone: {
                        maxlength: 12,
                        phone: true
                    },
                    phone: {
                        maxlength: 12,
                        phone: true
                    },
                    other_work: {
                        maxlength: 50,
                        alpha: true
                    },
                    role: {
                        maxlength: 50,
                        alpha: true
                    },
                    department: {
                        maxlength: 50,
                        alpha: true
                    },
                    work_phone: {
                        maxlength: 12,
                        phone: true
                    },
                    profession: {
                        required: true,
                        minlength: 5,
                        maxlength: 50,
                        alpha: true
                    },
                    e_mail: {
                        email: true
                    },
                    web_site: {
                        url: true
                    },
                    social: {
                        maxlength: 50
                    },
                    nickname: {
                        maxlength: 20,
                        alpha: true
                    },
                    politics: {
                        maxlength: 25,
                        alpha: true
                    },
                    religion: {
                        maxlength: 25,
                        alpha: true
                    },
                    other: {
                        maxlength: 100
                    }
                },
                messages: {
                    name_1: {
                        required: "Por favor, rellene este campo.",
                        minlength: "Por favor, no escriba menos de 3 caractéres.",
                        maxlength: "Por favor, no escriba más de 15 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    name_2: {
                        maxlength: "Por favor, no escriba más de 15 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    last_name_1: {
                        required: "Por favor, rellene este campo.",
                        minlength: "Por favor, no escriba menos de 3 caractéres.",
                        maxlength: "Por favor, no escriba más de 15 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    last_name_2: {
                        required: "Por favor, rellene este campo.",
                        minlength: "Por favor, no escriba menos de 3 caractéres.",
                        maxlength: "Por favor, no escriba más de 15 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    ci: {
                        required: "Por favor, rellene este campo.",
                        exactlength: "Por favor, escriba 11 números.",
                        number: "Por favor, escriba solo números."
                    },
                    address: {
                        required: "Por favor, rellene este campo.",
                        minlength: "Por favor, no escriba menos de 10 caractéres.",
                        maxlength: "Por favor, no escriba más de 100 caractéres."
                    },
                    mobile_phone: {
                        maxlength: "Por favor, no escriba más de 12 caractéres.",
                        phone: "Por favor, escriba un número de teléfono válido."
                    },
                    phone: {
                        maxlength: "Por favor, no escriba más de 12 caractéres.",
                        phone: "Por favor, escriba un número de teléfono válido."
                    },
                    other_work: {
                        maxlength: "Por favor, no escriba más de 50 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    role: {
                        maxlength: "Por favor, no escriba más de 50 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    department: {
                        maxlength: "Por favor, no escriba más de 50 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    work_phone: {
                        maxlength: "Por favor, no escriba más de 12 caractéres.",
                        phone: "Por favor, escriba un número de teléfono válido."
                    },
                    profession: {
                        required: "Por favor, rellene este campo.",
                        minlength: "Por favor, no escriba menos de 5 caractéres.",
                        maxlength: "Por favor, no escriba más de 50 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    e_mail: {
                        email: "Por favor, escriba una dirección de correo válida."
                    },
                    web_site: {
                        url: "Por favor, escriba una dirección url válida."
                    },
                    social: {
                        maxlength: "Por favor, no escriba más de 50 caractéres."
                    },
                    nickname: {
                        maxlength: "Por favor, no escriba más de 20 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    politics: {
                        maxlength: "Por favor, no escriba más de 25 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    religion: {
                        maxlength: "Por favor, no escriba más de 25 caractéres.",
                        alpha: "Por favor, escriba solo letras."
                    },
                    other: {
                        maxlength: "Por favor, no escriba más de 25 caractéres."
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
        $(function () {
            //Initialize DataTable
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false
            });

            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
            //Money Euro
            $('[data-mask]').inputmask();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });

        });

        function add_hnn_n() {
            var check = false;
            if ($('#approved').is(':checked')) {
                check = true;
            }
            if (check){
                $('#div_hnn_n').append("<label id=\"l_hnn_n\" for=\"hnn_n\" class=\"col-sm-5 col-form-label\">¿HNN <sup>n</sup>?</label>\n" +
                    "                                <div  id=\"c_hnn_n\" class=\"col-sm-7\">\n" +
                    "                                    <input type=\"checkbox\" name=\"hnn_n\" id=\"hnn_n\" data-bootstrap-switch data-off-color=\"danger\" data-on-color=\"success\" onchange=\"add_bonus();\">\n" +
                    "                                </div>");
                $("#hnn_n").each(function(){
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                    $(this).bootstrapSwitch('onText', 'SI');
                    $(this).bootstrapSwitch('offText', 'NO');
                });
            }
            else {
                $('#l_hnn_n').remove();
                $('#c_hnn_n').remove();
                $('#l_bonus').remove();
                $('#c_bonus').remove();
            }

        }

        function add_bonus() {
            var check = false;
            if ($('#hnn_n').is(':checked')) {
                check = true;
            }
            if (check){
                $('#div_bonus').append("<label id=\"l_bonus\" for=\"support\" class=\"col-sm-5 col-form-label\">Bono </label>\n" +
                    "                                <div id=\"c_bonus\" class=\"col-sm-7\">\n" +
                    "                                    <input type=\"text\" name=\"bonus\" id=\"bonus\"  value=\"<?php echo set_value('bonus'); ?>\" class=\"form-control\" maxlength=\"5\">\n" +
                    "                                </div>");
            }
            else {
                $('#l_bonus').remove();
                $('#c_bonus').remove();
            }

        }

        function check_all(id) {
            var check = false;
            if ($('#permission_group'+id).is(':checked')) {
                check = true;
            }
            $('.check'+id+':first-child > input[type="checkbox"]').prop('checked', check);
        }

        function uncheck(id) {
            var check = false;
            $('#permission_group'+id).prop('checked', check);
        }

        function calc_total() {
            var total = 0;
            var design = $('#design').val();
            var production = $('#production').val();
            var transport = $('#transport').val();
            var electric = $('#electric').val();
            var food = $('#food').val();

            total = design * 1 + production * 1 + transport * 1 + electric * 1 + food * 1;
            $('#total').val(total + ' CUC');
            $('#real').val(total);
        }

        var msg = document.getElementById('msg').innerText;
        var type = document.getElementById('type').innerText;
        if (msg != '') {
            if (type == 'success') {
                toastr.success(msg);
            } else if (type == 'info') {
                toastr.info(msg);
            } else if (type == 'error') {
                toastr.error(msg);
            } else {
                toastr.warning(msg);
            }
        }

        function allow_other_work() {
            var check = false;
            if ($('#allow_other_work').is(':checked')) {
                check = true;
            }
            if (check){
                $('#other_work').removeAttr('disabled');
                $('#role').removeAttr('disabled');
                $('#department').removeAttr('disabled');
                $('#work_phone').removeAttr('disabled');
                $('#section').removeAttr('disabled');
            } else {
                $('#other_work').prop('value', '');
                $('#role').prop('value', '');
                $('#department').prop('value', '');
                $('#work_phone').prop('value', '');
                $('#other_work').prop('disabled', 'disabled');
                $('#role').prop('disabled', 'disabled');
                $('#department').prop('disabled', 'disabled');
                $('#work_phone').prop('disabled', 'disabled');
                $('#section').prop('disabled', 'disabled');
            }
        }
    </script>
</body>
</html>

