<section class="content-header">
	<?= $this->session->flashdata('pesan'); ?>
</section>
<?php if ($this->session->userdata('hak_akses') == 'kecamatan') : ?>
	<section class="content-header">
		<h1>
			Dashboard
			<small>Kecamatan : <?= $kecamatan->nama_kecamatan ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('dashboard/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content-header">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?= $jumlah_laporan ?></h3>
						<p>Laporan Pengesahan Baru <small>(Belum disahkan)</small></p>
					</div>
					<div class="icon">
						<i class="ion ion-document-text"></i>
					</div>
					<a href="<?= base_url('pengesahan') ?>/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?= $jumlah_riwayat ?></sup></h3>
						<p>Riwayat Pengesahan <small>(Semua Laporan)</small></p>
					</div>
					<div class="icon">
						<i class="ion ion-clock"></i>
					</div>
					<a href="<?= base_url('pengesahan/riwayat') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?= $num_kartu_barang ?></h3>
						<p>Kartu Inventaris Barang <small>(Sudah disahkan)</small></p>
					</div>
					<div class="icon">
						<i class="ion ion-card"></i>
					</div>
					<a href="<?= base_url('pengesahan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?= $num_kartu_ruangan ?></h3>
						<p>Kartu Inventaris Ruangan <small>(Sudah disahkan)</small></p>
					</div>
					<div class="icon">
						<i class="ion ion-card"></i>
					</div>
					<a href="<?= base_url('pengesahan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<h1>
			Notifikasi
		</h1>
		<div class="row">
			<div class="box">
				<div class="box-body">
					<h4>Laporan Inventaris Barang</h4>
					<table class="table table-striped" style="margin-bottom: 20px;">
						<thead>
							<tr>
								<th>Tanggal Laporan</th>
								<th>Nama Lokasi</th>
								<th>Alamat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($barang->result() as $b) : ?>
								<tr>
									<td><?= cari_tanggal($b->updated_at) ?></td>
									<td><?= $b->nama_lokasi ?></td>
									<td><?= $b->alamat ?></td>
									<td>
										<a href="<?= site_url('laporan/kartuInventarisBarang/' . $b->id_kartu_inventaris_barang) ?>" class="btn btn-info">Lihat Detail</a>
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
								<th>Nama Lokasi</th>
								<th>Alamat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($ruangan->result() as $r) : ?>
								<tr>
									<td><?= cari_tanggal($r->updated_at) ?></td>
									<td><?= $r->nama_lokasi ?></td>
									<td><?= $r->alamat ?></td>
									<td>
										<a href="<?= site_url('laporan/kartuInventarisRuangan/' . $r->id_kartu_inventaris_ruangan) ?>" class="btn btn-info">Lihat Detail</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php elseif ($this->session->userdata('hak_akses') == 'admin') : ?>
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control Panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('dashboard/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<!-- Small boxes (Stat box) -->
	<section class="content-header">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?= $num_user ?></h3>
						<p>Jumlah User</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>Barang</h3>
						<p>Baik : <?= $num_barang_baik ?> Buruk : <?= $num_barang_buruk ?> Rusak : <?= $num_barang_rusak ?> </p>
					</div>
					<div class="icon">
						<i class="ion ion-hammer"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?= $num_barang_masuk ?></h3>
						<p>Barang Masuk</p>
					</div>
					<div class="icon">
						<i class="ion ion-log-in"></i>
					</div>
					<a href="#" class="small-box-footer"><?= date('F Y') ?> <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3>Transaksi</h3>
						<p>ditolak : <?= $num_transaksi_ditolak ?> diterima : <?= $num_transaksi_diterima ?> pending : <?= $num_transaksi_pending ?></p>
					</div>
					<div class="icon">
						<i class="ion ion-add"></i>
					</div>
					<a href="#" class="small-box-footer"><?= date('F Y') ?> <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- Small boxes (Stat box) -->
	<section class="content-header">
		<!-- Main row -->
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box">
					<div class="box-body">
						<h4>List Transaksi Pending</h4>

						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Kode Barang</th>
									<th>Nomor Anggota</th>
									<th>Tanggal Datang</th>
									<th>Tanggal Distribusi</th>
									<th>Status</th>
									<th>Waktu</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($transaksi_pending as $row) : ?>
									<tr>
										<th><?= $no++; ?></th>
										<td><?= $row->kode_barang ?></td>
										<td><?= $row->nomor_anggota ?></td>
										<td><?= cari_tanggal($row->tanggal_datang) ?></td>
										<td><?= cari_tanggal($row->tanggal_distribusi) ?></td>
										<td><?= $row->status ?></td>
										<td><?= $row->waktu ?></td>
										<td><a href="" class="btn btn-primary">Lihat</a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php elseif ($this->session->userdata('hak_akses') == 'pengelola') : ?>
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url('dashboard/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content-header">
		<div class="row">
			<div class="box">
				<div class="box-body">
					<h1>
						Notifikasi
					</h1>
					<h4>Laporan Inventaris Barang</h4>
					<table class="table table-striped" style="margin-bottom: 20px;">
						<thead>
							<tr>
								<th>Tanggal Laporan</th>
								<th>Nama Lokasi</th>
								<th>Alamat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($barang->result() as $b) : ?>
								<tr>
									<td><?= cari_tanggal($b->updated_at) ?></td>
									<td><?= $b->nama_lokasi ?></td>
									<td><?= $b->alamat ?></td>
									<td>
										<a href="<?= site_url('laporan/kartuInventarisBarang/' . $b->id_kartu_inventaris_barang) ?>" class="btn btn-info">Lihat Detail</a>
										<a href="<?= site_url('laporan/TutupKartuInventarisBarang/' . $b->id_kartu_inventaris_barang) ?>" class="btn btn-link">Tutup</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>

					<!-- <h4>Laporan Inventaris Ruangan</h4>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Tanggal Laporan</th>
								<th>Nama Lokasi</th>
								<th>Alamat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($ruangan->result() as $r) : ?>
								<tr>
									<td><?= cari_tanggal($r->updated_at) ?></td>
									<td><?= $r->nama_lokasi ?></td>
									<td><?= $r->alamat ?></td>
									<td>
										<a href="<?= site_url('laporan/kartuInventarisRuangan/' . $r->id_kartu_inventaris_ruangan) ?>" class="btn btn-info">Lihat Detail</a>
										<a href="<?= site_url('laporan/TutupKartuInventarisRuangan/' . $r->id_kartu_inventaris_ruangan) ?>" class="btn btn-link">Tutup</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table> -->
				</div>
			</div>
		</div>
	</section>
<?php endif ?>