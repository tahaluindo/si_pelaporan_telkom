<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>History Laporan</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias laudantium, eligendi veritatis quo voluptatum nisi! Repudiandae cumque fugit harum laboriosam voluptates veniam repellat sequi recusandae, rerum enim, dolores tempora ut!</p>
            </div>
            <div>
                <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.485349126062!2d104.16656811474536!3d-4.124463397001102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e39af6ab6d26c9b%3A0xcd4e7eab46627c9f!2sPT%20Telkom%20Baturaja!5e0!3m2!1sid!2sid!4v1667112811705!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="row mt-5">
            <?php if (isset($_POST['search'])) { ?>
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <a href="" class="btn btn-primary  btn-sm mb-4 mt-2"><i class="fa fa-refresh"></i> Refresh</a>
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no=1;
                            foreach ($laporan as $i) :
                                if ($i->laporan_status === "Menunggu") {
                                    $badges = 'warning';
                                } else if ($i->laporan_status === "Proses") {
                                    $badges = 'info';
                                } else if ($i->laporan_status === "Selesai") {
                                    $badges = 'success';
                                } else {
                                    $badges = 'danger';
                                }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $i->pelanggan_nama; ?></td>
                                <td><?= $i->created_date; ?></td>
                                <td><?= $i->laporan_text; ?></td>
                                <td><?= $i->laporan_status; ?></td>
                            </tr>
                        <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <form action="<?= base_url('report-history') ?>" method="post" class="php-email-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="pelanggan_id" class="form-control" id="pelanggan_id"  placeholder="ID Pelanggan" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="pelanggan_nama" id="pelanggan_nama" placeholder="Nama Pelanggan" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="pelanggan_telepon" class="form-control" id="pelanggan_telepon" placeholder="Telepon Pelanggan" readonly>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="pelanggan_alamat" id="pelanggan_alamat" placeholder="Alamat Pelanggan" readonly>
                            </div>
                        </div>
                        <div class="text-center"><button type="submit" name="search">Search</button></div>
                    </form>
                </div>
            <?php } ?>
            </div>
        </div>
    </section><!-- End Contact Section -->
    <input type="hidden" id="url" value="<?= base_url() ?>">
</main><!-- End #main -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
        check()
        $('#alert').hide();
        $('#pelanggan_id').bind('keyup', function() {
            check()
            var url = $("#url").val() + 'report/get_pelanggan/' + $("#pelanggan_id").val();
            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    var objJSON = JSON.parse(res);
                    if (objJSON.status === 'Failed') {
                        $('#alert').show();
                        $('#alert-message').text(objJSON.message);
                    } else {
                        $('#alert').hide();
                        $(':input[type="submit"]').prop('disabled', false);
                        $('#alert-text').hide();
                        $('#pelanggan_nama').val(objJSON.data.pelanggan_nama)
                        $('#pelanggan_telepon').val(objJSON.data.pelanggan_telepon)
                        $('#pelanggan_alamat').val(objJSON.data.pelanggan_alamat)
                    }
                }
            });
        });
    })

    function check() {
        if ($('#pelanggan_id').val().length == 0 || $('#pelanggan_nama').val().length == 0 || $('#pelanggan_telepon').val().length == 0 || $('#pelanggan_alamat').val().length == 0) {
            $(':input[type="submit"]').prop('disabled', true);
            $('#alert-text').show();
        }
    }
</script>