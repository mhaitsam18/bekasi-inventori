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
                    <a href="<?= site_url('laporan/kelola_barang/' . $id_lokasi . '?periode=triwulan&index=1') ?>" class="btn btn-info btn-lg btn-block">Triwulan 1</a>
                    <a href="<?= site_url('laporan/kelola_barang/' . $id_lokasi . '?periode=triwulan&index=2') ?>" class="btn btn-info btn-lg btn-block">Triwulan 2</a>
                    <a href="<?= site_url('laporan/kelola_barang/' . $id_lokasi . '?periode=triwulan&index=3') ?>" class="btn btn-info btn-lg btn-block">Triwulan 3</a>
                    <a href="<?= site_url('laporan/kelola_barang/' . $id_lokasi . '?periode=triwulan&index=4') ?>" class="btn btn-info btn-lg btn-block">Triwulan 4</a>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</section>