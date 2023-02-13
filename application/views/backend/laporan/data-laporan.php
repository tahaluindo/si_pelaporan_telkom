<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title"><?= $title ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item"><?= $title ?></li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <?php echo $this->session->flashdata('msg');
        unset($_SESSION['msg']); ?>
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title"><?= $title ?></div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover table-responsive" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Pelapor</th>
                            <th>Tanggal Laporan</th>
                            <th>Laporan</th>
                            <th>Status</th>
                            <?php if ($this->data['token']['level'] == '1') { ?>
                                <th></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Pelapor</th>
                            <th>Tanggal Laporan</th>
                            <th>Laporan</th>
                            <th>Status</th>
                            <?php if ($this->data['token']['level'] == '1') { ?>
                                <th></th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($laporan as $i) :
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
                                <td><?= $i->pelanggan_nama; ?></td>
                                <td><?= $i->created_date; ?></td>
                                <td><?= $i->laporan_text; ?></td>
                                <td><span class="badge badge-<?= $badges ?>"><?= $i->laporan_status ?></span></td>
                                <?php if ($this->data['token']['level'] == '1') { ?>
                                    <td>
                                        <?php if ($i->laporan_status == "Menunggu") { ?>
                                            <a href="<?= base_url('laporan/proses/' . $i->laporan_id) ?>" class="btn btn-warning" title="PROSES"><i class="fa fa-pencil"></i></a>
                                            <a href="<?= base_url('laporan/reject/' . $i->laporan_id) ?>" class="btn btn-danger" title="TOLAK" onclick="javascript: return confirm('Anda yakin untuk menolak laporan ini?')"><i class="fa fa-ban"></i></a>
                                        <?php } ?>
                                        <a class="btn btn-info" title="DETAIL"><i class="fa fa-eye text-white"></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>