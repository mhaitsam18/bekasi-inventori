<section class="content-header">
	<h1>
		Histori Pengesahan
		<small>Kecamatan : <?= $kecamatan->nama_kecamatan ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?= base_url('dashboard/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Histori Pengesahan</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="box">
			<div class="box-body">
				<h4>Laporan Inventaris Barang</h4>
				<table class="table table-striped" style="margin-bottom: 20px;">
					<thead>
						<tr>
							<th>Tanggal Laporan</th>
							<th>Tanggal Pengesahan</th>
							<th>Nama Lokasi</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($barang as $b): ?>
							<tr>
								<td><?= cari_tanggal($b->created_at) ?></td>
								<td><?= cari_tanggal($b->updated_at) ?></td>
								<td><?= $b->nama_lokasi ?></td>
								<td><?= $b->alamat ?></td>
								<td>
									<a href="<?= site_url('laporan/kartuInventarisBarang/'.$b->id_kartu_inventaris_barang) ?>" class="btn btn-info">Lihat Detail</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>

				<h4>Laporan Inventaris Ruangan</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Tanggal Laporan</th>
							<th>Tanggal Pengesahan</th>
							<th>Nama Lokasi</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($ruangan as $r): ?>
							<tr>
								<td><?= cari_tanggal($r->created_at) ?></td>
								<td><?= cari_tanggal($r->updated_at) ?></td>
								<td><?= $r->nama_lokasi ?></td>
								<td><?= $r->alamat ?></td>
								<td>
									<a href="<?= site_url('laporan/kartuInventarisRuangan/'.$r->id_kartu_inventaris_ruangan) ?>" class="btn btn-info">Lihat Detail</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>