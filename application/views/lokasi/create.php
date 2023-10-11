<section class="content-header">
    <h1>
        Tambah data Lokasi
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Lokasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>

    <div class="box">
        <div class="box-body">
            <form action="<?= base_url('lokasi/store') ?>" method="post">
                <div class="form-group">
                    <label for="nama_lokasi">Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat">
                </div>
                <div class="form-group">
                    <label for="id_kecamatan">Kecamatan</label>
                    <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                        <option value="" selected disabled>Pilih Kecamatan</option>
                        <?php foreach ($data_kecamatan as $kecamatan) : ?>
                            <option value="<?= $kecamatan->id ?>"><?= $kecamatan->nama_kecamatan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>

</section>