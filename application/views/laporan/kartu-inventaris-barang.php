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
				<div class="col text-center">
					<h3>Pemerintahan Kota Bekasi</h3>
					<h4>Kartu Inventaris Barang</h4>
				</div>
				<div class="col-lg-6 text-bold">
					<!-- <img src="<?= site_url('login/qrcode/bekasi.id/4') ?>"> -->
					<img src="<?= site_url('assets/img/logo-kota-bekasi.png') ?>" width="100">
					<div class="row">
						<div class="col-md-3">Nama Lokasi</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= $lokasi->nama_lokasi ?></div>
						<div class="col-md-3">Alamat</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= $lokasi->alamat ?></div>
						<div class="col-md-3">Kecamatan</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= $lokasi->nama_kecamatan ?></div>
						<div class="col-md-3">Tanggal</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= cari_tanggal($lokasi->created_at) ?></div>
						<?php if ($this->input->get('periode')) : ?>
							<div class="col-md-3">Periode</div>
							<div class="col-md-1"> : </div>
							<div class="col-md-8"><?= $this->input->get('periode') . " " . $this->input->get('index') ?></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-6">
				</div>
			</div>
			<?php if ($lokasi->status_pengesahan == 1) : ?>
				<div class="alert alert-success mt-3" role="alert" style="margin-top: 10px" id="hilang1">
					Status Pengesahan : Sudah disahkan
				</div>
				<a href="#" onclick="printKartu()" class="btn btn-primary hilang" id="hilang2"> <i class="fa fa-print"></i> Print </a>
			<?php else : ?>
				<div class="alert alert-danger mt-3" role="alert" style="margin-top: 10px" id="hilang1">
					Status Pengesahan : Belum disahkan
				</div>
			<?php endif ?>

			<table id="" class="table table-bordered tabel" style="margin-bottom: 10px">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Kode Barang</th>
						<th>Jenis</th>
						<th>Kategori</th>
						<th>Lokasi</th>
						<th>Tanggal Pengadaan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($data_barang as $barang) : ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $barang->nama_barang; ?></td>
							<td><?= $barang->kode; ?></td>
							<td><?= $barang->jenis; ?></td>
							<td><?= $barang->nama_kategori; ?></td>
							<td><?= $barang->nama_lokasi; ?></td>
							<td><?= cari_tanggal($barang->tanggal_pengadaan); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-lg-4 text-center text-bold">
					Mengetahui
					<br>
					Staff Pengelola
					<br>
					Bekasi, <?= cari_tanggal($lokasi->created_at) ?>
					<?php if ($lokasi->id_staff) : ?>
						<?php
						$staff = $this->db->get_where('user', ['id' => $lokasi->id_staff])->row();
						?>
						<br>
						<img src="<?= site_url('login/qrcode/' . $staff->username . '/3') ?>">
						<br>
						<?= $staff->nama_operator ?>
					<?php endif ?>
					<br>
					<hr style="margin-top:0;">
				</div>
				<div class="col-lg-4"></div>
				<div class="col-lg-4 text-center text-bold">
					<!-- Mengetahui -->
					<br>
					Bekasi,
					<?php if ($lokasi->kode_pengesahan) : ?>
						<?= cari_tanggal($lokasi->updated_at) ?>
						<br>
						Camat <?= $lokasi->nama_kecamatan ?>
						<br>
						<img src="<?= site_url('login/qrcode/' . $lokasi->kode_pengesahan . '/3') ?>">
					<?php elseif ($this->session->userdata('hak_akses') == 'kecamatan') : ?>
						<br>
						Camat <?= $lokasi->nama_kecamatan ?>
						<br>
						<div class="row" style="padding: 20px">
							<a href="<?= base_url('pengesahan/pengesahanBarang/' . $lokasi->id_kartu_inventaris_barang) ?>" class="btn btn-success"><i class="fa fa-edit"></i> Tandatangani Laporan</a>
						</div>
					<?php else : ?>
						<br>
						Camat <?= $lokasi->nama_kecamatan ?>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
					<?php endif ?>
					<?php if ($lokasi->id_camat) : ?>
						<?php
						$camat = $this->db->get_where('user', ['id' => $lokasi->id_camat])->row();
						?>
						<br>
						<?= $camat->nama_operator ?>
					<?php endif ?>
					<br>
					<!-- <?= $lokasi->nama_operator ?>	 -->
					<hr style="margin-top:0;">
				</div>
			</div>
		</div>
	</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	function printKartu() {}

	$('.hilang').on('click', function() {
		$("#hilang1").hide();
		$("#hilang2").hide();
		$(".tabel").attr('id', '');
		window.print();
	})
</script>