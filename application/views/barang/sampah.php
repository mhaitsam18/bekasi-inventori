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
                <li><a href="<?= base_url('barang/') ?>">Semua Kondisi</a></li>
                <li><a href="<?= base_url('barang/index/baik') ?>">Baik</a></li>
                <li><a href="<?= base_url('barang/index/buruk') ?>">Buruk</a></li>
                <li><a href="<?= base_url('barang/index/rusak') ?>">Rusak</a></li>
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
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-a-tab" data-toggle="tab" href="#kib-a" role="tab" aria-controls="kib-a" aria-selected="false">KIB A</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-b-tab" data-toggle="tab" href="#kib-b" role="tab" aria-controls="kib-b" aria-selected="false">KIB B</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-c-tab" data-toggle="tab" href="#kib-c" role="tab" aria-controls="kib-c" aria-selected="false">KIB C</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-d-tab" data-toggle="tab" href="#kib-d" role="tab" aria-controls="kib-d" aria-selected="false">KIB D</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-e-tab" data-toggle="tab" href="#kib-e" role="tab" aria-controls="kib-e" aria-selected="false">KIB E</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-f-tab" data-toggle="tab" href="#kib-f" role="tab" aria-controls="kib-f" aria-selected="false">KIB F</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kib-g-tab" data-toggle="tab" href="#kib-g" role="tab" aria-controls="kib-g" aria-selected="false">KIB G</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="lainnya-tab" data-toggle="tab" href="#lainnya" role="tab" aria-controls="lainnya" aria-selected="false">Lainnya</a>
        </li>

    </ul>
    <div class="box">
        <div class="box-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-responsive" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <!-- <th>Kondisi</th> -->
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
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <!-- <td><?= $barang['kondisi']; ?></td> -->
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
                <div class="tab-pane" id="kib-a" role="tabpanel" aria-labelledby="kib-a-tab">
                    <table class="table table-bordered" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kiba as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="kib-b" role="tabpanel" aria-labelledby="kib-b-tab">
                    <table class="table table-bordered" id="example3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kibb as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="kib-c" role="tabpanel" aria-labelledby="kib-c-tab">
                    <table class="table table-bordered" id="example4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kibc as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="kib-d" role="tabpanel" aria-labelledby="kib-d-tab">
                    <table class="table table-bordered" id="example5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kibd as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="kib-e" role="tabpanel" aria-labelledby="kib-e-tab">
                    <table class="table table-bordered" id="example6">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kibe as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="kib-f" role="tabpanel" aria-labelledby="kib-f-tab">
                    <table class="table table-bordered" id="example7">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kibf as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="kib-g" role="tabpanel" aria-labelledby="kib-g-tab">
                    <table class="table table-bordered" id="example8">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis</th> -->
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kibg as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <!-- <td><?= $barang['jenis']; ?></td> -->
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <td><?= $barang['kondisi']; ?></td>
                                    <td><?= $barang['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="lainnya" role="tabpanel" aria-labelledby="lainnya-tab">

                </div>

            </div>
        </div>
    </div>

</section>