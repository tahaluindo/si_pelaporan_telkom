<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Form Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Form Admin</li>
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
                if (isset($user)) {
                    $url = base_url('admin/update/' . $user[0]->id_user);
                } else {
                    $url = base_url('admin/create');
                }
                ?>
                <form class="form-horizontal" id="form-admin" method="post" action="<?= $url ?>" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($user) ? $user[0]->nip : '' ?>" name="nip">
                            <input class="form-control" type="hidden" readonly value="<?= isset($user) ? $user[0]->id_user : '' ?>" name="id_user">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($user) ? $user[0]->nama : '' ?>" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="password" type="password" name="password" placeholder="password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="confirm password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($user) ? $user[0]->kontak : '' ?>" name="kontak">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="level">
                                <option disabled>Pilih Level User</option>
                                <?php foreach ($level as $i) { ?>
                                    <option value="<?= $i->id_level ?>"><?= $i->nama_level ?></option>
                                <?php } ?>
                            </select>
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