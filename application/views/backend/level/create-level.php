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
                if (isset($level)) {
                    $url = base_url('level/update/' . $level[0]->id_level);
                } else {
                    $url = base_url('level/create');
                }
                ?>
                <form class="form-horizontal" id="form-level" method="post" action="<?= $url ?>" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Level</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= isset($level) ? $level[0]->nama_level : '' ?>" name="nama_level">
                            <input class="form-control" type="hidden" readonly value="<?= isset($level) ? $level[0]->id_level : '' ?>" name="id_level">
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