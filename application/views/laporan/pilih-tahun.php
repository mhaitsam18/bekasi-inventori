<section class="content-header">
    <h1>
        Kartu Inventaris Barang
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kartu Inventaris Barang</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="margin-bottom: 15px;">
                    <?php foreach ($data_tahun as $tahun) : ?>
                        <a href="<?= site_url('laporan/kelola_barang/' . $id_lokasi . '?periode=tahunan&index=' . $tahun->tahun) ?>" class="btn btn-info btn-lg btn-block">Tahun <?= $tahun->tahun ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</section>