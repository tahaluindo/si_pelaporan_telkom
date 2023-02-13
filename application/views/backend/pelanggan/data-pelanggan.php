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
        <a href="<?= base_url('pelanggan/create') ?>" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Data</a>
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
                            <th>Pelanggan ID</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Pelanggan ID</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($data_pelanggan as $i) : ?>
                            <tr>
                                <td><?= $i->pelanggan_id; ?></td>
                                <td><?= $i->pelanggan_nama; ?></td>
                                <td><?= $i->pelanggan_telepon; ?></td>
                                <td><?= $i->pelanggan_alamat; ?></td>
                                <td>
                                    <a href="<?= base_url('pelanggan/update/') . $i->pelanggan_id; ?>" class="btn btn-warning" title="EDIT"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url('backend/PelangganController/destroy/') . $i->pelanggan_id ?>" class="btn btn-danger" title="HAPUS" onclick="javascript: return confirm('anda yakin menghapus data?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>