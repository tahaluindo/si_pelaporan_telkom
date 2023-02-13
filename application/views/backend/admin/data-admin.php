<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Data Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Data Admin</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <a href="<?= base_url('admin/create') ?>" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Data</a>
        <?php echo $this->session->flashdata('msg');
        unset($_SESSION['msg']); ?>
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Data Admin</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover table-responsive" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Level</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Level</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($data_user as $i) : ?>
                            <tr>
                                <td><?= $i->nip; ?></td>
                                <td><?= $i->nama; ?></td>
                                <td><?= $i->kontak; ?></td>
                                <td><?= $i->nama_level; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/update/') . $i->id_user; ?>" class="btn btn-warning" title="EDIT"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url('backend/AdminController/destroy/') . $i->id_user ?>" class="btn btn-danger" title="HAPUS" onclick="javascript: return confirm('anda yakin menghapus data?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>