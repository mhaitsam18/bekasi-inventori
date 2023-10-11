<section class="content-header">
    <h1>
        Kondisi Barang
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Kondisi Barang</li>
    </ol>
</section>

    <!-- Main content -->
<section class="content">

	<?php echo anchor(site_url('kondisi/excel/'.$kondisi), 'Excel', 'class="btn btn-primary"'); ?>
    <!-- <div style="margin-bottom:1em">
    <a href="<?= base_url(); ?>barang/create" class="btn btn-primary">Tambah Barang</a>
    </div>

    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div> -->

    <div class="box">
        <div class="box-body">
            <table class="table table-bordered" id="example1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barcode</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Kondisi</th>
                    <!-- <th>Aksi</th> -->
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            foreach($barangs as $barang) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td>
                    <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    echo $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128);
                    ?></td>
                    <td><?= $barang['nama'];?></td>
                    <td><?= $barang['jenis'];?></td>
                    <td><?= $barang['kondisi'];?></td>
                    <!-- <td>
                        <a href="<?= base_url(); ?>barang/update/<?= $barang['id'];?>" class="btn btn-primary">Edit</a>
                        <a href="<?= base_url(); ?>barang/delete/<?= $barang['id'];?>" class="btn btn-danger">Hapus</a>
                    </td> -->
                </tr>

            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>

</section>