<section class="content-header">
    <h1>
        Barang <?= $button; ?>
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Barang <?= $button; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varchar">Nama <?php echo form_error('nama') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                </div>

                <!-- <div class="form-group">
                <label for="varchar">Jenis <?php echo form_error('jenis') ?></label>
                <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="<?php echo $jenis; ?>" />
            </div> -->
                <div class="form-group">
                    <label for="varchar">Kode <?php echo form_error('kode') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Kategori <?php echo form_error('kategori_id') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <select name="kategori_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($list_kategori as $lk) : ?>
                            <?php if ($lk->id == $kategori_id) : ?>
                                <option value="<?php echo $lk->id ?>" selected><?php echo $lk->nama ?></option>
                            <?php else : ?>
                                <option value="<?php echo $lk->id ?>"><?php echo $lk->nama ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="int">Kondisi Barang <?php echo form_error('kondisi') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <select name="kondisi" class="form-control">
                        <option value="" selected disabled>Pilih kondisi</option>
                        <option value="baik" <?= ($kondisi == "baik") ? "selected" : ""; ?>>Baik</option>
                        <option value="buruk" <?= ($kondisi == "buruk") ? "selected" : ""; ?>>Buruk</option>
                        <option value="rusak" <?= ($kondisi == "rusak") ? "selected" : ""; ?>>Rusak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="int">Keterangan <?php echo form_error('keterangan') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan Kondisi"><?= $keterangan ?></textarea>
                </div>
                <div class="form-group">
                    <label for="id_lokasi">Lokasi <?php echo form_error('id_lokasi') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <select name="id_lokasi" id="id_lokasi" class="form-control">
                        <option value="" selected disabled>Pilih Lokasi</option>
                        <?php foreach ($list_lokasi as $lokasi) : ?>
                            <?php if ($lokasi->id == $id_lokasi) : ?>
                                <option value="<?= $lokasi->id ?>" selected><?= $lokasi->nama_lokasi ?></option>
                            <?php else : ?>
                                <option value="<?= $lokasi->id ?>"><?= $lokasi->nama_lokasi ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_pengadaan">Tanggal Pengadaan <?php echo form_error('tanggal_pengadaan') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="date" name="tanggal_pengadaan" id="tanggal_pengadaan" class="form-control" value="<?php echo $tanggal_pengadaan; ?>">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar <?php echo form_error('gambar') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</section>