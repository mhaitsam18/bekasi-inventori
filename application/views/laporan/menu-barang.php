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
			<?php foreach ($kategori as $row): ?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6" style="margin-bottom: 15px;">
						<a href="<?= base_url('laporan/kartuInventarisBarang/'.$id_kartu_inventaris_barang.'/'.$row->id) ?>" class="btn btn-info btn-lg btn-block">KIB <?= $row->kib ?>(<?= $row->nama ?>)</a>
						
					</div>
					<div class="col-md-3"></div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>