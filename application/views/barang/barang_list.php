<section class="content-header">
    <h1>
        Barang
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Barang</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div style="margin-bottom:1em">
        <a href="<?= base_url(); ?>barang/create" class="btn btn-primary">Tambah Barang</a>
        <?php echo anchor(site_url('barang/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        <a href="<?= base_url(); ?>barang/cetak" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</a>
        <!-- Single button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kondisi Barang <?= ($kondisi) ? ": $kondisi" : '' ?><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="kondisi-barang" data-kondisi="" href="#">Semua Kondisi</a></li>
                <li><a class="kondisi-barang" data-kondisi="baik" href="#">Baik</a></li>
                <li><a class="kondisi-barang" data-kondisi="buruk" href="#">Buruk</a></li>
                <li><a class="kondisi-barang" data-kondisi="rusak" href="#">Rusak</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kategori <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="kategori-barang" data-kategori="" href="#">Semua kategori</a></li>
                <?php foreach ($list_kategori as $kategori) : ?>
                    <li><a class="kategori-barang" data-kategori="<?= $kategori->id ?>" href="#"><?= $kategori->nama ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>


    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active" role="presentation">
            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
        </li>
    </ul>
    <div class="box">
        <div class="box-body" id="barang_list">
            <div class="tab-content" id="myTabContent">
                <input type="hidden" id="kondisi" value="<?= $kondisi ?>">
                <input type="hidden" id="kategori_id" value="<?= $kategori_id ?>">
                <div class="tab-pane active table-responsive" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-responsive" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Keterangan</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barangs as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <?php if ($barang['gambar'] == '' || !$barang['gambar']) : ?>
                                            <img src="https://source.unsplash.com/600x400/?<?= $barang['nama_barang'] ?>" style="width: 100px; height: 100px;">
                                        <?php else : ?>
                                            <img src="<?= base_url('assets/img/barang/') . $barang['gambar'] ?>" class="img-thumbnail">
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>