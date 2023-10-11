<section class="content-header">
    <h1>
        Transaksi <?= $button; ?>
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Transaksi <?= $button; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varchar">Barang <?php echo form_error('kode_barang') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <select class="form-control" name="kode_barang" id="kode_barang">
                        <option>Pilih Barang</option>
                        <?php foreach ($barang as $item) : ?>
                            <option value="<?= $item->kode ?>" <?= ($kode_barang == $item->kode) ? 'selected' : '' ?>><?= $item->nama ?></option>
                        <?php endforeach ?>
                    </select>
                    <!-- <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" /> -->
                </div>
                <div class="form-group">
                    <label for="varchar">Nomor Anggota <?php echo form_error('nomor_anggota') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="text" class="form-control" name="nomor_anggota" id="nomor_anggota" placeholder="Nomor Anggota" value="<?= ($nomor_anggota) ? $nomor_anggota : $this->session->userdata('nomor_anggota'); ?>" readonly />
                </div>
                <div class="form-group">
                    <label for="jumlah_barang">Jumlah Barang <?php echo form_error('jumlah_barang') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" value="<?= ($jumlah_barang) ? $jumlah_barang : $this->session->userdata('jumlah_barang'); ?>">
                </div>
                <div class="form-group">
                    <label for="datetime">Tanggal Pemakaian <?php echo form_error('tanggal_datang') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="date" class="form-control" name="tanggal_datang" id="tanggal_datang" placeholder="Tanggal Pemakaian" value="<?= date('Y-m-d', strtotime($tanggal_datang)); ?>" />
                </div>
                <div class="form-group">
                    <label for="datetime">Tanggal Pengiriman <?php echo form_error('tanggal_distribusi') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <input type="date" class="form-control" name="tanggal_distribusi" id="tanggal_distribusi" placeholder="Tanggal Pengiriman" value="<?= date('Y-m-d', strtotime($tanggal_distribusi)); ?>" />
                </div>
                <div class="form-group">
                    <label for="datetime">Waktu <?php echo form_error('waktu') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <select class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo $waktu; ?>">
                        <option selected disabled value="">Pilih Waktu</option>
                        <option value="Pagi" <?= ($waktu == 'Pagi') ? 'selected' : '' ?>>Pagi</option>
                        <option value="Siang" <?= ($waktu == 'Siang') ? 'selected' : '' ?>>Siang</option>
                        <option value="Sore" <?= ($waktu == 'Sore') ? 'selected' : '' ?>>Sore</option>
                        <option value="Malam" <?= ($waktu == 'Malam') ? 'selected' : '' ?>>Malam</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="enum">Status <?php echo form_error('status') ?><sup style="color:#f55442;">*wajib diisi</sup></label>
                    <select class="form-control" name="status" id="status">
                        <option>Pilih Status</option>
                        <option value="datang" <?= ($status == 'datang') ? 'selected' : '' ?>>datang</option>
                        <option value="dikirim" <?= ($status == 'dikirim') ? 'selected' : '' ?>>dikirim</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" /> -->
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <!-- <div class="form-group">
            <label for="bap">Surat BAP<sup style="color:#f55442;">*wajib diisi</sup></label>
            <input type="file" class="form-control" name="bap" id="bap">
        </div> -->
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
            </form>

        </div>
    </div>
</section>