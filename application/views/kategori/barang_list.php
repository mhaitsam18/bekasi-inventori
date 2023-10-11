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
    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>

    <div class="box">
        <div class="box-body">
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
    </div>

</section>