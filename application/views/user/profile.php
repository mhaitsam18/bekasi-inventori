<section class="content-header">
    <h1>
        Profile
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <form action="<?= base_url('user/profile') ?>" method="post">
                <input type="hidden" name="id" id="id" value="<?= set_value('id', $user->id) ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control <?= (form_error('username')) ? "is-invalid" : '' ?>" name="username" id="username" value="<?= set_value('username', $user->username) ?>">
                    <?= form_error('username','<div class="invalid-feedback">','</div>') ?>
                </div>
                <div class="form-group">
                    <label for="nama_operator">Nama Lengkap</label>
                    <input type="text" class="form-control <?= (form_error('nama_operator')) ? "is-invalid" : '' ?>" name="nama_operator" id="nama_operator" value="<?= set_value('nama_operator', $user->nama_operator) ?>">
                    <?= form_error('nama_operator','<div class="invalid-feedback">','</div>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</section>