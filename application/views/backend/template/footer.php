<footer class="page-footer">
    <div class="font-13">2022 © <b>Cyber Lab Sriwijaya</b></div>
    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
</footer>
</div>
</div>
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="<?= base_url() ?>assets/vendors/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="<?= base_url() ?>assets/js/app.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<?php if ($title == 'Dashboard') { ?>
    <script>
        const labels = []
        const datax = []
        getData()
        bindData()

        function getData() {
            var urls = "<?php echo getenv("BASE_URL") ?>" + "get-grafik-tahun/2022"
            $.ajax({
                url: urls,
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $.each(data, function(i, item) {
                        labels.push(item.dis_name);
                        datax.push(item.panjang)
                    });
                    bindData(labels, datax);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(url);
                }
            });
        }

        function bindData(labels, datax) {
            var xValues = labels;
            var yValues = datax;
            var barColors = ["#9A86A4", "#B1BCE6", "#B7E5DD", "#F1F0C0", "#E5CB9F", '#F9CEEE', "#9ADCFF", '#85586F', '#7882A4', '#FF7878', '#6E7582', '#adf7b6', '#65cbe9'];
            e = document.getElementById("bar_chart").getContext("2d");
            new Chart(e, {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Kabupaten Ogan Komering Ulu"
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                let label = data.labels[tooltipItem.index];
                                let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return value + ' KM';

                            }
                        }
                    }
                },
            });
        }
    </script>
<?php } ?>
<!-- Form Validation JS -->
<script src="<?= base_url() ?>assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#form-admin").validate({
        rules: {
            nama: {
                minlength: 2,
                required: !0
            },
            username: {
                required: !0,
                minlength: 2
            },
            nomorhp: {
                required: !0,
                minlength: 5
            },
            alamat: {
                required: !0,
                minlength: 3
            },
            password: {
                minlength: 5
            },
            password_confirmation: {
                minlength: 5,
                equalTo: "#password"
            }
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });

    $("#form-kategori").validate({
        rules: {
            namakategori: {
                minlength: 2,
                required: !0
            },
            deskripsikategori: {
                required: !0,
                minlength: 3
            },
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });

    $("#form-barang").validate({
        rules: {
            namabarang: {
                minlength: 2,
                required: !0
            },
            harga: {
                required: !0,
                minlength: 3
            },
            hargamodal: {
                required: !0,
                minlength: 3
            },
            jumlahtersedia: {
                minlength: 2,
                required: !0
            },
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });
</script>
<!-- Data tables -->
<script src="<?= base_url() ?>assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
        });
    })
    $(document).ready(function() {
        $('#jalan-table').DataTable({
            responsive: true,
            dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"><ip>',
            buttons: [{
                    "extend": 'pdf',
                    "text": '<span class="fa fa-file-pdf-o"> PDF</span>',
                    "className": 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    "extend": 'excel',
                    "text": '<span class="fa fa-file-excel-o"> Excel</span>',
                    "className": 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    "extend": 'print',
                    "text": '<span class="fa fa-print"> Print</span>',
                    "className": 'btn btn-warning',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ]
        });
    });
</script>
</body>

</html>