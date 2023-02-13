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
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Mohon untuk memasukkan data yang valid!</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <?php
                if (isset($data_pelanggan)) {
                    $url = base_url('pelanggan/update/' . $data_pelanggan[0]->pelanggan_id);
                } else {
                    $url = base_url('pelanggan/create');
                }
                ?>
                <form class="form-horizontal" id="form-pelanggan" method="post" action="<?= $url ?>" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pelanggan ID</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($data_pelanggan) ? $data_pelanggan[0]->pelanggan_id : '' ?>" name="pelanggan_id">
                            <input class="form-control" type="hidden" readonly value="<?= isset($data_pelanggan) ? $data_pelanggan[0]->pelanggan_id : '' ?>" name="pelanggan_id_old">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($data_pelanggan) ? $data_pelanggan[0]->pelanggan_nama : '' ?>" name="pelanggan_nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($data_pelanggan) ? $data_pelanggan[0]->pelanggan_telepon : '' ?>" name="pelanggan_telepon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="pelanggan_alamat"><?= isset($data_pelanggan) ? $data_pelanggan[0]->pelanggan_alamat : '' ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <button class="btn btn-info" name="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->